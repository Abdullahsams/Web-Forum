<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post_Tag extends Model
{
    protected $table = "post_tags";

    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
