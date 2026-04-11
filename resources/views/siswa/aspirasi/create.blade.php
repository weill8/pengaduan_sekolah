@extends('layouts.siswa')

@section('title', 'Buat Aspirasi')

@section('content')
    <div class="max-w-3xl mx-auto">
        {{-- Header Section --}}
        <div class="mb-6">
            <h1 class="text-2xl font-bold bg-gradient-to-r from-emerald-600 to-teal-600 bg-clip-text text-transparent">
                Buat Aspirasi
            </h1>
            <p class="text-sm text-slate-500 mt-1">Sampaikan aspirasi atau keluhan Anda secara jelas, sopan, dan detail.</p>
        </div>

        {{-- Form Section --}}
        <form method="POST" action="{{ route('siswa.aspirasi.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden">

                {{-- Header --}}
                <div class="flex items-center gap-3.5 px-6 py-5 border-b border-slate-100">
                    <div class="w-10 h-10 rounded-xl bg-emerald-50 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5 text-emerald-700" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M7 8h10M7 12h6M7 16h10M5 5h14a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-sm font-medium text-slate-800 leading-tight">Formulir Aspirasi</h2>
                        <p class="text-xs text-slate-400 mt-0.5">Sampaikan laporan atau masukan Anda secara terperinci</p>
                    </div>
                </div>

                <div class="px-6 py-6 flex flex-col gap-5">

                    {{-- Kategori --}}
                    <div class="flex flex-col gap-1.5">
                        <label for="id_kategori"
                            class="text-xs font-medium text-slate-500 uppercase tracking-wide flex items-center gap-1">
                            Kategori<x-form.required />
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-3.5 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                    stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M4 14h8" />
                                </svg>
                            </span>
                            <select name="id_kategori" id="id_kategori"
                                class="w-full pl-10 pr-9 py-2.5 text-sm text-slate-700 bg-slate-50 border border-slate-200 rounded-lg appearance-none outline-none transition focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/10 focus:bg-white hover:border-slate-300 cursor-pointer
                        @error('id_kategori') !border-red-400 !bg-red-50/40 focus:!ring-red-400/10 focus:!border-red-400 @enderror">
                                <option value="">Pilih kategori laporan...</option>
                                @foreach ($kategoris as $kategori)
                                    <option value="{{ $kategori->id_kategori }}"
                                        {{ old('id_kategori') == $kategori->id_kategori ? 'selected' : '' }}>
                                        {{ $kategori->ket_kategori }}
                                    </option>
                                @endforeach
                            </select>
                            <span class="absolute inset-y-0 right-3 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                    stroke-width="2">
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
                            Lokasi<x-form.required />
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-3.5 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                    stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </span>
                            <input type="text" name="lokasi" id="lokasi" value="{{ old('lokasi') }}" maxlength="255"
                                placeholder="Contoh: Ruang Kelas XII RPL 1, Toilet Lantai 2..."
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
                            Keterangan<x-form.required />
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

                        <label for="foto"
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
                            <input type="file" id="foto" name="foto" accept="image/*" class="hidden">
                        </label>

                        {{-- Preview --}}
                        <img id="previewCreate"
                            class="mt-1 rounded-xl hidden w-32 h-32 object-cover border border-slate-200">

                        {{-- Hapus foto --}}
                        <button type="button" onclick="removeCreateImage()" id="btnRemoveCreate"
                            class="hidden self-start text-xs text-red-500 hover:text-red-600 font-medium mt-1 transition-colors">
                            Hapus Foto
                        </button>

                        @error('foto')
                            <p class="text-xs text-red-500 mt-0.5">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                {{-- Footer --}}
                <div class="px-6 pb-6 border-t border-slate-100 pt-5">
                    <button type="submit"
                        class="w-full flex items-center justify-center gap-2 px-6 py-3 text-sm font-medium text-white bg-emerald-600 hover:bg-emerald-700 active:scale-[0.99] rounded-xl transition-all">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                        </svg>
                        Kirim Aspirasi
                    </button>
                </div>

            </div>
        </form>
    </div>

    @push('scripts')
        <script>
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

            document.getElementById('foto').addEventListener('change', function(e) {
                const file = e.target.files[0];
                const preview = document.getElementById('previewCreate');
                const btn = document.getElementById('btnRemoveCreate');

                if (file) {
                    preview.src = URL.createObjectURL(file);
                    preview.classList.remove('hidden');
                    btn.classList.remove('hidden');
                }
            });

            function removeCreateImage() {
                const input = document.getElementById('foto');
                const preview = document.getElementById('previewCreate');
                const btn = document.getElementById('btnRemoveCreate');

                input.value = "";
                preview.src = "";
                preview.classList.add('hidden');
                btn.classList.add('hidden');
            }
        </script>
    @endpush
@endsection
