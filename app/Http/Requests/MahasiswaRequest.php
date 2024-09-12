<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MahasiswaRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'katakunci' => 'nullable|string|min:1|max:255',
        ];
    }

    public function katakunci()
    {
        return $this->get('katakunci', null);
    }
}
