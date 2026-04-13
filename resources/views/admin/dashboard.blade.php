@extends('layouts.admin')

@section('title', 'Dashboard - Admin')

@section('content')

{{-- Page Header --}}
<div class="mb-8">
    <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Dashboard</h1>
    <p class="mt-1 text-sm text-gray-500">Selamat datang kembali! Berikut ringkasan sistem pengaduan hari ini.</p>
</div>

{{-- STAT CARDS --}}
<div class="grid grid-cols-1 gap-5 sm:grid-cols-2 xl:grid-cols-4 mb-8">

    {{-- Card: Total Siswa --}}
    <div class="group relative overflow-hidden rounded-2xl bg-white p-5 shadow-sm ring-1 ring-gray-100 transition-all duration-200 hover:shadow-md hover:-translate-y-0.5">
        <div class="flex items-start justify-between">
            <div>
                <p class="text-xs font-semibold uppercase tracking-widest text-gray-400">Total Siswa</p>
                <p class="mt-2 text-3xl font-bold text-gray-900">{{ number_format($totalSiswa) }}</p>
                <p class="mt-1 text-xs text-gray-400">Siswa terdaftar</p>
            </div>
            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600 transition-colors duration-200 group-hover:bg-indigo-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </div>
        </div>
        <div class="absolute bottom-0 left-0 h-0.5 w-full bg-gradient-to-r from-indigo-400 to-indigo-600 opacity-0 transition-opacity duration-200 group-hover:opacity-100"></div>
    </div>

    {{-- Card: Total Aspirasi --}}
    <div class="group relative overflow-hidden rounded-2xl bg-white p-5 shadow-sm ring-1 ring-gray-100 transition-all duration-200 hover:shadow-md hover:-translate-y-0.5">
        <div class="flex items-start justify-between">
            <div>
                <p class="text-xs font-semibold uppercase tracking-widest text-gray-400">Total Aspirasi</p>
                <p class="mt-2 text-3xl font-bold text-gray-900">{{ number_format($totalReports) }}</p>
                <p class="mt-1 text-xs text-gray-400">Semua laporan masuk</p>
            </div>
            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-sky-50 text-sky-600 transition-colors duration-200 group-hover:bg-sky-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
        </div>
        <div class="absolute bottom-0 left-0 h-0.5 w-full bg-gradient-to-r from-sky-400 to-sky-600 opacity-0 transition-opacity duration-200 group-hover:opacity-100"></div>
    </div>

    {{-- Card: Total Kategori --}}
    <div class="group relative overflow-hidden rounded-2xl bg-white p-5 shadow-sm ring-1 ring-gray-100 transition-all duration-200 hover:shadow-md hover:-translate-y-0.5">
        <div class="flex items-start justify-between">
            <div>
                <p class="text-xs font-semibold uppercase tracking-widest text-gray-400">Kategori</p>
                <p class="mt-2 text-3xl font-bold text-gray-900">{{ number_format($totalKategori) }}</p>
                <p class="mt-1 text-xs text-gray-400">Kategori pengaduan</p>
            </div>
            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-violet-50 text-violet-600 transition-colors duration-200 group-hover:bg-violet-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                </svg>
            </div>
        </div>
        <div class="absolute bottom-0 left-0 h-0.5 w-full bg-gradient-to-r from-violet-400 to-violet-600 opacity-0 transition-opacity duration-200 group-hover:opacity-100"></div>
    </div>

    {{-- Card: Aspirasi Pending --}}
    <div class="group relative overflow-hidden rounded-2xl bg-white p-5 shadow-sm ring-1 ring-gray-100 transition-all duration-200 hover:shadow-md hover:-translate-y-0.5">
        <div class="flex items-start justify-between">
            <div>
                <p class="text-xs font-semibold uppercase tracking-widest text-gray-400">Menunggu</p>
                <p class="mt-2 text-3xl font-bold text-gray-900">{{ number_format($pendingReports) }}</p>
                <p class="mt-1 text-xs text-gray-400">Aspirasi belum ditangani</p>
            </div>
            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-amber-50 text-amber-600 transition-colors duration-200 group-hover:bg-amber-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>
        @if($pendingReports > 0)
            <div class="absolute top-3 right-3 flex h-2 w-2">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2 w-2 bg-amber-500"></span>
            </div>
        @endif
        <div class="absolute bottom-0 left-0 h-0.5 w-full bg-gradient-to-r from-amber-400 to-amber-600 opacity-0 transition-opacity duration-200 group-hover:opacity-100"></div>
    </div>

