<?php

namespace App\Containers\Snippets\Models;

use App\Containers\Snippets\Enums\SnippetType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 *
 */
class Snippet extends Model
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'snippets';

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'content',
        'description',
        'type',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'type' => SnippetType::class,
    ];

    /**
     * @return HasMany
     */
    public function arguments(): HasMany
    {
        return $this->hasMany(SnippetArgument::class);
    }
}
