<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = 'group';

    protected $fillable = ['name', 'description'];

    public function posts() {
        return $this->hasMany(Post::class);
    }

    public function memos() {
        return $this->hasManyThrough(Memo::class, Post::class);    
    }

    public function shoplists() {
        return $this->hasManyThrough(Shoplist::class, Post::class);
    }

    public function users() {
        return $this->belongsToMany(User::class, 'group_users', 'group_id', 'user_id')
                    ->withPivot('isAdmin')
                    ->withTimestamps();
    }

    public function admin() {
        return $this->belongsToMany(User::class, 'group_users', 'group_id', 'user_id')
                    ->wherePivot('isAdmin', true);
    }

}
