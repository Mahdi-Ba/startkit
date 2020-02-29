<?php

namespace App\Http\Controllers\Front;

use App\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function page(string $slug)
    {
        $page = Page::where('slug',$slug)->first();

        return view('page',['page' =>$page]);
    }

}
