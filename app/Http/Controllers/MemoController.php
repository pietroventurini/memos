<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Memo;
use App\Group;
use App\User;

class MemoController extends Controller
{
    public function __construct() 
    {
        $this->middleware('auth');
        $this->middleware('group');
    }
    
    public function store(Request $request) {
        $group_id = $request->route('group');
        $post = app('App\Http\Controllers\PostController')->store($request);
        $memo = new Memo();
        $memo->description = $request->input('description');
        $memo->post_id = $post->id;
        $memo->save();
        $post->postable_id = $memo->id;
        $post->postable_type = 'App\Memo';
        $post->save();
        return redirect()->route('groups.show', ['group' => $group_id]);
    }

    public function create(Request $request) {
        $group_id = $request->route('group');
        return view('post/create/memo')->with(['group_id' => $group_id, 'type' => 'memo']);
    }
}
