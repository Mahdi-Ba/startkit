<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Spatie\Tags\Tag;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.tag.list');
    }

    public function tags(Request $request)
    {

        $tag = Tag::query();
        if ($request->filled('name'))
            $tag->where('name->fa','like', '%'.$request->name.'%');
        $tag = $tag->latest()->paginate(8);
        return response()->json($tag);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tag = new Tag();

        return view('admin.tag.store', ['tag' => $tag]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required','string','max:255',
                Rule::unique('tags','name->fa')->ignore($request->id),
            ],
            'slug' => ['required','string','max:255',
                Rule::unique('tags','slug->fa')->ignore($request->id),
            ],


        ]);

        if ($validator->fails()) {
            return Response($validator->errors(), 400);
        }

        $tag = Tag::updateOrCreate(['id' => $request->id],
            [
                'name->fa' => $request->name,
                'slug->fa' =>  $request->slug
            ]
        );
        /*     if ($request->filled('slug'))
                 $category->slug = $request->slug;
             $category->save();*/

        if ($tag) {
            return Response('true', 200);
        }
        return Response('false', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tag = Tag::findOrFail($id);
        return view('admin.tag.store', ['tag' => $tag]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tag = Tag::find($id);
        if ($tag != null) {
            if($tag->delete())
                return response('true', 200);
        }
        return response('false', 200);
    }
}
