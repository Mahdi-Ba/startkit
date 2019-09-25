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
Route::resource('/admin/register', 'RegistrationController');
Route::get('/admin/users', 'RegistrationController@users');


/* category*/
Route::resource('/admin/category', 'CategoryController');
Route::get('/admin/categories', 'CategoryController@categories');
Route::get('/admin/select_categories', 'CategoryController@selectCategories');
/* tag*/
Route::resource('/admin/tag', 'TagController');
Route::get('/admin/tags', 'TagController@tags');
Route::get('/admin/select_tags', 'TagController@selectTags');

/*Blog*/
Route::resource('/admin/blog', 'BlogController');


Route::post('/admin/image', 'ImageController@store');
Route::post('/admin/image/deleted','ImageController@destroy');

