<?php

namespace Domain\Zoho\Connect\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

/**
 *
 */
class AuthorizationRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'id'          => "required",
            'secret'      => "required",
            'data_center' => "required",
            'scopes'      => ["required", "array"],
        ];
    }

    /**
     * @param Validator $validator
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|void
     */
    protected function failedValidation(Validator $validator)
    {
        return view("zoho.auth.error");
    }
}
