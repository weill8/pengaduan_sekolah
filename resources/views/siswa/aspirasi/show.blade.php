@extends('layouts.siswa')

@section('title', 'Detail Aspirasi')

@section('content')
    <div class="max-w-5xl mx-auto">
        {{-- Back Link --}}
        <div class="mb-6">
            <a href="{{ route('siswa.histori.histori') }}"
                class="inline-flex items-center gap-1.5 text-sm font-semibold text-slate-500 hover:text-emerald-600 transition-colors group">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform group-hover:-translate-x-0.5"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke Histori
            </a>
        </div>

        {{-- Page Header --}}
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
            <div>
                <div class="flex items-center gap-2 mb-1">
                    <div class="w-1 h-6 rounded-full bg-gradient-to-b from-emerald-500 to-teal-600"></div>
                    <h1
                        class="text-xl font-bold bg-gradient-to-r from-emerald-600 to-teal-600 bg-clip-text text-transparent">
                        Detail Aspirasi {{ Auth::guard('siswa')->user()->nama }}
                    </h1>
                </div>
                <p class="text-sm text-slate-500 ml-3">
                    Dikirim pada {{ $inputAspirasi->created_at?->translatedFormat('d F Y, H:i') ?? '-' }}
                </p>
            </div>

            {{-- Status Badge --}}
            @php
                $status = $inputAspirasi->aspirasi?->status ?? 'menunggu';
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
                $dotColors = [
                    'menunggu' => 'bg-amber-500',
                    'proses' => 'bg-sky-500 animate-pulse',
                    'selesai' => 'bg-emerald-500',
                ];
            @endphp
            <span
                class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-sm font-semibold {{ $statusColors[$status] }}">
                <span class="w-2 h-2 rounded-full {{ $dotColors[$status] }}"></span>
                {{ $statusLabels[$status] }}
            </span>
        </div>

        {{-- Main Grid --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">

            {{-- 
            KOLOM KIRI — Info Aspirasi
         --}}
            <div class="lg:col-span-2 space-y-5">

                {{-- Timeline Status (Visual Progress) --}}
                <div class="rounded-2xl border border-slate-100 bg-white shadow-sm overflow-hidden">
                    <div class="bg-slate-50/80 px-6 py-3.5 border-b border-slate-100 flex items-center gap-2">
                        <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                        <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Progres Penyelesaian</span>
                    </div>

                    <div
                        class="w-full max-w-2xl mx-auto bg-white/70 backdrop-blur-md shadow-sm p-8">
                        <div class="relative flex items-center justify-between">

                            {{-- Step 1: Menunggu --}}
                            <div class="relative flex flex-col items-center gap-3 z-10 flex-shrink-0">
                                <div class="relative">
                                    <div
                                        class="w-10 h-10 rounded-full flex items-center justify-center text-sm font-bold transition-all duration-500 ease-out
                                            {{ in_array($status, ['menunggu', 'proses', 'selesai'])
                                                ? 'bg-gradient-to-br from-emerald-500 to-teal-600 text-white shadow-lg shadow-emerald-500/30'
                                                : 'bg-slate-50 text-slate-400 border-2 border-dashed border-slate-300' }}">
                                        @if (in_array($status, ['menunggu', 'proses', 'selesai']))
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                stroke-width="3" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                            </svg>
                                        @else
                                            1
                                        @endif
                                    </div>
                                    @if ($status === 'menunggu')
                                        <div
                                            class="absolute -inset-1.5 rounded-full border-2 border-emerald-800 animate-pulse">
                                        </div>
                                    @endif
                                </div>
                                <span
                                    class="text-[11px] font-semibold uppercase tracking-wider {{ in_array($status, ['menunggu', 'proses', 'selesai']) ? 'text-emerald-700' : 'text-slate-400' }}">
                                    Menunggu
                                </span>
                            </div>

                            {{-- Garis 1 (Antara Menunggu & Proses) --}}
                            <div class="relative flex-1 h-1.5 mx-3 overflow-hidden">
                                {{-- Track Background: Abu-abu Dashed --}}
                                <div
                                    class="absolute inset-0 rounded-full bg-slate-100  border-slate-300">
                                </div>
                                {{-- Progress Fill --}}
                                <div class="absolute left-0 top-0 h-full rounded-full bg-gradient-to-r from-emerald-400 to-teal-500 transition-all duration-700 ease-out shadow-[0_0_12px_rgba(16,185,129,0.35)]"
                                    style="width: {{ in_array($status, ['proses', 'selesai']) ? '100%' : '0%' }};">
                                </div>
                            </div>

                            {{-- Step 2: Proses --}}
                            <div class="relative flex flex-col items-center gap-3 z-10 flex-shrink-0">
                                <div class="relative">
                                    <div
                                        class="w-10 h-10 rounded-full flex items-center justify-center text-sm font-bold transition-all duration-500 ease-out
                                        {{ in_array($status, ['proses', 'selesai'])
                                            ? 'bg-gradient-to-br from-emerald-500 to-teal-600 text-white shadow-lg shadow-emerald-500/30'
                                            : 'bg-slate-50 text-slate-400 border-2 border-dashed border-slate-300' }}">
                                        @if (in_array($status, ['proses', 'selesai']))
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                stroke-width="3" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                            </svg>
                                        @else
                                            2
                                        @endif
                                    </div>
                                    @if ($status === 'proses')
                                        <div
                                            class="absolute -inset-1.5 rounded-full border-2 border-emerald-800 animate-pulse">
                                        </div>
                                    @endif
                                </div>
                                <span
                                    class="text-[11px] font-semibold uppercase tracking-wider {{ in_array($status, ['proses', 'selesai']) ? 'text-emerald-700' : 'text-slate-400' }}">
                                    Proses
                                </span>
                            </div>

                            {{-- Garis 2 (Antara Proses & Selesai) --}}
                            <div class="relative flex-1 h-1.5 mx-3 overflow-hidden">
                                {{-- Track Background: Abu-abu Dashed --}}
                                <div
                                    class="absolute inset-0 rounded-full bg-slate-100  border-slate-300">
                                </div>
                                {{-- Progress Fill --}}
                                <div class="absolute left-0 top-0 h-full rounded-full bg-gradient-to-r from-teal-500 to-cyan-500 transition-all duration-700 ease-out shadow-[0_0_12px_rgba(16,185,129,0.35)]"
                                    style="width: {{ $status === 'selesai' ? '100%' : '0%' }};">
                                </div>
                            </div>

                            {{-- Step 3: Selesai --}}
                            <div class="relative flex flex-col items-center gap-3 z-10 flex-shrink-0">
                                <div class="relative">
                                    <div
                                        class="w-10 h-10 rounded-full flex items-center justify-center text-sm font-bold transition-all duration-500 ease-out
                                        {{ $status === 'selesai'
                                            ? 'bg-gradient-to-br from-emerald-500 to-teal-600 text-white shadow-lg shadow-emerald-500/30'
                                            : 'bg-slate-50 text-slate-400 border-2 border-dashed border-slate-300' }}">
                                        @if ($status === 'selesai')
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                stroke-width="3" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                            </svg>
                                        @else
                                            3
                                        @endif
                                    </div>
                                    @if ($status === 'selesai')
                                        <div
                                            class="absolute -inset-1.5 rounded-full border-2 border-emerald-800 animate-pulse">
                                        </div>
                                    @endif
                                </div>
                                <span
                                    class="text-[11px] font-semibold uppercase tracking-wider {{ $status === 'selesai' ? 'text-emerald-700' : 'text-slate-400' }}">
                                    Selesai
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Info Card --}}
                <div class="rounded-2xl border border-slate-100 bg-white shadow-sm overflow-hidden">
                    <div class="bg-slate-50/80 px-6 py-3.5 border-b border-slate-100 flex items-center gap-2">
                        <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Informasi Aspirasi</span>
                    </div>

                    <div class="divide-y divide-slate-50">
                        {{-- Kategori --}}
                        <div class="px-6 py-4 flex items-center justify-between">
                            <span class="text-sm font-medium text-slate-400">Kategori</span>
                            <div class="flex items-center gap-2">
                                <div
                                    class="w-6 h-6 rounded-lg bg-gradient-to-br from-teal-100 to-emerald-100 flex items-center justify-center">
                                    <svg class="w-3 h-3 text-teal-500" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                    </svg>
                                </div>
                                <span class="text-sm font-semibold text-slate-700">
                                    {{ $inputAspirasi->kategori?->ket_kategori ?? '-' }}
                                </span>
                            </div>
                        </div>

                        {{-- Lokasi --}}
                        <div class="px-6 py-4 flex items-center justify-between">
                            <span class="text-sm font-medium text-slate-400">Lokasi</span>
                            <span class="inline-flex items-center gap-1.5 text-sm text-slate-700">
                                <svg class="w-3.5 h-3.5 text-slate-400" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                {{ $inputAspirasi->lokasi }}
                            </span>
                        </div>

                        {{-- Keterangan --}}
                        <div class="px-6 py-4">
                            <span class="text-sm font-medium text-slate-400 block mb-2">Keterangan</span>
                            <p
                                class="text-sm text-slate-700 whitespace-pre-line wrap-break-word leading-relaxed bg-slate-50 rounded-xl px-4 py-3 border border-slate-100">{{ $inputAspirasi->ket }}</p>
                        </div>
                    </div>
                </div>



            </div>

            {{-- 
            KOLOM KANAN — Umpan Balik
         --}}
            <div class="space-y-5">

                {{-- Feedback Card --}}
                <div class="rounded-2xl border border-slate-100 bg-white shadow-sm overflow-hidden">
                    <div class="bg-slate-50/80 px-6 py-3.5 border-b border-slate-100 flex items-center gap-2">
                        <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                        </svg>
                        <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Umpan Balik Admin</span>
                    </div>

                    <div class="p-6">
                        @if ($inputAspirasi->aspirasi?->feedback)
                            <div class="space-y-4">
                                <p
                                    class="text-sm text-slate-700 whitespace-pre-line wrap-break-word bg-emerald-50/50 rounded-xl px-4 py-3 border border-emerald-100">{{ $inputAspirasi->aspirasi->feedback }}</p>

                                <div class="flex items-center gap-3 pt-3 border-t border-slate-100">
                                    <div
                                        class="w-8 h-8 rounded-full bg-gradient-to-tr from-emerald-500 to-teal-500 flex items-center justify-center text-white text-xs font-bold ring-2 ring-white">
                                        {{ strtoupper(substr($inputAspirasi->aspirasi->admin->username ?? 'A', 0, 1)) }}
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-xs font-semibold text-slate-700 truncate">
                                            {{ $inputAspirasi->aspirasi->admin->username ?? 'Admin' }}
                                        </p>
                                        <p class="text-[10px] text-slate-400">
                                            {{ $inputAspirasi->aspirasi->updated_at?->translatedFormat('d F Y, H:i') ?? '-' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="flex flex-col items-center gap-3 py-6 text-center">
                                <div class="w-12 h-12 rounded-2xl bg-slate-100 flex items-center justify-center">
                                    <svg class="w-6 h-6 text-slate-300" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-slate-500">Belum ada umpan balik</p>
                                    <p class="text-xs text-slate-400 mt-0.5">Admin akan meninjau dan memberikan tanggapan
                                        segera</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Quick Info Card --}}
                <div class="rounded-2xl border border-slate-100 bg-white shadow-sm overflow-hidden">
                    <div class="bg-slate-50/80 px-6 py-3.5 border-b border-slate-100 flex items-center gap-2">
                        <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Info Tambahan</span>
                    </div>
                    <div class="p-6 ">

                        <div class="flex items-center justify-between text-sm">
                            <span class="text-slate-400">Terakhir Update</span>
                            <span
                                class="text-slate-600">{{ $inputAspirasi->aspirasi?->updated_at?->translatedFormat('d M Y') ?? '-' }}</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
