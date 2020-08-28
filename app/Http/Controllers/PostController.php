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
        $this->middleware('post.creator',['only' => ['destroy']]);
    }

    /**
     * Handles put request to update 'done status' of a post
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

    /**
     * Handles http Delete requests to delete a post
     */
    public function destroy($group_id, $post_id, Request $request) {
        $post = Post::find($post_id);
        if ($post === null) 
            return response()->json(['message' => "Post not found"], 404); //ripetizione, avviene anche nel middleware
        $post->delete();
        return response()->json(['message' => "__('home.post.deleted')"], 200);
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

    //FIXME
    public function create(Request $request) {
        $group_id = $request->route('group');
        if(!$request->filled('type')) {
            //404
        }
        $type = $request->input('type');
        if($type == 'memo')
            return view('post/create/memo')->with(['group_id' => $group_id, 'type' => 'memo']);
        if ($type == 'shoplist')
            return view('post/create/shoplist')->with(['group_id' => $group_id,
                                                        'items'=> Item::all(),
                                                        'type' => 'shoplist']);
        // return bad formatting
            
    }

}
