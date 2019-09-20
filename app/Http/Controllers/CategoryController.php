<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class CategoryController extends Controller
{

    public function index()
    {
        return view('admin.category.list');
    }

    public function categories(Request $request)
    {

        $categories = Category::query();
        if ($request->filled('title'))
            $categories->where('title', 'like', '%' . $request->title . '%');
        $categories = $categories->latest()->paginate(8);
        return response()->json($categories);
    }

    public function create()
    {
        $category = new Category();
        $category->is_active=true;
        return view('admin.category.store', ['category' => $category]);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required','string','max:255',
                Rule::unique('categories')->ignore($request->id),
            ],
            'slug' => ['nullable','string', 'max:255',
                Rule::unique('categories')->ignore($request->id),
            ],
            'is_active' => 'required|boolean',

        ]);

        if ($validator->fails()) {
            return Response($validator->errors(), 400);
        }

        $category = Category::updateOrCreate(['id' => $request->id],
            $request->all()
        );
   /*     if ($request->filled('slug'))
            $category->slug = $request->slug;
        $category->save();*/

        if ($category) {
            return Response('true', 200);
        }
        return Response('false', 200);
    }


    public function show($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.category.store', ['category' => $category]);
    }



    public function destroy($id)
    {
        $category = Category::find($id);
        if ($category != null) {
            if($category->delete())
                return response('true', 200);
        }
        return response('false', 200);
    }
}
