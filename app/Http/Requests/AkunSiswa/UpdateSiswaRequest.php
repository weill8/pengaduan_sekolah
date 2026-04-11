<?php

namespace App\Http\Requests\AkunSiswa;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSiswaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nis'      => [
                'required',
                'size:8',
                'regex:/^[0-9]+$/',
                Rule::unique('tb_siswa', 'nis')->ignore($this->route('akunSiswa')->nis, 'nis'),
            ],
            'id_kelas' => ['required', 'exists:tb_kelas,id'],
            'nama'     => ['required', 'string', 'max:100'],
            'password' => ['nullable', 'string', 'min:6', 'confirmed'],
        ];
    }

    public function messages(): array
    {
        return [
            'nis.required'      => 'NIS wajib diisi.',
            'nis.size'          => 'NIS harus 8 digit.',
            'nis.regex'         => 'NIS hanya boleh berisi angka.',
            'nis.unique'        => 'NIS sudah terdaftar.',

            'id_kelas.required' => 'Kelas wajib dipilih.',
            'id_kelas.exists'   => 'Kelas tidak ditemukan.',

            'nama.required'     => 'Nama wajib diisi.',
            'nama.string'       => 'Nama harus berupa teks.',
            'nama.max'          => 'Nama maksimal 100 karakter.',

            'password.required' => 'Password wajib diisi.',
            'password.min'      => 'Password minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ];
    }
}
