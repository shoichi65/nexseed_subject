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
    return redirect('/login');
});

Route::get('/feeds', 'FeedsController@index');
Route::get('/feeds/create', 'FeedsController@create');
Route::post('/feeds', 'FeedsController@store');
Route::get('/feeds/{id}', 'FeedsController@view');
Route::get('/feeds/{id}/edit', 'FeedsController@edit');
Route::patch('/feeds/{id}', 'FeedsController@update');
Route::delete('/feeds/{id}', 'FeedsController@destory');
Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home', 'FeedsController@index');

// Route::post('/likes', 'LikesController@like');
Route::post('/likes', 'LikesController@ajaxlike');

// Route::post('/comments', 'CommentsController@store');
Route::post('/comments', 'CommentsController@ajaxstore');

// Route::get('/comments/{comment_id}/{feed_id}', 'CommentsController@destory');
// Route::delete('/comments/{comment_id}', 'CommentsController@destory');
Route::delete('/comments/{comment_id}', 'CommentsController@ajaxdestory');

Route::prefix('admin')->group(function() {
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/', 'AdminController@index')->name('admin.dashboard');
    Route::get('/view/{id}', 'AdminController@view')->name('admin.view');
    Route::post('/feeds/{id}', 'AdminController@ajaxdestory')->name('admin.feeds');
});
