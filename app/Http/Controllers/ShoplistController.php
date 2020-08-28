<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shoplist;
use App\Group;
use App\User;

class ShoplistController extends Controller
{
    //TO CHANGE
    public function store(Request $request) {
        $group_id = $request->route('group');
        $post = app('App\Http\Controllers\PostController')->store($request);
        $shoplist = new Shoplist();
        // FILL SHOPLIST WITH ITEMS
        // TODO
        $shoplist->post_id = $post->id;
        //$memo->save();
        $post->postable_id = $shoplist->id;
        $post->postable_type = 'App\Shoplist';
        //$post->save();
        return redirect()->route('groups.show', ['group' => $group_id]);
    }
}
