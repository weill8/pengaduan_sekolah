@extends('layouts.siswa')

@section('title', 'Dashboard Siswa')

@section('content')

{{-- 
    WELCOME HEADER
 --}}
<div class="mb-8">
    <div class="rounded-2xl bg-gradient-to-br from-emerald-600 to-teal-600 px-6 py-6 shadow-lg shadow-emerald-500/20 relative overflow-hidden">

        {{-- Background decoration --}}
        <div class="absolute top-0 right-0 w-48 h-48 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/4"></div>
        <div class="absolute bottom-0 right-12 w-24 h-24 bg-white/5 rounded-full translate-y-1/2"></div>

        <div class="relative flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <p class="text-white text-sm font-medium mb-1">Selamat datang kembali 👋</p>
                <h1 class="text-2xl font-bold text-white tracking-tight">
                    {{ $siswa->nama }} — {{ $siswa->nis }}
                </h1>
                <p class="text-white text-sm mt-1">
                    {{ $siswa->kelas?->nama_kelas ?? '-' }} &nbsp;·&nbsp;
                    {{ now()->translatedFormat('l, d F Y') }}
                </p>
            </div>
            <a href="{{ route('siswa.aspirasi.create') }}"
               class="inline-flex items-center gap-2 bg-white text-emerald-700 text-sm font-bold px-5 py-2.5 rounded-xl shadow-md hover:bg-emerald-50 transition-all hover:-translate-y-0.5 active:translate-y-0 self-start sm:self-auto whitespace-nowrap">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                </svg>
                Buat Laporan
            </a>
        </div>
    </div>
</div>

{{-- 
    STAT CARDS
 --}}
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">

    {{-- Total --}}
    <div class="group relative overflow-hidden rounded-2xl bg-white p-5 shadow-sm ring-1 ring-slate-100 transition-all duration-200 hover:shadow-md hover:-translate-y-0.5">
        <div class="flex items-start justify-between">
            <div>
                <p class="text-xs font-bold uppercase tracking-widest text-slate-400">Total</p>
                <p class="mt-2 text-3xl font-bold text-slate-800">{{ $totalLaporan }}</p>
                <p class="mt-1 text-xs text-slate-400">Semua laporan</p>
            </div>
            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-slate-100 text-slate-500 transition-colors group-hover:bg-slate-200">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
        </div>
        
        <div class="absolute bottom-0 left-0 h-0.5 w-full bg-gradient-to-r from-slate-300 to-slate-500 opacity-0 transition-opacity group-hover:opacity-100"></div>
    </div>

    {{-- menunggu --}}
    <div class="group relative overflow-hidden rounded-2xl bg-white p-5 shadow-sm ring-1 ring-slate-100 transition-all duration-200 hover:shadow-md hover:-translate-y-0.5">
        <div class="flex items-start justify-between">
            <div>
                <p class="text-xs font-bold uppercase tracking-widest text-slate-400">Menunggu</p>
                <p class="mt-2 text-3xl font-bold text-amber-600">{{ $menunggu }}</p>
                <p class="mt-1 text-xs text-slate-400">Menunggu ditangangi</p>
            </div>
            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-amber-50 text-amber-500 transition-colors group-hover:bg-amber-100">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>
        @if($menunggu > 0)
            <div class="absolute top-3 right-3 flex h-2 w-2">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2 w-2 bg-amber-500"></span>
            </div>
        @endif
        <div class="absolute bottom-0 left-0 h-0.5 w-full bg-gradient-to-r from-amber-400 to-amber-500 opacity-0 transition-opacity group-hover:opacity-100"></div>
    </div>

    {{-- Diproses --}}
    <div class="group relative overflow-hidden rounded-2xl bg-white p-5 shadow-sm ring-1 ring-slate-100 transition-all duration-200 hover:shadow-md hover:-translate-y-0.5">
        <div class="flex items-start justify-between">
            <div>
                <p class="text-xs font-bold uppercase tracking-widest text-slate-400">Diproses</p>
                <p class="mt-2 text-3xl font-bold text-sky-600">{{ $diproses }}</p>
                <p class="mt-1 text-xs text-slate-400">Sedang ditangani</p>
            </div>
            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-sky-50 text-sky-500 transition-colors group-hover:bg-sky-100">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                </svg>
            </div>
        </div>
        <div class="absolute bottom-0 left-0 h-0.5 w-full bg-gradient-to-r from-sky-400 to-sky-500 opacity-0 transition-opacity group-hover:opacity-100"></div>
    </div>

    {{-- Selesai --}}
    <div class="group relative overflow-hidden rounded-2xl bg-white p-5 shadow-sm ring-1 ring-slate-100 transition-all duration-200 hover:shadow-md hover:-translate-y-0.5">
        <div class="flex items-start justify-between">
            <div>
                <p class="text-xs font-bold uppercase tracking-widest text-slate-400">Selesai</p>
                <p class="mt-2 text-3xl font-bold text-emerald-600">{{ $selesai }}</p>
                <p class="mt-1 text-xs text-slate-400">Berhasil ditangani</p>
            </div>
            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-emerald-50 text-emerald-500 transition-colors group-hover:bg-emerald-100">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>
        <div class="absolute bottom-0 left-0 h-0.5 w-full bg-gradient-to-r from-emerald-400 to-emerald-500 opacity-0 transition-opacity group-hover:opacity-100"></div>
    </div>

