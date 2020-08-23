<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';
    protected $primaryKey = 'name'; // primary key is 'name' instead of 'id' (not sure if is considered such, because defined using unique() instead of increments())
    public $incrementing = false; //because 'name' is not autoincrement 
    protected $keyType = 'string'; // because 'name' is a string

    protected $fillable = ['name'];


    public function items() {
        return $this->hasMany(Item::class);
    }
}
