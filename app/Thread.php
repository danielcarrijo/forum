<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    protected $fillable = ['title','subtitle','description','topic','likes','code','user_id'];
    public function comments() {
        return $this->hasMany('App\Comment');
    }
    public function likes() {
        return $this->hasMany('App\Like');
    }
    public function user() {
        return $this->belongsto('App\User');
    }

}