</div>

{{-- 
    LAPORAN TERBARU
 --}}
<div class="rounded-2xl border border-slate-100 overflow-hidden shadow-sm bg-white">

    {{-- Header --}}
    <div class="bg-slate-50/80 px-6 py-3.5 border-b border-slate-100 flex items-center justify-between">
        <div class="flex items-center gap-2">
            <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
            </svg>
            <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Laporan Terbaru</span>
        </div>
        <a href="{{ route('siswa.histori.histori') }}"
           class="inline-flex items-center gap-1 text-xs font-semibold text-indigo-600 hover:text-indigo-700 transition-colors">
            Lihat semua
            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
            </svg>
        </a>
    </div>

    {{-- List --}}
    @forelse($laporanTerbaru as $laporan)
        @php
            $status     = $laporan->aspirasi?->status ?? 'menunggu';
            $statusMap  = [
                'menunggu' => ['label' => 'Menunggu', 'class' => 'bg-amber-50 text-amber-700 ring-1 ring-amber-200',   'dot' => 'bg-amber-500'],
                'proses'   => ['label' => 'Diproses', 'class' => 'bg-sky-50 text-sky-700 ring-1 ring-sky-200',         'dot' => 'bg-sky-500 animate-pulse'],
                'selesai'  => ['label' => 'Selesai',  'class' => 'bg-emerald-50 text-emerald-700 ring-1 ring-emerald-200', 'dot' => 'bg-emerald-500'],
            ];
            $s = $statusMap[$status] ?? $statusMap['menunggu'];
        @endphp

        <div class="px-6 py-4 border-b border-slate-50 last:border-0 hover:bg-slate-50/50 transition-colors">
            <div class="flex items-start justify-between gap-4">

                {{-- Icon + Info --}}
                <div class="flex items-start gap-3 min-w-0">
                    <div class="flex-shrink-0 w-9 h-9 rounded-xl bg-gradient-to-br from-violet-100 to-indigo-100 flex items-center justify-center mt-0.5">
                        <svg class="w-4 h-4 text-violet-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                        </svg>
                    </div>
                    <div class="min-w-0">
                        <p class="text-sm font-semibold text-slate-700 whitespace-pre-line wrap-break-word">{{ $laporan->ket }}</p>
                        <div class="flex items-center gap-2 mt-1 flex-wrap">
                            <span class="text-xs text-slate-400">{{ $laporan->kategori?->ket_kategori ?? '-' }}</span>
                            <span class="text-slate-200">·</span>
                            <span class="inline-flex items-center gap-1 text-xs text-slate-400">
                                <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                {{ $laporan->lokasi }}
                            </span>
                            <span class="text-slate-200">·</span>
                            <span class="text-xs text-slate-400">
                                {{ $laporan->created_at?->format('d M Y') }}
                            </span>
                        </div>

                        {{-- Feedback snippet --}}
                        @if($laporan->aspirasi?->feedback)
                            <p class="mt-2 text-xs text-slate-500 bg-slate-100 rounded-lg px-3 py-1.5 line-clamp-1">
                                💬 {{ $laporan->aspirasi->feedback }}
                            </p>
                        @endif
                    </div>
                </div>

                {{-- Status + Action --}}
                <div class="flex flex-col items-end gap-2 flex-shrink-0">
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-xs font-semibold {{ $s['class'] }}">
                        <span class="w-1.5 h-1.5 rounded-full {{ $s['dot'] }}"></span>
                        {{ $s['label'] }}
                    </span>
                    <a href="{{ route('siswa.histori.show', $laporan) }}"
                       class="text-xs font-semibold text-indigo-500 hover:text-indigo-700 transition-colors">
                        Detail →
                    </a>
                </div>

            </div>
        </div>

    @empty
        <div class="px-6 py-16 text-center">
            <div class="flex flex-col items-center gap-3">
                <div class="w-14 h-14 rounded-2xl bg-slate-100 flex items-center justify-center">
                    <svg class="w-7 h-7 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <p class="text-sm font-semibold text-slate-500">Belum ada laporan</p>
                <p class="text-xs text-slate-400">Mulai buat laporan aspirasi pertamamu</p>
                <a href="{{ route('siswa.aspirasi.create') }}"
                   class="mt-1 inline-flex items-center gap-1.5 text-xs font-bold text-indigo-600 bg-indigo-50 hover:bg-indigo-100 border border-indigo-200 px-4 py-2 rounded-xl transition-all">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                    </svg>
                    Buat Laporan Sekarang
                </a>
            </div>
        </div>
    @endforelse

</div>

@endsection