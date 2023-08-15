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
            'title'                   => ['required', 'string'],
            'description'             => ['nullable', 'string'],
            'component_name'          => ['unique:snippets,component_name,' . $this->get('id', ''), 'required_if:type,' . SnippetType::TEMPLATE->value, 'string'],
            'type'                    => ['nullable', 'string'],
            'language'                => ['nullable', 'string'],
            'content'                 => ['nullable', 'string'],
            'arguments'               => ['array', 'nullable'],
            'arguments.*'             => ['array'],
            'arguments.*.id'          => ['nullable', "int"],
            'arguments.*.name'        => ['required', "string"],
            'arguments.*.type'        => ['nullable', "string"],
            'arguments.*.default'     => ['nullable', "string"],
            'arguments.*.is_required' => ['required', 'boolean'],
            'arguments.*.is_slot'     => ['required', 'boolean'],
            'arguments.*._delete'     => ['nullable', 'boolean'],
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
