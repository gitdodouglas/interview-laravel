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

Route::get('/', 'HomeController@index');
Route::post('/', 'HomeController@posts');

Route::get('/login', 'LoginController@index');
Route::post('/login', 'LoginController@login');

Route::get('/logout', 'LogoutController@index');

Route::get('/cadastro', 'CadastroController@index');
Route::post('/cadastro', 'CadastroController@create');

Route::get('/dash', 'DashController@index');
Route::post('/dash', 'DashController@create');

Route::get('/@{nickname}', 'PerfilController@index');
Route::post('/@{nickname}', 'PerfilController@posts');

Route::get('/@{nickname}/post={id}', 'PostPageController@index');
Route::post('/@{nickname}/post={id}', 'PostPageController@post');
Route::post('/comment/post={id}', 'PostCommentController@comment');
