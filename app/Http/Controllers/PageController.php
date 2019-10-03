<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.page.list');

    }

    public function pages(Request $request)
    {

        $page = Page::query();
        if ($request->filled('title'))
            $page->where('title', 'like', '%' . $request->title . '%');
        $page = $page->with(['user'])->latest()->paginate(6);
        return response()->json($page);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.page.store');
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
            'template_id' => 'required|integer',
            'tag' => 'required'

        ]);

        if ($validator->fails()) {
            return Response($validator->errors(), 400);
        }
        $request->request->add(['user_id' => Auth::user()->id]);

        $page = Page::updateOrCreate(['id' => $request->id],
            $request->all()
        );
        $page->syncTags($request->tag);
        $page->save();
        if ($page) {
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
        $page = Page::where('id', $id)->with(['tags'])->get();
        return response(['page' => $page], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.page.store', ['pageId' => $id]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $page = Page::find($id);
        if ($page != null) {
            if ($page->delete())
                return response('true', 200);
        }
        return response('false', 200);
    }

    public function menu()
    {
  $page = Page::latest()->get(['id','title','slug'])->toArray();
       array_push($page,['id'=>7,'title'=>'salam','slug'=>'salam']);

/*        dd(array_search(7,$page,true));*/
        $a=[["a"=>"red","b"=>"green","c"=>"blue"]];
        dd(array_search("red",$a)) ;

    }
}
