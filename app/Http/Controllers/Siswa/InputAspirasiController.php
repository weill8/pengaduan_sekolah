<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Http\Requests\Siswa\StoreAspirasiRequest;
use App\Models\InputAspirasi;
use App\Models\Kategori;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        InputAspirasi::create([
            'nis'         => Auth::guard('siswa')->user()->nis,
            'id_kategori' => $request->id_kategori,
            'lokasi'      => $request->lokasi,
            'ket'         => $request->ket,
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

        return view('siswa.aspirasi.histori', compact('aspirasis'));
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
}
