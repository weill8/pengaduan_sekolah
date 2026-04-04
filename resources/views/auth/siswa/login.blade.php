<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Siswa — AspirasiKu</title>

    {{-- Favicon --}}
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">

    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/syne@5.0.0/index.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/dm-sans@5.0.0/index.min.css">

    <style>
        /* Grain overlay */
        .grain::after {
            content: '';
            position: fixed;
            inset: -200%;
            width: 400%;
            height: 400%;
            background-image: url("image/svg+xml,%3Csvg viewBox='0 0 512 512' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.65' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)'/%3E%3C/svg%3E");
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

        /* Shimmer button */
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

        /* Input focus styles */
        .input-field {
            transition: all 0.2s ease;
        }

        .input-field:focus {
            outline: none;
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        }

        /* Fade in animation */
        .fade-in {
            opacity: 0;
            transform: translateY(16px);
            animation: fadeIn 0.6s ease forwards;
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body x-data="{ showPassword: false }"
    class="grain bg-slate-50 text-slate-900 antialiased min-h-screen flex items-center justify-center p-4 relative overflow-x-hidden">

    {{-- Background blobs --}}
    <div class="absolute top-20 -left-32 w-64 h-64 blob bg-violet-400/20"></div>
    <div class="absolute bottom-20 -right-32 w-80 h-80 blob bg-indigo-400/20"></div>

    {{-- Grid pattern --}}
    <div class="absolute inset-0 opacity-[0.03]"
        style="background-image: linear-gradient(currentColor 1px, transparent 1px), linear-gradient(to right, currentColor 1px, transparent 1px); background-size: 40px 40px;">
    </div>

    {{-- Back to home link --}}
    <a href="/"
        class="absolute top-6 left-6 hidden sm:inline-flex items-center gap-2 text-sm font-medium text-slate-600 hover:text-indigo-600 transition-colors fade-in"
        style="animation-delay: 0s">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
        Kembali ke Beranda
    </a>

    {{-- Login Card --}}
    <div class="relative w-full max-w-md fade-in" style="animation-delay: 0.1s">
        {{-- Glow effect --}}
        <div class="absolute -inset-1 rounded-3xl bg-gradient-to-b from-indigo-500/10 to-transparent blur-xl"></div>

        <div class="relative rounded-2xl border border-slate-200/80 bg-white shadow-2xl overflow-hidden">
            {{-- Header --}}
            <div class="px-8 pt-8 pb-6 text-center">
                {{-- Logo --}}
                <div
                    class="inline-flex items-center justify-center w-14 h-14 rounded-xl bg-gradient-to-br from-indigo-500 to-violet-600 shadow-lg shadow-indigo-500/30 mb-4">
                    <svg class="w-7 h-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                    </svg>
                </div>

                <h1 class="font-display font-800 text-2xl text-slate-900 mb-2">Login Siswa</h1>
                <p class="text-sm text-slate-500">Masuk untuk mengirim aspirasi kamu</p>
            </div>

            {{-- Flash message error --}}
            @if (session('error'))
                <div class="mx-8 mb-4 p-4 rounded-xl bg-red-50 border border-red-200 fade-in"
                    style="animation-delay: 0.2s">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-red-500 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="text-sm text-red-700">{{ session('error') }}</p>
                    </div>
                </div>
            @endif

            {{-- Form --}}
            <form method="POST" action="{{ route('siswa.login') }}" class="px-8 pb-8">
                @csrf

                {{-- NIS Field --}}
                <div class="mb-5 fade-in" style="animation-delay: 0.2s">
                    <label for="nis" class="block text-sm font-medium text-slate-700 mb-2">NIS (Nomor Induk
                        Siswa)</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                            </svg>
                        </div>
                        <input type="number" id="nis" name="nis" value="{{ old('nis') }}"
                            placeholder="Masukkan NIS kamu"
                            class="input-field w-full pl-11 pr-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-slate-900 placeholder-slate-400 text-sm"
                            required autofocus>
                    </div>
                    @error('nis')
                        <p class="mt-2 text-xs text-red-600 flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Password Field --}}
                <div class="mb-5 fade-in" style="animation-delay: 0.3s">
                    <label for="password" class="block text-sm font-medium text-slate-700 mb-2">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <input :type="showPassword ? 'text' : 'password'" id="password" name="password"
                            placeholder="Masukkan password"
                            class="input-field w-full pl-11 pr-12 py-3 rounded-xl border border-slate-200 bg-slate-50 text-slate-900 placeholder-slate-400 text-sm"
                            required>
                        {{-- Eye Toggle Button --}}
                        <button type="button" @click="showPassword = !showPassword"
                            class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-indigo-600 transition-colors focus:outline-none"
                            :aria-label="showPassword ? 'Sembunyikan password' : 'Tampilkan password'">
                            {{-- Eye Open Icon --}}
                            <svg x-show="!showPassword" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            {{-- Eye Closed Icon --}}
                            <svg x-show="showPassword" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                            </svg>
                        </button>
                    </div>
                    @error('password')
                        <p class="mt-2 text-xs text-red-600 flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Remember Me --}}
                <div class="mb-6 fade-in flex justify-between" style="animation-delay: 0.4s">
                    <label class="flex items-center gap-2.5 cursor-pointer group">
                        <input type="checkbox" name="remember"
                            class="w-4 h-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500 focus:ring-offset-0 cursor-pointer">
                        <span class="text-sm text-slate-600 group-hover:text-slate-800 transition-colors">Ingat
                            Saya</span>
                    </label>

                    <a href="{{ route('siswa.register') }}"
                        class="text-sm text-indigo-600 hover:text-indigo-500 font-normal transition-colors">
                        Belum punya akun?
                    </a>
                </div>

                {{-- Submit Button --}}
                <button type="submit"
                    class="btn-shimmer w-full inline-flex items-center justify-center gap-2 bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-500 hover:to-violet-500 text-white font-semibold py-3.5 rounded-xl shadow-xl shadow-indigo-500/30 transition-all hover:-translate-y-0.5 fade-in"
                    style="animation-delay: 0.5s">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                    </svg>
                    Login
                </button>
            </form>

            {{-- Footer --}}
            <div class="px-8 py-5 bg-slate-50 border-t border-slate-100 text-center fade-in"
                style="animation-delay: 0.6s">
                <p class="text-xs text-slate-500">
                    © 2024 AspirasiKu. Dibuat Oleh Weillsun
                </p>
            </div>
        </div>

        {{-- Security badge --}}
        <div class="mt-6 flex items-center justify-center gap-2 text-xs text-slate-400 fade-in"
            style="animation-delay: 0.7s">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
            </svg>
            <span>Login aman & terenkripsi</span>
        </div>
    </div>

</body>

</html>
