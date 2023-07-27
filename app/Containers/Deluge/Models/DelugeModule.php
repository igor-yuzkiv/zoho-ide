<?php

namespace App\Containers\Deluge\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 *
 */
class DelugeModule extends Model
{
    /**
     * @var string
     */
    protected $table = "deluge_modules";

    /**
     * @var string[]
     */
    protected $fillable = [
        "name",
        "prefix",
        "namespace",
    ];

    /**
     * @return HasMany
     */
    public function components(): HasMany
    {
        return $this->hasMany(DelugeComponent::class, "module_id");
    }

}
