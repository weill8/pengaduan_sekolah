@extends('layouts.admin')

@section('title', 'Manajemen Kelas')

@section('content')

    {{-- Page Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <div class="w-1 h-6 rounded-full bg-gradient-to-b from-indigo-500 to-violet-600"></div>
                <h1 class="text-xl font-bold text-slate-800 tracking-tight">Manajemen Kelas</h1>
            </div>
            <p class="text-sm text-slate-400 ml-3">Kelola data kelas yang terdaftar di sistem</p>
        </div>
        <button onclick="document.getElementById('modalTambah').classList.remove('hidden')"
            class="inline-flex items-center gap-2 bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-500 hover:to-violet-500 text-white text-sm font-semibold px-5 py-2.5 rounded-xl shadow-lg shadow-indigo-500/25 transition-all hover:-translate-y-0.5 active:translate-y-0">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>
            Tambah Kelas
        </button>
    </div>

    {{-- Search Bar --}}
    <form method="GET" action="{{ route('admin.kelas.index') }}" class="mb-5">
        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama kelas..."
                class="w-full bg-white border border-slate-200 rounded-xl pl-10 pr-19 py-2.5 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500/30 focus:border-indigo-400 transition-all shadow-sm">
            @if (request('search'))
                <a href="{{ route('admin.kelas.index') }}"
                    class="absolute inset-y-0 right-0 border-l-2 border-slate-200 px-3 flex items-center text-slate-400 hover:text-slate-600 transition-colors">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </a>
            @else
            <button type="submit" class="absolute border-l-2 border-slate-200 inset-y-0 right-0 px-3 flex items-center text-slate-400 hover:text-slate-600 transition-colors">
                search    
            </button>
            @endif
        </div>
    </form>

    {{-- Table Card --}}
    <div class="rounded-2xl border border-slate-100 overflow-hidden shadow-sm">

        {{-- Table Header --}}
        <div class="bg-slate-50/80 px-6 py-3.5 border-b border-slate-100 flex items-center gap-2">
            <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
            </svg>
            <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Daftar Kelas</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead>
                    <tr class="bg-white border-b border-slate-100">
                        <th class="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider text-center w-16">No</th>
                        <th class="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider text-center">Nama Kelas</th>
                        <th
                            class="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider hidden sm:table-cell">
                            Dibuat</th>
                        <th class="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider text-center">Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse ($kelas as $index => $k)
                        <tr class="bg-white hover:bg-indigo-50/30 transition-colors group">
                            <td class="px-6 py-4">
                                <span
                                    class="text-xs font-semibold text-slate-400 bg-slate-100 w-7 h-7 rounded-lg flex items-center justify-center">
                                    {{ $kelas->firstItem() + $index }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-8 h-8 rounded-xl bg-gradient-to-br from-indigo-100 to-violet-100 flex items-center justify-center flex-shrink-0 group-hover:from-indigo-200 group-hover:to-violet-200 transition-colors">
                                        <svg class="w-4 h-4 text-indigo-500" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                        </svg>
                                    </div>
                                    <span class="font-semibold truncate max-w-xs text-slate-800 text-sm">{{ $k->nama_kelas }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 hidden sm:table-cell">
                                <span class="inline-flex items-center gap-1.5 text-xs text-slate-400">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                        stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    {{ $k->created_at->format('d M Y') }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-2">
                                    {{-- Edit Button --}}
                                    <button onclick="openModalEdit({{ $k->id }}, '{{ $k->nama_kelas }}')"
                                        class="inline-flex items-center gap-1.5 text-xs font-semibold text-amber-600 bg-amber-50 hover:bg-amber-100 border border-amber-200 px-3 py-1.5 rounded-lg transition-all hover:shadow-sm">
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                            stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                        Edit
                                    </button>

                                    {{-- Delete Button --}}
                                    <form method="POST" action="{{ route('admin.kelas.destroy', $k->id) }}"
                                        onsubmit="return confirm('Yakin ingin menghapus kelas ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="inline-flex items-center gap-1.5 text-xs font-semibold text-red-600 bg-red-50 hover:bg-red-100 border border-red-200 px-3 py-1.5 rounded-lg transition-all hover:shadow-sm">
                                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-16 text-center bg-white">
                                <div class="flex flex-col items-center gap-3">
                                    <div class="w-14 h-14 rounded-2xl bg-slate-100 flex items-center justify-center">
                                        @if (request('search'))
                                            <svg class="w-7 h-7 text-slate-300" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor" stroke-width="1.5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                            </svg>
                                        @else
                                            <svg class="w-7 h-7 text-slate-300" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor" stroke-width="1.5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                            </svg>
                                        @endif
                                    </div>
                                    <div>
                                        @if (request('search'))
                                            <p class="text-sm font-semibold text-slate-500">Tidak ada hasil untuk <span
                                                    class="text-indigo-500">"{{ request('search') }}"</span></p>
                                            <p class="text-xs text-slate-400 mt-0.5">Coba gunakan kata kunci yang berbeda
                                            </p>
                                        @else
                                            <p class="text-sm font-semibold text-slate-500">Belum ada kelas</p>
                                            <p class="text-xs text-slate-400 mt-0.5">Klik tombol "Tambah Kelas" untuk mulai
                                                menambahkan</p>
                                        @endif
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if ($kelas->hasPages())
            <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/50">
                {{ $kelas->appends(request()->query())->links() }}
            </div>
        @endif
    </div>


    {{-- ============================================================ --}}
    {{-- MODAL TAMBAH --}}
    {{-- ============================================================ --}}
    <div id="modalTambah" class="hidden fixed inset-0 z-50 flex items-start justify-center p-4">
        {{-- Backdrop --}}
        <div class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm"
            onclick="document.getElementById('modalTambah').classList.add('hidden')"></div>

        {{-- Modal Card --}}
        <div
            class="relative bg-white rounded-3xl shadow-2xl shadow-slate-900/20 w-full max-w-md border border-slate-100 overflow-hidden">
            {{-- Modal Header --}}
            <div class="flex items-center justify-between px-6 py-5 border-b border-slate-100">
                <div class="flex items-center gap-3">
                    <div
                        class="w-9 h-9 rounded-xl bg-gradient-to-br from-indigo-500 to-violet-600 flex items-center justify-center shadow-lg shadow-indigo-500/30">
                        <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-base font-bold text-slate-800">Tambah Kelas</h2>
                        <p class="text-xs text-slate-400">Isi nama kelas baru</p>
                    </div>
                </div>
                <button onclick="document.getElementById('modalTambah').classList.add('hidden')"
                    class="w-8 h-8 rounded-xl bg-slate-100 hover:bg-slate-200 flex items-center justify-center transition-colors">
                    <svg class="w-4 h-4 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            {{-- Modal Body --}}
            <form method="POST" action="{{ route('admin.kelas.store') }}">
                @csrf
                <div class="px-6 py-5">
                    <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-2">Nama Kelas</label>
                    <input type="text" name="nama_kelas" value="{{ old('nama_kelas') }}" maxlength="50" autofocus
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500/30 focus:border-indigo-400 transition-all
                    @error('nama_kelas') border-red-400 bg-red-50 focus:ring-red-500/20 focus:border-red-400 @enderror"
                        placeholder="Contoh: X RPL 1, XI IPA 2, dll">
                    @error('nama_kelas')
                        <div class="flex items-center gap-1.5 mt-2">
                            <svg class="w-3.5 h-3.5 text-red-500 flex-shrink-0" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p class="text-red-500 text-xs font-medium">{{ $message }}</p>
                        </div>
                    @enderror
                    <p class="text-xs text-slate-400 mt-2">Maksimal 50 karakter</p>
                </div>

                {{-- Modal Footer --}}
                <div class="flex justify-end gap-2.5 px-6 py-4 bg-slate-50/80 border-t border-slate-100">
                    <button type="button" onclick="document.getElementById('modalTambah').classList.add('hidden')"
                        class="px-5 py-2.5 text-sm font-semibold text-slate-600 bg-white border border-slate-200 rounded-xl hover:bg-slate-100 transition-all">
                        Batal
                    </button>
                    <button type="submit"
                        class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-semibold bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-500 hover:to-violet-500 text-white rounded-xl shadow-lg shadow-indigo-500/25 transition-all hover:-translate-y-0.5 active:translate-y-0">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>


    {{-- ============================================================ --}}
    {{-- MODAL EDIT --}}
    {{-- ============================================================ --}}
    <div id="modalEdit" class="hidden fixed inset-0 z-50 flex items-start justify-center p-4">
        {{-- Backdrop --}}
        <div class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm"
            onclick="document.getElementById('modalEdit').classList.add('hidden')"></div>

        {{-- Modal Card --}}
        <div
            class="relative bg-white rounded-3xl shadow-2xl shadow-slate-900/20 w-full max-w-md border border-slate-100 overflow-hidden">
            {{-- Modal Header --}}
            <div class="flex items-center justify-between px-6 py-5 border-b border-slate-100">
                <div class="flex items-center gap-3">
                    <div
                        class="w-9 h-9 rounded-xl bg-gradient-to-br from-amber-400 to-orange-500 flex items-center justify-center shadow-lg shadow-amber-500/30">
                        <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-base font-bold text-slate-800">Edit Kelas</h2>
                        <p class="text-xs text-slate-400">Ubah nama kelas yang dipilih</p>
                    </div>
                </div>
                <button onclick="document.getElementById('modalEdit').classList.add('hidden')"
                    class="w-8 h-8 rounded-xl bg-slate-100 hover:bg-slate-200 flex items-center justify-center transition-colors">
                    <svg class="w-4 h-4 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            {{-- Modal Body --}}
            <form method="POST" id="formEdit" action="">
                @csrf
                @method('PUT')
                <div class="px-6 py-5">
                    <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-2">Nama Kelas</label>
                    <input type="text" name="nama_kelas" id="editNamaKelas" maxlength="50"
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-amber-500/30 focus:border-amber-400 transition-all
                    @error('nama_kelas') border-red-400 bg-red-50 @enderror"
                        placeholder="Nama kelas">
                    @error('nama_kelas')
                        <div class="flex items-center gap-1.5 mt-2">
                            <svg class="w-3.5 h-3.5 text-red-500 flex-shrink-0" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p class="text-red-500 text-xs font-medium">{{ $message }}</p>
                        </div>
                    @enderror
                    <p class="text-xs text-slate-400 mt-2">Maksimal 50 karakter</p>
                </div>

                {{-- Modal Footer --}}
                <div class="flex justify-end gap-2.5 px-6 py-4 bg-slate-50/80 border-t border-slate-100">
                    <button type="button" onclick="document.getElementById('modalEdit').classList.add('hidden')"
                        class="px-5 py-2.5 text-sm font-semibold text-slate-600 bg-white border border-slate-200 rounded-xl hover:bg-slate-100 transition-all">
                        Batal
                    </button>
                    <button type="submit"
                        class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-semibold bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-400 hover:to-orange-400 text-white rounded-xl shadow-lg shadow-amber-500/25 transition-all hover:-translate-y-0.5 active:translate-y-0">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                        </svg>
                        Perbarui
                    </button>
                </div>
            </form>
        </div>
    </div>


    {{-- Scripts --}}
    <script>
        function openModalEdit(id, namaKelas) {
            const baseUrl = "{{ url('admin/kelas') }}";
            document.getElementById('formEdit').action = `${baseUrl}/${id}`;
            document.getElementById('editNamaKelas').value = namaKelas;
            document.getElementById('modalEdit').classList.remove('hidden');
        }

        // Auto buka modal tambah jika ada error validasi dari store
        @if ($errors->any() && old('_method') === null)
            document.getElementById('modalTambah').classList.remove('hidden');
        @endif

        // Auto buka modal edit jika ada error validasi dari update
        @if ($errors->any() && old('_method') === 'PUT')
            document.getElementById('modalEdit').classList.remove('hidden');
        @endif
    </script>

@endsection
