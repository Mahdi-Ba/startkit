<?php

namespace App\Http\Controllers;

use App\Menu;
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
                Rule::unique('pages')->ignore($request->id),
            ],
            'slug' => ['required', 'string', 'max:255',
                Rule::unique('pages')->ignore($request->id),
            ],
            'content' => 'required|string',
            'img' => 'required|string',
            'template_id' => 'required|integer',
            'tag' => 'required'

        ]);
        if($request->id == null)
        {
             $item  = 'inserted';
        }else{
            $item = 'update';
        }
        if ($validator->fails()) {
            return Response($validator->errors(), 400);
        }
        $request->request->add(['user_id' => Auth::user()->id]);

        $page = Page::updateOrCreate(['id' => $request->id],
            $request->all()
        );
        $menu = Menu::updateOrCreate(
            ['page_id' => $page->id],
            [
                'page_id' =>$page->id,
                'title' =>$page->title,
                'slug' =>$page->slug,
                'template_id' =>$page->template_id,

            ]
        );
        $menu->parent_id = '';
        $menu->save();



        $page->syncTags($request->tag);

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
         Menu::where('page_id','=',$id)->get()->each->delete();
        if ($page != null) {
            if ($page->delete())
                return response('true', 200);
        }
        return response('false', 200);
    }

    public function fetchMenu(){
        $tree = Menu::get()->toTree()->toArray();
        return response($tree,200);
    }

    public function rebuiltMenu(Request $request){

          /*  Menu::truncate();
            $node = Menu::create(
                [
                'id' =>17,
                'title' => 'Foo',
                'slug' => 'Foo',
                'template_id' =>3,
                'children' => [
                    [
                        'id' =>18,
                        'title' => 'Bar',
                        'slug' => 'Bar',
                        'template_id' =>3,
                        'children' => [
                            [
                                'id' =>19,
                                'title' => 'Baz',
                                'slug' => 'Baz',
                                'template_id' =>3,
                            ],
                            [
                                'id' =>22,
                                'title' => 'Baz1',
                                'slug' => 'Baz1',
                                'template_id' =>3,
                            ],
                        ],
                    ],
                ],
            ]

            );*/



        $array = $request->data;
       Menu::truncate();
       foreach ($array as $value)
       {
           $node = Menu::create(
              $value

           );
       }

    }
    public function menumaker()
    {
        return view('admin.menu_maker.menu');

    }


}
