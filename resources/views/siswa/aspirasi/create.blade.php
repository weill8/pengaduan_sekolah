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

    {{-- Form Section (Langsung tanpa wrapper glass tambahan) --}}
    <form method="POST" action="{{ route('siswa.aspirasi.store') }}" class="space-y-5">
        @csrf

        {{-- Kategori --}}
        <div>
            <label for="id_kategori" class="block text-sm font-semibold text-slate-700 mb-2">
                Kategori <span class="text-red-500">*</span>
            </label>
            <div class="relative">
                <select name="id_kategori" id="id_kategori"
                    class="w-full px-4 py-3 pr-10 rounded-xl border border-slate-200 bg-slate-50/60 text-slate-700 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all duration-200 appearance-none cursor-pointer @error('id_kategori') !border-red-400 !bg-red-50/30 focus:!ring-red-500/20 focus:!border-red-500 @enderror">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach ($kategoris as $kategori)
                        <option value="{{ $kategori->id_kategori }}" {{ old('id_kategori') == $kategori->id_kategori ? 'selected' : '' }}>
                            {{ $kategori->ket_kategori }}
                        </option>
                    @endforeach
                </select>
                {{-- Custom Dropdown Arrow --}}
                <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none text-slate-400">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>
            </div>
            @error('id_kategori')
                <p class="text-xs text-red-500 mt-1.5 flex items-center gap-1">
                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                    {{ $message }}
                </p>
            @enderror
        </div>

        {{-- Lokasi --}}
        <div>
            <label for="lokasi" class="block text-sm font-semibold text-slate-700 mb-2">
                Lokasi <span class="text-red-500">*</span>
            </label>
            <input type="text" name="lokasi" id="lokasi" value="{{ old('lokasi') }}" maxlength="255"
                placeholder="Contoh: Ruang Kelas XII RPL 1, Toilet Lantai 2, dll"
                class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/60 text-slate-700 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all duration-200 @error('lokasi') !border-red-400 !bg-red-50/30 focus:!ring-red-500/20 focus:!border-red-500 @enderror">
            @error('lokasi')
                <p class="text-xs text-red-500 mt-1.5 flex items-center gap-1">
                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                    {{ $message }}
                </p>
            @enderror
        </div>

        {{-- Keterangan --}}
        <div>
            <label for="ket" class="block text-sm font-semibold text-slate-700 mb-2">
                Keterangan <span class="text-red-500">*</span>
            </label>
            <textarea name="ket" id="ket" rows="4" maxlength="255"
                placeholder="Jelaskan permasalahan yang ingin dilaporkan secara detail..."
                class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/60 text-slate-700 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all duration-200 resize-none @error('ket') !border-red-400 !bg-red-50/30 focus:!ring-red-500/20 focus:!border-red-500 @enderror">{{ old('ket') }}</textarea>
            
            <div class="flex justify-between items-center mt-1.5">
                @error('ket')
                    <p class="text-xs text-red-500 flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                        {{ $message }}
                    </p>
                @else
                    <span></span>
                @enderror
                <span class="text-xs text-slate-400 font-mono"><span id="char-count">0</span>/255</span>
            </div>
        </div>

        {{-- Action Buttons --}}
        <div class="flex justify-end gap-3 pt-5 mt-2 border-t border-slate-200/60">
           
            <button type="submit"
                class="flex items-center w-full justify-center gap-2 px-5 py-2.5 text-sm font-semibold text-white bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 rounded-xl shadow-md shadow-emerald-500/25 hover:shadow-lg hover:shadow-emerald-500/30 transition-all duration-200 active:scale-[0.98]">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                </svg>
                Kirim Aspirasi
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const textarea = document.getElementById('ket');
        const counter = document.getElementById('char-count');
        if(textarea && counter) {
            textarea.addEventListener('input', function() {
                counter.textContent = this.value.length;
                counter.classList.toggle('text-amber-600', this.value.length > 200);
                counter.classList.toggle('text-red-600', this.value.length >= 245);
            });
            counter.textContent = textarea.value.length;
        }
    });
</script>
@endpush
@endsection