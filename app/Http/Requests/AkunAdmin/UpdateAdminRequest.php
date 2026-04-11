<?php

namespace App\Http\Requests\AkunAdmin;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAdminRequest extends FormRequest
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
            'username' => [
                'required', 
                'string', 
                'max:50',
                Rule::unique('tb_admin', 'username')->ignore($this->route('akunAdmin')->id_admin, 'id_admin')
            ],
            'password' => ['nullable', 'string', 'min:6', 'confirmed'],
            'role'     => ['required', 'in:admin,super_admin'],
        ];
    }

    public function messages(): array
    {
        return [
            'username.required' => 'Username wajib diisi',
            'username.unique'   => 'Username sudah digunakan',
            'username.max'      => 'Username maksimal 50 karakter',

            'password.min'      => 'Password minimal 6 karakter',
            'password.confirmed'=> 'Konfirmasi password tidak cocok',

            'role.required'     => 'Role wajib dipilih',
            'role.in'           => 'Role tidak valid',
        ];
    }
}
