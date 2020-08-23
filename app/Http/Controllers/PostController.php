<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    public function __construct() 
    {
        
    }

    /**
     * Handles put request to update post name, expiration date or done status
     */
    public function update($group_id, $post_id, Request $request) {
        $post = Post::find($post_id);
        if ($post === null) 
            return response()->json(['message' => "Post not found"], 404);
        if (!$request->has('done') || !$request->filled('done'))
            return response()->json(['message' => "Parameter 'done' is missing"], 400);

        $done = $request->input('done') == "true" ? 1 : 0;
        if ($post->done != $done) {
            $post->done = $done;
            $post->save();
        }
        return response()->json(['message' => "OK"], 200);
    }
}
