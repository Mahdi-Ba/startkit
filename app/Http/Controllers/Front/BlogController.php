<?php

namespace App\Http\Controllers\Front;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Blog;
use Spatie\Tags\Tag;

class BlogController extends Controller
{

    public function blog()
    {
        $latest = Blog::with(['user'])->latest()->limit(4)->get();
        $blog = Blog::with(['category', 'user'])->latest()->paginate(9);
        return view('blog', ['latest' => $latest, 'blog' => $blog]);
    }

    public function single_blog(int $id, string $slug)
    {


        $latest = Blog::with(['user'])->latest()->limit(4)->get();
        $post = Blog::with(['category'])->with(['tags'])->with(['user'])->findOrFail($id);
        $array_tag = [];
        foreach ($post->tags as $tag) {
            array_push($array_tag, $tag->name);
        }


        $related = Blog::where('id','<>',$post->id)->withAnyTags($array_tag)->with(['user'])->limit(3)->get();


        return view('single_blog', ['latest' => $latest, 'post' => $post, 'related' => $related]);
    }

    public function tag(string $tag)
    {
        $tag = Tag::where('slug->fa', '=', $tag)->get();
        $blog = Blog::withAllTags($tag)->with(['category', 'user'])->latest()->paginate(9);
        $latest = Blog::with(['user'])->latest()->limit(4)->get();
        return view('blog', ['latest' => $latest, 'blog' => $blog]);

    }


    public function category(string $category)
    {
        $category = Category::where('slug', '=', $category)->first();
        $blog = Blog::with(['category', 'user'])->where('category_id', '=', $category->id)->latest()->paginate(9);
        $latest = Blog::with(['user'])->latest()->limit(4)->get();
        return view('blog', ['latest' => $latest, 'blog' => $blog]);

    }
}
