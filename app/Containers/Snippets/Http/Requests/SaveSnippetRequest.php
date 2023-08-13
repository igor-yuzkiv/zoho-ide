<?php

namespace App\Containers\Snippets\Http\Requests;

use App\Containers\Snippets\Enums\SnippetType;
use Illuminate\Foundation\Http\FormRequest;

class SaveSnippetRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name'                  => ['required', 'string'],
            'component_name'        => ['unique:snippets,component_name,' . $this->get('id', ''), 'required_if:type,' . SnippetType::TEMPLATE->value, 'string'],
            'component_insert_text' => ['nullable', 'string'],
            'content'               => ['nullable', 'string'],
            'description'           => ['nullable', 'string'],
            'type'                  => ['nullable', 'string'],

            'arguments'            => ['array', 'nullable'],
            'arguments.*'          => ['array'],
            'arguments.*.id'       => ['nullable', "int"],
            'arguments.*.name'     => ['required', "string"],
            'arguments.*.type'     => ['nullable', "string"],
            'arguments.*.default'  => ['nullable', "string"],
            'arguments.*.required' => ['required', 'boolean'],
            'arguments.*.is_slot'  => ['required', 'boolean'],
            'arguments.*._delete'  => ['nullable', 'boolean'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
