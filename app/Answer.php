<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $table = 'answers';   
    protected $fillable = ['isi','user_id','post_id','like','dislike','vote','correct'];

    public function author () {
        return $this->belongsTo('App\User','user_id');
    }

    public function posts () {
        return $this->belongsTo('App\Post','post_id');
    }
    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }

    public function comment() {
        return $this->hasMany('App\Comment_Answer','answer_id');
    }
}
