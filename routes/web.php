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

use App\Blog;
use App\Page;
use App\User;


Route::get('/', 'Front\HomeController@index')->name('home');
Route::get('/page/{slug}', 'Front\HomeController@page')->name('page');
Route::get('/blog', 'Front\BlogController@blog')->name('blog');
Route::get('/tag/{tag}', 'Front\BlogController@tag')->name('tag');
Route::get('/category/{category}', 'Front\BlogController@category')->name('category');
Route::get('/single_blog/{id}/{slug?}', 'Front\BlogController@single_blog')->name('single_blog');

Route::view('login', 'auth.login')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::middleware(['auth'])->group(function () {
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');

    Route::get('/admin', function () {
        return view('admin.home',[
            'user'=> User::count(),
            'blog'=> Blog::count(),
            'page'=> Page::count(),
        ]);
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
    Route::resource('/admin/blogs', 'BlogController');
    Route::get('/admin/blog/posts', 'BlogController@posts');


    Route::post('/admin/image', 'ImageController@store');
    Route::post('/admin/image/deleted','ImageController@destroy');

    /*Blog*/
    Route::resource('/admin/pages', 'PageController');
    Route::get('/admin/page/pages', 'PageController@pages');

    Route::post('/admin/page/rebuilt_menu', 'PageController@rebuiltMenu');
    Route::get('/admin/page/fetch_menu', 'PageController@fetchMenu');


    Route::get('/admin/page/menu', function () {
        return view('admin.menu_maker.menu');
    });
});
