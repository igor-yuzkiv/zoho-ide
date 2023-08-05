<?php

namespace App\Containers\Deluge\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveArgumentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            //'snippet_id' => ['required', 'exists:snippets,id'],
            'name'       => ['required', 'string'],
            'type'       => ['required', 'string'],
            'default'    => ['nullable', 'string'],
            'required'   => ['nullable', 'boolean'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
