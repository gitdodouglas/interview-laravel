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

Route::get('/', 'HomeController@index')->name('home');
Route::post('/', 'HomeController@posts')->name('posts');

Route::get('/login', 'LoginController@index');
Route::post('/login', 'LoginController@login')->name('login');

Route::get('/logout', 'LogoutController@index');

Route::get('/cadastro', 'CadastroController@index');
Route::post('/cadastro', 'CadastroController@create')->name('cadastro');

Route::get('/dash', 'DashController@index');
Route::post('/dash', 'DashController@create')->name('dash');

Route::get('/@{nickname}', 'PerfilController@index')->name('perfil');
Route::post('/@{nickname}', 'PerfilController@posts')->name('perfilPosts');

Route::get('/@{nickname}/post={id}', 'PostPageController@index')->name('post');
Route::post('/@{nickname}/post={id}', 'PostPageController@post')->name('page');
