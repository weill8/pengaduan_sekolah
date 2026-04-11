<?php

namespace App\Http\Controllers\Admin\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AkunAdmin\StoreAdminRequest;
use App\Http\Requests\AkunAdmin\UpdateAdminRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AkunAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Admin::query();

        if ($request->filled('search')) {
            $query->where('username', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        $akunAdmins = $query->latest()->paginate(10)->withQueryString();

        return view('super_admin.akun_admin.index', compact('akunAdmins'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAdminRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);

        Admin::create($data);

        return redirect()->route('admin.akunAdmin.index')->with('success', 'Admin berhasil ditambahkan');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAdminRequest $request, Admin $akunAdmin)
    {
        $data = $request->validated();

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $akunAdmin->update($data);

        return redirect()->route('admin.akunAdmin.index')->with('success', 'Admin berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $akunAdmin)
    {
        $akunAdmin->delete();

        return redirect()->route('admin.akunAdmin.index')->with('success', 'Admin berhasil dihapus');
    }
}
