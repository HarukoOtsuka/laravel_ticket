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

// Route::get('/', function () {
//     return view('welcome');
// });

//ログインに関するルーティング
Auth::routes();

//ticketsに関するリソースルーティング
//TicketControllerの各アクションに紐づける
Route::resource('tickets', 'TicketController');

//トップページのルーティング
Route::get('/', 'TicketController@index')->name('top');

//出品チケット一覧に関するルーティング
Route::get('/users/{user}/exhibitions', 'UserController@exhibitions')->name('users.exhibitions');

//フォローに関するルーティング
Route::resource('follows', 'FollowController')->only([
    'index', 'store', 'destroy'
]);

//ユーザーに関するルーティング
Route::get('/users/{user}', 'UserController@show')->name('users.show');