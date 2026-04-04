<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>AspirasiKu — Suara Siswa, Masa Depan Lebih Baik</title>

    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Fonts (Fontsource via CDN) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/syne@5.0.0/index.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/dm-sans@5.0.0/index.min.css">

    <style>
        [x-cloak] {
            display: none !important;
        }

        /* Grain overlay */
        .grain::after {
            content: '';
            position: fixed;
            inset: -200%;
            width: 400%;
            height: 400%;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 512 512' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.65' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)'/%3E%3C/svg%3E");
            opacity: 0.025;
            pointer-events: none;
            z-index: 9999;
            animation: grain 8s steps(10) infinite;
        }

        @keyframes grain {

            0%,
            100% {
                transform: translate(0, 0);
            }

            10% {
                transform: translate(-5%, -10%);
            }

            20% {
                transform: translate(-15%, 5%);
            }

            30% {
                transform: translate(7%, -25%);
            }

            40% {
                transform: translate(-5%, 25%);
            }

            50% {
                transform: translate(-15%, 10%);
            }

            60% {
                transform: translate(15%, 0%);
            }

            70% {
                transform: translate(0%, 15%);
            }

            80% {
                transform: translate(3%, 35%);
            }

            90% {
                transform: translate(-10%, 10%);
            }
        }

        /* Glow blob */
        .blob {
            filter: blur(80px);
            border-radius: 9999px;
            animation: float 8s ease-in-out infinite;
        }

        /* Marquee */
        .marquee-track {
            display: flex;
            gap: 3rem;
            animation: marquee 20s linear infinite;
            white-space: nowrap;
        }

        /* Card hover glow */
        .card-glow {
            transition: all 0.3s ease;
        }

        .card-glow:hover {
            box-shadow: 0 0 40px rgba(99, 102, 241, 0.15);
            transform: translateY(-4px);
        }

        /* Shimmer CTA */
        .btn-shimmer {
            position: relative;
            overflow: hidden;
        }

        .btn-shimmer::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 60%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .btn-shimmer:hover::before {
            left: 150%;
        }

        /* Fade in on scroll */
        .fade-up {
            opacity: 0;
            transform: translateY(24px);
            transition: opacity 0.7s ease, transform 0.7s ease;
        }

        .fade-up.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Active nav indicator */
        .nav-link::after {
            content: '';
            display: block;
            width: 0;
            height: 2px;
            background: #6366f1;
            transition: width 0.3s ease;
        }

        .nav-link:hover::after {
            width: 100%;
        }
    </style>
</head>

