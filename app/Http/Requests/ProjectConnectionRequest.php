<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectConnectionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'project_id' => ['required', 'exists:projects,id'],
            'client_id' => ['required', 'string'],
            'client_secret' => ['required', 'string'],
            'data_center' => ['required', 'string'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
