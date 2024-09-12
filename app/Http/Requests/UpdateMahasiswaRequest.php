<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMahasiswaRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'nama' => 'required|string|max:255',
            'jurusan' => 'required|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'nama.required' => 'Nama Wajib Di isi',
            'jurusan.required' => 'Jurusan Wajib Di isi',
        ];
    }
}
