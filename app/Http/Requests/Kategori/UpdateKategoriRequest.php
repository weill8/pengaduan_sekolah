<?php

namespace App\Http\Requests\Kategori;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateKategoriRequest extends FormRequest
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
            'ket_kategori' => [
                'required',
                'string',
                'max:50',
                Rule::unique('tb_kategori', 'ket_kategori')->ignore($this->kategori, 'id_kategori'),
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'ket_kategori.required' => 'Nama kategori wajib diisi.',
            'ket_kategori.max'      => 'Nama kategori maksimal 50 karakter.',
            'ket_kategori.unique'   => 'Nama kategori sudah ada.',
        ];
    }
}