</div>

{{-- 
    CHARTS
 --}}
<div class="grid grid-cols-1 gap-5 lg:grid-cols-3 mb-8">

    {{-- Line Chart: Aspirasi per hari --}}
    <div class="lg:col-span-2 rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-100">
        <div class="mb-4 flex items-center justify-between">
            <div>
                <h2 class="text-sm font-semibold text-gray-900">Tren Aspirasi</h2>
                <p class="text-xs text-gray-400 mt-0.5">7 hari terakhir</p>
            </div>
            <span class="inline-flex items-center gap-1.5 rounded-lg bg-indigo-50 px-2.5 py-1 text-xs font-medium text-indigo-700">
                <div class="h-3 w-3 bg-white rounded-full ring-2 ring-indigo-500"></div>
                Aspirasi Masuk
            </span>
        </div>
        <div class="relative h-60">
            <canvas id="lineChart"></canvas>
        </div>
    </div>

    {{-- Bar Chart: Aspirasi per kategori --}}
    <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-100">
        <div class="mb-4">
            <h2 class="text-sm font-semibold text-gray-900">Per Kategori</h2>
            <p class="text-xs text-gray-400 mt-0.5">Distribusi semua laporan</p>
        </div>
        <div class="relative h-60">
            <canvas id="barChart"></canvas>
        </div>
    </div>

</div>

{{-- 
    RECENT REPORTS TABLE
 --}}
<div class="rounded-2xl bg-white shadow-sm ring-1 ring-gray-100 overflow-hidden">

    {{-- Table Header --}}
    <div class="flex items-center justify-between px-6 py-4 border-b border-gray-50">
        <div>
            <h2 class="text-sm font-semibold text-gray-900">Aspirasi Terbaru</h2>
            <p class="text-xs text-gray-400 mt-0.5">8 laporan terkini</p>
        </div>
        <a href="{{ route('admin.aspirasi.index') }}"
           class="inline-flex items-center gap-1 text-xs font-medium text-indigo-600 hover:text-indigo-700 transition-colors">
            Lihat semua
            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
            </svg>
        </a>
    </div>

    {{-- Table --}}
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-50">
            <thead>
                <tr class="bg-gray-50/60">
                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-400">Keterangan</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-400">Pelapor</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-400">Kategori</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-400">Lokasi</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-400">Tanggal</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-400">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50 bg-white">

                @forelse($reports as $report)
                    @php
                        $status = $report->aspirasi?->status ?? 'menunggu';
                    @endphp
                    <tr class="transition-colors duration-150 hover:bg-gray-50/70">

                        {{-- Keterangan --}}
                        <td class="px-6 py-4">
                            <p class="text-sm font-medium text-gray-800 truncate max-w-[180px]" title="{{ $report->ket }}">
                                {{ $report->ket }}
                            </p>
                        </td>

                        {{-- Pelapor --}}
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2.5">
                                <div class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-indigo-100 text-xs font-bold text-indigo-700">
                                    {{ strtoupper(substr($report->siswa?->nama, 0, 1)) }}
                                </div>
                                <span class="text-sm text-gray-700">{{ $report->siswa?->nama }}</span>
                            </div>
                        </td>

                        {{-- Kategori --}}
                        <td class="px-6 py-4">
                            <span class="text-sm text-gray-600">{{ $report->kategori?->ket_kategori ?? '-' }}</span>
                        </td>

                        {{-- Lokasi --}}
                        <td class="px-6 py-4">
                            <span class="text-sm text-gray-500 truncate max-w-[120px] block" title="{{ $report->lokasi }}">
                                {{ $report->lokasi }}
                            </span>
                        </td>

                        {{-- Tanggal --}}
                        <td class="px-6 py-4">
                            <span class="text-sm text-gray-500">
                                {{ \Carbon\Carbon::parse($report->created_at)->format('d M Y') }}
                            </span>
                        </td>

                        {{-- Status Badge --}}
                        <td class="px-6 py-4">
                            @if($status === 'menunggu')
                                <span class="inline-flex items-center gap-1 rounded-full bg-amber-50 px-2.5 py-1 text-xs font-semibold text-amber-700 ring-1 ring-amber-200">
                                    <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>
                                    Menunggu
                                </span>
                            @elseif($status === 'proses')
                                <span class="inline-flex items-center gap-1 rounded-full bg-sky-50 px-2.5 py-1 text-xs font-semibold text-sky-700 ring-1 ring-sky-200">
                                    <span class="h-1.5 w-1.5 rounded-full bg-sky-500 animate-pulse"></span>
                                    Proses
                                </span>
                            @elseif($status === 'selesai')
                                <span class="inline-flex items-center gap-1 rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-700 ring-1 ring-emerald-200">
                                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                    Selesai
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 rounded-full bg-gray-50 px-2.5 py-1 text-xs font-semibold text-gray-500 ring-1 ring-gray-200">
                                    Tidak diketahui
                                </span>
                            @endif
                        </td>

                    </tr>
                @empty
                    {{-- Empty State --}}
                    <tr>
                        <td colspan="6" class="px-6 py-16 text-center">
                            <div class="flex flex-col items-center justify-center gap-3">
                                <div class="flex h-14 w-14 items-center justify-center rounded-full bg-gray-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                </div>
                                <p class="text-sm font-medium text-gray-500">Belum ada laporan masuk</p>
                                <p class="text-xs text-gray-400">Aspirasi dari siswa akan muncul di sini</p>
                            </div>
                        </td>
                    </tr>
                @endforelse

            </tbody>
        </table>
    </div>
