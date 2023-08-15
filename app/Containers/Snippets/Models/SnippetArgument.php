<?php

namespace App\Containers\Snippets\Models;

use App\Containers\Snippets\Casts\ArgumentValueCast;
use App\Containers\Snippets\Enums\ArgumentType;
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
        'type'        => ArgumentType::class,
        'is_required' => 'boolean',
        'is_slot'     => 'boolean',
        'default'     => ArgumentValueCast::class,
    ];

    /**
     * @return BelongsTo
     */
    public function snippet(): BelongsTo
    {
        return $this->belongsTo(Snippet::class);
    }
}
