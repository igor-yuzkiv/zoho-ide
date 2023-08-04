<?php

namespace App\Containers\Deluge\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use  \Illuminate\Database\Eloquent\Relations\BelongsTo;
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
        'required'
    ];

    /**
     * @return BelongsTo
     */
    public function snippet():BelongsTo
    {
        return $this->belongsTo(Snippet::class);
    }
}
