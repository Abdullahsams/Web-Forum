<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment_Post extends Model
{
    protected $table = 'comment_posts';
    protected $fillable = ['body','user_id','post_id'];

    public function author () {
        return $this->belongsTo('App\User','user_id');
    }
}
