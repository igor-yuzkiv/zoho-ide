<?php

namespace App\Containers\Deluge\Http\Controllers;

use App\Containers\Deluge\Models\Snippet;
use App\Ship\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SnippetsController extends Controller
{
    public function createSnippet(Request $request)
    {
        file_put_contents(
            base_path('resources/views/snippets/'.$request->get('name').'.blade.php'),
            $request->get('content')
        );
        return response()->json(['status' => 'success']);
    }
}
