<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});
//Route::get('post/tag/{tag}', 'BlogController@search');
//Route::get('photos/popular', 'PostController@showbytag');
//Route::resource('posts', 'PostController');
//Route::get('api/posts/showPostByTag/{tag}', 'PostController@showPostByTag');
Route::group(array('prefix' => 'api'), function() {
Route::get( 'showbytag/{tag}', array('as' => 'api.posts.showbytag', 'uses' => 'PostController@showbytag'));
Route::get( 'countbytag/{tag}', array('as' => 'api.posts.countbytag', 'uses' => 'PostController@countbytag'));
Route::resource('posts', 'PostController');
Route::resource('tags', 'TagController');  
});
