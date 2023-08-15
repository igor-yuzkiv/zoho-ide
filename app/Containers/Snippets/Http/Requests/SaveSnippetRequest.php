<?php

namespace App\Containers\Snippets\Http\Requests;

use App\Containers\Snippets\DTO\SnippetDto;
use App\Containers\Snippets\Enums\SnippetType;
use Illuminate\Foundation\Http\FormRequest;

/**
 *
 */
class SaveSnippetRequest extends FormRequest
{
    /**
     * @return array[]
     */
    public function rules(): array
    {
        return [
            'name'                  => ['required', 'string'],
            'component_name'        => ['unique:snippets,component_name,' . $this->get('id', ''), 'required_if:type,' . SnippetType::TEMPLATE->value, 'string'],
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

    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return SnippetDto
     */
    public function getDto(): SnippetDto
    {
        return SnippetDto::of($this->validated());
    }
}
