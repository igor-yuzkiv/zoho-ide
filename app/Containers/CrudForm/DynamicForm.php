<?php

namespace App\Containers\CrudForm;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Http\JsonResponse;

abstract class DynamicForm
{
    protected Model $model;

    protected array $fields = [];


    /**
     * @return
     */
    public function respond(): JsonResponse {
        return \Response::json([
            'fields' => $this->fields,
            "meta" => [
                "action" => '',
                "method" => 'POST',
            ],
        ]);
    }
}
