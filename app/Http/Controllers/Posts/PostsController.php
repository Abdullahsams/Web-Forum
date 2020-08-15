<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Post;
use App\Answer;
use Auth;

class PostsController extends Controller
{
    public function index()
    {
        $post = Post::with('author')->latest()->get();
        return view('postAll.index', ['post' => $post]);
    }

    public function show($id)
    {
        $post = Post::find($id);
        $all = Answer::with('user')->where('post_id', $id)->latest()->paginate(5);
        return view('postAll.show',compact('post','all'));
    }

    public function store(Request $request)
    {
        $answer = new Answer();
        $answer->isi = $request->isi;
        $answer->like = 0;
        $answer->dislike = 0;
        $answer->vote = 0;
        $answer->correct = 0;
        $answer->user_id = Auth::id();
        $answer->post_id = $request->post_id;
        $answer->save();

        return back()->with('sukses','Pertanyaan berhasil dibuat !');
    }

    public function updateLike($id, Request $request)
    {
        try {
            $answer = Answer::find($id);
            if (!empty($request->like)) {
                $answer->like = $answer->like + 1;
            }
            if (!empty($request->dislike)) {
                $answer->dislike = $answer->dislike + 1;
            }
            $answer->save();

            return back()->with('sukses','Sukses');
        } catch (\Throwable $th) {
            return back()->with('sukses',$th->getMessage());
        }
    }

    public function updateVote($id, Request $request)
    {
        try {
            $answer = Answer::find($id);
            if (!empty($request->upvote)) {
                $answer->vote = $answer->vote + 15;
            }
            if (!empty($request->downvote)) {
                $answer->vote = $answer->vote - 1;
            }
            $answer->save();

            return back()->with('sukses','Sukses');
        } catch (\Throwable $th) {
            return back()->with('sukses',$th->getMessage());
        }
    }
}
