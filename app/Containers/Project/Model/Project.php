<?php

namespace App\Containers\Project\Model;

use Illuminate\Database\Eloquent\Model;

/**
 *
 */
class Project extends Model
{
    /**
     * @var string
     */
    protected $table = "projects";

    /**
     * @var string[]
     */
    protected $fillable = [
        "name",
        "description",
    ];
}
