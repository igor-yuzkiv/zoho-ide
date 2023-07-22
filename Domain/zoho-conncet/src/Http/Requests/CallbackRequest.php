<?php

namespace Domain\Zoho\Connect\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

/**
 *
 */
class CallbackRequest extends FormRequest
{

    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'code'     => "required",
            'location' => ["string", "nullable"],
        ];
    }

    /**
     * @param Validator $validator
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|void
     */
    protected function failedValidation(Validator $validator)
    {
        return view("zoho.auth.error");
    }
}
