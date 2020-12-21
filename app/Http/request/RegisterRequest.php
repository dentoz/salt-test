<?php

namespace App\Http\request;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'string|nullable',
            'email' => 'required|email',
            'password' => 'required|min:6'
        ];
    }
}
