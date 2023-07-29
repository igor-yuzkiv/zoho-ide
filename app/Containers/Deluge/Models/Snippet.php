<?php

namespace App\Containers\Deluge\Models;

use Illuminate\Database\Eloquent\Model;

class Snippet extends Model
{
    protected $table = 'snippets';

    protected $fillable = [
        'name',
        'content',
    ];
}
