<?php

namespace App\Containers\Snippets\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 *
 */
class SnippetArgument extends Model
{
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
        'description',
        'is_required',
        'is_slot',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'is_required' => 'boolean',
        'is_slot'     => 'boolean',
    ];

    /**
     * @return BelongsTo
     */
    public function snippet(): BelongsTo
    {
        return $this->belongsTo(Snippet::class);
    }
}
