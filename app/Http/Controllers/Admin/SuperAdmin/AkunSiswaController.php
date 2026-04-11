<?php

namespace App\Http\Controllers\Admin\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AkunSiswa\StoreSiswaRequest;
use App\Http\Requests\AkunSiswa\UpdateSiswaRequest;
use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AkunSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Siswa::with('kelas');
        if ($request->filled('search')) {
            $query->where('nis', 'like', '%' . $request->search . '%')
                ->orWhere('nama', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('id_kelas')) {
            $query->where('id_kelas', $request->id_kelas);
        }

        $kelas = Kelas::select('id', 'nama_kelas')->orderBy('nama_kelas')->get();

        $akunSiswa = $query->latest()->paginate(10)->withQueryString();

        return view('super_admin.akun_siswa.index', compact('akunSiswa', 'kelas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSiswaRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);

        Siswa::create($data);

        return redirect()->route('admin.akunSiswa.index')->with('success', 'Siswa berhasil ditambahkan');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSiswaRequest $request, Siswa $akunSiswa)
    {
        $data = $request->validated();

        if(!empty($data['password'])){
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $akunSiswa->update($data);

        return redirect()->route('admin.akunSiswa.index')->with('success', 'Siswa berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Siswa $akunSiswa)
    {
        $akunSiswa->delete();

        return redirect()->route('admin.akunSiswa.index')->with('success', 'Siswa berhasil dihapus');
    }
}
