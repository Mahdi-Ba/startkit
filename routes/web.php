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

Route::get('/home', 'HomeController@index')->name('home');

Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::view('login', 'auth.login')->name('login');
Route::post('login', 'Auth\LoginController@login');





Route::get('/admin', function () {
    return view('admin.home');
});

Route::get('/admin/register', 'RegistrationController@create')->name('register');
Route::post('/admin/register', 'RegistrationController@store');