<body x-data="{ mobileOpen: false }" class="grain bg-slate-50 text-slate-900 antialiased overflow-x-hidden">

    {{-- ===================== NAVBAR ===================== --}}
    <header class="fixed top-0 left-0 right-0 z-50">
        <div class="absolute inset-0 bg-slate-50/80 backdrop-blur-xl border-b border-slate-200/60"></div>
        <nav class="relative max-w-7xl mx-auto px-5 sm:px-8 h-16 flex items-center justify-between">

            {{-- Logo --}}
            <a href="#" class="flex items-center gap-2.5 group relative z-10">
                <div
                    class="w-8 h-8 rounded-lg bg-gradient-to-br from-indigo-500 to-violet-600 flex items-center justify-center shadow-lg shadow-indigo-500/30 group-hover:scale-105 transition-transform">
                    <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                    </svg>
                </div>
                <span class="font-display font-700 text-lg tracking-tight text-slate-900">AspirasiKu</span>
            </a>

            {{-- Desktop Nav - Centered Absolutely --}}
            <ul class="hidden md:flex absolute left-1/2 -translate-x-1/2 items-center gap-7">
                <li><a href="#fitur"
                        class="nav-link text-sm font-medium text-slate-600 hover:text-slate-900 transition-colors">Fitur</a>
                </li>
                <li><a href="#cara-kerja"
                        class="nav-link text-sm font-medium text-slate-600 hover:text-slate-900 transition-colors">Cara
                        Kerja</a></li>
                <li><a href="#statistik"
                        class="nav-link text-sm font-medium text-slate-600 hover:text-slate-900 transition-colors">Dampak</a>
                </li>
            </ul>

            {{-- Right Actions --}}
            <div class="flex items-center gap-3 relative z-10">
                @auth('admin')
                    {{-- Jika login sebagai admin --}}
                    <a href="{{ route('admin.dashboard') }}"
                        class="btn-shimmer hidden sm:inline-flex items-center gap-1.5 text-sm font-semibold bg-indigo-600 text-white px-4 py-2 rounded-lg">
                        Dashboard >>
                    </a>
                @elseif(auth('siswa')->check())
                    {{-- Jika login sebagai siswa --}}
                    <a href="{{ route('siswa.dashboard') }}"
                        class="btn-shimmer hidden sm:inline-flex items-center gap-1.5 text-sm font-semibold bg-indigo-600 text-white px-4 py-2 rounded-lg">
                        Dashboard >>
                    </a>
                @else
                    <a href="{{ route('siswa.login') }}"
                        class="hidden sm:inline-flex text-sm font-medium text-slate-700 hover:text-indigo-600 transition-colors px-3 py-2">Masuk</a>

                    <a href="{{ route('admin.login') }}"
                        class="btn-shimmer hidden sm:inline-flex items-center gap-1.5 text-sm font-semibold bg-indigo-600 hover:bg-indigo-500 text-white px-4 py-2 rounded-lg shadow-lg shadow-indigo-500/25 transition-colors">
                        <span>Admin</span>
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                @endauth

                {{-- Mobile menu toggle --}}
                <button x-cloak @click="mobileOpen = !mobileOpen"
                    class="md:hidden p-2 rounded-lg hover:bg-slate-100 transition-colors">
                    <svg x-show="!mobileOpen" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg x-show="mobileOpen" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </nav>

        {{-- Mobile Menu --}}
        <div x-cloak x-show="mobileOpen" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-2"
            class="relative md:hidden border-t border-slate-200 bg-slate-50 px-5 py-4 flex flex-col gap-2">
            <a href="#fitur" @click="mobileOpen = false" class="py-2 text-sm font-medium text-slate-700">Fitur</a>
            <a href="#cara-kerja" @click="mobileOpen = false" class="py-2 text-sm font-medium text-slate-700">Cara
                Kerja</a>
            <a href="#statistik" @click="mobileOpen = false" class="py-2 text-sm font-medium text-slate-700">Dampak</a>
            @auth('admin')
                <div class="border-t border-slate-200 pt-4">
                    <a href="{{ route('admin.dashboard') }}"
                        class="btn-shimmer flex items-center gap-1.5 text-sm font-semibold bg-indigo-600 text-white px-4 py-2 rounded-lg">
                        Dashboard
                    </a>
                </div>
            @elseif(auth('siswa')->check())
                <div class="border-t border-slate-200 pt-4">
                    <a href="{{ route('siswa.dashboard') }}"
                        class="btn-shimmer flex items-center gap-1.5 text-sm font-semibold bg-indigo-600 text-white px-4 py-2 rounded-lg">
                        Dashboard
                    </a>
                </div>
            @else
                <div class="pt-2 border-t border-slate-200 flex flex-col gap-3">
                    <a href="{{ route('siswa.login') }}"
                        class="flex-1 text-center text-sm font-medium border border-slate-200 rounded-lg py-2 hover:bg-slate-100 transition-colors">Masuk
                        Siswa</a>
                    <a href="{{ route('admin.login') }}"
                        class="flex-1 text-center text-sm font-medium border text-white bg-indigo-600 border-indigo-200 rounded-lg py-2 hover:bg-indigo-800 transition-colors">Masuk
                        Admin</a>
                </div>
            @endauth

        </div>
    </header>


    {{-- ===================== HERO SECTION ===================== --}}
    <section class="relative min-h-screen flex items-center pt-16 overflow-hidden">
        {{-- Background blobs --}}
        <div class="absolute top-20 -left-32 w-64 sm:w-96 h-64 sm:h-96 blob bg-violet-400/20"></div>
        <div
            class="absolute bottom-10 -right-10 sm:-right-32 w-64 sm:w-[500px] h-64 sm:h-[500px] blob blob-2 bg-indigo-400/20">
        </div>
        <div
            class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[300px] blob bg-sky-400/10 hidden sm:block">
        </div>

        {{-- Grid pattern overlay --}}
        <div class="absolute inset-0 opacity-[0.03]"
            style="background-image: linear-gradient(currentColor 1px, transparent 1px), linear-gradient(to right, currentColor 1px, transparent 1px); background-size: 40px 40px;">
        </div>

        <div class="relative max-w-7xl mx-auto px-5 sm:px-8 pt-10 pb-20 text-center w-full">
            {{-- Badge --}}
            <div
                class="inline-flex tracking-widest items-center gap-2 rounded-full border border-indigo-200 bg-indigo-50 px-4 py-1.5 mb-8 text-xs font-semibold text-indigo-700 fade-up">
                <span class="flex h-1.5 w-1.5 rounded-full bg-indigo-500">
                    <span
                        class="animate-ping absolute inline-flex h-1.5 w-1.5 rounded-full bg-indigo-400 opacity-75"></span>
                </span>
                WEILLSUN | XII RPL 1 | 2026
            </div>

            {{-- Headline --}}
            <h1 class="font-display font-800 text-5xl sm:text-6xl lg:text-7xl xl:text-8xl leading-[1.05] tracking-tight text-slate-900 mb-6 fade-up"
                style="transition-delay: 0.1s">
                Suara Siswa<br>
                <span class="relative inline-block">
                    <span
                        class="bg-gradient-to-r from-indigo-600 via-violet-600 to-purple-600 bg-clip-text text-transparent">Didengar
                        & Ditindak</span>
                    <svg class="absolute -bottom-2 left-0 w-full" height="6" viewBox="0 0 300 6" fill="none"
                        xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
                        <path d="M0 5 Q75 0 150 5 Q225 10 300 5" stroke="url(#underline-grad)" stroke-width="2.5"
                            stroke-linecap="round" fill="none" />
                        <defs>
                            <linearGradient id="underline-grad" x1="0" y1="0" x2="300"
                                y2="0" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#6366f1" />
                                <stop offset="1" stop-color="#9333ea" />
                            </linearGradient>
                        </defs>
                    </svg>
                </span>
            </h1>

            {{-- Subheadline --}}
            <p class="max-w-2xl mx-auto text-lg sm:text-xl text-slate-500 leading-relaxed mb-10 fade-up"
                style="transition-delay: 0.2s">
                Platform aspirasi modern yang menghubungkan siswa dengan pihak sekolah secara transparan, terstruktur,
                dan terukur dari pengiriman hingga penyelesaian.
            </p>

            {{-- CTAs --}}
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 mb-20 fade-up"
                style="transition-delay: 0.3s">
                <a href="{{ route('siswa.login') }}"
                    class="btn-shimmer group w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-500 hover:to-violet-500 text-white font-semibold px-7 py-3.5 rounded-xl shadow-xl shadow-indigo-500/30 transition-all hover:-translate-y-0.5">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                    </svg>
                    Kirim Aspirasi Sekarang
                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
                <a href="#cara-kerja"
                    class="w-full sm:w-auto inline-flex items-center justify-center gap-2 text-slate-700 font-semibold px-7 py-3.5 rounded-xl border border-slate-200 hover:bg-slate-100 transition-all">
                    <svg class="w-4 h-4 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Lihat Cara Kerja
                </a>
            </div>

            {{-- Dashboard Preview --}}
            <div class="relative max-w-5xl mx-auto fade-up" style="transition-delay: 0.4s">
                <div
                    class="absolute -inset-4 rounded-3xl bg-gradient-to-b from-emerald-500/10 to-transparent blur-2xl">
                </div>
                <div class="relative rounded-2xl border border-slate-200/80 bg-white shadow-2xl overflow-hidden">

                    {{-- Browser bar --}}
                    <div class="flex items-center gap-2 px-4 py-3 border-b border-slate-100 bg-slate-50">
                        <div class="flex gap-1.5">
                            <div class="w-3 h-3 rounded-full bg-red-400"></div>
                            <div class="w-3 h-3 rounded-full bg-amber-400"></div>
                            <div class="w-3 h-3 rounded-full bg-emerald-400"></div>
                        </div>
                        <div class="flex-1 mx-4 bg-slate-100 rounded-md h-6 flex items-center px-3">
                            <span class="text-xs text-slate-400 font-mono">aspirasiku/siswa/dashboard</span>
                        </div>
                    </div>

                    {{-- Dashboard Body --}}
                    <div class="p-4 bg-white text-left space-y-4">

                        {{-- Welcome Header --}}
                        <div
                            class="rounded-xl bg-gradient-to-br from-emerald-600 to-teal-600 px-5 py-4 relative overflow-hidden">
                            <div
                                class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/4">
                            </div>
                            <div class="absolute bottom-0 right-10 w-16 h-16 bg-white/5 rounded-full translate-y-1/2">
                            </div>
                            <div class="relative flex items-center justify-between gap-4">
                                <div>
                                    <p class="text-white/80 text-xs mb-0.5">Selamat datang kembali 👋</p>
                                    <p class="text-white font-semibold text-base">Ahmad Fauzi — 2024001</p>
                                    <p class="text-white/75 text-xs mt-0.5">XII IPA 1 &nbsp;·&nbsp; Jumat, 03 April
                                        2025</p>
                                </div>
                                <div
                                    class="flex-shrink-0 bg-white text-emerald-700 text-xs font-bold px-4 py-2 rounded-xl flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                                    </svg>
                                    Buat Laporan
                                </div>
                            </div>
                        </div>

                        {{-- Stat Cards --}}
                        <div class="grid grid-cols-4 gap-3">

                            {{-- Total --}}
                            <div class="rounded-xl bg-white border border-slate-100 p-3.5 relative overflow-hidden">
                                <p class="text-[9px] font-bold uppercase tracking-widest text-slate-400">Total</p>
                                <p class="text-2xl font-bold text-slate-800 mt-1.5 mb-0.5">24</p>
                                <p class="text-[10px] text-slate-400">Semua laporan</p>
                                <div
                                    class="absolute top-2.5 right-2.5 w-8 h-8 rounded-lg bg-slate-100 flex items-center justify-center">
                                    <svg class="w-4 h-4 text-slate-500" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                            </div>

                            {{-- Menunggu --}}
                            <div class="rounded-xl bg-white border border-slate-100 p-3.5 relative overflow-hidden">
                                <p class="text-[9px] font-bold uppercase tracking-widest text-slate-400">Menunggu</p>
                                <p class="text-2xl font-bold text-amber-600 mt-1.5 mb-0.5">3</p>
                                <p class="text-[10px] text-slate-400">Menunggu ditangani</p>
                                {{-- Ping dot --}}
                                <div class="absolute top-2.5 right-2.5 flex h-2 w-2">
                                    <span
                                        class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-2 w-2 bg-amber-500"></span>
                                </div>
                                <div
                                    class="absolute top-7 right-2.5 w-8 h-8 rounded-lg bg-amber-50 flex items-center justify-center">
                                    <svg class="w-4 h-4 text-amber-500" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                            </div>

                            {{-- Diproses --}}
                            <div class="rounded-xl bg-white border border-slate-100 p-3.5 relative overflow-hidden">
                                <p class="text-[9px] font-bold uppercase tracking-widest text-slate-400">Diproses</p>
                                <p class="text-2xl font-bold text-sky-600 mt-1.5 mb-0.5">7</p>
                                <p class="text-[10px] text-slate-400">Sedang ditangani</p>
                                <div
                                    class="absolute top-2.5 right-2.5 w-8 h-8 rounded-lg bg-sky-50 flex items-center justify-center">
                                    <svg class="w-4 h-4 text-sky-500" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                    </svg>
                                </div>
                            </div>

                            {{-- Selesai --}}
                            <div class="rounded-xl bg-white border border-slate-100 p-3.5 relative overflow-hidden">
                                <p class="text-[9px] font-bold uppercase tracking-widest text-slate-400">Selesai</p>
                                <p class="text-2xl font-bold text-emerald-600 mt-1.5 mb-0.5">14</p>
                                <p class="text-[10px] text-slate-400">Berhasil ditangani</p>
                                <div
                                    class="absolute top-2.5 right-2.5 w-8 h-8 rounded-lg bg-emerald-50 flex items-center justify-center">
                                    <svg class="w-4 h-4 text-emerald-500" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                            </div>

                        </div>

                        {{-- Laporan Terbaru --}}
                        <div class="rounded-xl border border-slate-100 overflow-hidden">

                            {{-- Header --}}
                            <div
                                class="flex items-center justify-between px-4 py-2.5 bg-slate-50 border-b border-slate-100">
                                <div class="flex items-center gap-2">
                                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                    <span class="text-[9px] font-bold uppercase tracking-widest text-slate-500">Laporan
                                        Terbaru</span>
                                </div>
                                <span class="text-[11px] font-semibold text-indigo-500">Lihat semua →</span>
                            </div>

                            {{-- Row: Perbaikan Toilet --}}
                            <div class="flex items-center gap-3 px-4 py-3 border-b border-slate-50">
                                <div
                                    class="w-9 h-9 rounded-xl bg-gradient-to-br from-violet-100 to-indigo-100 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-4 h-4 text-violet-500" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-xs font-semibold text-slate-700">Perbaikan Toilet Lantai 2</p>
                                    <div class="flex">
                                        <p class="text-[10px] text-slate-400 mt-0.5">Fasilitas &nbsp;·&nbsp;</p>
                                        <p class="text-[10px] text-slate-400 mt-0.5 flex gap-1 items-center">
                                            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                            Gedung A
                                            &nbsp;·&nbsp;
                                        </p>
                                        <p class="text-[10px] text-slate-400 mt-0.5">28 Mar 2025</p>
                                    </div>
                                </div>
                                <div class="flex flex-col items-end gap-1 flex-shrink-0">
                                    <span
                                        class="inline-flex items-center gap-1 text-[10px] font-semibold px-2 py-0.5 rounded-lg bg-amber-50 text-amber-700 ring-1 ring-amber-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>Menunggu
                                    </span>
                                    <span class="text-[10px] font-semibold text-indigo-500">Detail →</span>
                                </div>
                            </div>

                            {{-- Row: Penambahan Buku --}}
                            <div class="flex items-start gap-3 px-4 py-3 border-b border-slate-50">
                                <div
                                    class="w-9 h-9 rounded-xl bg-gradient-to-br from-violet-100 to-indigo-100 flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <svg class="w-4 h-4 text-violet-500" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-xs font-semibold text-slate-700">Penambahan Buku Perpustakaan</p>
                                    <div class="flex">
                                        <p class="text-[10px] text-slate-400 mt-0.5">Akademik &nbsp;·&nbsp;
                                        </p>
                                        <p class="text-[10px] text-slate-400 mt-0.5 flex gap-1 items-center">
                                            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                            Perpustakaan
                                            &nbsp;·&nbsp;
                                        </p>
                                        <p class="text-[10px] text-slate-400 mt-0.5">
                                            20 Mar 2025
                                        </p>
                                    </div>
                                    <p class="mt-1.5 text-[10px] w-fit">
                                        🙍‍♂️💬: <span
                                            class="text-slate-500 bg-slate-100 font-mono rounded-r-full rounded-tl-full px-2.5 py-1">
                                            Buku sudah ditambahkan sebanyak 50 judul baru.</span>
                                    </p>

                                </div>
                                <div class="flex flex-col items-end gap-1 flex-shrink-0">
                                    <span
                                        class="inline-flex items-center gap-1 text-[10px] font-semibold px-2 py-0.5 rounded-lg bg-emerald-50 text-emerald-700 ring-1 ring-emerald-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>Selesai
                                    </span>
                                    <span class="text-[10px] font-semibold text-indigo-500">Detail →</span>
                                </div>
                            </div>

                            {{-- Row: WiFi --}}
                            <div class="flex items-center gap-3 px-4 py-3 border-b border-slate-50">
                                <div
                                    class="w-9 h-9 rounded-xl bg-gradient-to-br from-violet-100 to-indigo-100 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-4 h-4 text-violet-500" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-xs font-semibold text-slate-700">WiFi di Ruang Kelas</p>

                                    <div class="flex">
                                        <p class="text-[10px] text-slate-400 mt-0.5">
                                            Teknologi &nbsp;·&nbsp;
                                        </p>
                                        <p class="text-[10px] text-slate-400 mt-0.5 flex gap-1 items-center">
                                            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                            Ruang Kelas
                                            &nbsp;·&nbsp;
                                        </p>
                                        <p class="text-[10px] text-slate-400 mt-0.5">
                                            15 Mar 2025
                                        </p>
                                    </div>
                                </div>
                                <div class="flex flex-col items-end gap-1 flex-shrink-0">
                                    <span
                                        class="inline-flex items-center gap-1 text-[10px] font-semibold px-2 py-0.5 rounded-lg bg-sky-50 text-sky-700 ring-1 ring-sky-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-sky-500 animate-pulse"></span>Diproses
                                    </span>
                                    <span class="text-[10px] font-semibold text-indigo-500">Detail →</span>
                                </div>
                            </div>

                            {{-- Row: Kantin --}}
                            <div class="flex items-start gap-3 px-4 py-3">
                                <div
                                    class="w-9 h-9 rounded-xl bg-gradient-to-br from-violet-100 to-indigo-100 flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <svg class="w-4 h-4 text-violet-500" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-xs font-semibold text-slate-700">Kantin Lebih Sehat</p>
                                    <div class="flex">
                                    <p class="text-[10px] text-slate-400 mt-0.5">Kesehatan &nbsp;·&nbsp;</p>
                                    <p class="text-[10px] text-slate-400 mt-0.5 flex gap-1 items-center">
                                            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                            Kantin
                                            &nbsp;·&nbsp;
                                        </p>
                                    <p class="text-[10px] text-slate-400 mt-0.5">10 Mar 2025</p>
                                    </div>

                                    <p class="mt-1.5 text-[10px] w-fit">
                                        🙍‍♂️💬: <span
                                            class="text-slate-500 bg-slate-100 font-mono rounded-r-full rounded-tl-full px-2.5 py-1">
                                            Menu kantin sudah diperbarui dengan pilihan lebih sehat.</span>
                                    </p>
                                </div>
                                <div class="flex flex-col items-end gap-1 flex-shrink-0">
                                    <span
                                        class="inline-flex items-center gap-1 text-[10px] font-semibold px-2 py-0.5 rounded-lg bg-emerald-50 text-emerald-700 ring-1 ring-emerald-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>Selesai
                                    </span>
                                    <span class="text-[10px] font-semibold text-indigo-500">Detail →</span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    {{-- ===================== FITUR SECTION ===================== --}}
    <section id="fitur" class="py-24 sm:py-32 relative overflow-hidden">
        <div
            class="absolute top-0 left-1/2 -translate-x-1/2 w-px h-32 bg-gradient-to-b from-transparent via-slate-300 to-transparent">
        </div>

        <div class="max-w-7xl mx-auto px-5 sm:px-8">
            {{-- Section header --}}
            <div class="text-center mb-16 fade-up">
                <span class="text-xs font-bold uppercase tracking-widest text-indigo-600 mb-3 block">Fitur
                    Unggulan</span>
                <h2 class="font-display font-700 text-4xl sm:text-5xl text-slate-900 mb-4 tracking-tight">
                    Semua yang Kamu Butuhkan
                </h2>
                <p class="text-slate-500 max-w-xl mx-auto">Dirancang khusus untuk ekosistem sekolah Indonesia —
                    sederhana namun powerful.</p>
            </div>

            {{-- Feature grid --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                <div class="card-glow group rounded-2xl p-6 bg-white border border-slate-200/80 fade-up"
                    style="transition-delay: 0s">
                    <div
                        class="w-11 h-11 rounded-xl bg-gradient-to-br from-indigo-500 to-indigo-600 flex items-center justify-center text-lg mb-4 shadow-lg group-hover:scale-110 transition-transform">
                        📢
                    </div>
                    <h3 class="font-display font-600 text-base text-slate-900 mb-2">Kirim Aspirasi Mudah</h3>
                    <p class="text-sm text-slate-500 leading-relaxed">Siswa bisa menyampaikan aspirasi kapan saja lewat
                        form yang simpel dan intuitif.</p>
                </div>
                <div class="card-glow group rounded-2xl p-6 bg-white border border-slate-200/80 fade-up"
                    style="transition-delay: 0.08s">
                    <div
                        class="w-11 h-11 rounded-xl bg-gradient-to-br from-violet-500 to-violet-600 flex items-center justify-center text-lg mb-4 shadow-lg group-hover:scale-110 transition-transform">
                        ⏳
                    </div>
                    <h3 class="font-display font-600 text-base text-slate-900 mb-2">Pantau Progres</h3>
                    <p class="text-sm text-slate-500 leading-relaxed">Lacak status aspirasi: Menunggu → Diproses →
                        Selesai dengan visualisasi progress tracker.</p>
                </div>
                <div class="card-glow group rounded-2xl p-6 bg-white border border-slate-200/80 fade-up"
                    style="transition-delay: 0.16s">
                    <div
                        class="w-11 h-11 rounded-xl bg-gradient-to-br from-sky-500 to-sky-600 flex items-center justify-center text-lg mb-4 shadow-lg group-hover:scale-110 transition-transform">
                        💬
                    </div>
                    <h3 class="font-display font-600 text-base text-slate-900 mb-2">FeedBack</h3>
                    <p class="text-sm text-slate-500 leading-relaxed">Terima respons dan keterangan langsung dari pihak
                        sekolah terkait penanganan aspirasi yang kamu kirim.</p>
                </div>
                <div class="card-glow group rounded-2xl p-6 bg-white border border-slate-200/80 fade-up"
                    style="transition-delay: 0.24s">
                    <div
                        class="w-11 h-11 rounded-xl bg-gradient-to-br from-sky-500 to-sky-600 flex items-center justify-center text-lg mb-4 shadow-lg group-hover:scale-110 transition-transform">
                        🕒
                    </div>
                    <h3 class="font-display font-600 text-base text-slate-900 mb-2">Histori</h3>
                    <p class="text-sm text-slate-500 leading-relaxed">Semua aspirasi tersimpan di histori. Filter
                        berdasarkan kategori, status, atau tanggal dengan mudah.</p>
                </div>
                <div class="card-glow group rounded-2xl p-6 bg-white border border-slate-200/80 fade-up"
                    style="transition-delay: 0.32s">
                    <div
                        class="w-11 h-11 rounded-xl bg-gradient-to-br from-emerald-500 to-emerald-600 flex items-center justify-center text-lg mb-4 shadow-lg group-hover:scale-110 transition-transform">
                        🔍
                    </div>
                    <h3 class="font-display font-600 text-base text-slate-900 mb-2">Kategorisasi Cerdas</h3>
                    <p class="text-sm text-slate-500 leading-relaxed">Admin dapat memfilter laporan per tanggal, per
                        bulan, per siswa, atau per kategori untuk penanganan efisien.</p>
                </div>
                <div class="card-glow group rounded-2xl p-6 bg-white border border-slate-200/80 fade-up"
                    style="transition-delay: 0.4s">
                    <div
                        class="w-11 h-11 rounded-xl bg-gradient-to-br from-amber-500 to-amber-600 flex items-center justify-center text-lg mb-4 shadow-lg group-hover:scale-110 transition-transform">
                        🔐
                    </div>
                    <h3 class="font-display font-600 text-base text-slate-900 mb-2">Notifikasi Status</h3>
                    <p class="text-sm text-slate-500 leading-relaxed">Sistem autentikasi berbeda untuk siswa (login via
                        NIS) dan admin, menjamin keamanan data sekolah.</p>
                </div>
            </div>
        </div>
    </section>


    {{-- ===================== CARA KERJA SECTION ===================== --}}
    <section id="cara-kerja" class="py-24 sm:py-32 bg-slate-100/60 border-y border-slate-200/80 overflow-hidden">
        <div class="max-w-7xl mx-auto px-5 sm:px-8">
            <div class="text-center mb-16 fade-up">
                <span class="text-xs font-bold uppercase tracking-widest text-indigo-600 mb-3 block">Cara Kerja</span>
                <h2 class="font-display font-700 text-4xl sm:text-5xl text-slate-900 mb-4 tracking-tight">
                    3 Langkah Mudah
                </h2>
                <p class="text-slate-500 max-w-xl mx-auto">Dari aspirasi yang tersimpan dalam diam, menjadi perubahan
                    nyata di sekolah.</p>
            </div>

            <div class="relative">
                <div
                    class="hidden lg:block absolute top-14 left-1/2 -translate-x-1/2 w-2/3 h-px bg-gradient-to-r from-transparent via-indigo-300 to-transparent">
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <div class="relative text-center fade-up" style="transition-delay: 0s">
                        <div class="relative inline-flex items-center justify-center w-28 h-28 mb-6">
                            <div class="absolute inset-0 rounded-full bg-indigo-100 animate-ping opacity-20"></div>
                            <div
                                class="relative w-24 h-24 rounded-full bg-gradient-to-br from-indigo-500 to-indigo-600 flex items-center justify-center text-4xl shadow-xl shadow-indigo-500/20">
                                ✍️
                            </div>
                            <span
                                class="absolute -top-1 -right-1 w-7 h-7 rounded-full bg-white border-2 border-indigo-500 flex items-center justify-center text-xs font-display font-700 text-indigo-600">01</span>
                        </div>
                        <h3 class="font-display font-700 text-xl text-slate-900 mb-3">Siswa Kirim Aspirasi</h3>
                        <p class="text-sm text-slate-500 leading-relaxed max-w-xs mx-auto">Login ke platform, pilih
                            kategori, tulis aspirasi kamu — bisa dengan nama atau anonim. Prosesnya cuma 2 menit.</p>
                    </div>
                    <div class="relative text-center fade-up" style="transition-delay: 0.15s">
                        <div class="relative inline-flex items-center justify-center w-28 h-28 mb-6">
                            <div class="absolute inset-0 rounded-full bg-violet-100 animate-ping opacity-20"></div>
                            <div
                                class="relative w-24 h-24 rounded-full bg-gradient-to-br from-violet-500 to-violet-600 flex items-center justify-center text-4xl shadow-xl shadow-violet-500/20">
                                ⚙️
                            </div>
                            <span
                                class="absolute -top-1 -right-1 w-7 h-7 rounded-full bg-white border-2 border-violet-500 flex items-center justify-center text-xs font-display font-700 text-violet-600">02</span>
                        </div>
                        <h3 class="font-display font-700 text-xl text-slate-900 mb-3">Admin Tinjau & Proses</h3>
                        <p class="text-sm text-slate-500 leading-relaxed max-w-xs mx-auto">Pihak sekolah menerima
                            notifikasi, meninjau aspirasi, memberi tanggapan, dan menentukan tindak lanjut.</p>
                    </div>
                    <div class="relative text-center fade-up" style="transition-delay: 0.3s">
                        <div class="relative inline-flex items-center justify-center w-28 h-28 mb-6">
                            <div class="absolute inset-0 rounded-full bg-emerald-100 animate-ping opacity-20"></div>
                            <div
                                class="relative w-24 h-24 rounded-full bg-gradient-to-br from-emerald-500 to-emerald-600 flex items-center justify-center text-4xl shadow-xl shadow-emerald-500/20">
                                🎉
                            </div>
                            <span
                                class="absolute -top-1 -right-1 w-7 h-7 rounded-full bg-white border-2 border-emerald-500 flex items-center justify-center text-xs font-display font-700 text-emerald-600">03</span>
                        </div>
                        <h3 class="font-display font-700 text-xl text-slate-900 mb-3">Perubahan Terjadi</h3>
                        <p class="text-sm text-slate-500 leading-relaxed max-w-xs mx-auto">Siswa mendapat update status
                            dan melihat hasil nyata dari aspirasi mereka. Transparan dari awal hingga akhir.</p>
                    </div>
                </div>
            </div>

        </div>
    </section>


    {{-- ===================== STATISTIK / CTA SECTION ===================== --}}
<section id="statistik" class="py-20 border-t border-slate-200/80 bg-white">
    <div class="max-w-7xl mx-auto px-5 sm:px-8">

        {{-- Header --}}
        <div class="flex items-end justify-between gap-6 mb-12 flex-wrap fade-up">
            <div>
                <span class="text-xs font-semibold uppercase tracking-widest text-slate-400 mb-2 block">Dampak Nyata</span>
                <h2 class="font-display font-500 text-4xl text-slate-900 leading-tight">
                    Platform aspirasi terpercaya<br>untuk sekolah Indonesia
                </h2>
            </div>
            <p class="text-slate-500 text-sm leading-relaxed max-w-xs text-right">
                Ribuan siswa telah membuktikan bahwa aspirasi yang tersampaikan dengan baik menghasilkan perubahan nyata.
            </p>
        </div>

        {{-- Stats Grid --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 divide-x divide-y lg:divide-y-0 divide-slate-200 border border-slate-200 rounded-2xl overflow-hidden mb-20 fade-up">
            @foreach([
                ['12,4K+', 'Aspirasi dikirim', 82],
                ['95%', 'Tingkat respons', 95],
                ['340+', 'Sekolah bergabung', 68],
                ['87%', 'Aspirasi ditindak', 87],
            ] as $stat)
            <div class="bg-white p-8 sm:p-10">
                <div class="h-0.5 bg-slate-100 rounded-full mb-5 overflow-hidden">
                    <div class="h-full bg-slate-900 rounded-full" style="width: {{ $stat[2] }}%"></div>
                </div>
                <div class="text-3xl sm:text-4xl font-display font-500 text-slate-900 tracking-tight mb-1">{{ $stat[0] }}</div>
                <div class="text-xs text-slate-400">{{ $stat[1] }}</div>
            </div>
            @endforeach
        </div>

        {{-- CTA Block --}}
        <div class="flex items-start gap-20 pb-20 border-t border-slate-100 pt-16 flex-wrap fade-up">
            <div class="flex-1 min-w-[260px]">
                <span class="text-xs font-semibold uppercase tracking-widest text-slate-400 mb-3 block">Mulai sekarang</span>
                <h2 class="font-display font-500 text-4xl text-slate-900 leading-tight tracking-tight mb-5">
                    Suara kamu layak<br>untuk didengar.
                </h2>
                <p class="text-slate-500 text-sm leading-relaxed max-w-sm">
                    Bergabunglah dengan ribuan siswa yang aspirasi mereka sudah menghasilkan perubahan nyata di sekolah masing-masing.
                </p>
            </div>
            <div class="flex flex-col gap-3 min-w-[240px]">
                <a href="{{ route('siswa.login') }}"
                    class="flex items-center justify-between gap-3 bg-slate-900 hover:bg-slate-700 text-white font-medium text-sm px-5 py-3.5 rounded-xl transition-colors">
                    <span class="flex items-center gap-2.5">
                        <span class="w-6 h-6 rounded-md bg-white/10 flex items-center justify-center">
                            <svg class="w-3 h-3" fill="none" viewBox="0 0 16 16" stroke="white" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 2v12M2 8l6-6 6 6"/>
                            </svg>
                        </span>
                        Masuk sebagai Siswa
                    </span>
                    <svg class="w-4 h-4 opacity-40" fill="none" viewBox="0 0 16 16" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 8h10M9 4l4 4-4 4"/>
                    </svg>
                </a>
                <a href="{{ route('admin.login') }}"
                    class="flex items-center justify-between gap-3 bg-slate-100 hover:bg-slate-200 text-slate-800 font-medium text-sm px-5 py-3.5 rounded-xl transition-colors border border-slate-200">
                    <span class="flex items-center gap-2.5">
                        <span class="w-6 h-6 rounded-md bg-slate-200 flex items-center justify-center">
                            <svg class="w-3 h-3" fill="none" viewBox="0 0 16 16" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2 3h12a1 1 0 011 1v7a1 1 0 01-1 1H2a1 1 0 01-1-1V4a1 1 0 011-1zM6 3v9M10 3v9"/>
                            </svg>
                        </span>
                        Login Admin Sekolah
                    </span>
                    <svg class="w-4 h-4 opacity-40" fill="none" viewBox="0 0 16 16" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 8h10M9 4l4 4-4 4"/>
                    </svg>
                </a>
                <span class="inline-flex items-center gap-1.5 text-xs text-emerald-600 bg-emerald-50 border border-emerald-200 px-3 py-1.5 rounded-full self-start mt-1">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                    Semua sistem berjalan normal
                </span>
            </div>
        </div>
    </div>
</section>

{{-- Footer --}}
<footer class="bg-slate-50 border-t border-slate-200">
    <div class="max-w-7xl mx-auto px-5 sm:px-8">
        <div class="py-12 flex items-start gap-20 flex-wrap">
            <div class="flex-1 min-w-[200px]">
                <div class="flex items-center gap-2.5 mb-3">
                    <div class="w-7 h-7 rounded-lg bg-slate-900 flex items-center justify-center">
                        <svg class="w-3.5 h-3.5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                        </svg>
                    </div>
                    <span class="font-display font-500 text-sm text-slate-900">AspirasiKu</span>
                </div>
                <p class="text-xs text-slate-400 leading-relaxed max-w-[200px]">
                    Platform aspirasi modern untuk ekosistem sekolah Indonesia. Transparan, terstruktur, terukur.
                </p>
            </div>
            <div class="flex gap-16 flex-wrap">
                <div>
                    <h4 class="text-[10px] font-semibold uppercase tracking-widest text-slate-400 mb-4">Platform</h4>
                    <ul class="space-y-2.5">
                        <li><a href="#fitur" class="text-xs text-slate-500 hover:text-slate-900 transition-colors">Fitur</a></li>
                        <li><a href="#cara-kerja" class="text-xs text-slate-500 hover:text-slate-900 transition-colors">Cara Kerja</a></li>
                        <li><a href="#statistik" class="text-xs text-slate-500 hover:text-slate-900 transition-colors">Statistik</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-[10px] font-semibold uppercase tracking-widest text-slate-400 mb-4">Akun</h4>
                    <ul class="space-y-2.5">
                        <li><a href="{{ route('siswa.login') }}" class="text-xs text-slate-500 hover:text-slate-900 transition-colors">Login Siswa</a></li>
                        <li><a href="{{ route('admin.login') }}" class="text-xs text-slate-500 hover:text-slate-900 transition-colors">Login Admin</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-[10px] font-semibold uppercase tracking-widest text-slate-400 mb-4">Lainnya</h4>
                    <ul class="space-y-2.5">
                        <li><a href="#" class="text-xs text-slate-500 hover:text-slate-900 transition-colors">Kebijakan Privasi</a></li>
                        <li><a href="#" class="text-xs text-slate-500 hover:text-slate-900 transition-colors">Syarat Penggunaan</a></li>
                        <li><a href="#" class="text-xs text-slate-500 hover:text-slate-900 transition-colors">Bantuan</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="border-t border-slate-200 py-5 flex items-center justify-between gap-4 flex-wrap">
            <p class="text-[11px] text-slate-400">© 2025 AspirasiKu. Dibuat oleh Weillsun — XII RPL 1.</p>
            <div class="flex items-center gap-5">
                <a href="#" class="text-[11px] text-slate-400 hover:text-slate-700 transition-colors">Privasi</a>
                <a href="#" class="text-[11px] text-slate-400 hover:text-slate-700 transition-colors">Ketentuan</a>
                <a href="#" class="text-[11px] text-slate-400 hover:text-slate-700 transition-colors">Kontak</a>
            </div>
        </div>
    </div>
</footer>

    {{-- Scroll reveal script --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const obs = new IntersectionObserver((entries) => {
                entries.forEach(e => {
                    if (e.isIntersecting) {
                        e.target.classList.add('visible');
                        obs.unobserve(e.target);
                    }
                });
            }, {
                threshold: 0.1
            });

            document.querySelectorAll('.fade-up').forEach(el => obs.observe(el));
        });
    </script>
</body>

</html>
