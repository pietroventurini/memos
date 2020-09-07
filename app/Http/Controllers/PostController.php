<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Item;


class PostController extends Controller
{
    public function __construct() 
    {
        $this->middleware('auth');
        $this->middleware('group');
        $this->middleware('post.creator',['only' => ['destroy']]);
    }

    /**
     * Handles put request to update 'done status' of a post
     */
    public function update($group_id, $post_id, Request $request) {
        $post = Post::find($post_id);
        if ($post === null) 
            return response()->json(['message' => __('home.post.not-found')], 404);
        if (!$request->has('done') || !$request->filled('done'))
            return response()->json(['message' => "Parameter 'done' is missing"], 400);

        $done = $request->input('done') == "true" ? 1 : 0;
        if ($post->done != $done) {
            $post->done = $done;
            $post->save();
        }
        return response()->json(['message' => "OK"], 200);
    }

    /**
     * Handles http Delete requests to delete a post
     */
    public function destroy($group_id, $post_id, Request $request) {
        $post = Post::find($post_id);
        if ($post === null) 
            return response()->json(['message' => __('home.post.not-found')], 404); //ripetizione, avviene anche nel middleware
        $post->delete();
        return response()->json(['message' => __('home.post.deleted')], 200);
    }

    public function show($group_id, $post_id, Request $request) {
        echo "Group: " . $group_id . "<br>";
        echo "Post: " . $post_id . "<br>";
    }

    // FIXME
    public function store(Request $request) {
        $post = new Post();
        $post->title = $request->input('title');
        $post->expires_at = $request->input('expires_at');
        $post->done = '0';
        $post->user_id = auth()->id();
        $post->group_id = $request->route('group');
        $post->save();
        return $post;
    }

    public function updateInfo($group_id, $post_id, $title, $expires_at) {
        $post = Post::find($post_id);
        if ($post === null) 
            return response()->json(['message' => __('home.post.not-found')], 404);
        if ($post->user->id != auth()->id())
            return response()->json(['message' => __('home.post.forbidden')], 401);
        
        $post->title = $title;
        $post->expires_at = $expires_at;
        $post->save();
        return response()->json(['message' => "OK"], 200);
    }

}
