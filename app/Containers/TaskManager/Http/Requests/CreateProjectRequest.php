<?php

namespace App\Containers\TaskManager\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProjectRequest extends FormRequest
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
