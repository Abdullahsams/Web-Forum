<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote_Post extends Model
{
    protected $table = 'vote_posts';
    protected $guarded = [];

    public $timestamps = false;
}
