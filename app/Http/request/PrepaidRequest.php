<?php

namespace App\Http\request;

use App\enum\Value;
use Illuminate\Foundation\Http\FormRequest;
use App\helpers\Rule;
use Illuminate\Validation\Rule as ValidationRule;

class PrepaidRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'phone' => [
                'required',
                'min:7',
                'max:12',
                function($attribute, $value, $fail) {
                    $pref = substr($value, 0, 3);
                    if ( $pref !== "081" ) {
                        $fail('Phone number must have 081 as prefix');
                    }
                }
            ],
            'value' => [
                'required',
                ValidationRule::in(Value::getValues())
            ]
        ];
    }
}
