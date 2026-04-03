<?php

namespace App\Http\Requests\Auth;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class SiswaRegisterRequest extends FormRequest
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
            'nis'      => ['required', 'numeric', 'unique:tb_siswa,nis'],
            'id_kelas' => ['required', 'exists:tb_kelas,id'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ];
    }

    public function messages(): array
    {
        return [
            'nis.required'      => 'NIS wajib diisi.',
            'nis.numeric'       => 'NIS harus berupa angka.',
            'nis.unique'        => 'NIS sudah terdaftar.',
            'id_kelas.required' => 'Kelas wajib dipilih.',
            'id_kelas.exists'   => 'Kelas tidak ditemukan.',
            'password.required' => 'Password wajib diisi.',
            'password.min'      => 'Password minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ];
    }
}
