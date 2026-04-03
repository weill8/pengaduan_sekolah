<?php

namespace App\Http\Requests\Aspirasi;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class FeedbackRequest extends FormRequest
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
            'feedback' => ['required', 'string', 'max:1000'],
            'status'   => ['required', 'in:menunggu,proses,selesai'],
        ];
    }
 
    public function messages(): array
    {
        return [
            'feedback.required' => 'Feedback tidak boleh kosong.',
            'feedback.max'      => 'Feedback maksimal 1000 karakter.',
            'status.required'   => 'Status harus dipilih.',
            'status.in'         => 'Status tidak valid.',
        ];
    }
}
