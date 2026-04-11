<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') — AspirasiKu</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Favicon --}}
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">

    <style>
    .x-scrollbar::-webkit-scrollbar {
        height: 4px;
    }

    .x-scrollbar::-webkit-scrollbar-button,
     {
        display: none;
    }

    .x-scrollbar::-webkit-scrollbar-track {
        background: transparent;
    }

    .x-scrollbar::-webkit-scrollbar-thumb {
        background: #cbd5f5; 
        border-radius: 9999px;
    }

        .sidebar-link {
            position: relative;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .sidebar-link::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%) scaleY(0);
            width: 3px;
            height: 0;
            background: linear-gradient(180deg, #6366f1, #8b5cf6);
            border-radius: 0 4px 4px 0;
            transition: all 0.3s ease;
        }

        .sidebar-link:hover {
            transform: translateX(6px);
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.08) 0%, rgba(139, 92, 246, 0.08) 100%);
        }

        .sidebar-link:hover::before {
            height: 60%;
            transform: translateY(-50%) scaleY(1);
        }

        .sidebar-link.active {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            color: white;
            box-shadow: 0 8px 20px rgba(99, 102, 241, 0.35);
        }

        .sidebar-link.active::before {
            height: 70%;
            transform: translateY(-50%) scaleY(1);
            background: white;
        }

        .sidebar-link.active svg {
            color: white;
        }

        /* Hide scrollbar for sidebar */
        .sidebar-scroll::-webkit-scrollbar {
            width: 4px;
        }

        .sidebar-scroll::-webkit-scrollbar-track {
            background: transparent;
        }

        .sidebar-scroll::-webkit-scrollbar-thumb {
            background: #e2e8f0;
            border-radius: 4px;
        }

        ::-webkit-scrollbsidebar-scrollar-thumb:hover {
            background: #cbd5e1;
        }

        /* Mobile tab bar */
        .tab-bar-item {
            transition: all 0.2s ease;
            position: relative;
            border-radius: 12px;
        }

        .tab-bar-item.active {
            color: #6366f1;
            background-color: rgba(99, 102, 241, 0.08);
        }

        .tab-bar-item.active svg {
            fill: #6366f1;
        }
    </style>
</head>

