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
                <div class="absolute -inset-4 rounded-3xl bg-gradient-to-b from-indigo-500/10 to-transparent blur-2xl">
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
                            <span class="text-xs text-slate-400 font-mono">aspirasiku/dashboard</span>
                        </div>
                    </div>
                    {{-- Fake Dashboard UI --}}
                    <div class="p-5 bg-white">
                        {{-- Stats row --}}
                        <div class="grid grid-cols-2 md:grid-cols-2 gap-3 mb-4">
                            <div class="rounded-xl p-3.5 bg-slate-50 border border-slate-100">
                                <div class="text-2xl font-display font-700 text-slate-900 mb-0.5">24</div>
                                <div class="text-xs text-slate-500">Total Aspirasi</div>
                                <div class="mt-2 h-1 rounded-full bg-slate-200">
                                    <div class="h-1 rounded-full bg-indigo-500" style="width: 80%"></div>
                                </div>
                            </div>
                            <div class="rounded-xl p-3.5 bg-slate-50 border border-slate-100">
                                <div class="text-2xl font-display font-700 text-slate-900 mb-0.5">8</div>
                                <div class="text-xs text-slate-500">Diproses</div>
                                <div class="mt-2 h-1 rounded-full bg-slate-200">
                                    <div class="h-1 rounded-full bg-amber-500" style="width: 45%"></div>
                                </div>
                            </div>
                        </div>
                        <div class="rounded-xl p-3.5 mb-4 bg-slate-50 border border-slate-100">
                            <div class="text-2xl font-display font-700 text-slate-900 mb-0.5">14</div>
                            <div class="text-xs text-slate-500">Selesai</div>
                            <div class="mt-2 h-1 rounded-full bg-slate-200">
                                <div class="h-1 rounded-full bg-emerald-500" style="width: 95%"></div>
                            </div>
                        </div>
                        {{-- Fake table --}}
                        <div class="rounded-xl border border-slate-100 overflow-hidden">
                            <div class="flex items-center gap-3 px-4 py-2.5 bg-slate-50 border-b border-slate-100">
                                <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Aspirasi
                                    Terbaru</span>
                            </div>
                            <div class="flex items-center gap-3 px-4 py-2.5 border-b border-slate-50 last:border-0">
                                <span class="text-base">⏳</span>
                                <div class="flex-1 min-w-0">
                                    <div class="text-xs font-medium text-slate-800 truncate">Perbaikan Toilet Lantai 2
                                    </div>
                                    <div class="text-[10px] text-slate-400">Fasilitas</div>
                                </div>
                                <span
                                    class="text-[10px] font-semibold px-2 py-0.5 rounded-full bg-amber-100 text-amber-700">Diproses</span>
                            </div>
                            <div class="flex items-center gap-3 px-4 py-2.5 border-b border-slate-50 last:border-0">
                                <span class="text-base">✅</span>
                                <div class="flex-1 min-w-0">
                                    <div class="text-xs font-medium text-slate-800 truncate">Penambahan Buku
                                        Perpustakaan</div>
                                    <div class="text-[10px] text-slate-400">Akademik</div>
                                </div>
                                <span
                                    class="text-[10px] font-semibold px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-700">Selesai</span>
                            </div>
                            <div class="flex items-center gap-3 px-4 py-2.5 border-b border-slate-50 last:border-0">
                                <span class="text-base">📋</span>
                                <div class="flex-1 min-w-0">
                                    <div class="text-xs font-medium text-slate-800 truncate">WiFi di Ruang Kelas</div>
                                    <div class="text-[10px] text-slate-400">Teknologi</div>
                                </div>
                                <span
                                    class="text-[10px] font-semibold px-2 py-0.5 rounded-full bg-slate-100 text-slate-700">Menunggu</span>
                            </div>
                            <div class="flex items-center gap-3 px-4 py-2.5 border-b border-slate-50 last:border-0">
                                <span class="text-base">✅</span>
                                <div class="flex-1 min-w-0">
                                    <div class="text-xs font-medium text-slate-800 truncate">Kantin Lebih Sehat</div>
                                    <div class="text-[10px] text-slate-400">Kesehatan</div>
                                </div>
                                <span
                                    class="text-[10px] font-semibold px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-700">Selesai</span>
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
    <section id="statistik" class="py-24 sm:py-32 relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-indigo-600 via-violet-600 to-purple-700"></div>
        <div class="absolute inset-0 opacity-10"
            style="background-image: linear-gradient(rgba(255,255,255,0.15) 1px, transparent 1px), linear-gradient(to right, rgba(255,255,255,0.15) 1px, transparent 1px); background-size: 40px 40px;">
        </div>
        <div class="absolute top-0 right-0 w-96 h-96 blob bg-white/10 rounded-full"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 blob blob-2 bg-white/10 rounded-full"></div>

        <div class="relative max-w-7xl mx-auto px-5 sm:px-8 text-white">
            {{-- Stats --}}
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 mb-20">
                <div class="text-center fade-up" style="transition-delay: 0s">
                    <div class="stat-number font-display font-800 text-4xl sm:text-5xl mb-1 text-white">12,400+</div>
                    <div class="text-sm text-white/70 font-medium">Aspirasi Dikirim</div>
                </div>
                <div class="text-center fade-up" style="transition-delay: 0.1s">
                    <div class="stat-number font-display font-800 text-4xl sm:text-5xl mb-1 text-white">95%</div>
                    <div class="text-sm text-white/70 font-medium">Tingkat Respons</div>
                </div>
                <div class="text-center fade-up" style="transition-delay: 0.2s">
                    <div class="stat-number font-display font-800 text-4xl sm:text-5xl mb-1 text-white">340+</div>
                    <div class="text-sm text-white/70 font-medium">Sekolah Bergabung</div>
                </div>
                <div class="text-center fade-up" style="transition-delay: 0.3s">
                    <div class="stat-number font-display font-800 text-4xl sm:text-5xl mb-1 text-white">87%</div>
                    <div class="text-sm text-white/70 font-medium">Aspirasi Ditindak</div>
                </div>
            </div>

            {{-- CTA block --}}
            <div class="text-center fade-up">
                <h2 class="font-display font-800 text-4xl sm:text-5xl lg:text-6xl mb-5 leading-tight">
                    Siap Mulai Bersuara?
                </h2>
                <p class="text-white/75 max-w-lg mx-auto text-lg mb-10 leading-relaxed">
                    Bergabunglah dengan ribuan siswa yang aspirasi mereka sudah didengar dan menghasilkan perubahan
                    nyata.
                </p>
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                    <a href="{{ route('siswa.login') }}"
                        class="btn-shimmer w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-white text-indigo-700 font-bold px-8 py-4 rounded-xl shadow-2xl hover:bg-indigo-50 transition-all hover:-translate-y-0.5 text-base">
                        🚀 Masuk sebagai Siswa
                    </a>
                    <a href="{{ route('admin.login') }}"
                        class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-white/10 hover:bg-white/20 border border-white/30 text-white font-semibold px-8 py-4 rounded-xl transition-all hover:-translate-y-0.5 text-base backdrop-blur-sm">
                        🏫 Login Admin Sekolah
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="py-8 border-t border-slate-200 bg-slate-50">
        <div class="max-w-7xl mx-auto px-5 sm:px-8 flex flex-col sm:flex-row items-center justify-between gap-3">
            <div class="flex items-center gap-2">
                <div
                    class="w-6 h-6 rounded-md bg-gradient-to-br from-indigo-500 to-violet-600 flex items-center justify-center">
                    <svg class="w-3 h-3 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                    </svg>
                </div>
                <span class="font-display font-600 text-sm text-slate-700">AspirasiKu</span>
            </div>
            <p class="text-xs text-slate-400">© 2024 AspirasiKu. Dibuat Oleh Weillsun</p>
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
