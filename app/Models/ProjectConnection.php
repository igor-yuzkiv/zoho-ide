<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 *
 */
class ProjectConnection extends Model
{
    /**
     * @var string
     */
    protected $table = "project_connections";

    /**
     * @var string[]
     */
    protected $fillable = [
        "project_id",
        "client_id",
        "client_secret",
        "access_token",
        "refresh_token",
        "data_cen\ter",
        "domain",
        "expire",
    ];

    /**
     * @return HasOne
     */
    public function project(): HasOne
    {
        return $this->hasOne(Project::class, "id", "project_id");
    }
}
