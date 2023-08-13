<?php

namespace App\Containers\Snippets\Models;

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
        'is_slot',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'required' => 'boolean',
        'is_slot'  => 'boolean',
    ];

    /**
     * @return BelongsTo
     */
    public function snippet(): BelongsTo
    {
        return $this->belongsTo(Snippet::class);
    }
}
