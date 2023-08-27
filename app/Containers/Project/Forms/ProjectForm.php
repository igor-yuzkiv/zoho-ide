<?php

namespace App\Containers\Project\Forms;

use App\Containers\CrudForm\CrudForm;
use App\Containers\CrudForm\Fields\StringFormField;
use App\Containers\CrudForm\Fields\TextFormField;
use App\Containers\Project\Model\Project;

/**
 *
 */
class ProjectForm extends CrudForm
{
    /**
     * @var array|string[]
     */
    protected array $fields = [
        'name'        => StringFormField::class,
        'description' => TextFormField::class,
    ];

    /**
     * @var array|string[]
     */
    protected array $labels = [
        'name'        => 'Name',
        'description' => 'Description',
    ];

    /**
     * @var array|array[]
     */
    protected array $rules = [
        'name'        => ['required', 'string', 'max:255'],
        'description' => ['nullable', 'string'],
    ];
}
