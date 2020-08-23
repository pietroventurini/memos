<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'post';

    protected $fillable = ['title','done','expires_at'];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'done' => false,
    ];

    public function group() {
        return $this->belongsTo(Group::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function postable()
    {
        return $this->morphTo();
    }
}