<body class="bg-slate-50 min-h-screen font-sans y-scrollbar overflow-x-hidden">

    <nav
        class="fixed top-0 left-0 md:left-64 right-0 h-16 bg-white/90 backdrop-blur-md border-b border-slate-200 z-40 transition-all duration-300">
        <div class="flex items-center justify-between h-full px-4">

            {{-- LEFT: Page Context & Greeting --}}
            <div class="flex justify-center">
                {{-- Logo --}}
                <div class="flex items-center gap-3 ">
                    <div class="relative">
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-indigo-500 to-violet-600 rounded-lg blur-md opacity-40 group-hover:opacity-60 transition-opacity">
                        </div>
                        <div
                            class="relative w-9 h-9 rounded-lg bg-gradient-to-br from-indigo-500 to-violet-600 flex items-center justify-center shadow-md shadow-indigo-500/40 group-hover:scale-105 transition-transform duration-300">
                            <a href="{{ route('admin.dashboard') }}">
                                <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                    stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div class="block">
                        <span
                            class="font-display font-800 text-lg tracking-tight bg-gradient-to-r from-indigo-600 to-violet-600 bg-clip-text text-transparent block">AspirasiKu</span>
                        <span class="text-[10px] text-slate-500 font-medium -mt-0.5 block">Admin Panel</span>
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-4">

                {{-- Profile Dropdown --}}
                <div class="relative" id="profileDropdown">
                    <button onclick="toggleDropdown()"
                        class="flex items-center gap-3 hover:bg-slate-50 py-1.5 px-2 rounded-lg border border-transparent hover:border-slate-200 transition-all sm:pointer-events-none">
                        <div class="text-right hidden md:block lg:block">
                            <p class="text-sm font-semibold text-slate-700 leading-none">
                                {{ Auth::guard('admin')->user()->username }}</p>
                            <p class="text-xs text-slate-500 font-mono mt-0.5">
                                {{ Auth::guard('admin')->user()->role === 'super_admin' ? 'Super Admin' : 'Admin' }}
                            </p>
                        </div>

                        <div
                            class="h-9 w-9 rounded-full bg-gradient-to-tr from-indigo-500 to-purple-500 flex items-center justify-center text-white font-bold shadow-md ring-2 ring-white flex-shrink-0">
                            {{ substr(Auth::guard('admin')->user()->username, 0, 1) }}
                        </div>

                        <svg id="dropdownChevron"
                            class="md:hidden lg:hidden w-3.5 h-3.5 text-slate-400 transition-transform duration-200 flex-shrink-0"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    {{-- Dropdown Panel --}}
                    <div id="dropdownPanel"
                        class="hidden sm:hidden absolute right-0 mt-2 w-40 bg-white rounded-2xl shadow-xl shadow-slate-200/60 border border-slate-100 overflow-hidden z-50">

                        <div class="px-4 py-3 bg-gradient-to-br from-indigo-50 to-violet-50 border-b border-slate-100">
                            <p class="text-xs font-bold text-slate-700 truncate">
                                {{ Auth::guard('admin')->user()->username }}</p>
                            <p class="text-[11px] text-indigo-500 font-medium mt-0.5">Super Admin</p>
                        </div>

                        <div class="p-2">
                            <form method="POST" action="{{ route('admin.logout') }}">
                                @csrf
                                <button type="submit"
                                    class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-red-600 text-sm font-semibold hover:bg-red-50 transition-colors">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                        stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </nav>



    {{-- Spacer for fixed navbar --}}
    <div class="h-14 sm:h-16"></div>

    <div class="flex">
        {{-- Desktop Sidebar --}}
        <aside
            class="hidden md:flex flex-col w-64 fixed z-50 left-0 top-0 h-screen bg-white/80 backdrop-blur-xl border-r border-slate-200 p-5 overflow-y-auto sidebar-scroll flex flex-col">

            {{-- Menu Header --}}
            <div
                class="group flex items-center gap-3 px-4 py-3 mb-4 rounded-full bg-indigo-600 border border-slate-100/50">
                <div
                    class="flex items-center justify-center w-8 h-8 rounded-lg bg-indigo-50 text-indigo-600 shadow-sm group-hover:bg-indigo-100 group-hover:scale-105 transition-all duration-300">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                        </path>
                    </svg>
                </div>

                <div class="flex flex-col">
                    <span class="text-[13px] font-bold text-white tracking-widest leading-none">
                        Menu Utama
                    </span>
                    <span class="text-[10px] text-white font-medium mt-1 leading-none">
                        Navigasi Dashboard
                    </span>
                </div>
            </div>

            {{-- Navigation --}}
            <ul class="space-y-1.5 flex-1">
                <li>
                    <a href="{{ route('admin.dashboard') }}"
                        class="sidebar-link flex items-center gap-3.5 px-4 py-3.5 rounded-2xl text-slate-600 font-semibold text-sm
                                {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <div class="{{ request()->routeIs('admin.dashboard') ? '' : 'text-slate-400' }}">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                        </div>
                        <span>Dashboard</span>
                        @if (request()->routeIs('admin.dashboard'))
                            <svg class="w-4 h-4 ml-auto opacity-60" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        @endif
                    </a>
                </li>

                @if (Auth::guard('admin')->user()->role === 'super_admin')
                    <li>
                        <a href="{{ route('admin.akunAdmin.index') }}"
                            class="sidebar-link flex items-center gap-3.5 px-4 py-3.5 rounded-2xl text-slate-600 font-semibold text-sm
                                    {{ request()->routeIs('admin.akunAdmin.index') ? 'active' : '' }}">
                            <div class="{{ request()->routeIs('admin.akunAdmin.index') ? '' : 'text-slate-400' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                                </svg>

                            </div>
                            <span>Akun Admin</span>
                            @if (request()->routeIs('admin.akunAdmin.index'))
                                <svg class="w-4 h-4 ml-auto opacity-60" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            @endif
                        </a>
                    </li>
                @endif

                <li>
                    <a href="{{ route('admin.akunSiswa.index') }}"
                        class="sidebar-link flex items-center gap-3.5 px-4 py-3.5 rounded-2xl text-slate-600 font-semibold text-sm
                                {{ request()->routeIs('admin.akunSiswa.index') ? 'active' : '' }}">
                        <div class="{{ request()->routeIs('admin.akunSiswa.index') ? '' : 'text-slate-400' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                            </svg>


                        </div>
                        <span>Akun Siswa</span>
                        @if (request()->routeIs('admin.akunSiswa.index'))
                            <svg class="w-4 h-4 ml-auto opacity-60" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        @endif
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.kelas.index') }}"
                        class="sidebar-link flex items-center gap-3.5 px-4 py-3.5 rounded-2xl text-slate-600 font-semibold text-sm
                                {{ request()->routeIs('admin.kelas.*') ? 'active' : '' }}">
                        <div class="{{ request()->routeIs('admin.kelas.*') ? '' : 'text-slate-400' }}">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <span>Kelas</span>
                        @if (request()->routeIs('admin.kelas.*'))
                            <svg class="w-4 h-4 ml-auto opacity-60" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        @endif
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.kategori.index') }}"
                        class="sidebar-link flex items-center gap-3.5 px-4 py-3.5 rounded-2xl text-slate-600 font-semibold text-sm
                                {{ request()->routeIs('admin.kategori.*') ? 'active' : '' }}">
                        <div class="{{ request()->routeIs('admin.kategori.*') ? '' : 'text-slate-400' }}">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                            </svg>
                        </div>
                        <span>Kategori</span>
                        @if (request()->routeIs('admin.kategori.*'))
                            <svg class="w-4 h-4 ml-auto opacity-60" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        @endif
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.aspirasi.index') }}"
                        class="sidebar-link flex items-center gap-3.5 px-4 py-3.5 rounded-2xl text-slate-600 font-semibold text-sm
                                {{ request()->routeIs('admin.aspirasi.*') ? 'active' : '' }}">
                        <div class="{{ request()->routeIs('admin.aspirasi.*') ? '' : 'text-slate-400' }}">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                            </svg>
                        </div>
                        <span>Aspirasi</span>
                        @if (request()->routeIs('admin.aspirasi.*'))
                            <svg class="w-4 h-4 ml-auto opacity-60" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        @endif
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.histori.histori') }}"
                        class="sidebar-link flex items-center gap-3.5 px-4 py-3.5 rounded-2xl text-slate-600 font-semibold text-sm
                                {{ request()->routeIs('admin.histori.*') ? 'active' : '' }}">
                        <div class="{{ request()->routeIs('admin.histori.*') ? '' : 'text-slate-400' }}">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <span>Histori</span>
                        @if (request()->routeIs('admin.histori.*'))
                            <svg class="w-4 h-4 ml-auto opacity-60" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        @endif
                    </a>
                </li>
            </ul>

            {{-- Quick Stats Card --}}
            <div class="mt-8 pt-6 border-t border-slate-100">
                <div class="flex items-center gap-2 px-3 mb-4">
                    <div class="w-1.5 h-1.5 rounded-full bg-gradient-to-r from-indigo-500 to-violet-600"></div>
                    <p class="text-xs font-bold text-slate-700 uppercase tracking-wider">Statistik Cepat</p>
                </div>
                <div class="space-y-3">

                    <div
                        class="flex items-center justify-between px-3 py-2.5 rounded-xl bg-gradient-to-r from-slate-50/50 to-gray-50/50 border border-slate-100/50 hover:border-slate-200 transition-all">
                        <div class="flex items-center gap-2.5">
                            <div class="w-2 h-2 rounded-full bg-slate-500"></div>
                            <span class="text-xs font-medium text-slate-600">Total</span>
                        </div>
                        <span class="text-sm font-bold text-slate-600">{{ $total ?? 0 }}</span>
                    </div>
                    {{-- <div
                        class="flex items-center justify-between px-3 py-2.5 rounded-xl bg-gradient-to-r from-indigo-50/50 to-violet-50/50 border border-indigo-100/50 hover:border-indigo-200 transition-all">
                        <div class="flex items-center gap-2.5">
                            <div class="w-2 h-2 rounded-full bg-indigo-500"></div>
                            <span class="text-xs font-medium text-slate-600">Belum di Handle</span>
                        </div>
                        <span class="text-sm font-bold text-indigo-600">{{ $belum ?? 0 }}</span>
                    </div> --}}
                    {{-- <div
                        class="flex items-center justify-between px-3 py-2.5 rounded-xl bg-gradient-to-r from-indigo-50/50 to-violet-50/50 border border-indigo-100/50 hover:border-indigo-200 transition-all">
                        <div class="flex items-center gap-2.5">
                            <div class="w-2 h-2 rounded-full bg-indigo-500"></div>
                            <span class="text-xs font-medium text-slate-600">Sudah di Handle</span>
                        </div>
                        <span class="text-sm font-bold text-indigo-600">{{ $sudah ?? 0 }}</span>
                    </div> --}}

                    <div
                        class="flex items-center justify-between px-3 py-2.5 rounded-xl bg-gradient-to-r from-amber-50/50 to-orange-50/50 border border-amber-100/50 hover:border-amber-200 transition-all">
                        <div class="flex items-center gap-2.5">
                            <div class="w-2 h-2 rounded-full bg-amber-500"></div>
                            <span class="text-xs font-medium text-slate-600">Menunggu</span>
                        </div>
                        <span class="text-sm font-bold text-amber-600">{{ $menunggu ?? 0 }}</span>
                    </div>
                    <div
                        class="flex items-center justify-between px-3 py-2.5 rounded-xl bg-gradient-to-r from-blue-50/50 to-cyan-50/50 border border-blue-100/50 hover:border-blue-200 transition-all">
                        <div class="flex items-center gap-2.5">
                            <div class="w-2 h-2 rounded-full bg-blue-500"></div>
                            <span class="text-xs font-medium text-slate-600">Diproses</span>
                        </div>
                        <span class="text-sm font-bold text-blue-600">{{ $proses ?? 0 }}</span>
                    </div>
                    <div
                        class="flex items-center justify-between px-3 py-2.5 rounded-xl bg-gradient-to-r from-emerald-50/50 to-teal-50/50 border border-emerald-100/50 hover:border-emerald-200 transition-all">
                        <div class="flex items-center gap-2.5">
                            <div class="w-2 h-2 rounded-full bg-emerald-500"></div>
                            <span class="text-xs font-medium text-slate-600">Selesai</span>
                        </div>
                        <span class="text-sm font-bold text-emerald-600">{{ $selesai ?? 0 }}</span>
                    </div>
                </div>
            </div>

            {{-- Logout Button (Baru di Sidebar) --}}
            <div class="mt-6 pt-4  border-t border-slate-100">
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit"
                        class="sidebar-link w-full flex items-center gap-3.5 px-4 py-3.5 rounded-2xl text-red-600 font-semibold text-sm hover:bg-red-50 transition-colors border border-transparent hover:border-red-100">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        <span>Logout</span>
                    </button>
                </form>
            </div>

        </aside>

        {{-- Main Content --}}
        <main class="flex-1 ml-0 md:ml-64 p-6 overflow-x-auto ">

            {{-- Page Content --}}
            <div
                class="bg-white/80 backdrop-blur-xl  rounded-3xl shadow-xl shadow-slate-200/40 border border-white/50 p-6 lg:p-8 mb-16 lg:mb-0 md:mb-0">
                @yield('content')
            </div>
        </main>
    </div>

    {{-- Mobile Bottom Tab Bar --}}
    <div class="md:hidden fixed bottom-0 left-0 right-0 z-50 pb-safe">
        <div class="relative">
            {{-- Main Tab Bar Container --}}
            <div
                class="relative bg-white/40 backdrop-blur-lg border border-white/50 shadow-[0_8px_32px_0_rgba(31,38,135,0.15)] rounded-t-[2rem] overflow-hidden">

                {{-- Gradient Overlay for extra glass feel --}}
                <div
                    class="absolute inset-0 bg-gradient-to-t from-white/60 via-white/20 to-transparent pointer-events-none">
                </div>

                <div class="flex items-center justify-between px-2 py-3 relative z-10 overflow-x-auto x-scrollbar">

                    {{-- Dashboard --}}
                    <a href="{{ route('admin.dashboard') }}"
                        class="relative flex flex-col items-center justify-center min-w-[70px] transition-all duration-300 active:scale-95 {{ request()->routeIs('admin.dashboard') ? '' : 'opacity-60 hover:opacity-100' }}">

                        {{-- Icon Container --}}
                        <div
                            class="relative w-10 h-10 flex items-center justify-center rounded-full transition-all duration-300 
                    {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-500/20 shadow-inner shadow-indigo-500/10' : 'bg-transparent' }}">

                            <svg class="w-6 h-6 transition-all duration-300 ease-out 
                        {{ request()->routeIs('admin.dashboard') ? 'text-indigo-600 scale-110' : 'text-slate-500 scale-100' }}"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                        </div>

                        {{-- Active Dot Indicator --}}
                        <div
                            class="absolute -bottom-2 w-1 h-1 rounded-full bg-indigo-600 opacity-0 transition-all duration-300 {{ request()->routeIs('admin.dashboard') ? 'opacity-100 scale-125' : 'opacity-0 scale-75' }}">
                        </div>

                        <span
                            class="text-[10px] font-medium mt-1 transition-colors duration-300 
                    {{ request()->routeIs('admin.dashboard') ? 'text-indigo-700' : 'text-slate-400' }}">
                            Dashboard
                        </span>
                    </a>

                    @if (Auth::guard('admin')->user()->role === 'super_admin')
                        {{-- akun admin --}}
                        <a href="{{ route('admin.akunAdmin.index') }}"
                            class="relative flex flex-col items-center justify-center min-w-[70px] transition-all duration-300 active:scale-95 {{ request()->routeIs('admin.akunAdmin.index') ? '' : 'opacity-60 hover:opacity-100' }}">

                            <div
                                class="relative w-10 h-10 flex items-center justify-center rounded-full transition-all duration-300 
                        {{ request()->routeIs('admin.akunAdmin.index') ? 'bg-indigo-500/20 shadow-inner shadow-indigo-500/10' : 'bg-transparent' }}">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    class="w-6 h-6 transition-all duration-300 ease-out
                                    {{ request()->routeIs('admin.akunAdmin.index') ? 'text-indigo-600 scale-110' : 'text-slate-500 scale-100' }}">

                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                                </svg>

                            </div>

                            <div
                                class="absolute -bottom-2 w-1 h-1 rounded-full bg-indigo-600 opacity-0 transition-all duration-300 {{ request()->routeIs('admin.akunAdmin.index') ? 'opacity-100 scale-125' : 'opacity-0 scale-75' }}">
                            </div>

                            <span
                                class="text-[10px] font-medium mt-1 transition-colors duration-300 
                        {{ request()->routeIs('admin.akunAdmin.index') ? 'text-indigo-700' : 'text-slate-400' }}">
                                Admin
                            </span>
                        </a>
                    @endif

                    {{-- akun siswa--}}
                    <a href="{{ route('admin.akunSiswa.index') }}"
                        class="relative flex flex-col items-center justify-center min-w-[70px] transition-all duration-300 active:scale-95 {{ request()->routeIs('admin.akunSiswa.index') ? '' : 'opacity-60 hover:opacity-100' }}">

                        <div
                            class="relative w-10 h-10 flex items-center justify-center rounded-full transition-all duration-300 
                    {{ request()->routeIs('admin.akunSiswa.index') ? 'bg-indigo-500/20 shadow-inner shadow-indigo-500/10' : 'bg-transparent' }}">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="w-6 h-6 transition-all duration-300 ease-out
                                {{ request()->routeIs('admin.akunSiswa.index') ? 'text-indigo-600 scale-110' : 'text-slate-500 scale-100' }}">

                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                            </svg>
                        </div>

                        <div
                            class="absolute -bottom-2 w-1 h-1 rounded-full bg-indigo-600 opacity-0 transition-all duration-300 {{ request()->routeIs('admin.akunSiswa.index') ? 'opacity-100 scale-125' : 'opacity-0 scale-75' }}">
                        </div>

                        <span
                            class="text-[10px] font-medium mt-1 transition-colors duration-300 
                    {{ request()->routeIs('admin.akunSiswa.index') ? 'text-indigo-700' : 'text-slate-400' }}">
                            Siswa
                        </span>
                    </a>

                    {{-- Kelas --}}
                    <a href="{{ route('admin.kelas.index') }}"
                        class="relative flex flex-col items-center justify-center min-w-[70px] transition-all duration-300 active:scale-95 {{ request()->routeIs('admin.kelas.*') ? '' : 'opacity-60 hover:opacity-100' }}">

                        <div
                            class="relative w-10 h-10 flex items-center justify-center rounded-full transition-all duration-300 
                    {{ request()->routeIs('admin.kelas.*') ? 'bg-indigo-500/20 shadow-inner shadow-indigo-500/10' : 'bg-transparent' }}">

                            <svg class="w-6 h-6 transition-all duration-300 ease-out 
                        {{ request()->routeIs('admin.kelas.*') ? 'text-indigo-600 scale-110' : 'text-slate-500 scale-100' }}"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>

                        <div
                            class="absolute -bottom-2 w-1 h-1 rounded-full bg-indigo-600 opacity-0 transition-all duration-300 {{ request()->routeIs('admin.kelas.*') ? 'opacity-100 scale-125' : 'opacity-0 scale-75' }}">
                        </div>

                        <span
                            class="text-[10px] font-medium mt-1 transition-colors duration-300 
                    {{ request()->routeIs('admin.kelas.*') ? 'text-indigo-700' : 'text-slate-400' }}">
                            Kelas
                        </span>
                    </a>

                    {{-- Kategori --}}
                    <a href="{{ route('admin.kategori.index') }}"
                        class="relative flex flex-col items-center justify-center min-w-[70px] transition-all duration-300 active:scale-95 {{ request()->routeIs('admin.kategori.*') ? '' : 'opacity-60 hover:opacity-100' }}">

                        <div
                            class="relative w-10 h-10 flex items-center justify-center rounded-full transition-all duration-300 
                    {{ request()->routeIs('admin.kategori.*') ? 'bg-indigo-500/20 shadow-inner shadow-indigo-500/10' : 'bg-transparent' }}">

                            <svg class="w-6 h-6 transition-all duration-300 ease-out 
                        {{ request()->routeIs('admin.kategori.*') ? 'text-indigo-600 scale-110' : 'text-slate-500 scale-100' }}"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                            </svg>
                        </div>

                        <div
                            class="absolute -bottom-2 w-1 h-1 rounded-full bg-indigo-600 opacity-0 transition-all duration-300 {{ request()->routeIs('admin.kategori.*') ? 'opacity-100 scale-125' : 'opacity-0 scale-75' }}">
                        </div>

                        <span
                            class="text-[10px] font-medium mt-1 transition-colors duration-300 
                    {{ request()->routeIs('admin.kategori.*') ? 'text-indigo-700' : 'text-slate-400' }}">
                            Kategori
                        </span>
                    </a>

                    {{-- Aspirasi --}}
                    <a href="{{ route('admin.aspirasi.index') }}"
                        class="relative flex flex-col items-center justify-center min-w-[70px] transition-all duration-300 active:scale-95 {{ request()->routeIs('admin.aspirasi.index') ? '' : 'opacity-60 hover:opacity-100' }}">

                        <div
                            class="relative w-10 h-10 flex items-center justify-center rounded-full transition-all duration-300 
                            {{ request()->routeIs('admin.aspirasi.*') ? 'bg-indigo-500/20 shadow-inner shadow-indigo-500/10' : 'bg-transparent' }}">

                            <svg class="w-6 h-6 transition-all duration-300 ease-out 
                                {{ request()->routeIs('admin.aspirasi.*') ? 'text-indigo-600 scale-110' : 'text-slate-500 scale-100' }}"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                            </svg>
                        </div>

                        <div
                            class="absolute -bottom-2 w-1 h-1 rounded-full bg-indigo-600 opacity-0 transition-all duration-300 {{ request()->routeIs('admin.aspirasi.*') ? 'opacity-100 scale-125' : 'opacity-0 scale-75' }}">
                        </div>

                        <span
                            class="text-[10px] font-medium mt-1 transition-colors duration-300 
                    {{ request()->routeIs('admin.aspirasi.*') ? 'text-indigo-700' : 'text-slate-400' }}">
                            Aspirasi
                        </span>
                    </a>

                    {{-- Histori --}}
                    <a href="{{ route('admin.histori.histori') }}"
                        class="relative flex flex-col items-center justify-center min-w-[70px] transition-all duration-300 active:scale-95 {{ request()->routeIs('admin.histori.histori') ? '' : 'opacity-60 hover:opacity-100' }}">

                        <div
                            class="relative w-10 h-10 flex items-center justify-center rounded-full transition-all duration-300 
                    {{ request()->routeIs('admin.histori.*') ? 'bg-indigo-500/20 shadow-inner shadow-indigo-500/10' : 'bg-transparent' }}">

                            <svg class="w-6 h-6 transition-all duration-300 ease-out 
                        {{ request()->routeIs('admin.histori.*') ? 'text-indigo-600 scale-110' : 'text-slate-500 scale-100' }}"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>

                        <div
                            class="absolute -bottom-2 w-1 h-1 rounded-full bg-indigo-600 opacity-0 transition-all duration-300 {{ request()->routeIs('admin.histori.*') ? 'opacity-100 scale-125' : 'opacity-0 scale-75' }}">
                        </div>

                        <span
                            class="text-[10px] font-medium mt-1 transition-colors duration-300 
                    {{ request()->routeIs('admin.histori.*') ? 'text-indigo-700' : 'text-slate-400' }}">
                            Histori
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    @if (session('success') || session('error'))
        <script>
            Swal.fire({
                icon: '{{ session('success') ? 'success' : 'error' }}',
                title: '{{ session('success') ? 'Berhasil' : 'Oops...' }}',
                text: '{{ session('success') ?? session('error') }}',
                timer: 2000,
                showConfirmButton: false,
                timerProgressBar: true
            });
        </script>
    @endif

        <script>
            function toggleDropdown() {
                const panel = document.getElementById('dropdownPanel');
                const chevron = document.getElementById('dropdownChevron');
                const isHidden = panel.classList.contains('hidden');

                panel.classList.toggle('hidden');
                chevron.style.transform = isHidden ? 'rotate(180deg)' : '';
            }

            // Tutup dropdown saat klik di luar
            document.addEventListener('click', function(e) {
                const wrapper = document.getElementById('profileDropdown');
                if (!wrapper.contains(e.target)) {
                    document.getElementById('dropdownPanel').classList.add('hidden');
                    document.getElementById('dropdownChevron').style.transform = '';
                }
            });

            document.querySelectorAll('.form-delete').forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();

                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: 'Data tidak bisa dikembalikan!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#dc2626',
                        cancelButtonColor: '#9ca3af',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
        });
        </script>
    
    @stack('modals')
    @stack('scripts')
</body>

</html>
