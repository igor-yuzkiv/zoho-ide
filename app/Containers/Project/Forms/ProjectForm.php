<?php

namespace App\Containers\Project\Forms;

use App\Containers\CrudForm\CrudForm;
use App\Containers\CrudForm\Fields\StringFormField;
use App\Containers\CrudForm\Fields\TextFormField;

class ProjectForm extends CrudForm
{
    protected array $fields = [
        'name' => StringFormField::class,
        'description' => TextFormField::class,
    ];
}
