<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment_Answer extends Model
{
    protected $table = 'comment_answers';
    protected $fillable = ['body','user_id','answer_id'];

    public function author () {
        return $this->belongsTo('App\User','user_id');
    }
}

