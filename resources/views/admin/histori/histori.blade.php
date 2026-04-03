@extends('layouts.admin')

@section('title', 'Histori Aspirasi per Siswa')

@section('content')

    {{-- Page Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <div class="w-1 h-6 rounded-full bg-gradient-to-b from-indigo-500 to-violet-600"></div>
                <h1 class="text-xl font-bold text-slate-800 tracking-tight">Histori Aspirasi</h1>
            </div>
            <p class="text-sm text-slate-400 ml-3">Riwayat aspirasi seluruh siswa. Pilih siswa untuk melihat detail
                historinya.</p>
        </div>
    </div>

    {{-- Filter Card --}}
    <div class="rounded-2xl border border-slate-100 bg-white shadow-sm mb-6 overflow-hidden">
        <div class="bg-slate-50/80 px-6 py-3.5 border-b border-slate-100 flex items-center gap-2">
            <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M21 21l-4.35-4.35M17 11A6 6 0 1 0 5 11a6 6 0 0 0 12 0z" />
            </svg>
            <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Cari Siswa</span>
        </div>

        <form method="GET" action="{{ route('admin.histori.histori') }}" class="p-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">

                {{-- Filter NIS --}}
                <div>
                    <label for="cari"
                        class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-2">NIS</label>
                    <input type="number" id="cari" name="cari" value="{{ request('cari') }}"
                        placeholder="Cari berdasarkan NIS..."
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500/30 focus:border-indigo-400 transition-all" />
                </div>

                {{-- Filter Kelas --}}
                <div>
                    <label for="id_kelas"
                        class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-2">Kelas</label>
                    <select id="id_kelas" name="id_kelas"
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-500/30 focus:border-indigo-400 transition-all">
                        <option value="">-- Semua Kelas --</option>
                        @foreach ($kelases as $kelas)
                            <option value="{{ $kelas->id }}" {{ request('id_kelas') == $kelas->id ? 'selected' : '' }}>
                                {{ $kelas->nama_kelas }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Tombol Aksi --}}
                <div class="flex items-end gap-3">
                    <button type="submit"
                        class="inline-flex items-center gap-2 bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-500 hover:to-violet-500 text-white text-sm font-semibold px-5 py-2.5 rounded-xl shadow-lg shadow-indigo-500/25 transition-all hover:-translate-y-0.5 active:translate-y-0">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 21l-4.35-4.35M17 11A6 6 0 1 0 5 11a6 6 0 0 0 12 0z" />
                        </svg>
                        Cari
                    </button>
                    @if (request()->hasAny(['cari', 'id_kelas']))
                        <a href="{{ route('admin.histori.histori') }}"
                            class="text-sm font-semibold text-slate-500 hover:text-slate-700 transition-colors inline-flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                            Reset
                        </a>
                    @endif
                </div>
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
            <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Daftar Siswa</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead>
                    <tr class="bg-white border-b border-slate-100">
                        <th class="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider text-center w-16">
                            No</th>
                        <th class="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider">NIS</th>
                        <th class="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider">Kelas</th>
                        <th class="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider text-center">Total
                        </th>
                        <th class="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider text-center">
                            <span class="inline-flex items-center gap-1">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>Menunggu
                            </span>
                        </th>
                        <th class="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider text-center">
                            <span class="inline-flex items-center gap-1">
                                <span class="w-1.5 h-1.5 rounded-full bg-sky-500"></span>Proses
                            </span>
                        </th>
                        <th class="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider text-center">
                            <span class="inline-flex items-center gap-1">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>Selesai
                            </span>
                        </th>
                        <th class="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider text-center">Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse ($siswas as $index => $siswa)
                        @php
                            $aspirasis = $siswa->inputAspirasi;
                            $cMenunggu = $aspirasis
                                ->filter(fn($a) => ($a->aspirasi?->status ?? 'menunggu') === 'menunggu')
                                ->count();
                            $cProses = $aspirasis->filter(fn($a) => $a->aspirasi?->status === 'proses')->count();
                            $cSelesai = $aspirasis->filter(fn($a) => $a->aspirasi?->status === 'selesai')->count();
                        @endphp
                        <tr class="bg-white hover:bg-indigo-50/30 transition-colors group">
                            <td class="px-6 py-4">
                                <span
                                    class="text-xs font-semibold text-slate-400 bg-slate-100 w-7 h-7 rounded-lg flex items-center justify-center">
                                    {{ $siswas->firstItem() + $index }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span
                                    class="font-mono text-xs font-semibold text-slate-700 bg-slate-100 px-2.5 py-1 rounded-md">
                                    {{ $siswa->nis }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm text-slate-600">{{ $siswa->kelas?->nama_kelas ?? '-' }}</span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span
                                    class="inline-flex items-center justify-center w-8 h-8 rounded-xl bg-slate-100 text-slate-700 text-xs font-bold">
                                    {{ $siswa->total_aspirasi }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if ($cMenunggu > 0)
                                    <span
                                        class="inline-flex items-center justify-center w-8 h-8 rounded-xl bg-amber-50 text-amber-700 ring-1 ring-amber-200 text-xs font-bold">
                                        {{ $cMenunggu }}
                                    </span>
                                @else
                                    <span class="text-slate-300">—</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if ($cProses > 0)
                                    <span
                                        class="inline-flex items-center justify-center w-8 h-8 rounded-xl bg-sky-50 text-sky-700 ring-1 ring-sky-200 text-xs font-bold">
                                        {{ $cProses }}
                                    </span>
                                @else
                                    <span class="text-slate-300">—</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if ($cSelesai > 0)
                                    <span
                                        class="inline-flex items-center justify-center w-8 h-8 rounded-xl bg-emerald-50 text-emerald-700 ring-1 ring-emerald-200 text-xs font-bold">
                                        {{ $cSelesai }}
                                    </span>
                                @else
                                    <span class="text-slate-300">—</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center">
                                    @if ($siswa->total_aspirasi > 0)
                                        <a href="{{ route('admin.histori.histori.siswa', $siswa) }}"
                                            class="inline-flex items-center gap-1.5 text-xs font-semibold text-indigo-600 bg-indigo-50 hover:bg-indigo-100 border border-indigo-200 px-3 py-1.5 rounded-lg transition-all hover:shadow-sm whitespace-nowrap">
                                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                            Lihat Histori
                                        </a>
                                    @else
                                        <span class="text-xs text-slate-400 italic">Belum ada aspirasi</span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-16 text-center bg-white">
                                <div class="flex flex-col items-center gap-3">
                                    <div class="w-14 h-14 rounded-2xl bg-slate-100 flex items-center justify-center">
                                        @if (request()->hasAny(['cari', 'id_kelas']))
                                            <svg class="w-7 h-7 text-slate-300" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor" stroke-width="1.5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M21 21l-4.35-4.35M17 11A6 6 0 1 0 5 11a6 6 0 0 0 12 0z" />
                                            </svg>
                                        @else
                                            <svg class="w-7 h-7 text-slate-300" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor" stroke-width="1.5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                            </svg>
                                        @endif
                                    </div>
                                    <div>
                                        @if (request()->hasAny(['cari', 'id_kelas']))
                                            <p class="text-sm font-semibold text-slate-500">Tidak ada hasil untuk pencarian
                                                yang dipilih</p>
                                            <p class="text-xs text-slate-400 mt-0.5">Coba reset filter atau ubah kriteria
                                                pencarian</p>
                                        @else
                                            <p class="text-sm font-semibold text-slate-500">Belum ada data siswa</p>
                                            <p class="text-xs text-slate-400 mt-0.5">Data siswa dengan aspirasi akan muncul
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
        @if ($siswas->hasPages())
            <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/50">
                {{ $siswas->appends(request()->query())->links() }}
            </div>
        @endif
    </div>

@endsection
