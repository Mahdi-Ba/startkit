<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ImageController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'address' =>'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);

        if ($validator->fails()) {
            return Response($validator->errors(), 400);
        }

        $path = Storage::disk('public')->put($request->address,$request->file('image'));

        return response(['path' =>$path],200);
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $path
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'img_url' =>'required|string',
        ]);

        if ($validator->fails()) {
            return Response($validator->errors(), 400);
        }

        $delete = Storage::disk('public')->delete($request->img_url);
        if($delete)
            response('true',200);
        response('false',200);


    }
}
