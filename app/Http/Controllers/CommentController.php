<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\comment_post;
use App\Post;
use Auth;

class CommentController extends Controller
{          
    Public function __construct() {
        $this->middleware('auth');
    }  

    public function create(Request $request, $id)
    {        
        $list = Comment_Post::create([
            'body' => $request['body'],
            'user_id' => Auth::id(),
            'post_id' => $id
        ]);

        $list = Post::where('id', $id)->first();
        return view('posts.show',compact('list'));        
    }
}
