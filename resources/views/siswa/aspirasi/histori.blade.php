@extends('layouts.siswa')

@section('title', 'Histori Aspirasi')

@section('content')
<div class="max-w-7xl mx-auto">
    {{-- Page Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <div class="w-1 h-6 rounded-full bg-gradient-to-b from-emerald-500 to-teal-600"></div>
                <h1 class="text-xl font-bold bg-gradient-to-r from-emerald-600 to-teal-600 bg-clip-text text-transparent">Histori Aspirasi</h1>
            </div>
            <p class="text-sm text-slate-500 ml-3">Pantau status dan riwayat laporan aspirasi Anda</p>
        </div>
        <a href="{{ route('siswa.aspirasi.create') }}"
            class="inline-flex items-center gap-2 bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white text-sm font-semibold px-5 py-2.5 rounded-xl shadow-md shadow-emerald-500/25 hover:shadow-lg hover:shadow-emerald-500/30 transition-all hover:-translate-y-0.5 active:translate-y-0">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>
            Buat Aspirasi
        </a>
    </div>

    {{-- Table Card --}}
    <div class="rounded-2xl border border-slate-100 overflow-hidden shadow-sm">
        {{-- Table Header --}}
        <div class="bg-slate-50/80 px-6 py-3.5 border-b border-slate-100 flex items-center gap-2">
            <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Daftar Histori</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead>
                    <tr class="bg-white border-b border-slate-100">
                        <th class="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider text-center w-16">No</th>
                        <th class="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider">Kategori</th>
                        <th class="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider">Lokasi</th>
                        <th class="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider text-center">Status</th>
                        <th class="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse ($aspirasis as $index => $item)
                        @php
                            $status = $item->aspirasi?->status ?? 'menunggu';
                            $statusColors = [
                                'menunggu' => 'bg-amber-50 text-amber-700 ring-1 ring-amber-200',
                                'proses'   => 'bg-sky-50 text-sky-700 ring-1 ring-sky-200',
                                'selesai'  => 'bg-emerald-50 text-emerald-700 ring-1 ring-emerald-200',
                            ];
                            $statusLabels = [
                                'menunggu' => 'Menunggu',
                                'proses'   => 'Diproses',
                                'selesai'  => 'Selesai',
                            ];
                        @endphp
                        <tr class="bg-white hover:bg-emerald-50/30 transition-colors group">
                            <td class="px-6 py-4 text-center">
                                <span class="text-xs font-semibold text-slate-400 bg-slate-100 w-7 h-7 rounded-lg inline-flex items-center justify-center">
                                    {{ $aspirasis->firstItem() + $index }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <div class="w-6 h-6 rounded-lg bg-gradient-to-br from-teal-100 to-emerald-100 flex items-center justify-center flex-shrink-0">
                                        <svg class="w-3 h-3 text-teal-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                        </svg>
                                    </div>
                                    <span class="text-sm font-medium text-slate-700 truncate max-w-[150px]">{{ $item->kategori?->ket_kategori ?? '-' }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm text-slate-600 truncate max-w-[150px]" title="{{ $item->lokasi }}">{{ $item->lokasi }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center gap-1.5 text-xs text-slate-500">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    {{ $item->created_at?->format('d M Y') ?? '-' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex items-center justify-center gap-1.5 px-2.5 py-1 rounded-lg text-xs font-semibold {{ $statusColors[$status] }}">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $status === 'menunggu' ? 'bg-amber-500' : ($status === 'proses' ? 'bg-sky-500 animate-pulse' : 'bg-emerald-500') }}"></span>
                                    {{ $statusLabels[$status] }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <a href="{{ route('siswa.histori.show', $item->id_pelaporan) }}"
                                    class="inline-flex items-center gap-1.5 text-xs font-semibold text-emerald-600 bg-emerald-50 hover:bg-emerald-100 border border-emerald-200 px-3 py-1.5 rounded-lg transition-all hover:shadow-sm whitespace-nowrap">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-16 text-center bg-white">
                                <div class="flex flex-col items-center gap-3">
                                    <div class="w-14 h-14 rounded-2xl bg-slate-100 flex items-center justify-center">
                                        <svg class="w-7 h-7 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-slate-500">Belum ada riwayat aspirasi</p>
                                        <p class="text-xs text-slate-400 mt-0.5">
                                            <a href="{{ route('siswa.aspirasi.create') }}" class="text-emerald-600 hover:text-emerald-700 font-medium underline underline-offset-2 decoration-emerald-300 hover:decoration-emerald-500 transition-all">
                                                Buat aspirasi pertama Anda
                                            </a> untuk memulai.
                                        </p>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if ($aspirasis->hasPages())
            <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/50">
                {{ $aspirasis->links() }}
            </div>
        @endif
    </div>
</div>
@endsection