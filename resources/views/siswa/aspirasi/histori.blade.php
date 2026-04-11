@extends('layouts.siswa')

@section('title', 'Histori Aspirasi')

@section('content')

    <div class="max-w-7xl mx-auto">
        {{-- Page Header --}}
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
            <div>
                <div class="flex items-center gap-2 mb-1">
                    <div class="w-1 h-6 rounded-full bg-gradient-to-b from-emerald-500 to-teal-600"></div>
                    <h1
                        class="text-xl font-bold bg-gradient-to-r from-emerald-600 to-teal-600 bg-clip-text text-transparent">
                        Histori Aspirasi</h1>
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
                <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Daftar Histori</span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead>
                        <tr class="bg-white border-b border-slate-100">
                            <th
                                class="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider text-center w-16">
                                No</th>
                            <th class="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider">Kategori</th>
                            <th class="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider">Lokasi</th>
                            <th class="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider">Tanggal</th>
                            <th class="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider text-center">
                                Status</th>
                            <th class="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider text-center">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse ($aspirasis as $index => $item)
                            @php
                                $status = $item->aspirasi?->status ?? 'menunggu';
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
                            @endphp
                            <tr class="bg-white hover:bg-emerald-50/30 transition-colors group">
                                <td class="px-6 py-4 text-center">
                                    <span
                                        class="text-xs font-semibold text-slate-400 bg-slate-100 w-7 h-7 rounded-lg inline-flex items-center justify-center">
                                        {{ $aspirasis->firstItem() + $index }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <div
                                            class="w-6 h-6 rounded-lg bg-gradient-to-br from-teal-100 to-emerald-100 flex items-center justify-center flex-shrink-0">
                                            <svg class="w-3 h-3 text-teal-500" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                            </svg>
                                        </div>
                                        <span
                                            class="text-sm font-medium text-slate-700 truncate max-w-[150px]">{{ $item->kategori?->ket_kategori ?? '-' }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-sm text-slate-600 truncate max-w-[150px]"
                                        title="{{ $item->lokasi }}">{{ $item->lokasi }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center gap-1.5 text-xs text-slate-500">
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                            stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        {{ $item->created_at?->format('d M Y') ?? '-' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span
                                        class="inline-flex items-center justify-center gap-1.5 px-2.5 py-1 rounded-lg text-xs font-semibold {{ $statusColors[$status] }}">
                                        <span
                                            class="w-1.5 h-1.5 rounded-full {{ $status === 'menunggu' ? 'bg-amber-500' : ($status === 'proses' ? 'bg-sky-500 animate-pulse' : 'bg-emerald-500') }}"></span>
                                        {{ $statusLabels[$status] }}
                                    </span>
                                </td>


                                <td class="px-6 py-4 flex gap-2 justify-center items-center text-center">
                                    @php
                                        $status = $item->aspirasi?->status ?? 'menunggu';
                                        $canEdit = !$item->aspirasi || $status === 'menunggu';
                                    @endphp

                                    @if ($canEdit)
                                        <button data-id="{{ $item->id_pelaporan }}" data-kategori="{{ $item->id_kategori }}"
                                            data-lokasi='@json($item->lokasi)' data-ket='@json($item->ket)'
                                            data-foto='@json($item->foto)' onclick="openModalEdit(this)"
                                            class="inline-flex items-center gap-1.5 text-xs font-semibold text-amber-600 bg-amber-50 hover:bg-amber-100 border border-amber-200 px-3 py-1.5 rounded-lg transition-all hover:shadow-sm">
                                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                            Edit
                                        </button>
                                    @endif
                                    <a href="{{ route('siswa.histori.show', $item->id_pelaporan) }}"
                                        class="inline-flex items-center gap-1.5 text-xs font-semibold text-emerald-600 bg-emerald-50 hover:bg-emerald-100 border border-emerald-200 px-3 py-1.5 rounded-lg transition-all hover:shadow-sm whitespace-nowrap">
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                            stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
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
                                            <svg class="w-7 h-7 text-slate-300" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor" stroke-width="1.5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm font-semibold text-slate-500">Belum ada riwayat aspirasi</p>
                                            <p class="text-xs text-slate-400 mt-0.5">
                                                <a href="{{ route('siswa.aspirasi.create') }}"
                                                    class="text-emerald-600 hover:text-emerald-700 font-medium underline underline-offset-2 decoration-emerald-300 hover:decoration-emerald-500 transition-all">
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

    @push('modals')
        {{-- MODAL EDIT --}}
        <div id="modalEdit" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
            {{-- Backdrop --}}
            <div class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm"
                onclick="document.getElementById('modalEdit').classList.add('hidden')"></div>

            {{-- Modal Card --}}
            <div
                class="relative bg-white rounded-2xl shadow-xl w-full max-w-md border border-slate-200 overflow-hidden my-8 max-h-[90vh] flex flex-col">

                {{-- Modal Header --}}
                <div class="flex items-center gap-3.5 px-6 py-5 border-b border-slate-100 flex-shrink-0">
                    <div class="w-10 h-10 rounded-xl bg-emerald-50 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5 text-emerald-700" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h2 class="text-sm font-medium text-slate-800 leading-tight">Edit Aspirasi</h2>
                        <p class="text-xs text-slate-400 mt-0.5">Ubah detail aspirasi yang dipilih</p>
                    </div>
                    <button onclick="document.getElementById('modalEdit').classList.add('hidden')"
                        class="w-8 h-8 rounded-lg bg-slate-50 hover:bg-slate-100 flex items-center justify-center transition-colors shrink-0">
                        <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                {{-- Modal Body (Scrollable) --}}
                <form method="POST" id="formEdit" enctype="multipart/form-data" action=""
                    class="flex-1 overflow-y-auto">
                    @csrf
                    @method('PUT')

                    <div class="px-6 py-6 flex flex-col gap-5">

                        {{-- Kategori --}}
                        <div class="flex flex-col gap-1.5">
                            <label for="kategori"
                                class="text-xs font-medium text-slate-500 uppercase tracking-wide flex items-center gap-1">
                                Kategori <span class="text-emerald-600 text-sm leading-none">*</span>
                            </label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-3.5 flex items-center pointer-events-none">
                                    <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" stroke-width="1.8">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M4 14h8" />
                                    </svg>
                                </span>
                                <select name="id_kategori" id="kategori"
                                    class="w-full pl-10 pr-9 py-2.5 text-sm text-slate-700 bg-slate-50 border border-slate-200 rounded-lg appearance-none outline-none transition focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/10 focus:bg-white hover:border-slate-300 cursor-pointer
                            @error('id_kategori') !border-red-400 !bg-red-50/40 focus:!ring-red-400/10 focus:!border-red-400 @enderror">
                                    <option value="">Pilih kategori laporan...</option>
                                    @foreach ($kategoris as $kategori)
                                        <option value="{{ $kategori->id_kategori }}"
                                            {{ old('id_kategori', $item->id_kategori ?? '') == $kategori->id_kategori ? 'selected' : '' }}>
                                            {{ $kategori->ket_kategori }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="absolute inset-y-0 right-3 flex items-center pointer-events-none">
                                    <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </span>
                            </div>
                            @error('id_kategori')
                                <p class="flex items-center gap-1 text-xs text-red-500 mt-0.5">
                                    <svg class="w-3.5 h-3.5 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Lokasi --}}
                        <div class="flex flex-col gap-1.5">
                            <label for="lokasi"
                                class="text-xs font-medium text-slate-500 uppercase tracking-wide flex items-center gap-1">
                                Lokasi <span class="text-emerald-600 text-sm leading-none">*</span>
                            </label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-3.5 flex items-center pointer-events-none">
                                    <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" stroke-width="1.8">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </span>
                                <input type="text" name="lokasi" id="lokasi" value="{{ old('lokasi') }}"
                                    maxlength="255" placeholder="Contoh: Ruang Kelas XII RPL 1, Toilet Lantai 2..."
                                    class="w-full pl-10 pr-4 py-2.5 text-sm text-slate-700 bg-slate-50 border border-slate-200 rounded-lg outline-none transition focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/10 focus:bg-white hover:border-slate-300 placeholder-slate-400
                            @error('lokasi') !border-red-400 !bg-red-50/40 focus:!ring-red-400/10 focus:!border-red-400 @enderror">
                            </div>
                            @error('lokasi')
                                <p class="flex items-center gap-1 text-xs text-red-500 mt-0.5">
                                    <svg class="w-3.5 h-3.5 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Keterangan --}}
                        <div class="flex flex-col gap-1.5">
                            <label for="ket"
                                class="text-xs font-medium text-slate-500 uppercase tracking-wide flex items-center gap-1">
                                Keterangan <span class="text-emerald-600 text-sm leading-none">*</span>
                            </label>
                            <textarea name="ket" id="ket" rows="4" maxlength="255"
                                placeholder="Jelaskan permasalahan secara detail agar dapat ditindaklanjuti..."
                                class="w-full px-4 py-2.5 text-sm text-slate-700 bg-slate-50 border border-slate-200 rounded-lg outline-none transition focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/10 focus:bg-white hover:border-slate-300 placeholder-slate-400 resize-none
                        @error('ket') !border-red-400 !bg-red-50/40 focus:!ring-red-400/10 focus:!border-red-400 @enderror">{{ old('ket') }}</textarea>
                            <div class="flex items-center justify-between">
                                @error('ket')
                                    <p class="flex items-center gap-1 text-xs text-red-500">
                                        <svg class="w-3.5 h-3.5 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @else
                                    <span></span>
                                @enderror
                                <span class="text-xs text-slate-400 font-mono"><span id="char-count">0</span>/255</span>
                            </div>
                        </div>

                        {{-- Divider --}}
                        <div class="flex items-center gap-3">
                            <div class="flex-1 h-px bg-slate-100"></div>
                            <span class="text-xs text-slate-400 uppercase tracking-widest">Lampiran</span>
                            <div class="flex-1 h-px bg-slate-100"></div>
                        </div>

                        {{-- Foto --}}
                        <div class="flex flex-col gap-1.5">
                            <label class="text-xs font-medium text-slate-500 uppercase tracking-wide flex items-center gap-2">
                                Foto
                                <span
                                    class="normal-case tracking-normal text-xs font-medium bg-emerald-50 text-emerald-700 px-2 py-0.5 rounded-full">Opsional</span>
                            </label>

                            <label for="fotoEdit"
                                class="flex flex-col items-center justify-center gap-2.5 px-4 py-7 border border-dashed border-slate-200 rounded-xl bg-slate-50 cursor-pointer transition-all hover:border-emerald-400 hover:bg-emerald-50/40">
                                <div class="w-9 h-9 rounded-xl bg-emerald-50 flex items-center justify-center">
                                    <svg class="w-5 h-5 text-emerald-600" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" stroke-width="1.8">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div class="text-center">
                                    <p class="text-sm font-medium text-slate-600">Klik untuk unggah foto</p>
                                    <p class="text-xs text-slate-400 mt-0.5">PNG, JPG, JPEG hingga 2MB</p>
                                </div>
                                <input type="file" id="fotoEdit" name="foto" accept="image/*" class="hidden">
                            </label>

                            <img id="previewEdit"
                                class="mt-1 rounded-xl hidden w-32 h-32 object-cover border border-slate-200">

                            <button type="button" onclick="removeEditImage()" id="btnRemoveEdit"
                                class="hidden self-start text-xs text-red-500 hover:text-red-600 font-medium mt-1 transition-colors">
                                Hapus Foto
                            </button>

                            @error('foto')
                                <p class="text-xs text-red-500 mt-0.5">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>

                    {{-- Modal Footer --}}
                    <div class="flex gap-3 px-6 pb-6 border-t border-slate-100 pt-5 flex-shrink-0">
                        <button type="button" onclick="document.getElementById('modalEdit').classList.add('hidden')"
                            class="flex-1 flex items-center justify-center gap-2 px-6 py-3 text-sm font-medium text-slate-600 bg-slate-50 border border-slate-200 hover:bg-slate-100 active:scale-[0.99] rounded-xl transition-all">
                            Batal
                        </button>
                        <button type="submit"
                            class="flex-1 flex items-center justify-center gap-2 px-6 py-3 text-sm font-medium text-white bg-emerald-600 hover:bg-emerald-700 active:scale-[0.99] rounded-xl transition-all">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                            </svg>
                            Perbarui
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endpush

    {{-- Scripts --}}
    <script>
        function openModalEdit(el) {
            const id = el.dataset.id;
            const kategori = el.dataset.kategori;
            const lokasi = JSON.parse(el.dataset.lokasi);
            const ket = JSON.parse(el.dataset.ket);
            const foto = el.dataset.foto ? JSON.parse(el.dataset.foto) : null;

            const baseUrl = "{{ url('siswa/histori') }}";

            document.getElementById('formEdit').action = `${baseUrl}/${id}`;
            document.getElementById('kategori').value = kategori;
            document.getElementById('lokasi').value = lokasi;
            document.getElementById('ket').value = ket;

            const preview = document.getElementById('previewEdit');
            const btn = document.getElementById('btnRemoveEdit');
            const inputFile = document.getElementById('fotoEdit');

            // tampilkan foto lama
            if (foto) {
                preview.src = `/storage/${foto}`;
                preview.classList.remove('hidden');
                btn.classList.remove('hidden');
            } else {
                preview.src = '';
                preview.classList.add('hidden');
                btn.classList.add('hidden');
            }


            inputFile.value = "";

            inputFile.onchange = function(e) {
                const file = e.target.files[0];

                if (file) {
                    preview.src = URL.createObjectURL(file);
                    preview.classList.remove('hidden');
                    btn.classList.remove('hidden');
                }
            };

            // char counter
            const textarea = document.getElementById('ket');
            const counter = document.getElementById('char-count');
            counter.textContent = textarea.value.length;

            document.getElementById('modalEdit').classList.remove('hidden');
        }

        document.addEventListener('DOMContentLoaded', function() {
            const textarea = document.getElementById('ket');
            const counter = document.getElementById('char-count');
            if (textarea && counter) {
                textarea.addEventListener('input', function() {
                    counter.textContent = this.value.length;
                    counter.classList.toggle('text-amber-600', this.value.length > 200);
                    counter.classList.toggle('text-red-600', this.value.length >= 245);
                });
                counter.textContent = textarea.value.length;
            }
        });

        function removeEditImage() {
            document.getElementById('fotoEdit').value = "";
            document.getElementById('previewEdit').src = "";
            document.getElementById('previewEdit').classList.add('hidden');
            document.getElementById('btnRemoveEdit').classList.add('hidden');

            // kasih flag ke backend
            let input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'hapus_foto';
            input.value = '1';

            document.getElementById('formEdit').appendChild(input);
        }

        // Auto buka modal edit jika ada error validasi dari update
        @if ($errors->any() && old('_method') === 'PUT')
            document.getElementById('modalEdit').classList.remove('hidden');
        @endif
    </script>
@endsection
