<?php

namespace App\Containers\Projects\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
    ];

    /**
     * @return HasMany
     */
    public function connections() : HasMany {
        return  $this->hasMany(ProjectConnection::class, "project_id", "id");
    }
}
