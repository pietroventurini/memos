<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Shoplist;
use App\Item;
use App\Group;


class ShoplistController extends Controller
{
    public function __construct() 
    {
        $this->middleware('auth');
        $this->middleware('group');
    }

    public function store(Request $request) {
        $title = $request[2]['value'];
        $expires_at = $request[3]['value'];
        $request->merge(['title' => $title, 'expires_at' => $expires_at]);
        $group_id = $request->route('group');
        $post = app('App\Http\Controllers\PostController')->store($request);
        $shoplist = new Shoplist();
        $shoplist->post_id = $post->id;
        $shoplist->save();
        $post->postable_id = $shoplist->id;
        $post->postable_type = 'App\Shoplist';
        $post->save();
        // FILL SHOPLIST WITH ITEMS
        $items = $request[6]['value'];
        //$items_ids = array_column($items, 'id');
        $user_id = auth()->id();
        foreach($items as $item_to_store) {
            $id = $item_to_store['id'];
            $quantity = $item_to_store['quantity'];
            DB::table('item_shoplist_user')->insert([
                'item_id' => $id,
                'shoplist_id' => $shoplist->id,
                'user_id' => $user_id,
                'quantity' => $quantity,
                'checked' => '0',
                'created_at' => new \Datetime(),
                'updated_at' => new \Datetime()
            ]);
        }
        return route('groups.show', ['group' => $group_id]);
    }

    public function create(Request $request) {
        $group_id = $request->route('group');
        return view('post/create/shoplist')->with(['group_id' => $group_id,
                                                    'items'=> Item::all(),
                                                    'type' => 'shoplist']);
    }
    

    public function checkItem(Request $request) {
        $group_id = $request->route('group');
        $list_id = $request->route('shoplist');
        $item_id = $request->filled('item_id') ? $request->input('item_id') : null;
        if ($request->filled('checked'))
            $checked = $request->input('checked') === 'true' ? '1' : '0';

        if ($item_id == null || $checked == null)
            return response()->json(['message' => 'Missing parameters'], 400);
        
        $shoplist = Shoplist::find($request->route('shoplist'));
        $shoplist->items->find($item_id)->pivot->update(['checked' => $checked]);
        
        return response()->json(['message' => 'Checked status has been updated'], 200); 
    }

    protected function getAvailableItems($shoplist) {
        return Item::all()->diff($shoplist->items);
    }

    public function edit(Request $request) {
        $shoplist_id = $request->route('shoplist');
        $shoplist = Shoplist::find($shoplist_id);
        return view('post/edit/shoplist')->with([
            'group_id' => $request->route('group'),
            'post' => $shoplist->post,
            'shoplist' => $shoplist,
            'available_items' => self::getAvailableItems($shoplist),
        ]);
    }

    public function update(Request $request) {
        $group_id = $request->route('group');
        $shoplist_id = $request->route('shoplist');
        $shoplist = Shoplist::find($shoplist_id);
        
        // items in the shoplist
        $items = $request->input('items');
        
        $id_items = array_column($items, 'id');
        // detach items that are not anymore in the list
        // FIXME: sync rimuove gli elementi non presenti e aggiunge quelli extra
        // quindi bisogna passare a sync solo quelli vecchi che rimangono (nuovi intersezione vecchi)
        $shoplist->items()->sync($id_items);

        $old_items = $shoplist->items()->get(['id','quantity']);

        // update items whose quantity has changed
        foreach ($items as $item) {
            foreach($old_items as $old_item) {
                if ($item['id'] == $old_item['id'] && $item['quantity'] != $old_item->pivot['quantity']) {
                    $shoplist->items()->updateExistingPivot($item['id'], ['user_id' => auth()->id(), 'quantity' => $item['quantity']]);
                }
            } 
        }

        // add new items
        //dd(Item::whereIn('id', $id_items)->diff($shoplist->items));




    }
}
