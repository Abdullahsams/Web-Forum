<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/home', 'PostsController@index');
Route::get('/posts/logout','PostsController@logout');
Route::get('/posts/mypost','PostsController@myPost');
Route::get('/posts/upvote/{post_id}','PostsController@PostupVote');
Route::get('/posts/downvote/{post_id}','PostsController@PostdownVote');
Route::get('/posts/correct/{post_id}','PostsController@PostCorrect');
Route::get('/posts/uncorrect/{post_id}','PostsController@PostUnCorrect');

Route::get('/answer/{post_id}/create', 'AnswerController@create');
Route::put('/answer/{answer_id}','AnswerController@update');
Route::get('/answer/upvote/{answer_id}','AnswerController@AnswerupVote');
Route::get('/answer/downvote/{answer_id}','AnswerController@AnswerdownVote');

Route::put('/comment/{post_id}','CommentController@create');
Route::put('/comment/answer/{post_id}','CommentController@createAnswer');

Route::resource('posts','PostsController');
Auth::routes();

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});



