<?php

namespace App\Containers\Projects\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 *
 */
class SaveProjectRequest extends FormRequest
{
    /**
     * @return array[]
     */
    public function rules(): array
    {
        return [
            'name' => ['required', "string"]
        ];
    }

    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }
}
