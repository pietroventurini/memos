<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Memo extends Model
{
    protected $table = 'memo';
    public $timestamps = false;
    protected $fillable = ['description'];


    public function post()
    {
        return $this->morphOne(Post::class, 'postable');
    }


}