</div>

{{-- 
    CHART.JS SCRIPTS
 --}}
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
    const chartDefaults = {
        font: { family: "'Inter', sans-serif" },
        color: '#9ca3af',
    };
    Chart.defaults.font.family  = chartDefaults.font.family;
    Chart.defaults.color        = chartDefaults.color;

    // ── Line Chart ──────────────────────────────
    new Chart(document.getElementById('lineChart'), {
        type: 'line',
        data: {
            labels: @json($userGrowthLabels),
            datasets: [{
                label: 'Aspirasi',
                data: @json($userGrowthData),
                borderColor: '#6366f1',
                backgroundColor: 'rgba(99,102,241,0.08)',
                borderWidth: 2,
                pointBackgroundColor: '#6366f1',
                pointRadius: 4,
                pointHoverRadius: 6,
                tension: 0.4,
                fill: true,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#1e1b4b',
                    titleColor: '#e0e7ff',
                    bodyColor: '#c7d2fe',
                    padding: 10,
                    cornerRadius: 8,
                },
            },
            scales: {
                x: { grid: { display: false }, border: { display: false } },
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1, precision: 0 },
                    grid: { color: 'rgba(0,0,0,0.04)' },
                    border: { display: false },
                },
            },
        }
    });

    // ── Bar Chart ───────────────────────────────
    new Chart(document.getElementById('barChart'), {
        type: 'bar',
        data: {
            labels: @json($reportCategoryLabels),
            datasets: [{
                label: 'Aspirasi',
                data: @json($reportCategoryData),
                backgroundColor: [
                    'rgba(99,102,241,0.75)',
                    'rgba(14,165,233,0.75)',
                    'rgba(168,85,247,0.75)',
                    'rgba(251,191,36,0.75)',
                    'rgba(52,211,153,0.75)',
                    'rgba(251,113,133,0.75)',
                ],
                borderRadius: 6,
                borderSkipped: false,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#1e1b4b',
                    titleColor: '#e0e7ff',
                    bodyColor: '#c7d2fe',
                    padding: 10,
                    cornerRadius: 8,
                },
            },
            scales: {
                x: { grid: { display: false }, border: { display: false } },
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1, precision: 0 },
                    grid: { color: 'rgba(0,0,0,0.04)' },
                    border: { display: false },
                },
            },
        }
    });
</script>
@endpush

@endsection