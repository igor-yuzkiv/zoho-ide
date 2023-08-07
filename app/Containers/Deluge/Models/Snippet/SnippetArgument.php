<?php

namespace App\Containers\Deluge\Models\Snippet;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 *
 */
class SnippetArgument extends Model
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'snippet_arguments';

    /**
     * @var string[]
     */
    protected $fillable = [
        'snippet_id',
        'name',
        'type',
        'default',
        'required',
        'options',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'options' => 'array',
    ];

    /**
     * @return BelongsTo
     */
    public function snippet(): BelongsTo
    {
        return $this->belongsTo(Snippet::class);
    }
}