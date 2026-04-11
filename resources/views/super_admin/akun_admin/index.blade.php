@extends('layouts.admin')

@section('title', 'Manajemen Akun Admin')

@section('content')

    {{-- Page Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <div class="w-1 h-6 rounded-full bg-gradient-to-b from-indigo-500 to-violet-600"></div>
                <h1 class="text-xl font-bold text-slate-800 tracking-tight">Manajemen Akun Admin</h1>
            </div>
            <p class="text-sm text-slate-400 ml-3">Kelola akun admin yang terdaftar di sistem</p>
        </div>
        <button onclick="document.getElementById('modalTambah').classList.remove('hidden')"
            class="inline-flex items-center gap-2 bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-500 hover:to-violet-500 text-white text-sm font-semibold px-5 py-2.5 rounded-xl shadow-lg shadow-indigo-500/25 transition-all hover:-translate-y-0.5 active:translate-y-0">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>
            Tambah Admin
        </button>
    </div>

    {{-- Search & Filter Bar --}}
    <form method="GET" action="{{ route('admin.akunAdmin.index') }}" class="mb-5 flex flex-wrap items-center gap-2">

        {{-- Search --}}
        <div class="relative flex-1 min-w-[150px]">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>

            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari..."
                class="w-full bg-white border border-slate-200 rounded-xl pl-9 pr-3 py-2 text-sm">
        </div>

        {{-- Filter Role --}}
        <div class="relative w-[140px]">
            <select name="role" onchange="this.form.submit()"
                class="w-full appearance-none bg-white border border-slate-200 rounded-xl pl-4 pr-9 py-2.5 text-sm">
                <option value="">Semua Role</option>
                <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="super_admin" {{ request('role') == 'super_admin' ? 'selected' : '' }}>Super Admin</option>
            </select>

            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                </svg>
            </div>
        </div>

        {{-- Button --}}
        <button type="submit"
            class="flex-1 sm:flex-none flex items-center justify-center gap-1.5 px-4 py-2.5 text-sm font-semibold text-white bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-500 hover:to-violet-500 rounded-xl shadow-lg shadow-indigo-500/25 transition-all hover:-translate-y-0.5">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
            Cari
        </button>

        {{-- Reset --}}
        @if (request('search') || request('role'))
            <a href="{{ route('admin.akunAdmin.index') }}"
                class="inline-flex items-center gap-1.5 px-4 py-2.5 text-sm font-semibold text-slate-500 bg-white border border-slate-200 rounded-xl hover:bg-slate-50 transition-all shadow-sm">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
                Reset
            </a>
        @endif

    </form>

    {{-- Table Card --}}
    <div class="rounded-2xl border border-slate-100 overflow-hidden shadow-sm">

        {{-- Table Header --}}
        <div class="bg-slate-50/80 px-6 py-3.5 border-b border-slate-100 flex items-center gap-2">
            <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Daftar Akun Admin</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead>
                    <tr class="bg-white border-b border-slate-100">
                        <th class="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider text-center w-16">
                            No</th>
                        <th class="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider">Username</th>
                        <th class="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider text-center">
                            Role
                        </th>
                        <th class="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider">Dibuat</th>
                        <th class="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider text-center">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse ($akunAdmins as $index => $admin)
                        <tr class="bg-white hover:bg-indigo-50/30 transition-colors group">
                            <td class="px-6 py-4">
                                <span
                                    class="text-xs font-semibold text-slate-400 bg-slate-100 w-7 h-7 rounded-lg flex items-center justify-center">
                                    {{ $akunAdmins->firstItem() + $index }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-8 h-8 rounded-xl bg-gradient-to-br from-indigo-100 to-violet-100 flex items-center justify-center flex-shrink-0 group-hover:from-indigo-200 group-hover:to-violet-200 transition-colors">
                                        <svg class="w-4 h-4 text-indigo-500" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                    <span
                                        class="font-semibold truncate max-w-52 text-slate-800 text-sm">{{ $admin->username }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if ($admin->role === 'super_admin')
                                    <span
                                        class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-xs font-semibold bg-violet-100 text-violet-700 border border-violet-200">
                                        <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                            stroke-width="2.5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                                        </svg>
                                        Super Admin
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-xs font-semibold bg-indigo-100 text-indigo-700 border border-indigo-200">
                                        <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                            stroke-width="2.5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        Admin
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center gap-1.5 text-xs text-slate-400">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                        stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    {{ $admin->created_at->format('d M Y') }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-2">
                                    {{-- Edit Button --}}
                                    <button
                                        onclick="openModalEdit({{ $admin->id_admin }}, '{{ $admin->username }}', '{{ $admin->role }}')"
                                        class="inline-flex items-center gap-1.5 text-xs font-semibold text-amber-600 bg-amber-50 hover:bg-amber-100 border border-amber-200 px-3 py-1.5 rounded-lg transition-all hover:shadow-sm">
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                        Edit
                                    </button>

                                    {{-- Delete Button --}}
                                    <form method="POST"
                                        action="{{ route('admin.akunAdmin.destroy', $admin->id_admin) }}" class="form-delete">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="btn-delete inline-flex items-center gap-1.5 text-xs font-semibold text-red-600 bg-red-50 hover:bg-red-100 border border-red-200 px-3 py-1.5 rounded-lg transition-all hover:shadow-sm">
                                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-16 text-center bg-white">
                                <div class="flex flex-col items-center gap-3">
                                    <div class="w-14 h-14 rounded-2xl bg-slate-100 flex items-center justify-center">
                                        @if (request('search'))
                                            <svg class="w-7 h-7 text-slate-300" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor" stroke-width="1.5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                            </svg>
                                        @else
                                            <svg class="w-7 h-7 text-slate-300" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor" stroke-width="1.5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                        @endif
                                    </div>
                                    <div>
                                        @if (request('search'))
                                            <p class="text-sm font-semibold text-slate-500">Tidak ada hasil untuk <span
                                                    class="text-indigo-500">"{{ request('search') }}"</span></p>
                                            <p class="text-xs text-slate-400 mt-0.5">Coba gunakan kata kunci yang
                                                berbeda
                                            </p>
                                        @else
                                            <p class="text-sm font-semibold text-slate-500">Belum ada akun admin</p>
                                            <p class="text-xs text-slate-400 mt-0.5">Klik tombol "Tambah Admin" untuk mulai menambahkan</p>
                                        @endif
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if ($akunAdmins->hasPages())
            <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/50">
                {{ $akunAdmins->appends(request()->query())->links() }}
            </div>
        @endif
    </div>

    @push('modals')
        {{-- MODAL TAMBAH --}}
        <div id="modalTambah" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
            {{-- Backdrop --}}
            <div class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm"
                onclick="document.getElementById('modalTambah').classList.add('hidden')"></div>

            {{-- Modal Card --}}
            <div
                class="relative bg-white rounded-3xl shadow-2xl shadow-slate-900/20 w-full max-w-md border border-slate-100 overflow-hidden">
                {{-- Modal Header --}}
                <div class="flex items-center justify-between px-6 py-5 border-b border-slate-100">
                    <div class="flex items-center gap-3">
                        <div
                            class="w-9 h-9 rounded-xl bg-gradient-to-br from-indigo-500 to-violet-600 flex items-center justify-center shadow-lg shadow-indigo-500/30">
                            <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-base font-bold text-slate-800">Tambah Admin</h2>
                            <p class="text-xs text-slate-400">Isi data akun admin baru</p>
                        </div>
                    </div>
                    <button onclick="document.getElementById('modalTambah').classList.add('hidden')"
                        class="w-8 h-8 rounded-xl bg-slate-100 hover:bg-slate-200 flex items-center justify-center transition-colors">
                        <svg class="w-4 h-4 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                {{-- Modal Body --}}
                <form method="POST" action="{{ route('admin.akunAdmin.store') }}">
                    @csrf
                    <div class="px-6 py-5 space-y-4">
                        {{-- Username --}}
                        <div>
                            <label
                                class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-2">Username<x-form.required /></label>
                            <input type="text" name="username" value="{{ old('username') }}" maxlength="50" autofocus
                                class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500/30 focus:border-indigo-400 transition-all
                                @error('username') border-red-400 bg-red-50 focus:ring-red-500/20 focus:border-red-400 @enderror"
                                placeholder="Masukkan username">
                            @error('username')
                                <div class="flex items-center gap-1.5 mt-2">
                                    <svg class="w-3.5 h-3.5 text-red-500 flex-shrink-0" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <p class="text-red-500 text-xs font-medium">{{ $message }}</p>
                                </div>
                            @enderror
                        </div>

                        {{-- Role --}}
                        <div>
                            <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-2">Role<x-form.required /></label>
                            <select name="role"
                                class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-500/30 focus:border-indigo-400 transition-all
                                @error('role') border-red-400 bg-red-50 @enderror">
                                <option value="">-- Pilih Role --</option>
                                <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="super_admin" {{ old('role') === 'super_admin' ? 'selected' : '' }}>Super
                                    Admin
                                </option>
                            </select>
                            @error('role')
                                <div class="flex items-center gap-1.5 mt-2">
                                    <svg class="w-3.5 h-3.5 text-red-500 flex-shrink-0" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <p class="text-red-500 text-xs font-medium">{{ $message }}</p>
                                </div>
                            @enderror
                        </div>

                        {{-- Password --}}
                        <div>
                            <label
                                class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-2">Password<x-form.required /></label>
                            <div class="relative">
                                <input type="password" name="password" id="tambahPassword"
                                    class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 pr-11 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500/30 focus:border-indigo-400 transition-all
            @error('password') border-red-400 bg-red-50 focus:ring-red-500/20 focus:border-red-400 @enderror"
                                    placeholder="Minimal 6 karakter">
                                <button type="button" onclick="togglePassword('tambahPassword', 'eyeTambah')"
                                    class="absolute inset-y-0 right-0 px-3.5 flex items-center text-slate-400 hover:text-slate-600 transition-colors">
                                    <svg id="eyeTambah" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                            </div>
                            @error('password')
                                <div class="flex items-center gap-1.5 mt-2">
                                    <svg class="w-3.5 h-3.5 text-red-500 flex-shrink-0" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <p class="text-red-500 text-xs font-medium">{{ $message }}</p>
                                </div>
                            @enderror
                        </div>

                        {{-- Password Confirmation --}}
                        <div>
                            <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-2">Konfirmasi
                                Password</label>
                            <div class="relative">
                                <input type="password" name="password_confirmation" id="tambahPasswordConfirm"
                                    class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 pr-11 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500/30 focus:border-indigo-400 transition-all"
                                    placeholder="Ulangi password">
                                <button type="button" onclick="togglePassword('tambahPasswordConfirm', 'eyeTambahConfirm')"
                                    class="absolute inset-y-0 right-0 px-3.5 flex items-center text-slate-400 hover:text-slate-600 transition-colors">
                                    <svg id="eyeTambahConfirm" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                    </div>

                    {{-- Modal Footer --}}
                    <div class="flex justify-end gap-2.5 px-6 py-4 bg-slate-50/80 border-t border-slate-100">
                        <button type="button" onclick="document.getElementById('modalTambah').classList.add('hidden')"
                            class="px-5 py-2.5 text-sm font-semibold text-slate-600 bg-white border border-slate-200 rounded-xl hover:bg-slate-100 transition-all">
                            Batal
                        </button>
                        <button type="submit"
                            class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-semibold bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-500 hover:to-violet-500 text-white rounded-xl shadow-lg shadow-indigo-500/25 transition-all hover:-translate-y-0.5 active:translate-y-0">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- MODAL EDIT --}}
        <div id="modalEdit" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
            {{-- Backdrop --}}
            <div class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm"
                onclick="document.getElementById('modalEdit').classList.add('hidden')"></div>

            {{-- Modal Card --}}
            <div
                class="relative bg-white rounded-3xl shadow-2xl shadow-slate-900/20 w-full max-w-md border border-slate-100 overflow-hidden">
                {{-- Modal Header --}}
                <div class="flex items-center justify-between px-6 py-5 border-b border-slate-100">
                    <div class="flex items-center gap-3">
                        <div
                            class="w-9 h-9 rounded-xl bg-gradient-to-br from-amber-400 to-orange-500 flex items-center justify-center shadow-lg shadow-amber-500/30">
                            <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-base font-bold text-slate-800">Edit Admin</h2>
                            <p class="text-xs text-slate-400">Ubah data akun admin yang dipilih</p>
                        </div>
                    </div>
                    <button onclick="document.getElementById('modalEdit').classList.add('hidden')"
                        class="w-8 h-8 rounded-xl bg-slate-100 hover:bg-slate-200 flex items-center justify-center transition-colors">
                        <svg class="w-4 h-4 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                {{-- Modal Body --}}
                <form method="POST" id="formEdit">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id_admin" id="editAdminId" value="{{ old('id_admin') }}">
                    <div class="px-6 py-5 space-y-4">
                        {{-- Username --}}
                        <div>
                            <label
                                class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-2">Username<x-form.required /></label>
                            <input type="text" name="username" id="editUsername" maxlength="50"
                                value="{{ old('username') }}"
                                class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-amber-500/30 focus:border-amber-400 transition-all
                                @error('username') border-red-400 bg-red-50 @enderror"
                                placeholder="Masukkan username">
                            @error('username')
                                <div class="flex items-center gap-1.5 mt-2">
                                    <svg class="w-3.5 h-3.5 text-red-500 flex-shrink-0" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <p class="text-red-500 text-xs font-medium">{{ $message }}</p>
                                </div>
                            @enderror
                        </div>

                        {{-- Role --}}
                        <div>
                            <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-2">Role<x-form.required /></label>
                            <select name="role" id="editRole"
                                class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-amber-500/30 focus:border-amber-400 transition-all
                                @error('role') border-red-400 bg-red-50 @enderror">
                                <option value="admin" {{ old('role', '') === 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="super_admin" {{ old('role', '') === 'super_admin' ? 'selected' : '' }}>
                                    Super
                                    Admin</option>
                            </select>
                            @error('role')
                                <div class="flex items-center gap-1.5 mt-2">
                                    <svg class="w-3.5 h-3.5 text-red-500 flex-shrink-0" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <p class="text-red-500 text-xs font-medium">{{ $message }}</p>
                                </div>
                            @enderror
                        </div>

                        {{-- Password Baru (opsional) --}}
                        <div>
                            <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-2">Password
                                Baru
                                <span class="text-slate-400 font-normal normal-case">(opsional)</span>
                            </label>
                            <div class="relative">
                                <input type="password" name="password" id="editPassword"
                                    class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 pr-11 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-amber-500/30 focus:border-amber-400 transition-all
                                        @error('password') border-red-400 bg-red-50 @enderror"
                                    placeholder="Kosongkan jika tidak ingin mengubah">
                                <button type="button" onclick="togglePassword('editPassword', 'eyeEdit')"
                                    class="absolute inset-y-0 right-0 px-3.5 flex items-center text-slate-400 hover:text-slate-600 transition-colors">
                                    <svg id="eyeEdit" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                            </div>
                            @error('password')
                                ...
                            @enderror
                        </div>

                        {{-- Konfirmasi Password Baru --}}
                        <div>
                            <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-2">Konfirmasi
                                Password Baru</label>
                            <div class="relative">
                                <input type="password" name="password_confirmation" id="editPasswordConfirm"
                                    class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 pr-11 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-amber-500/30 focus:border-amber-400 transition-all"
                                    placeholder="Ulangi password baru">
                                <button type="button" onclick="togglePassword('editPasswordConfirm', 'eyeEditConfirm')"
                                    class="absolute inset-y-0 right-0 px-3.5 flex items-center text-slate-400 hover:text-slate-600 transition-colors">
                                    <svg id="eyeEditConfirm" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                    </div>

                    {{-- Modal Footer --}}
                    <div class="flex justify-end gap-2.5 px-6 py-4 bg-slate-50/80 border-t border-slate-100">
                        <button type="button" onclick="document.getElementById('modalEdit').classList.add('hidden')"
                            class="px-5 py-2.5 text-sm font-semibold text-slate-600 bg-white border border-slate-200 rounded-xl hover:bg-slate-100 transition-all">
                            Batal
                        </button>
                        <button type="submit"
                            class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-semibold bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-400 hover:to-orange-400 text-white rounded-xl shadow-lg shadow-amber-500/25 transition-all hover:-translate-y-0.5 active:translate-y-0">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                            </svg>
                            Perbarui
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endpush

    {{-- Scripts --}}
    @push('scripts')
        <script>
            function openModalEdit(id, username, role) {
                const baseUrl = "{{ url('admin/akunAdmin') }}";
                document.getElementById('formEdit').action = `${baseUrl}/${id}`;
                document.getElementById('editAdminId').value = id;
                document.getElementById('editUsername').value = username;
                document.getElementById('editRole').value = role;
                document.getElementById('modalEdit').classList.remove('hidden');
            }

            function togglePassword(inputId, iconId) {
                const input = document.getElementById(inputId);
                const icon = document.getElementById(iconId);
                const isHidden = input.type === 'password';

                input.type = isHidden ? 'text' : 'password';
                icon.innerHTML = isHidden ?
                    `<path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />` :
                    `<path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />`;
            }

            // Auto buka modal tambah jika ada error validasi dari store
            @if ($errors->any() && old('_method') === null)
                document.getElementById('modalTambah').classList.remove('hidden');
            @endif

            // Auto buka modal edit jika ada error validasi dari update
            @if ($errors->any() && old('_method') === 'PUT')
                (function() {
                    const id = "{{ old('id_admin') }}";
                    const baseUrl = "{{ url('admin/akunAdmin') }}";
                    document.getElementById('formEdit').action = `${baseUrl}/${id}`;
                    document.getElementById('modalEdit').classList.remove('hidden');
                })();
            @endif
        </script>
    @endpush

@endsection
