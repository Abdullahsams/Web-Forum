<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    protected $fillable = ['title','body','user_id','like','dislike','vote'];

    public function author () {
        return $this->belongsTo('App\User','user_id');
    }

    public function tags () {
        return $this->belongsToMany('App\Tag','post_tags','post_id','tag_id');
    }

    public function answer() {
        return $this->hasMany('App\Answer','post_id');
    }

    public function comment() {
        return $this->hasMany('App\Comment_Post','post_id');
    }
}
