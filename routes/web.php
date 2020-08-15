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

Route::get('/posts/logout','PostsController@logout');
Route::get('/posts/mypost','PostsController@myPost');
Route::put('/comment/{post_id}','CommentController@create');
Route::resource('posts','PostsController');
Auth::routes();




