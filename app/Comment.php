<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['thread_id','comment','likes'];
    public function thread() {
        return $this->belongsto('App\Thread');
    }
    public function user() {
        return $this->belongsto('App\User');
    }
    public function likes() {
        return $this->hasMany('App\Like');
    }
}
