<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shoplist extends Model
{
    protected $table = 'shoplist';

    public function post()
    {
        return $this->morphOne(Post::class, 'postable');
    }
    
    public function items() {
        return $this->belongsToMany(Item::class, 'item_shoplist_user')
        ->withPivot('quantity','checked')
        ->withTimestamps();
    }

    public function users() {
        return $this->belongsToMany(User::class, 'item_shoplist_user')
                    ->withPivot('quantity','checked')
                    ->withTimestamps();
    }

}
