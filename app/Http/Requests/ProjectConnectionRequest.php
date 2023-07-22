<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectConnectionRequest extends FormRequest
{
    public function rules(): array
    {
        $dataCenter = array_keys(config('zoho.auth.data_center'));
        return [
            'project_id'    => ['required', 'exists:projects,id'],
            'client_id'     => ['required', 'string'],
            'client_secret' => ['required', 'string'],
            'data_center'   => ['required', 'string', 'in:' . implode(',', $dataCenter)],
            'scopes'        => ['required', 'array'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
