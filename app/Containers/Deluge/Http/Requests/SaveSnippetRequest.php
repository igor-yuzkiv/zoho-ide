<?php

namespace App\Containers\Deluge\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveSnippetRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name'                 => ['required', 'string'],
            'content'              => ['nullable', 'string'],
            'description'          => ['nullable', 'string'],
            'arguments'            => ['array', 'nullable'],
            'arguments.*'          => ['array'],
            'arguments.*.id'       => ['nullable', "int"],
            'arguments.*.name'     => ['required', "string"],
            'arguments.*.type'     => ['nullable', "string"],
            'arguments.*.default'  => ['nullable', "string"],
            'arguments.*.required' => ['required', 'boolean'],
            'arguments.*._delete'  => ['nullable', 'boolean'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}