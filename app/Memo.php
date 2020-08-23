<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Memo extends Model
{
    protected $table = 'memo';

    protected $fillable = ['description'];


    public function post()
    {
        return $this->morphOne(Post::class, 'postable');
    }


}
