<?php

namespace App\Containers\Projects\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveProjectRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', "string"]
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}