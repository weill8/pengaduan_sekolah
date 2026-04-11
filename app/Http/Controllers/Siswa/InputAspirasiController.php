<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Http\Requests\Siswa\StoreAspirasiRequest;
use App\Models\InputAspirasi;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class InputAspirasiController extends Controller
{
    public function create()
    {
        $kategoris = Kategori::all();

        return view('siswa.aspirasi.create', compact('kategoris'));
    }

    // Simpan aspirasi
    public function store(StoreAspirasiRequest $request)
    {
        $fotoPath = null;

        // cek kalo ada foto
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('aspirasi', 'public');
        }
        InputAspirasi::create([
            'nis'         => Auth::guard('siswa')->user()->nis,
            'id_kategori' => $request->id_kategori,
            'lokasi'      => $request->lokasi,
            'ket'         => $request->ket,
            'foto'        => $fotoPath ?? null,
        ]);

        return redirect()->route('siswa.histori.histori')
            ->with('success', 'Aspirasi berhasil dikirim!');
    }

    // Halaman histori aspirasi siswa
    public function histori()
    {
        $aspirasis = InputAspirasi::with(['kategori', 'aspirasi'])
            ->where('nis', Auth::guard('siswa')->user()->nis)
            ->latest()
            ->paginate(10);

        $kategoris = Kategori::all();

        return view('siswa.aspirasi.histori', compact('aspirasis', 'kategoris'));
    }

    // Halaman detail aspirasi (status, feedback, progres)
    public function show(InputAspirasi $inputAspirasi)
    {
        // Pastikan hanya pemilik yang bisa lihat
        abort_if(
            $inputAspirasi->nis !== Auth::guard('siswa')->user()->nis,
            403,
            'Anda tidak memiliki akses ke aspirasi ini.'
        );

        $inputAspirasi->load(['kategori', 'aspirasi.admin']);

        return view('siswa.aspirasi.show', compact('inputAspirasi'));
    }

    public function update(Request $request, $id)
    {
        $data = InputAspirasi::findOrFail($id);

        // cek pemilik
        if ($data->nis !== Auth::guard('siswa')->user()->nis) {
            abort(403);
        }

        // default pakai foto lama
        $fotoPath = $data->foto;

        // kalau upload foto baru
        if ($request->hasFile('foto')) {

            // 🔥 hapus foto lama (jika ada)
            if ($data->foto && Storage::disk('public')->exists($data->foto)) {
                Storage::disk('public')->delete($data->foto);
            }

            // simpan foto baru
            $fotoPath = $request->file('foto')->store('aspirasi', 'public');
        }

        $data->update([
            'id_kategori' => $request->id_kategori,
            'lokasi'      => $request->lokasi,
            'ket'         => $request->ket,
            'foto'        => $fotoPath,
        ]);

        return redirect()->back()->with('success', 'Aspirasi berhasil diupdate');
    }
}
