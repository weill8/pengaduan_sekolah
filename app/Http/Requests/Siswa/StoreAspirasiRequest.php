<?php

namespace App\Http\Requests\Siswa;

// use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreAspirasiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::guard('siswa')->check();
    }

    public function rules(): array
    {
        return [
            'id_kategori' => ['required', 'exists:tb_kategori,id_kategori'],
            'lokasi'      => ['required', 'string', 'max:255'],
            'ket'         => ['required', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'id_kategori.required' => 'Kategori wajib dipilih.',
            'id_kategori.exists'   => 'Kategori tidak valid.',
            'lokasi.required'      => 'Lokasi wajib diisi.',
            'lokasi.max'           => 'Lokasi maksimal 255 karakter.',
            'ket.required'         => 'Keterangan wajib diisi.',
            'ket.max'              => 'Keterangan maksimal 255 karakter.',
        ];
    }
}
