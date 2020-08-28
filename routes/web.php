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


//Route::get('/', 'FrontController@getHome');  //bianchini ha usato front controller
Route::get('/', function () {
    return view('welcome');
}); 


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


// Groups

Route::resource('/groups', 'GroupController', [
                    'except' => ['update'] //rimuovere dalle esclusioni le azioni che ci servono e aggiungerle al controller
                    ]);
Route::post('/groups/{group}/update', 'GroupController@update')->name('groups.update'); //in realta esiste gia update generato da resource (PUT)

Route::get('/users', 'UserController@getUserByIdOrEmail')->name('users.get');
Route::get('/users/{user}', 'UserController@show')->name('users.show');

//Route::get('/groups/{group}/posts/{post}', 'PostController@show')->name('posts.show');
//Route::resource('groups.posts', 'PostController')->except(['index','edit','create']);
Route::put('/groups/{group}/posts/{post}', 'PostController@update')->name('posts.update');
Route::delete('/groups/{group}/posts/{post}', 'PostController@destroy')->name('posts.destroy');

Route::get('/groups/{group}/posts/create', 'PostController@create')->name('groups.posts.create');
Route::post('/groups/{group}/posts/memos', 'MemoController@store')->name('memos.store');
Route::post('/groups/{group}/posts/shoplist', 'ShoplistController@store')->name('shoplist.store');






/* COSE AGGIUNTE DA ME 
Route::get('/home', 'HomeController@index')->name('home');
equivale a 
Route::get('/home', ['as' => 'home', 'uses' => 'HomeController'@])
*/


