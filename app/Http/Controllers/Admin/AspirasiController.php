<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Aspirasi\FeedbackRequest;
use App\Models\Aspirasi;
use App\Models\InputAspirasi;
use App\Models\Kategori;
use App\Models\Kelas;
use App\Models\Siswa;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AspirasiController extends Controller
{
    public function index(Request $request)
    {
        $query = InputAspirasi::with(['siswa.kelas', 'kategori', 'aspirasi'])
            ->latest();

        $today = Carbon::today();

        // Validasi: tanggal tidak boleh diisi tanpa bulan
        if ($request->filled('tanggal') && !$request->filled('bulan')) {
            return back()->with('error', 'Pilih bulan terlebih dahulu sebelum memilih tanggal');
        }

        if ($request->filled('bulan')) {
            [$tahun, $bulan] = explode('-', $request->bulan);

            $selectedMonth = Carbon::createFromDate((int)$tahun, (int)$bulan, 1)->startOfMonth();

            if ($selectedMonth->gt($today->copy()->startOfMonth())) {
                return back()->with('error', 'Tidak bisa memilih bulan di masa depan');
            }

            // Jika tanggal juga diisi, filter spesifik per hari
            if ($request->filled('tanggal')) {
                $selectedFullDate = Carbon::createFromDate((int)$tahun, (int)$bulan, (int)$request->tanggal);

                if ($selectedFullDate->gt($today)) {
                    return back()->with('error', 'Tidak bisa memilih tanggal di masa depan');
                }

                $query->whereDate('created_at', $selectedFullDate);
            } else {
                // Filter per bulan saja
                $query->whereYear('created_at', $tahun)
                    ->whereMonth('created_at', $bulan);
            }
        }

        // Filter per siswa (NIS) atau nama
        if ($request->filled('search')) {
            $query->whereHas('siswa', function ($q) use ($request) {
                $q->where('nis', 'like', '%' . $request->search . '%')
                    ->orWhere('nama', 'like', '%' . $request->search . '%');
            });
        }

        // Filter per kategori
        if ($request->filled('id_kategori')) {
            $query->where('id_kategori', $request->id_kategori);
        }

        $aspirasi   = $query->paginate(10)->withQueryString();
        $kategoris  = Kategori::orderBy('ket_kategori')->get();
        $siswas     = Siswa::with('kelas')->orderBy('nis')->get();

        return view('admin.aspirasi.index', compact('aspirasi', 'kategoris', 'siswas'));
    }

    /**
     * Tampilkan detail aspirasi + form feedback.
     */
    public function show(InputAspirasi $aspirasi)
    {
        $aspirasi->load(['siswa.kelas', 'kategori', 'aspirasi.admin']);

        return view('admin.aspirasi.show', compact('aspirasi'));
    }

    /**
     * Simpan atau perbarui feedback dan status aspirasi.
     * Jika Aspirasi belum ada, buat baru; jika sudah ada, update.
     */
    public function feedback(FeedbackRequest $request, InputAspirasi $aspirasi): RedirectResponse
    {
        $validated = $request->validated();

        Aspirasi::updateOrCreate(
            ['id_pelaporan' => $aspirasi->id_pelaporan],
            [
                'status'    => $validated['status'],
                'feedback'  => $validated['feedback'],
                'id_admin'  => auth('admin')->id(),
            ]
        );

        return redirect()
            ->route('admin.aspirasi.show', $aspirasi)
            ->with('success', 'Umpan balik berhasil disimpan.');
    }

    /**
     * Update hanya status aspirasi (quick action dari list).
     */
    public function updateStatus(Request $request, InputAspirasi $aspirasi): RedirectResponse
    {
        $request->validate([
            'status' => ['required', 'in:menunggu,proses,selesai'],
        ]);

        Aspirasi::updateOrCreate(
            ['id_pelaporan' => $aspirasi->id_pelaporan],
            [
                'status'   => $request->status,
                'id_admin' => auth('admin')->id(),
            ]
        );

        return back()->with('success', 'Status aspirasi berhasil diperbarui.');
    }

    public function histori(Request $request)
    {
        $query = Siswa::with(['kelas', 'inputAspirasi.aspirasi'])
            ->withCount('inputAspirasi as total_aspirasi')
            ->orderBy('nis');

        // Filter per kelas
        if ($request->filled('id_kelas')) {
            $query->where('id_kelas', $request->id_kelas);
        }

        // Cari berdasarkan NIS
        if ($request->filled('search')) {
            $query->where('nis', 'like', '%' . $request->search . '%')
                ->orWhere('nama', 'like', '%' . $request->search . '%');
        }

        $siswas  = $query->paginate(15)->withQueryString();
        $kelases = Kelas::orderBy('nama_kelas')->get();

        return view('admin.histori.histori', compact('siswas', 'kelases'));
    }

    /**
     * Tampilkan histori aspirasi milik satu siswa tertentu.
     */
    public function historiSiswa(Request $request, Siswa $siswa)
    {
        $siswa->load('kelas');

        $query = InputAspirasi::with(['kategori', 'aspirasi.admin'])
            ->where('nis', $siswa->nis)
            ->latest();

        // Filter per status
        if ($request->filled('status')) {
            $query->whereHas('aspirasi', fn($q) => $q->where('status', $request->status))
                ->orWhere(function ($q) use ($request) {
                    // jika status='menunggu' dan belum ada record di tb_aspirasi
                    if ($request->status === 'menunggu') {
                        $q->whereDoesntHave('aspirasi');
                    }
                });
        }

        // Filter per kategori
        if ($request->filled('id_kategori')) {
            $query->where('id_kategori', $request->id_kategori);
        }

        // Statistik ringkasan
        $stats = [
            'total' => InputAspirasi::where('nis', $siswa->nis)->count(),
            'menunggu' => InputAspirasi::where('nis', $siswa->nis)
                ->where(fn($q) => $q
                    ->whereHas('aspirasi', fn($q2) => $q2->where('status', 'menunggu'))
                    ->orWhereDoesntHave('aspirasi'))
                ->count(),

            'proses' => InputAspirasi::where('nis', $siswa->nis)
                ->whereHas('aspirasi', fn($q) => $q->where('status', 'proses'))
                ->count(),

            'selesai' => InputAspirasi::where('nis', $siswa->nis)
                ->whereHas('aspirasi', fn($q) => $q->where('status', 'selesai'))
                ->count(),
        ];

        $aspirasis = $query->paginate(10)->withQueryString();
        $kategoris = Kategori::orderBy('ket_kategori')->get();

        return view('admin.histori.histori_siswa', compact('siswa', 'aspirasis', 'kategoris', 'stats'));
    }
}
