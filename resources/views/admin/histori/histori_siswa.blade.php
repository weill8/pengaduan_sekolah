@extends('layouts.admin')

@section('title', 'Histori Aspirasi — NIS ' . $siswa->nis)

@section('content')

    {{-- Page Header + Back --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
        <div>
            <div class="flex items-center gap-2 mb-3">
                <a href="{{ route('admin.histori.histori') }}"
                    class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-500 hover:text-indigo-600 transition-colors">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali
                </a>
            </div>
            <div class="flex items-center gap-2">
                <div class="w-1 h-6 rounded-full bg-gradient-to-b from-indigo-500 to-violet-600"></div>
                <h1 class="text-xl font-bold text-slate-800 tracking-tight">Histori Aspirasi</h1>
            </div>
            <p class="text-sm text-slate-400 ml-3">
                Riwayat aspirasi {{ $siswa->nama }}  — {{ $siswa->kelas?->nama_kelas ?? '-' }}
            </p>
        </div>

        {{-- Avatar Siswa --}}
        <div class="flex items-center gap-3 bg-white rounded-xl border border-slate-100 px-4 py-2.5 shadow-sm">
            <div
                class="w-10 h-10 rounded-full bg-gradient-to-br from-indigo-100 to-violet-100 flex items-center justify-center flex-shrink-0">
                <span class="text-sm font-bold text-indigo-700">{{ strtoupper(substr($siswa->nama, 0 , 1)) }}</span>
            </div>
            <div class="block">
                <p class="text-xs font-semibold text-slate-600">{{ $siswa->nama }}</p>
                <p class="text-xs text-slate-400">NIS: <span class="px-1 bg-gray-100 rounded-sm text-slate-600">{{ $siswa->nis }}</span></p>
            </div>
        </div>
    </div>

    {{-- Stats Summary Card --}}
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 mb-6">
        {{-- Total --}}
        <div class="rounded-xl border border-slate-100 bg-white px-4 py-3 shadow-sm">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total</span>
                <div class="w-6 h-6 rounded-lg bg-slate-100 flex items-center justify-center">
                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
            </div>
            <p class="mt-2 text-2xl font-bold text-slate-800">{{ $stats['total'] }}</p>
        </div>

        {{-- Menunggu --}}
        <div class="rounded-xl border border-amber-200 bg-amber-50/50 px-4 py-3 shadow-sm">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-amber-600 uppercase tracking-wider">Menunggu</span>
                <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></span>
            </div>
            <p class="mt-2 text-2xl font-bold text-amber-700">{{ $stats['menunggu'] }}</p>
        </div>

        {{-- Proses --}}
        <div class="rounded-xl border border-sky-200 bg-sky-50/50 px-4 py-3 shadow-sm">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-sky-600 uppercase tracking-wider">Proses</span>
                <span class="w-2 h-2 rounded-full bg-sky-500 animate-pulse"></span>
            </div>
            <p class="mt-2 text-2xl font-bold text-sky-700">{{ $stats['proses'] }}</p>
        </div>

        {{-- Selesai --}}
        <div class="rounded-xl border border-emerald-200 bg-emerald-50/50 px-4 py-3 shadow-sm">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-emerald-600 uppercase tracking-wider">Selesai</span>
                <svg class="w-4 h-4 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            <p class="mt-2 text-2xl font-bold text-emerald-700">{{ $stats['selesai'] }}</p>
        </div>
    </div>

    {{-- Filter Card --}}
    <div class="rounded-2xl border border-slate-100 bg-white shadow-sm mb-6 overflow-hidden">
        <div class="bg-slate-50/80 px-6 py-3.5 border-b border-slate-100 flex items-center gap-2">
            <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L13 13.414V19a1 1 0 01-.553.894l-4 2A1 1 0 017 21v-7.586L3.293 6.707A1 1 0 013 6V4z" />
            </svg>
            <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Filter Histori</span>
        </div>

        <form method="GET" action="{{ route('admin.histori.histori.siswa', $siswa) }}" class="p-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                {{-- Filter Status --}}
                <div>
                    <label for="status"
                        class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-2">Status</label>
                    <select id="status" name="status"
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-500/30 focus:border-indigo-400 transition-all">
                        <option value="">-- Semua Status --</option>
                        <option value="menunggu" {{ request('status') === 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                        <option value="proses" {{ request('status') === 'proses' ? 'selected' : '' }}>Proses</option>
                        <option value="selesai" {{ request('status') === 'selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                </div>

                {{-- Filter Kategori --}}
                <div>
                    <label for="id_kategori"
                        class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-2">Kategori</label>
                    <select id="id_kategori" name="id_kategori"
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-500/30 focus:border-indigo-400 transition-all">
                        <option value="">-- Semua Kategori --</option>
                        @foreach ($kategoris as $kategori)
                            <option value="{{ $kategori->id_kategori }}"
                                {{ request('id_kategori') == $kategori->id_kategori ? 'selected' : '' }}>
                                {{ $kategori->ket_kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- Tombol Filter --}}
            <div class="flex items-center gap-3 mt-5 pt-4 border-t border-slate-100">
                <button type="submit"
                    class="inline-flex items-center gap-2 bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-500 hover:to-violet-500 text-white text-sm font-semibold px-5 py-2.5 rounded-xl shadow-lg shadow-indigo-500/25 transition-all hover:-translate-y-0.5 active:translate-y-0">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L13 13.414V19a1 1 0 01-.553.894l-4 2A1 1 0 017 21v-7.586L3.293 6.707A1 1 0 013 6V4z" />
                    </svg>
                    Terapkan Filter
                </button>
                @if (request()->hasAny(['status', 'id_kategori']))
                    <a href="{{ route('admin.histori.histori.siswa', $siswa) }}"
                        class="text-sm font-semibold text-slate-500 hover:text-slate-700 transition-colors inline-flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                        Reset Filter
                    </a>
                @endif
            </div>
        </form>
    </div>

    {{-- Timeline Aspirasi --}}
    <div class="space-y-4">
        @forelse ($aspirasis as $item)
            @php
                $statusNow = $item->aspirasi?->status ?? 'menunggu';
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
                $statusDot = [
                    'menunggu' => 'bg-amber-500',
                    'proses' => 'bg-sky-500 animate-pulse',
                    'selesai' => 'bg-emerald-500',
                ];
            @endphp

            {{-- Timeline Item Card --}}
            <div
                class="rounded-2xl border border-slate-100 bg-white shadow-sm overflow-hidden hover:shadow-md transition-shadow">

                {{-- Card Header --}}
                <div
                    class="px-6 py-4 border-b border-slate-100 bg-slate-50/30 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                    <div class="flex items-center gap-3">
                        {{-- Icon Kategori --}}
                        <div
                            class="w-9 h-9 rounded-xl bg-gradient-to-br from-violet-100 to-purple-100 flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-violet-500" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                            </svg>
                        </div>
                        <div>
                            <div class="flex items-center gap-2">
                                <span class="text-xs font-mono text-slate-400"># {{ $loop->iteration }}</span>
                                <span class="text-slate-300">•</span>
                                <span class="text-xs text-slate-500 inline-flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                        stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    {{ $item->created_at?->translatedFormat('d M Y, H:i') ?? '-' }}
                                </span>
                            </div>
                            <p class="text-sm font-semibold text-slate-800 mt-0.5">
                                {{ $item->kategori?->ket_kategori ?? '-' }}
                            </p>
                        </div>
                    </div>

                    {{-- Status Badge --}}
                    <span
                        class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold w-fit {{ $statusColors[$statusNow] }}">
                        <span class="w-1.5 h-1.5 rounded-full {{ $statusDot[$statusNow] }}"></span>
                        {{ $statusLabels[$statusNow] }}
                    </span>
                </div>

                {{-- Card Body --}}
                <div class="px-6 py-4 grid sm:grid-cols-2 gap-4">
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1.5">Lokasi</p>
                        <div class="flex items-start gap-2">
                            <svg class="w-4 h-4 text-slate-400 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <p class="text-sm text-slate-700">{{ $item->lokasi }}</p>
                        </div>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1.5">Keterangan</p>
                        <p class="text-sm text-slate-700">
                            {{ $item->ket ?: '<span class="text-slate-400 italic">-</span>' }}</p>
                    </div>
                </div>

                {{-- Feedback Section --}}
                @if ($item->aspirasi)
                    <div class="px-6 py-4 bg-gradient-to-r from-indigo-50/50 to-violet-50/50 border-t border-slate-100">
                        <div class="flex flex-col sm:flex-row sm:items-start gap-3">
                            <div class="flex-1 min-w-0">
                                <p
                                    class="text-xs font-bold text-indigo-600 uppercase tracking-wider mb-2 flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                        stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                    </svg>
                                    Umpan Balik Admin
                                </p>
                                @if ($item->aspirasi->feedback)
                                    <p class="text-sm text-slate-700 ">{{ $item->aspirasi->feedback }}
                                    </p>
                                @else
                                    <p class="text-sm text-slate-400 italic">Belum ada umpan balik.</p>
                                @endif
                            </div>
                            <div class="text-right text-xs text-slate-400 whitespace-nowrap sm:ml-4">
                                @if ($item->aspirasi->admin)
                                    <p class="text-slate-500">Dibalas oleh:</p>
                                    <p class="font-semibold text-slate-600">{{ $item->aspirasi->admin->username }}</p>
                                @endif
                                <p class="mt-1">
                                    {{ $item->aspirasi->updated_at?->translatedFormat('d M Y, H:i') ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="px-6 py-3 bg-slate-50 border-t border-slate-100">
                        <p class="text-xs text-slate-400 italic">Belum ada umpan balik dari admin.</p>
                    </div>
                @endif

                {{-- Card Footer / Action --}}
                <div class="px-6 py-3 border-t border-slate-100 bg-slate-50/30 flex justify-end">
                    <a href="{{ route('admin.aspirasi.show', $item) }}"
                        class="inline-flex items-center gap-1.5 text-xs font-semibold text-indigo-600 bg-indigo-50 hover:bg-indigo-100 border border-indigo-200 px-3 py-1.5 rounded-lg transition-all hover:shadow-sm whitespace-nowrap">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        Detail & Umpan Balik
                    </a>
                </div>
            </div>
        @empty
            {{-- Empty State --}}
            <div class="rounded-2xl border border-slate-100 bg-white shadow-sm px-6 py-16 text-center">
                <div class="flex flex-col items-center gap-3">
                    <div class="w-14 h-14 rounded-2xl bg-slate-100 flex items-center justify-center">
                        @if (request()->hasAny(['status', 'id_kategori']))
                            <svg class="w-7 h-7 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L13 13.414V19a1 1 0 01-.553.894l-4 2A1 1 0 017 21v-7.586L3.293 6.707A1 1 0 013 6V4z" />
                            </svg>
                        @else
                            <svg class="w-7 h-7 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        @endif
                    </div>
                    <div>
                        @if (request()->hasAny(['status', 'id_kategori']))
                            <p class="text-sm font-semibold text-slate-500">Tidak ada hasil untuk filter yang dipilih</p>
                            <p class="text-xs text-slate-400 mt-0.5">Coba reset filter atau ubah kriteria pencarian</p>
                        @else
                            <p class="text-sm font-semibold text-slate-500">Belum ada aspirasi dari siswa ini</p>
                            <p class="text-xs text-slate-400 mt-0.5">Data aspirasi akan muncul di sini setelah siswa
                                mengajukan laporan</p>
                        @endif
                    </div>
                </div>
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    @if ($aspirasis->hasPages())
        <div class="mt-6">
            {{ $aspirasis->appends(request()->query())->links() }}
        </div>
    @endif

@endsection
