<?php

namespace App\Containers\Deluge\Http\Controllers;

use App\Containers\Deluge\Models\Snippet;
use App\Containers\Deluge\Transformers\SnippetTransformer;
use App\Ship\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Fractalistic\ArraySerializer;

class SnippetsController extends Controller
{
    public function createSnippet(Request $request)
    {
        $snippet = Snippet::create([
            'name'      => $request->get('name'),
            'content'   => $request->get('content'),
            'arguments' => $request->get('arguments'),
        ]);

        $path = base_path('resources/views/snippets/s_' . $snippet->id . '.blade.php');
        file_put_contents($path, $request->get('content'));

        return fractal($snippet)
            ->transformWith(new SnippetTransformer())
            ->serializeWith(ArraySerializer::class)
            ->respond();
    }
}
