@extends('layouts.admin')

@section('title', 'Detail Aspirasi')

@section('content')

    {{-- Back link --}}
    <div class="mb-6">
        <a href="{{ route('admin.aspirasi.index') }}"
            class="inline-flex items-center gap-1.5 text-sm font-semibold text-slate-500 hover:text-indigo-600 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Kembali ke Daftar Aspirasi
        </a>
    </div>

    {{-- Page Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <div class="w-1 h-6 rounded-full bg-gradient-to-b from-indigo-500 to-violet-600"></div>
                <h1 class="text-xl font-bold text-slate-800 tracking-tight">
                    Detail Aspirasi
                    <span class="text-slate-400 font-normal"> — {{ $aspirasi->siswa->nama ?? '-' }}</span>
                </h1>
            </div>
            <p class="text-sm text-slate-400 ml-3">
                Dikirim pada {{ $aspirasi->created_at?->translatedFormat('d F Y, H:i') ?? '-' }}
            </p>
        </div>

        {{-- Status Badge --}}
        @php
            $statusNow = $aspirasi->aspirasi?->status ?? 'menunggu';
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
            class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-sm font-semibold {{ $statusColors[$statusNow] }}">
            <span class="w-2 h-2 rounded-full {{ $dotColors[$statusNow] }}"></span>
            {{ $statusLabels[$statusNow] }}
        </span>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">

        {{-- 
            KOLOM KIRI — Info Aspirasi
         --}}
        <div class="lg:col-span-2 space-y-5">

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

                    {{-- NIS --}}
                    <div class="px-6 py-4 flex items-center justify-between">
                        <span class="text-sm font-medium text-slate-400">NIS Siswa</span>
                        <span class="font-mono text-xs font-semibold text-slate-700 bg-slate-100 px-2.5 py-1 rounded-md">
                            {{ $aspirasi->nis }}
                        </span>
                    </div>

                    {{-- Kelas --}}
                    <div class="px-6 py-4 flex items-center justify-between">
                        <span class="text-sm font-medium text-slate-400">Kelas</span>
                        <span class="text-sm font-semibold text-slate-700">
                            {{ $aspirasi->siswa?->kelas?->nama_kelas ?? '-' }}
                        </span>
                    </div>

                    {{-- Kategori --}}
                    <div class="px-6 py-4 flex items-center justify-between">
                        <span class="text-sm font-medium text-slate-400">Kategori</span>
                        <div class="flex items-center gap-2">
                            <div
                                class="w-6 h-6 rounded-lg bg-gradient-to-br from-violet-100 to-purple-100 flex items-center justify-center">
                                <svg class="w-3 h-3 text-violet-500" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                </svg>
                            </div>
                            <span class="text-sm font-semibold text-slate-700">
                                {{ $aspirasi->kategori?->ket_kategori ?? '-' }}
                            </span>
                        </div>
                    </div>

                    {{-- Lokasi --}}
                    <div class="px-6 py-4 flex items-center justify-between">
                        <span class="text-sm font-medium text-slate-400">Lokasi</span>
                        <span class="inline-flex items-center gap-1.5 text-sm text-slate-700">
                            <svg class="w-3.5 h-3.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            {{ $aspirasi->lokasi }}
                        </span>
                    </div>

                    {{-- Keterangan --}}
                    <div class="px-6 py-4">
                        <span class="text-sm font-medium text-slate-400 block mb-2">Keterangan</span>
                        <p
                            class="text-sm text-slate-700 whitespace-pre-line wrap-break-word leading-relaxed bg-slate-50 rounded-xl px-4 py-3 border border-slate-100">{{ $aspirasi->ket }}</p>
                    </div>

                </div>
            </div>

            {{-- Diproses Oleh --}}
                <div class="rounded-2xl border border-slate-100 bg-white shadow-sm overflow-hidden">
                    <div class="bg-slate-50/80 px-6 py-3.5 border-b border-slate-100 flex items-center gap-2">
                        <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Riwayat Penanganan</span>
                    </div>
                    <div class="divide-y divide-slate-50">
                        <div class="px-6 py-4 flex items-center justify-between">
                            <span class="text-sm font-medium text-slate-400">Diproses oleh</span>
                            <span class="text-sm font-semibold text-slate-700">
                                {{ $aspirasi->aspirasi->admin->username ?? '-' }}
                            </span>
                        </div>
                        <div class="px-6 py-4 flex items-center justify-between">
                            <span class="text-sm font-medium text-slate-400">Terakhir diperbarui</span>
                            <span class="inline-flex items-center gap-1.5 text-xs text-slate-500">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                    stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                {{ $aspirasi->aspirasi?->updated_at?->translatedFormat('d F Y, H:i') ?? '-' }}
                            </span>
                        </div>
                    </div>
                </div>
            
                {{-- foto --}}
                <div class="rounded-2xl border border-slate-100 bg-white shadow-sm overflow-hidden">
                    <div class="bg-slate-50/80 px-6 py-3.5 border-b border-slate-100 flex items-center gap-2">
                        <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 7h4l2-2h6l2 2h4v12H3V7z" />
                            <circle cx="12" cy="13" r="3" stroke-linecap="round" stroke-linejoin="round">
                            </circle>
                        </svg>
                        <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Foto Lampiran</span>
                    </div>
                    <div class="p-6 ">
                        <div class="flex items-center">
                            @if ($aspirasi->foto)
                                <img src="{{ asset('storage/' . $aspirasi->foto) }}"
                                    class="w-[270px] h-[270px] object-cover rounded-lg">
                            @else
                                <span class="text-slate-400 italic font-xs">Tidak ada foto terlampir.</span>
                            @endif
                        </div>
                    </div>
                </div>

        </div>

        {{-- 
            KOLOM KANAN — Feedback
         --}}
        <div class="space-y-5">

            {{-- Feedback yang sudah ada --}}
            <div class="rounded-2xl border border-indigo-100 bg-white shadow-sm overflow-hidden">
                <div class="bg-indigo-50/80 px-6 py-3.5 border-b border-indigo-100 flex items-center gap-2">
                    <svg class="w-4 h-4 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                    </svg>
                    <span class="text-xs font-bold text-indigo-500 uppercase tracking-wider">Umpan Balik Saat Ini</span>
                </div>
                <div class="px-6 py-4">
                    @if ($aspirasi->aspirasi?->feedback)
                    <p class="text-sm text-slate-700 wrap-break-word leading-relaxed">{{ $aspirasi->aspirasi->feedback }}
                        @else
                            <span class="text-slate-500 italic">Belum ada umpan balik</span>
                        @endif
                    </p>
                </div>
            </div>

            {{-- Form Feedback --}}
            <div class="rounded-2xl border border-slate-100 bg-white shadow-sm overflow-hidden">
                <div class="bg-slate-50/80 px-6 py-3.5 border-b border-slate-100 flex items-center gap-2">
                    <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">
                        {{ $aspirasi->aspirasi ? 'Perbarui Umpan Balik' : 'Beri Umpan Balik' }}
                    </span>
                </div>

                <form method="POST" action="{{ route('admin.aspirasi.feedback', $aspirasi) }}" class="p-6 space-y-4">
                    @csrf
                    @method('PATCH')

                    {{-- Status --}}
                    <div>
                        <label for="status"
                            class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-2">
                            Status <span class="text-red-400">*</span>
                        </label>
                        <select id="status" name="status"
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-500/30 focus:border-indigo-400 transition-all
                                @error('status') border-red-300 @enderror">
                            @foreach (['menunggu' => 'Menunggu', 'proses' => 'Diproses', 'selesai' => 'Selesai'] as $value => $label)
                                <option value="{{ $value }}"
                                    {{ old('status', $aspirasi->aspirasi?->status ?? 'menunggu') === $value ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                        @error('status')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Feedback --}}
                    <div>
                        <label for="feedback"
                            class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-2">
                            Umpan Balik <span class="text-red-400">*</span>
                        </label>
                        <textarea id="feedback" name="feedback" rows="6"
                            placeholder="Tuliskan tanggapan atau informasi perkembangan penanganan aspirasi ini..."
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500/30 focus:border-indigo-400 transition-all resize-none
                                @error('feedback') border-red-300 @enderror">{{ old('feedback', $aspirasi->aspirasi?->feedback) }}</textarea>
                        @error('feedback')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit"
                        class="w-full inline-flex items-center justify-center gap-2 bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-500 hover:to-violet-500 text-white text-sm font-semibold px-5 py-2.5 rounded-xl shadow-lg shadow-indigo-500/25 transition-all hover:-translate-y-0.5 active:translate-y-0">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                        Simpan Umpan Balik
                    </button>
                </form>
            </div>

        </div>
    </div>

@endsection
