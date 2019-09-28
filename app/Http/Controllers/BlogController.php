<?php

namespace App\Http\Controllers;

use App\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Spatie\Tags\Tag;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.blog.store', ['blogId' => 3]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string', 'max:255',
                Rule::unique('blogs')->ignore($request->id),
            ],
            'slug' => ['required', 'string', 'max:255',
                Rule::unique('blogs')->ignore($request->id),
            ],
            'content' => 'required|string',
            'img' => 'required|string',
            'category_id' => 'required|integer',
            'tag' => 'required'

        ]);

        if ($validator->fails()) {
            return Response($validator->errors(), 400);
        }

        $blog = Blog::updateOrCreate(['id' => $request->id],
            $request->all()
        );
        $blog->syncTags($request->tag);
        $blog->save();
        if ($blog) {
            return Response('true', 200);
        }
        return Response('false', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Blog::where('id', $id)->with(['category'])->with(['tags'])->get();
        return response(['post'=>$post],200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.blog.store', ['blog' => $id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
