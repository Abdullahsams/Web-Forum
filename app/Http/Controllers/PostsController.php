<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Auth;
use App\Tag;

class PostsController extends Controller
{
    Public function __construct() {
        //$this->middleware('auth')->only(['create','store','edit','update','destroy']);
        $this->middleware('auth');
    }  

    public function index()
    {
        $list = Auth::user()->posts;
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
        //explode request menjadi tag array
        // looping ke arrat tags tadi
        // setiap sekali looping lakukan pengecekan
        $tags_arr = explode(',', $request["tags"]);
        //dd($tags_arr);

        $tag_ids = [];
        foreach($tags_arr as $name){
            $tag = Tag::where("name", $name)->first();
            if($tag){
                $tag_ids[] = $tag->id;
            } else {
                $new_tag = Tag::create(["name" => $name]);
                $tag_ids[] = $new_tag->id;
            }
        }

        $list = Post::create([
            'title' => $request['title'],
            'body' => $request['body'],
            'user_id' => Auth::id(),
            'like'=> 0,
            'dislike' =>0, 
            'vote' => 0
        ]);

        // $tag_ids[]=$list->id;
        //dd($tag_ids);

        $list->tags()->sync($tag_ids);

        $user = Auth::user();
        $user->posts()->save($list);

        return redirect('/posts')->with('sukses','Pertanyaan berhasil dibuat !');
    }

    public function show($id)
    {
        //$list = Post::where('id', $id)->first();
        $list = Post::find($id);
        return view('posts.show',compact('list'));
    }
  
    public function edit($id)
    {
        $list = Post::find($id);
        $tags = [];
        foreach ($list->tags as $key => $value) {
            $tags[] = $value->name;
        }
        return view('posts.edit',compact('list','tags'));
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
}
