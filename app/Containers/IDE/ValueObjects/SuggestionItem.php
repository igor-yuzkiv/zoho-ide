<?php

namespace App\Containers\IDE\ValueObjects;

use App\Abstractions\ValueObject;

/**
 *
 */
class SuggestionItem extends ValueObject
{
    /**
     * @var string
     */
    protected string $label;

    /**
     * @var string
     */
    protected string $insertText;

    /**
     * @var string
     */
    protected string $kind;

    /**
     * @return string[]
     */
    protected function rules(): array
    {
        return  [
            'label'      => 'required|string',
            'insertText' => 'required|string',
            'kind'       => 'required|string',
        ];
    }
}
