<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Answer;
use App\Vote_Answer;
use App\Profile;

class AnswerController extends Controller
{
    public function create(Request $request, $id)
    {                 
       
        $list = Answer::create([
            'isi' => " ",
            'user_id' => Auth::id(),
            'post_id' => $id,
            'like'=> 0,
            'dislike' =>0, 
            'vote' => 0,
            'correct' => 0
        ]);

        return view('/answer/create',compact('list'));
    }

   
    public function update(Request $request, $id)
    {
        
        $query = Answer::where('id',$id)->update([
                        'isi' => $request['isi']
        ]);

        $list = Answer::find($id);        
        $post_id = $list->post_id;
        return redirect("/posts/{$post_id}");  
        
    }
    
    public function AnswerupVote($id)
    {
        try {
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
                        'answer_id' => $id,
                    ]);
                    

                    // refresh halaman sebelumnya
                    $post_id = $answer->post_id;
                    return redirect("/posts/{$post_id}");                
                }

                else {
                    $post_id = $answer->post_id;
                    return redirect("/posts/{$post_id}")->with('sukses','Anda sudah melakukan vote untuk jawaban ini !');                
                }
                
                
            }
            else {
                $post_id = $answer->post_id;
                return redirect("/posts/{$post_id}")->with('sukses','Anda tidak bisa melakukan vote untuk jawaban anda sendiri !');                
            }

        } catch (\Throwable $th) {
            return redirect("/posts")->with('sukses',$th->getMessage());
        }
    }

    public function AnswerdownVote($id)
    {
        try {
            $user_point = Auth::user()->profiles->point;

            if ( $user_point >= 15 ) {
                $answer = Answer::find($id);
                $answer->vote = $answer->vote - 1;
                $answer->save();

                // kurang 1 poin dari user akrif
                $user_id = Auth::user()->profiles->id;
                $profile = Profile::find($user_id);
                $profile->point -= 1;
                $profile->save();
                
                // kembali ke halaman sebelumnya
                $post_id = $answer->post_id;
                return redirect("/posts/{$post_id}");         
            }
            else {
                $post_id = $answer->post_id;
                return redirect("/posts/{$post_id}")->with('sukses','Poin partisipasi anda minimal 15 untuk melakukan downvote');         
            }


        } catch (\Throwable $th) {
            return redirect("/posts")->with('sukses',$th->getMessage());
        }
    }
}
