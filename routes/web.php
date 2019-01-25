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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/post/{id}', 'AdminPostController@post')->name('post');

Route::group(['middleware'=>'admin'], function (){
    
    Route::get('/admin', function (){
    
        return view('admin.index');

    });
     
    Route::resource('admin/users', 'AdminUsersController');
    
    Route::resource('admin/posts', 'AdminPostController');
    
    Route::resource('admin/categories', 'AdminCategoriesController');
    
    Route::resource('admin/media', 'AdminMediasController');
    
    //Route::get('admin/media/upload', ['as' => 'media.upload', 'uses' => 'AdminMediasController@store' ]);
    
    Route::resource('admin/comments', 'PostCommentsController');
    
    Route::resource('admin/comment/replies', 'CommentRepliesController');
    
    Route::get('/delete/media', 'AdminMediasController@deleteMedia');
});




Route::get('admin/getposts', 'AdminPostController@getPosts');

