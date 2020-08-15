<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment_Post;
use App\Comment_Answer;
use App\Post;
use App\Answer;
use Auth;

class CommentController extends Controller
{          
    Public function __construct() {
        $this->middleware('auth');
    }  

    public function create(Request $request, $id)
    {        
      if(Auth::check()){
        $list = Comment_Post::create([
            'body' => $request['body'],
            'user_id' => Auth::id(),
            'post_id' => $id
        ]);
        return redirect("/posts/{$id}"); 
      }
    }

    public function createAnswer(Request $request, $id)
    {        
      if(Auth::check()){
        $list = Comment_Answer::create([
            'body' => $request['body'],
            'user_id' => Auth::id(),
            'answer_id' => $id
        ]);

        $ans = Answer::find($id);
        $post_id = $ans->post_id;
        return redirect("/posts/{$post_id}"); 
      }
    }
}
