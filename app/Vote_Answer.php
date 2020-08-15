<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote_Answer extends Model
{
    protected $table = 'vote_answers';
    protected $guarded = [];
    
    public $timestamps = false;
}
