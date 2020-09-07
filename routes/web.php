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

Route::group(['middleware' => ['lang']], function() {

    Route::get('/', function () {
        return view('welcome');
    }); 

    Auth::routes();
    Route::get('/home', 'HomeController@index')->name('home');

    // Groups
    Route::resource('/groups', 'GroupController', [
                        'except' => ['update'] //rimuovere dalle esclusioni le azioni che ci servono e aggiungerle al controller
                        ]);
    Route::post('/groups/{group}/update', 'GroupController@update')->name('groups.update');

    // Users
    Route::get('/users', 'UserController@getUserByIdOrEmail')->name('users.get');
    Route::get('/users/{user}', 'UserController@show')->name('users.show');

    // Posts
    Route::put('/groups/{group}/posts/{post}', 'PostController@update')->name('posts.update');
    Route::delete('/groups/{group}/posts/{post}', 'PostController@destroy')->name('posts.destroy');
    // Memos
    Route::get('/groups/{group}/posts/memos/create', 'MemoController@create')->name('groups.memos.create');
    Route::post('/groups/{group}/posts/memos', 'MemoController@store')->name('groups.memos.store');
    // Shoplits
    Route::get('/groups/{group}/posts/shoplists/create', 'ShoplistController@create')->name('groups.shoplists.create');
    Route::post('/groups/{group}/posts/shoplists', 'ShoplistController@store')->name('groups.shoplists.store');
    Route::put('/groups/{group}/posts/shoplists/{shoplist}/checkItem', 'ShoplistController@checkItem')->name('groups.shoplists.checkItem');
    Route::get('/groups/{group}/posts/shoplists/{shoplist}/edit', 'ShoplistController@edit')->name('groups.shoplists.edit');
    Route::post('/groups/{group}/posts/shoplists/{shoplist}', 'ShoplistController@update')->name('groups.shoplists.update');
    // Items
    Route::get('/items/create', 'ItemController@create')->name('items.create');
    Route::post('/items/store', 'ItemController@store')->name('items.store');
});

// Language
Route::get('/lang/{lang}', 'LangController@setLanguage')->name('lang.set');
