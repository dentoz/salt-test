<?php

namespace App\Http\request;

use Illuminate\Foundation\Http\FormRequest;

class ProductsRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => [
                'required',
                'min:10',
                'max:150',
            ],
            'address' => [
                'required',
                'min:10',
                'max:150',
            ],
            'price' => [
                'required',
                'numeric'
            ]
        ];
    }
}
