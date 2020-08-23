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
//Route::get('/groups/{group_id}/destroy', 'GroupController@destroy')->name('groups.destroy'); //in realta esiste gia destroy generato da resource (DELETE)

Route::get('/users', 'UserController@getUserByIdOrEmail')->name('users.get');
Route::get('/users/{user}', 'UserController@show')->name('users.show');

/* COSE AGGIUNTE DA ME 
Route::get('/home', 'HomeController@index')->name('home');
equivale a 
Route::get('/home', ['as' => 'home', 'uses' => 'HomeController'@])
*/


