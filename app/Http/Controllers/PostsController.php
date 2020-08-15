<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Profile;
use App\Tag;
use App\Vote_Post;
use App\Answer;
use App\Vote_Answer;
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
          
        $tag_arr = explode(',',$request['tags']);
        
        $tag_id = [];
        foreach($tag_arr as $tag) {
            $tag_1 = Tag::firstOrCreate(['name'=>$tag]);
            $tag_id[] = $tag_1->id;
        }
        
        $list = Post::create([
            'title' => $request['title'],
            'body' => $request['body'],
            'user_id' => Auth::id(),
            'like'=> 0,
            'dislike' =>0, 
            'vote' => 0
        ]);

        $list->tags()->sync($tag_id);

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

    public function PostupVote($id)
    {
        try {
            $post = Post::find($id);
            $user_id = $post->user_id;    
            $userlogin = Auth::user()->profiles->id;

            // hanya bisa melakukan vote untuk user lain
            if ($user_id <> $userlogin) {

                //cek apakah sudah pernah memberikan vote
                $cek =  Vote_Post:: where('user_id', $userlogin)->where('post_id', $id)->first();


                if (!$cek) {
                    // tambahkan 1 vote sesuai id pertanyaan
                    $post->vote += 1;                   
                    $post->save();

                    // tambahkan 10 poin untuk pembuat pertanyaan
                    $profile = Profile:: where('user_id', $user_id)->first(); 
                    $profile->point += 10;
                    $profile->save();
                
                    //simpan ke tabel vote_answer
                    $Vote = Vote_Post::create([
                        'user_id' => $userlogin,
                        'post_id' => $id,
                    ]);
                    
                    // refresh halaman sebelumnya
                    return redirect("/posts/{$id}");                
                }

                else {
                    return redirect("/posts/{$id}")->with('sukses','Anda sudah melakukan vote untuk pertanyaan ini !');                
                }
                
                
            }
            else {
                return redirect("/posts/{$id}")->with('sukses','Anda tidak bisa melakukan vote untuk pertanyaan anda sendiri !');                
            }

        } catch (\Throwable $th) {
            return redirect("/posts/{$id}")->with('sukses',$th->getMessage());
        }
    }

    public function PostdownVote($id)
    {
        try {
            $user_point = Auth::user()->profiles->point;

            if ( $user_point >= 15 ) {
                $post = Post::find($id);
                $post->vote = $post->vote - 1;
                $post->save();

                // kurang 1 poin dari user akrif
                $user_id = Auth::user()->profiles->id;
                $profile = Profile::find($user_id);
                $profile->point -= 1;
                $profile->save();
                
                return redirect("/posts/{$id}");         
            }
            else {
                return redirect("/posts/{$id}")->with('sukses','Poin partisipasi anda minimal 15 untuk melakukan downvote');         
            }


        } catch (\Throwable $th) {
            return redirect("/posts/{$id}")->with('sukses',$th->getMessage());
        }
    }

    public function PostCorrect($id) {
        try {
           $ans = Answer::find($id);
           $ans->correct = 1;           
           $ans->save();

            // tambahkan 15 poin untuk pembuat jawaban
            $user_id = $ans->user_id;  
            $profile = Profile:: where('user_id', $user_id)->first(); 
            $profile->point += 15;
            $profile->save();

           $post_id = $ans->post_id;
           return redirect("/posts/{$post_id}"); 

        } catch (\Throwable $th) {
            return redirect("/posts/{$id}")->with('sukses',$th->getMessage());
        }
    }

    public function PostUnCorrect($id) {
        try {
           $ans = Answer::find($id);
           $ans->correct = 0;
           $ans->save();

            // kurangi 15 poin jika batal jawaban tepat
             $user_id = $ans->user_id;  
             $profile = Profile:: where('user_id', $user_id)->first(); 
             $profile->point -= 15;
             $profile->save();

           $post_id = $ans->post_id;

           return redirect("/posts/{$post_id}"); 
           
        } catch (\Throwable $th) {
            return redirect("/posts/{$id}")->with('sukses',$th->getMessage());
        }
    }
    public function AnswerupVote($id)
    {
        try {
            $post_id = 2;
            $answer = Answer::find($id);
            $user_id = $answer->user_id;    
            $userlogin = Auth::user()->profiles->id;

            // hanya bisa melakukan vote untuk user lain
            if ($user_id <> $userlogin) {

                //cek apakah sudah pernah memberikan vote
                $cek =  Vote_Answer:: where('user_id', $userlogin)->where('answer_id', $id)->first();


                if (!$cek) {
                    // tambahkan 1 vote sesuai id jawaban
                    $answer->vote += 1;                   
                    $answer->save();

                    // tambahkan 10 poin untuk pembuat jawaban
                    $profile = Profile:: where('user_id', $user_id)->first(); 
                    $profile->point += 10;
                    $profile->save();
                
                    //simpan ke tabel vote_answer
                    $Vote = Vote_Answer::create([
                        'user_id' => $userlogin,
                        'post_id' => $id,
                    ]);
                    
                    // refresh halaman sebelumnya
                    return redirect("/posts/{$post_id}");                
                }

                else {
                    return redirect("/posts/{$post_id}")->with('sukses','Anda sudah melakukan vote untuk jawaban ini !');                
                }
                
                
            }
            else {
                return redirect("/posts/{$post_id}")->with('sukses','Anda tidak bisa melakukan vote untuk jawaban anda sendiri !');                
            }

        } catch (\Throwable $th) {
            return redirect("/posts/{$post_id}")->with('sukses',$th->getMessage());
        }
    }
}
