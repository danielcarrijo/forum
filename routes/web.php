<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'WelcomeController@index');
Route::get('/topic/{topic}','WelcomeController@filter')->name('welcome.filter');
Route::get('/user','UserController@index')->name('user.index');
Route::post('/user','UserController@store')->name('user.store');
Route::get('/user/{id}','UserController@show')->name('user.show');


Route::get('/thread/create','ThreadController@create')->name('thread.create')->middleware('auth');;
Route::get('/thread/{id}','ThreadController@show')->name('thread.show');
Route::post('/thread','ThreadController@store')->name('thread.store');
Route::put('/thread/like/{thread_id}','ThreadController@like')->name('thread.like');
Route::put('/thread/dislike/{thread_id}','ThreadController@dislike')->name('thread.dislike');
Route::get('/thread/like/{thread_id}/{user_id}','ThreadController@check')->name('thread.check');
Route::delete('/thread/like/{thread_id}','ThreadController@unlike')->name('thread.unlike');
Route::delete('/home/thread/{id}','ThreadController@destroy')->name('thread.destroy')->middleware('auth');
Route::get('/home/thread/','ThreadController@index')->name('thread.index')->middleware('auth');

Route::get('/comment/{id}','CommentController@index')->name('comment.index');
Route::post('/comment','CommentController@store')->name('comment.store');
Route::get('/comment/delete/{id}','CommentController@destroy')->name('comment.destroy')->middleware('auth');
Route::put('/comment/like/{comment_id}','CommentController@like')->name('comment.like');
Route::put('/comment/dislike/{comment_id}','CommentController@dislike')->name('comment.dislike');
Route::get('/comment/like/{comment_id}/{user_id}','CommentController@check')->name('comment.check');
Route::delete('/comment/like/{comment_id}','CommentController@unlike')->name('comment.unlike');




Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
