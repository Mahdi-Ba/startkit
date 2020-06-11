<?php

namespace App\Http\Controllers\Front;

use App\Contact;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'message' => 'required|string|max:1000',
            'email' => 'email|max:255',
            'mobile' => 'required|numeric',

        ]);
        if ($validator->fails()) {
            return Response('موارد بالا را به درستی وارد نمایید', 400);
        }
        try {
            Contact::create($request->all());
            return 'با موفقیت ارسال شد';
        }catch (Exception $e)
        {
            return 'خطا در ارسال';
        }

    }
}
