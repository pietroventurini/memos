<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'item';

    protected $fillable = ['name','description'];


    public function category() {
        return $this->belongsTo(Category::class, 'category_name', 'name');
    }

    public function users() {
        return $this->belongsToMany(User::class, 'item_shoplist_user')
                    ->withPivot('quantity','checked')
                    ->withTimestamps();
    }

    public function shoplists() {
        return $this->belongsToMany(Shoplist::class, 'item_shoplist_user')
                    ->withPivot('quantity','checked')
                    ->withTimestamps();
    }
}
