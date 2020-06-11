<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class ContactController extends Controller
{

    public function index()
    {
        return view('admin.contact.list');
    }

    public function contacts(Request $request)
    {

        $categories = Contact::query();
        if ($request->filled('title'))
            $categories->where('mobile', 'like', '%' . $request->title . '%');
            $categories->Orwhere('name', 'like', '%' . $request->title . '%');
            $categories->Orwhere('email', 'like', '%' . $request->title . '%');
        $categories = $categories->latest()->paginate(8);
        return response()->json($categories);
    }


    public function show($id)
    {
        $category = Contact::findOrFail($id);
        return view('admin.contact.store', ['category' => $category]);
    }



    public function destroy($id)
    {
        $category = Contact::find($id);
        if ($category != null) {
            if($category->delete())
                return response('true', 200);
        }
        return response('false', 200);
    }
}
