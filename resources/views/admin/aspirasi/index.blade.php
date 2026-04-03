@extends('layouts.admin')

@section('title', 'Manajemen Aspirasi')

@section('content')

    {{-- Page Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <div class="w-1 h-6 rounded-full bg-gradient-to-b from-indigo-500 to-violet-600"></div>
                <h1 class="text-xl font-bold text-slate-800 tracking-tight">Manajemen Aspirasi</h1>
            </div>
            <p class="text-sm text-slate-400 ml-3">Kelola seluruh laporan aspirasi sarana sekolah dari siswa</p>
        </div>
    </div>

    {{-- Flash Message --}}
    @if (session('success'))
        <div
            class="mb-5 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700 shadow-sm flex items-center gap-2">
            <svg class="w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
            </svg>
            {{ session('success') }}
        </div>
    @endif

    {{-- Filter Card --}}
    <div class="rounded-2xl border border-slate-100 bg-white shadow-sm mb-6 overflow-hidden">
        <div class="bg-slate-50/80 px-6 py-3.5 border-b border-slate-100 flex items-center gap-2">
            <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L13 13.414V19a1 1 0 01-.553.894l-4 2A1 1 0 017 21v-7.586L3.293 6.707A1 1 0 013 6V4z" />
            </svg>
            <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Filter Aspirasi</span>
        </div>

        <form method="GET" action="{{ route('admin.aspirasi.index') }}" class="p-6">
            <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-4">

                {{-- Filter Tanggal --}}
                <div>
                    <label for="tanggal"
                        class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-2">Tanggal</label>
                    <select id="tanggal" name="tanggal"
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-500/30 focus:border-indigo-400 transition-all">
                        <option value="">Semua Tanggal</option>
                        @for ($i = 1; $i <= 31; $i++)
                            <option value="{{ $i }}" {{ request('tanggal') == $i ? 'selected' : '' }}>
                                {{ $i }}
                            </option>
                        @endfor
                    </select>
                </div>

                {{-- Filter Bulan --}}
                <div>
                    <label for="bulan"
                        class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-2">Bulan</label>
                    <input type="month" id="bulan" name="bulan" value="{{ request('bulan') }}"
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-500/30 focus:border-indigo-400 transition-all" />
                </div>

                {{-- Filter Siswa --}}
                <div>
                    <label for="nis" class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-2">Nama Siswa / NIS</label>
                    <input list="listNis" id="nis" name="search" value="{{ request('search') }}"
                        placeholder="Cari Nama / NIS..."
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500/30 focus:border-indigo-400 transition-all">
                    <datalist id="listNis">
                        @foreach ($siswas as $siswa)
                            <option value="{{ $siswa->nama }}">
                                {{ $siswa->nis }} — {{ $siswa->kelas->nama_kelas ?? '-' }}
                            </option>
                        @endforeach
                    </datalist>
                </div>

                {{-- Filter Kategori --}}
                <div>
                    <label for="id_kategori"
                        class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-2">Kategori</label>
                    <select id="id_kategori" name="id_kategori"
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-500/30 focus:border-indigo-400 transition-all">
                        <option value="">Semua Kategori</option>
                        @foreach ($kategoris as $kategori)
                            <option value="{{ $kategori->id_kategori }}"
                                {{ request('id_kategori') == $kategori->id_kategori ? 'selected' : '' }}>
                                {{ $kategori->ket_kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- Tombol Filter --}}
            <div class="flex items-center justify-end gap-3 mt-5 pt-4 border-t border-slate-100">
                <button type="submit"
                    class="inline-flex items-center gap-2 bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-500 hover:to-violet-500 text-white text-sm font-semibold px-5 py-2.5 rounded-xl shadow-lg shadow-indigo-500/25 transition-all hover:-translate-y-0.5 active:translate-y-0">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L13 13.414V19a1 1 0 01-.553.894l-4 2A1 1 0 017 21v-7.586L3.293 6.707A1 1 0 013 6V4z" />
                    </svg>
                    Terapkan Filter
                </button>
                @if (request()->hasAny(['tanggal', 'bulan', 'nis', 'id_kategori']))
                    <a href="{{ route('admin.aspirasi.index') }}"
                        class="text-sm font-semibold text-slate-500 hover:text-slate-700 transition-colors inline-flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                        Reset Filter
                    </a>
                @endif
            </div>
        </form>
    </div>

    {{-- Table Card --}}
    <div class="rounded-2xl border border-slate-100 overflow-hidden shadow-sm">

        {{-- Table Header --}}
        <div class="bg-slate-50/80 px-6 py-3.5 border-b border-slate-100 flex items-center gap-2">
            <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
            </svg>
            <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Daftar Aspirasi</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead>
                    <tr class="bg-white border-b border-slate-100">
                        <th class="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider text-center w-16">
                            No</th>
                        <th class="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider">Siswa</th>
                        <th class="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider">Kelas</th>
                        <th class="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider">Kategori</th>
                        <th class="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider">Lokasi</th>
                        <th class="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider text-center">Status
                        </th>
                        <th class="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider text-center">Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse ($aspirasi as $index => $item)
                        @php
                            $statusNow = $item->aspirasi?->status ?? 'menunggu';
                            $statusColors = [
                                'menunggu' => 'bg-amber-50 text-amber-700 ring-1 ring-amber-200',
                                'proses' => 'bg-sky-50 text-sky-700 ring-1 ring-sky-200',
                                'selesai' => 'bg-emerald-50 text-emerald-700 ring-1 ring-emerald-200',
                            ];
                            $statusLabels = [
                                'menunggu' => 'Menunggu',
                                'proses' => 'Diproses',
                                'selesai' => 'Selesai',
                            ];
                        @endphp
                        <tr class="bg-white hover:bg-indigo-50/30 transition-colors group">
                            <td class="px-6 py-4">
                                <span
                                    class="text-xs font-semibold text-slate-400 bg-slate-100 w-7 h-7 rounded-lg flex items-center justify-center">
                                    {{ $aspirasi->firstItem() + $index }}
                                </span>
                            </td>
                            <td class="px-2 py-4">
                                <span class="inline-flex items-center gap-1.5 text-xs text-slate-500">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                        stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    {{ $item->created_at?->format('d M Y') ?? '-' }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span
                                    class="font-mono text-xs font-semibold text-slate-700 bg-slate-100 px-2.5 py-1 rounded-md">
                                    {{ $item->siswa?->nama ?? '-' }}
                                </span>
                            </td>
                            <td class="px-2 py-4">
                                <span class="text-sm text-slate-600">{{ $item->siswa?->kelas?->nama_kelas ?? '-' }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <div
                                        class="w-6 h-6 rounded-lg bg-gradient-to-br from-violet-100 to-purple-100 flex items-center justify-center flex-shrink-0">
                                        <svg class="w-3 h-3 text-violet-500" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                        </svg>
                                    </div>
                                    <span
                                        class="text-sm max-w-[120px] truncate text-slate-700">{{ $item->kategori?->ket_kategori ?? '-' }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm text-slate-500 truncate block"
                                    title="{{ $item->lokasi }}">{{ $item->lokasi }}</span>
                            </td>
                            <td class="px-6 py-4 flex text-center justify-between gap-x-2">
                                <span
                                    class="inline-flex w-full items-center gap-1.5 px-2.5 py-1 rounded-lg text-xs font-semibold {{ $statusColors[$statusNow] }}">
                                    <span
                                        class="w-1.5 h-1.5 rounded-full {{ $statusNow === 'menunggu'
                                            ? 'bg-amber-500'
                                            : ($statusNow === 'proses'
                                                ? 'bg-sky-500 animate-pulse'
                                                : 'bg-emerald-500') }}"></span>
                                    {{ $statusLabels[$statusNow] }}
                                </span>
                                {{-- Quick Update Status --}}
                                <form method="POST" action="{{ route('admin.aspirasi.updateStatus', $item) }}"
                                    class="w-full sm:w-auto">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" onchange="this.form.submit()"
                                        class="w-auto bg-slate-50 border border-slate-200 rounded-lg py-1.5 text-xs font-semibold text-slate-600 focus:outline-none focus:ring-2 focus:ring-indigo-500/30 focus:border-indigo-400 transition-all cursor-pointer">

                                        <option value="" disabled selected hidden class="">⚙️</option>
                                        @foreach (['menunggu', 'proses', 'selesai'] as $s)
                                            <option value="{{ $s }}"
                                                {{ $s === $item->status ? 'selected' : '' }}>
                                                {{ ucfirst($s) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </form>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-col sm:flex-row items-center gap-2 justify-center">

                                    {{-- Detail Button --}}
                                    <a href="{{ route('admin.aspirasi.show', $item) }}"
                                        class="inline-flex items-center gap-1.5 text-xs font-semibold text-indigo-600 bg-indigo-50 hover:bg-indigo-100 border border-indigo-200 px-3 py-1.5 rounded-lg transition-all hover:shadow-sm whitespace-nowrap">
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        Detail
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-16 text-center bg-white">
                                <div class="flex flex-col items-center gap-3">
                                    <div class="w-14 h-14 rounded-2xl bg-slate-100 flex items-center justify-center">
                                        @if (request()->hasAny(['tanggal', 'bulan', 'nis', 'id_kategori']))
                                            <svg class="w-7 h-7 text-slate-300" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor" stroke-width="1.5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L13 13.414V19a1 1 0 01-.553.894l-4 2A1 1 0 017 21v-7.586L3.293 6.707A1 1 0 013 6V4z" />
                                            </svg>
                                        @else
                                            <svg class="w-7 h-7 text-slate-300" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor" stroke-width="1.5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                            </svg>
                                        @endif
                                    </div>
                                    <div>
                                        @if (request()->hasAny(['tanggal', 'bulan', 'nis', 'id_kategori']))
                                            <p class="text-sm font-semibold text-slate-500">Tidak ada hasil untuk filter
                                                yang dipilih</p>
                                            <p class="text-xs text-slate-400 mt-0.5">Coba reset filter atau ubah kriteria
                                                pencarian</p>
                                        @else
                                            <p class="text-sm font-semibold text-slate-500">Belum ada aspirasi</p>
                                            <p class="text-xs text-slate-400 mt-0.5">Data aspirasi dari siswa akan muncul
                                                di sini</p>
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
        @if ($aspirasi->hasPages())
            <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/50">
                {{ $aspirasi->appends(request()->query())->links() }}
            </div>
        @endif
    </div>

@endsection
