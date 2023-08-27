<?php

namespace App\Containers\Project\Model;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = "projects";

    protected $fillable = [
        "name",
        "description",
    ];
}
