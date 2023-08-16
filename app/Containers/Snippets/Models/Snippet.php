<?php

namespace App\Containers\Snippets\Models;

use App\Abstractions\Filter\HasFilter;
use App\Containers\Snippets\Enums\SnippetLanguage;
use App\Containers\Snippets\Enums\SnippetType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 *
 */
class Snippet extends Model
{
    use HasFilter;

    /**
     * @var string
     */
    protected $table = 'snippets';

    /**
     * @var string[]
     */
    protected $fillable = [
        'title',
        'description',
        'component_name',
        'type',
        'language',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'type'     => SnippetType::class,
        'language' => SnippetLanguage::class,
    ];

    /**
     * @return HasMany
     */
    public function arguments(): HasMany
    {
        return $this->hasMany(SnippetArgument::class);
    }
}
