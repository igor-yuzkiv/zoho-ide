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
        'type',
        'description',
        'content',
        'component_name',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'type'         => SnippetType::class,
    ];

    /**
     * @return HasMany
     */
    public function arguments(): HasMany
    {
        return $this->hasMany(SnippetArgument::class);
    }

    /**
     * @return string
     * TODO: move to some another place ??
     */
    public function getContent(): string
    {
        if ($this->type === SnippetType::SAMPLE) {
            return $this->content;
        } else {
            return file_get_contents(
                base_path(config('project.snippets.components_folder')) . '/' . $this->component_name . '.blade.php'
            );
        }
    }
}
