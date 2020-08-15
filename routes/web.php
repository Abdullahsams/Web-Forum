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

Route::resource('posts','PostsController');

Route::group(['namespace' => 'Posts'], function () {
    Route::get('allPosts/index', 'PostsController@index')->name('allPosts.index');
    Route::get('allPosts/show/{id}',  'PostsController@show');
    Route::post('allPosts/store',  'PostsController@store')->name('answer.post');
    Route::post('allPosts/updateLike/{id}',  'PostsController@updateLike');
    Route::post('allPosts/updateVote/{id}',  'PostsController@updateVote');
    
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web','auth']], function (){
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
