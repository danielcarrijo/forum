<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    public $timestamps = false;
    protected $fillable = ['thread_id','comment_id','like'];
    public function comment() {
        return $this->belongsto('App\Comment');
    }

    public function thread() {
        return $this->belongsto('App\Thread');
    }
}
