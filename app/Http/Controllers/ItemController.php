<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Item;

class ItemController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    public function create(Request $request) {
        if (!$request->has('shoplist') || !$request->has('group'))
            return redirect('home');

        $shoplist_id = $request->input('shoplist');
        $group_id = $request->input('group');
        $categories = Category::all('name');
        return view('post.edit.addItem')->with(['group_id' => $group_id, 
                                                'shoplist_id' => $shoplist_id,
                                                'categories' => $categories]);
    }

    public function store(Request $request) {
        if ($request->filled('name')) {
            $item = new Item();
            $item->name = $request->input('name');
            if ($request->filled('description'))
                $item->description = $request->input('description');
            $item->category_name = $request->category;

            $item->save();
        }
        return redirect()->back();
    }
}
