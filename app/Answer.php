<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $table = 'answers';   
    protected $fillable = ['body','user_id','post_id'];

    public function author () {
        return $this->belongsTo('App\User','user_id');
    }
}
