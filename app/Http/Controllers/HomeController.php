<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Page;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function adminHome(){
        return view('admin.home',[
            'user'=> User::count(),
            'blog'=> Blog::count(),
            'page'=> Page::count(),
        ]);
    }
}
