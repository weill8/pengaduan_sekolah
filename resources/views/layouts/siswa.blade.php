<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>@yield('title', 'Siswa Panel') — AspirasiKu</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
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
            background: linear-gradient(180deg, #10b981, #0d9488);
            border-radius: 0 4px 4px 0;
            transition: all 0.3s ease;
        }

        .sidebar-link:hover {
            transform: translateX(6px);
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.08) 0%, rgba(13, 148, 136, 0.08) 100%);
        }

        .sidebar-link:hover::before {
            height: 60%;
            transform: translateY(-50%) scaleY(1);
        }

        .sidebar-link.active {
            background: linear-gradient(135deg, #10b981 0%, #0d9488 100%);
            color: white;
            box-shadow: 0 8px 20px rgba(16, 185, 129, 0.35);
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
        .sidebar-scroll::-webkit-scrollbar { width: 4px; }
        .sidebar-scroll::-webkit-scrollbar-track { background: transparent; }
        .sidebar-scroll::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 4px; }
        .sidebar-scroll::-webkit-scrollbar-thumb:hover { background: #cbd5e1; }

        /* Mobile tab bar */
        .tab-bar-item { transition: all 0.2s ease; position: relative; border-radius: 12px; }
        .tab-bar-item.active {
            color: #10b981;
            background-color: rgba(16, 185, 129, 0.08);
        }
        .tab-bar-item.active svg { fill: #10b981; }
    </style>
</head>

<body class="bg-slate-50 min-h-screen font-sans overflow-x-hidden">

    {{-- Navbar --}}
    <nav class="fixed top-0 left-0 md:left-64 right-0 h-16 bg-white/90 backdrop-blur-md border-b border-slate-200 z-40 transition-all duration-300">
        <div class="flex items-center justify-between h-full px-4">
            {{-- LEFT: Logo & Greeting --}}
            <div class="flex justify-center">
                <div class="flex items-center gap-3">
                    <div class="relative">
                        <div class="absolute inset-0 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-lg blur-md opacity-40 group-hover:opacity-60 transition-opacity"></div>
                        <div class="relative w-9 h-9 rounded-lg bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center shadow-md shadow-emerald-500/40 group-hover:scale-105 transition-transform duration-300">
                            <a href="{{ route('siswa.dashboard') }}">
                                <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div class="block">
                        <span
                            class="font-display font-800 text-lg tracking-tight bg-gradient-to-r from-emerald-600 to-teal-600 bg-clip-text text-transparent block">AspirasiKu</span>
                        <span class="text-[10px] text-slate-500 font-medium -mt-0.5 block">Siswa Panel</span>
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <div class="flex items-center gap-3 hover:bg-slate-50 py-1.5 px-2 rounded-lg border border-transparent hover:border-slate-200 transition-all">
                    <div class="text-right">
                        <p class="text-sm font-semibold text-slate-700 leading-none">
                            {{ Auth::guard('siswa')->user()->nama }}
                        </p>
                        <p class="text-xs text-slate-500 mt-0.5">{{ Auth::guard('siswa')->user()->nis }}</p>
                    </div>
                    <div class="h-9 w-9 rounded-full bg-gradient-to-tr from-emerald-500 to-teal-500 flex items-center justify-center text-white font-bold shadow-md ring-2 ring-white">
                        {{ strtoupper(substr(Auth::guard('siswa')->user()->nama, 0, 1)) }}
                    </div>
                </div>
            </div>
        </div>
    </nav>

    {{-- Spacer for fixed navbar --}}
    <div class="h-14 sm:h-16"></div>

    <div class="flex">
        {{-- Desktop Sidebar --}}
        <aside class="hidden md:flex flex-col w-64 fixed z-50 left-0 top-0 h-screen bg-white/80 backdrop-blur-xl border-r border-slate-200 p-5 sidebar-scroll overflow-y-auto">

            {{-- Menu Header --}}
            <div class="group flex items-center gap-3 px-4 py-3 mb-4 rounded-full bg-emerald-600 border border-slate-100/50">
                <div class="flex items-center justify-center w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 shadow-sm group-hover:bg-emerald-100 group-hover:scale-105 transition-all duration-300">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                    </svg>
                </div>
                <div class="flex flex-col">
                    <span class="text-[13px] font-bold text-white tracking-widest leading-none">Menu Siswa</span>
                    <span class="text-[10px] text-white font-medium mt-1 leading-none">Navigasi Dashboard</span>
                </div>
            </div>

            {{-- Navigation --}}
            <ul class="space-y-1.5 flex-1">
                <li>
                    <a href="{{ route('siswa.dashboard') }}"
                        class="sidebar-link flex items-center gap-3.5 px-4 py-3.5 rounded-2xl text-slate-600 font-semibold text-sm
                        {{ request()->routeIs('siswa.dashboard') ? 'active' : '' }}"
                        @if(request()->routeIs('siswa.dashboard')) aria-current="page" @endif>
                        <div class="{{ request()->routeIs('siswa.dashboard') ? '' : 'text-slate-400' }}">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                        </div>
                        <span>Dashboard</span>
                        @if (request()->routeIs('siswa.dashboard'))
                            <svg class="w-4 h-4 ml-auto opacity-60" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        @endif
                    </a>
                </li>
                <li>
                    <a href="{{ route('siswa.aspirasi.create') }}"
                        class="sidebar-link flex items-center gap-3.5 px-4 py-3.5 rounded-2xl text-slate-600 font-semibold text-sm
                        {{ request()->routeIs('siswa.aspirasi.create') ? 'active' : '' }}"
                        @if(request()->routeIs('siswa.aspirasi.create')) aria-current="page" @endif>
                        <div class="{{ request()->routeIs('siswa.aspirasi.create') ? '' : 'text-slate-400' }}">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </div>
                        <span>Buat Aspirasi</span>
                        @if (request()->routeIs('siswa.aspirasi.create'))
                            <svg class="w-4 h-4 ml-auto opacity-60" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        @endif
                    </a>
                </li>
                <li>
                    <a href="{{ route('siswa.histori.histori') }}"
                        class="sidebar-link flex items-center gap-3.5 px-4 py-3.5 rounded-2xl text-slate-600 font-semibold text-sm
                        {{ request()->routeIs('siswa.histori.*') ? 'active' : '' }}"
                        @if(request()->routeIs('siswa.histori.*')) aria-current="page" @endif>
                        <div class="{{ request()->routeIs('siswa.histori.*') ? '' : 'text-slate-400' }}">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <span>Histori Aspirasi</span>
                        @if (request()->routeIs('siswa.histori.*'))
                            <svg class="w-4 h-4 ml-auto opacity-60" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        @endif
                    </a>
                </li>
            </ul>

            {{-- Quick Stats Card (Siswa) --}}
            <div class="mt-8 pt-6 border-t border-slate-100">
                <div class="flex items-center gap-2 px-3 mb-4">
                    <div class="w-1.5 h-1.5 rounded-full bg-gradient-to-r from-emerald-500 to-teal-600"></div>
                    <p class="text-xs font-bold text-slate-700 uppercase tracking-wider">Statistik Cepat</p>
                </div>
                <div class="space-y-3">

                    <div class="flex items-center justify-between px-3 py-2.5 rounded-xl bg-gradient-to-r from-slate-50/50 to-gray-50/50 border border-slate-100/50 hover:border-slate-200 transition-all">
                        <div class="flex items-center gap-2.5"><div class="w-2 h-2 rounded-full bg-slate-500"></div><span class="text-xs font-medium text-slate-600">Total</span></div>
                        <span class="text-sm font-bold text-slate-600">{{ $total ?? 0 }}</span>
                    </div>

                    <div class="flex items-center justify-between px-3 py-2.5 rounded-xl bg-gradient-to-r from-amber-50/50 to-orange-50/50 border border-amber-100/50 hover:border-amber-200 transition-all">
                        <div class="flex items-center gap-2.5"><div class="w-2 h-2 rounded-full bg-amber-500"></div><span class="text-xs font-medium text-slate-600">Menunggu</span></div>
                        <span class="text-sm font-bold text-amber-600">{{ $menunggu ?? 0 }}</span>
                    </div>

                    <div class="flex items-center justify-between px-3 py-2.5 rounded-xl bg-gradient-to-r from-blue-50/50 to-cyan-50/50 border border-blue-100/50 hover:border-blue-200 transition-all">
                        <div class="flex items-center gap-2.5"><div class="w-2 h-2 rounded-full bg-blue-500"></div><span class="text-xs font-medium text-slate-600">Diproses</span></div>
                        <span class="text-sm font-bold text-blue-600">{{ $proses ?? 0 }}</span>
                    </div>

                    <div class="flex items-center justify-between px-3 py-2.5 rounded-xl bg-gradient-to-r from-emerald-50/50 to-teal-50/50 border border-emerald-100/50 hover:border-emerald-200 transition-all">
                        <div class="flex items-center gap-2.5"><div class="w-2 h-2 rounded-full bg-emerald-500"></div><span class="text-xs font-medium text-slate-600">Selesai</span></div>
                        <span class="text-sm font-bold text-emerald-600">{{ $selesai ?? 0 }}</span>
                    </div>
                    
                </div>
            </div>

            {{-- Logout Button --}}
            <div class="mt-6 pt-4 border-t border-slate-100">
                <form method="POST" action="{{ route('siswa.logout') }}">
                    @csrf
                    <button type="submit" class="sidebar-link w-full flex items-center gap-3.5 px-4 py-3.5 rounded-2xl text-red-600 font-semibold text-sm hover:bg-red-100 transition-colors border border-transparent hover:border-red-100">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        {{-- Main Content --}}
        <main class="flex-1 ml-0 md:ml-64 p-4 md:p-6 overflow-x-auto">
            {{-- Page Content --}}
            <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-xl shadow-slate-200/40 border border-white/50 p-4 sm:p-6 lg:p-8 mb-20 lg:mb-0 md:mb-0">
                @yield('content')
            </div>
        </main>
    </div>

    {{-- Mobile Bottom Tab Bar --}}
    <div class="md:hidden fixed bottom-0 left-0 right-0 z-50 pb-[env(safe-area-inset-bottom)]">
        <div class="relative">
            <div class="relative bg-white/40 backdrop-blur-lg border border-white/50 shadow-[0_8px_32px_0_rgba(31,38,135,0.15)] rounded-t-[2rem] overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-t from-white/60 via-white/20 to-transparent pointer-events-none"></div>
                <div class="flex items-center justify-between px-2 py-3 relative z-10">

                    {{-- Dashboard --}}
                    <a href="{{ route('siswa.dashboard') }}"
                        class="relative flex flex-col items-center justify-center w-full transition-all duration-300 active:scale-95 {{ request()->routeIs('siswa.dashboard') ? '' : 'opacity-60 hover:opacity-100' }}">
                        <div class="relative w-10 h-10 flex items-center justify-center rounded-full transition-all duration-300 {{ request()->routeIs('siswa.dashboard') ? 'bg-emerald-500/20 shadow-inner shadow-emerald-500/10' : 'bg-transparent' }}">
                            <svg class="w-6 h-6 transition-all duration-300 ease-out {{ request()->routeIs('siswa.dashboard') ? 'text-emerald-600 scale-110' : 'text-slate-500 scale-100' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                        </div>
                        <div class="absolute -bottom-2 w-1 h-1 rounded-full bg-emerald-600 opacity-0 transition-all duration-300 {{ request()->routeIs('siswa.dashboard') ? 'opacity-100 scale-125' : 'opacity-0 scale-75' }}"></div>
                        <span class="text-[10px] font-medium mt-1 transition-colors duration-300 {{ request()->routeIs('siswa.dashboard') ? 'text-emerald-700' : 'text-slate-400' }}">Dashboard</span>
                    </a>

                    {{-- Buat Aspirasi --}}
                    <a href="{{ route('siswa.aspirasi.create') }}"
                        class="relative flex flex-col items-center justify-center w-full transition-all duration-300 active:scale-95 {{ request()->routeIs('siswa.aspirasi.create') ? '' : 'opacity-60 hover:opacity-100' }}">
                        <div class="relative w-10 h-10 flex items-center justify-center rounded-full transition-all duration-300 {{ request()->routeIs('siswa.aspirasi.create') ? 'bg-emerald-500/20 shadow-inner shadow-emerald-500/10' : 'bg-transparent' }}">
                            <svg class="w-6 h-6 transition-all duration-300 ease-out {{ request()->routeIs('siswa.aspirasi.create') ? 'text-emerald-600 scale-110' : 'text-slate-500 scale-100' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </div>
                        <div class="absolute -bottom-2 w-1 h-1 rounded-full bg-emerald-600 opacity-0 transition-all duration-300 {{ request()->routeIs('siswa.aspirasi.create') ? 'opacity-100 scale-125' : 'opacity-0 scale-75' }}"></div>
                        <span class="text-[10px] font-medium mt-1 transition-colors duration-300 {{ request()->routeIs('siswa.aspirasi.create') ? 'text-emerald-700' : 'text-slate-400' }}">Buat Aspirasi</span>
                    </a>

                    {{-- Histori --}}
                    <a href="{{ route('siswa.histori.histori') }}"
                        class="relative flex flex-col items-center justify-center w-full transition-all duration-300 active:scale-95 {{ request()->routeIs('siswa.histori.*') ? '' : 'opacity-60 hover:opacity-100' }}">
                        <div class="relative w-10 h-10 flex items-center justify-center rounded-full transition-all duration-300 {{ request()->routeIs('siswa.histori.*') ? 'bg-emerald-500/20 shadow-inner shadow-emerald-500/10' : 'bg-transparent' }}">
                            <svg class="w-6 h-6 transition-all duration-300 ease-out {{ request()->routeIs('siswa.histori.*') ? 'text-emerald-600 scale-110' : 'text-slate-500 scale-100' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="absolute -bottom-2 w-1 h-1 rounded-full bg-emerald-600 opacity-0 transition-all duration-300 {{ request()->routeIs('siswa.histori.*') ? 'opacity-100 scale-125' : 'opacity-0 scale-75' }}"></div>
                        <span class="text-[10px] font-medium mt-1 transition-colors duration-300 {{ request()->routeIs('siswa.histori.*') ? 'text-emerald-700' : 'text-slate-400' }}">Histori</span>
                    </a>

                </div>
            </div>
        </div>
    </div>

    @stack('scripts')
</body>
</html>