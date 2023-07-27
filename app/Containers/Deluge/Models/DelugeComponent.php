<?php

namespace App\Containers\Deluge\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 *
 */
class DelugeComponent extends Model
{
    /**
     * @var string
     */
    protected $table = "deluge_components";

    /**
     * @var string[]
     */
    protected $fillable = [
        "name",
        "module_id",
        "description",
        "insertText",
        "attributes",
        "slots",
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        "attributes" => "array",
        "slots"      => "array",
    ];

    /**
     * @return BelongsTo
     */
    public function module(): BelongsTo
    {
        return $this->belongsTo(DelugeModule::class, "module_id");
    }
}
