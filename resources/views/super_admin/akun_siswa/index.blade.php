@extends('layouts.admin')

@section('title', 'Manajemen Akun Siswa')

@section('content')

    {{-- Page Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <div class="w-1 h-6 rounded-full bg-gradient-to-b from-indigo-500 to-violet-600"></div>
                <h1 class="text-xl font-bold text-slate-800 tracking-tight">Manajemen Akun Siswa</h1>
            </div>
            <p class="text-sm text-slate-400 ml-3">Kelola akun siswa yang terdaftar di sistem</p>
        </div>
        <button onclick="document.getElementById('modalTambah').classList.remove('hidden')"
            class="inline-flex items-center gap-2 bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-500 hover:to-violet-500 text-white text-sm font-semibold px-5 py-2.5 rounded-xl shadow-lg shadow-indigo-500/25 transition-all hover:-translate-y-0.5 active:translate-y-0">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>
            Tambah Siswa
        </button>
    </div>

    {{-- Search & Filter Bar --}}
    <form method="GET" action="{{ route('admin.akunSiswa.index') }}" class="mb-5 flex flex-wrap items-center gap-2">

        {{-- Search --}}
        <div class="relative flex-1 min-w-[150px]">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>

            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama/NIS..."
                class="w-full bg-white border border-slate-200 rounded-xl pl-9 pr-3 py-2 text-sm">
        </div>

        {{-- Filter Role --}}
        <div class="relative w-[140px]">
            <select name="id_kelas" onchange="this.form.submit()"
                class="appearance-none bg-white border border-slate-200 rounded-xl pl-4 pr-9 py-2.5 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-500/30 focus:border-indigo-400 transition-all shadow-sm cursor-pointer">
                <option value="">Semua Kelas</option>
                @foreach ($kelas as $k)
                    <option value="{{ $k->id }}" {{ request('id_kelas') == $k->id ? 'selected' : '' }}>
                        {{ $k->nama_kelas }}
                    </option>
                @endforeach
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
        @if (request('search') || request('id_kelas'))
            <a href="{{ route('admin.akunSiswa.index') }}"
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
                    d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
            </svg>
            <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Daftar Akun Siswa</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead>
                    <tr class="bg-white border-b border-slate-100">
                        <th class="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider text-center w-16">
                            No</th>
                        <th class="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider text-center">Nama
                        </th>
                        <th class="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider text-center">NIS
                        </th>
                        <th class="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider text-center">Kelas
                        </th>
                        <th class="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider">Dibuat</th>
                        <th class="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider text-center">Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse ($akunSiswa as $index => $siswa)
                        <tr class="bg-white hover:bg-indigo-50/30 transition-colors group">
                            <td class="px-6 py-4">
                                <span
                                    class="text-xs font-semibold text-slate-400 bg-slate-100 w-7 h-7 rounded-lg flex items-center justify-center">
                                    {{ $akunSiswa->firstItem() + $index }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-8 h-8 rounded-xl bg-gradient-to-br from-emerald-100 to-teal-100 flex items-center justify-center flex-shrink-0 group-hover:from-emerald-200 group-hover:to-teal-200 transition-colors">
                                        <svg class="w-4 h-4 text-emerald-500" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                    <span
                                        class="font-semibold truncate max-w-52 text-slate-800 text-sm">{{ $siswa->nama }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span
                                    class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-semibold bg-slate-100 text-slate-600 border border-slate-200 font-mono tracking-wider">
                                    {{ $siswa->nis }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span
                                    class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-xs font-semibold bg-indigo-100 text-indigo-700 border border-indigo-200">
                                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                        stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                    {{ $siswa->kelas->nama_kelas ?? '-' }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center gap-1.5 text-xs text-slate-400">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                        stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    {{ $siswa->created_at->format('d M Y') }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-2">
                                    {{-- Edit Button --}}
                                    <button
                                        onclick="openModalEdit('{{ $siswa->nis }}', '{{ $siswa->nama }}', {{ $siswa->id_kelas }})"
                                        class="inline-flex items-center gap-1.5 text-xs font-semibold text-amber-600 bg-amber-50 hover:bg-amber-100 border border-amber-200 px-3 py-1.5 rounded-lg transition-all hover:shadow-sm">
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                        Edit
                                    </button>

                                    {{-- Delete Button --}}
                                    <form method="POST" action="{{ route('admin.akunSiswa.destroy', $siswa->nis) }}" class="form-delete">
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
                            <td colspan="6" class="px-6 py-16 text-center bg-white">
                                <div class="flex flex-col items-center gap-3">
                                    <div class="w-14 h-14 rounded-2xl bg-slate-100 flex items-center justify-center">
                                        @if (request('search') || request('id_kelas'))
                                            <svg class="w-7 h-7 text-slate-300" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor" stroke-width="1.5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                            </svg>
                                        @else
                                            <svg class="w-7 h-7 text-slate-300" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor" stroke-width="1.5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                                            </svg>
                                        @endif
                                    </div>
                                    <div>
                                        @if (request('search') || request('id_kelas'))
                                            <p class="text-sm font-semibold text-slate-500">Tidak ada hasil yang ditemukan
                                            </p>
                                            <p class="text-xs text-slate-400 mt-0.5">Coba gunakan kata kunci yang berbeda
                                            </p>
                                        @else
                                            <p class="text-sm font-semibold text-slate-500">Belum ada akun siswa</p>
                                            <p class="text-xs text-slate-400 mt-0.5">Klik tombol "Tambah Siswa" untuk mulai
                                                menambahkan</p>
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
        @if ($akunSiswa->hasPages())
            <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/50">
                {{ $akunSiswa->appends(request()->query())->links() }}
            </div>
        @endif
    </div>

    @push('modals')
        {{-- MODAL TAMBAH --}}
        <div id="modalTambah" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
            <div class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm"
                onclick="document.getElementById('modalTambah').classList.add('hidden')"></div>

            <div
                class="relative bg-white rounded-3xl shadow-2xl shadow-slate-900/20 w-full max-w-md border border-slate-100 overflow-hidden">
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
                            <h2 class="text-base font-bold text-slate-800">Tambah Siswa</h2>
                            <p class="text-xs text-slate-400">Isi data akun siswa baru</p>
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

                <form method="POST" action="{{ route('admin.akunSiswa.store') }}">
                    @csrf
                    <div class="px-6 py-5 space-y-4">
                        {{-- NIS --}}
                        <div>
                            <label
                                class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-2">NIS<x-form.required /></label>
                            <input type="text" name="nis" value="{{ old('nis') }}" maxlength="8"
                                oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500/30 focus:border-indigo-400 transition-all font-mono
                                @error('nis') border-red-400 bg-red-50 focus:ring-red-500/20 focus:border-red-400 @enderror"
                                placeholder="8 digit angka" autofocus>
                            @error('nis')
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

                        <div class="flex justify-between items-center gap-2">
                            {{-- Nama --}}
                            <div class="flex-1">
                                <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-2">Nama
                                    Lengkap<x-form.required /></label>
                                <input type="text" name="nama" value="{{ old('nama') }}" maxlength="100"
                                    class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500/30 focus:border-indigo-400 transition-all
                                @error('nama') border-red-400 bg-red-50 focus:ring-red-500/20 focus:border-red-400 @enderror"
                                    placeholder="Masukkan nama lengkap">
                                @error('nama')
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

                            {{-- Kelas --}}
                            <div class="flex-1">
                                <label
                                    class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-2">Kelas<x-form.required /></label>
                                <select name="id_kelas"
                                    class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-500/30 focus:border-indigo-400 transition-all
                                @error('id_kelas') border-red-400 bg-red-50 @enderror">
                                    <option value="">-- Pilih Kelas --</option>
                                    @foreach ($kelas as $k)
                                        <option value="{{ $k->id }}"
                                            {{ old('id_kelas') == $k->id ? 'selected' : '' }}>
                                            {{ $k->nama_kelas }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_kelas')
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

                        {{-- Konfirmasi Password --}}
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
            <div class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm"
                onclick="document.getElementById('modalEdit').classList.add('hidden')"></div>

            <div
                class="relative bg-white rounded-3xl shadow-2xl shadow-slate-900/20 w-full max-w-md border border-slate-100 overflow-hidden">
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
                            <h2 class="text-base font-bold text-slate-800">Edit Siswa</h2>
                            <p class="text-xs text-slate-400">Ubah data akun siswa yang dipilih</p>
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

                <form method="POST" id="formEdit" action="">
                    @csrf
                    @method('PUT')
                    {{-- Simpan NIS untuk set action saat error validasi --}}
                    <input type="hidden" name="nis_edit" id="editNisHidden" value="{{ old('nis_edit') }}">

                    <div class="px-6 py-5 space-y-4">
                        {{-- NIS (readonly karena primary key) --}}
                        <div>
                            <label
                                class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-2">NIS<x-form.required /></label>
                            @php
                                $isAdmin = Auth::guard('admin')->user()->role === 'admin';
                            @endphp

                            <input type="text" name="nis" id="editNis" maxlength="8"
                                class="w-full border rounded-xl px-4 py-3 text-sm font-mono
                                {{ $isAdmin
                                    ? 'bg-slate-100 border-slate-200 text-slate-500 cursor-not-allowed'
                                    : 'bg-white border-slate-200 text-slate-800' }}
                                @error('nis') border-red-400 bg-red-50 @enderror"
                                {{ $isAdmin ? 'readonly' : '' }}>

                            @error('nis')
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

                        <div class="flex justify-between items-center gap-2">
                            {{-- Nama --}}
                            <div class="flex-1">
                                <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-2">Nama
                                    Lengkap<x-form.required /></label>
                                <input type="text" name="nama" id="editNama" maxlength="100"
                                    value="{{ old('nama') }}"
                                    class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-amber-500/30 focus:border-amber-400 transition-all
                                    @error('nama') border-red-400 bg-red-50 @enderror"
                                    placeholder="Masukkan nama lengkap">
                                @error('nama')
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

                            {{-- Kelas --}}
                            <div class="flex-1">
                                <label
                                    class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-2">Kelas<x-form.required /></label>
                                <select name="id_kelas" id="editKelas"
                                    class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-amber-500/30 focus:border-amber-400 transition-all
                                    @error('id_kelas') border-red-400 bg-red-50 @enderror">
                                    @foreach ($kelas as $k)
                                        <option value="{{ $k->id }}"
                                            {{ old('id_kelas') == $k->id ? 'selected' : '' }}>
                                            {{ $k->nama_kelas }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_kelas')
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
                        </div>

                        {{-- Password Baru --}}
                        <div>
                            <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-2">
                                Password Baru
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

    @push('scripts')
        <script>
            function openModalEdit(nis, nama, idKelas) {
                const baseUrl = "{{ url('admin/akunSiswa') }}";
                document.getElementById('formEdit').action = `${baseUrl}/${nis}`;
                document.getElementById('editNisHidden').value = nis;
                document.getElementById('editNis').value = nis;
                document.getElementById('editNama').value = nama;
                document.getElementById('editKelas').value = idKelas;
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
                    const nis = "{{ old('nis_edit') }}";
                    const baseUrl = "{{ url('admin/akunSiswa') }}";
                    document.getElementById('formEdit').action = `${baseUrl}/${nis}`;
                    document.getElementById('editNis').value = nis;
                    document.getElementById('modalEdit').classList.remove('hidden');
                })();
            @endif
        </script>
    @endpush

@endsection
