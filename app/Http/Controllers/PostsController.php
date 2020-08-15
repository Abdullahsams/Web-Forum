<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Auth;

class PostsController extends Controller
{
    Public function __construct() {
        $this->middleware('auth')->only(['create','store','edit','update','destroy']);
    }  

    public function index()
    {
        $list = Post::all();
        return view('posts.index',compact('list'));   
    }

    public function myPost()
    {
        if (Auth::check()) {
            $list = Auth::user()->posts;
        }
        else {
            $list = Post::all();
        }
        return view('posts.index',compact('list'));   
    }

    
    public function create()
    {
        return view('posts.create');
    }

   
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:posts',
            'body' => 'required',
        ]);
          
        $list = Post::create([
            'title' => $request['title'],
            'body' => $request['body'],
            'user_id' => Auth::id(),
            'like'=> 0,
            'dislike' =>0, 
            'vote' => 0
        ]);

        return redirect('/posts')->with('sukses','Pertanyaan berhasil dibuat !');
    }

    public function show($id)
    {
        $list = Post::where('id', $id)->first();
        return view('posts.show',compact('list'));
    }
  
    public function edit($id)
    {
        $list = Post::find($id);
        return view('posts.edit',compact('list'));
    }
   
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|unique:posts',
            'body' => 'required',
        ]);

        $list = Post::where('id',$id)->update([
                            'title' => $request['title'],
                            'body' => $request['body']
        ]);

        return redirect('/posts')->with('sukses','Pertanyaan berhasil diupdate !');
    }
   
    public function destroy($id)
    {
        $list = Post::where('id',$id)->delete();
        return redirect('/posts')->with('sukses','Pertanyaan berhasil dihapus !');
    }

    public function logout () {        
        Auth::logout();
        return  redirect('/posts');
    }

}
