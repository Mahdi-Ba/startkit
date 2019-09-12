<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use const Grpc\STATUS_ABORTED;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class RegistrationController extends Controller
{
    public function index()
    {
        return view('admin.users_list');
    }

    public function users(Request $request)
    {

        $users = User::query();
        if ($request->filled('name'))
            $users->where('name', 'like', '%' . $request->name . '%');
        if ($request->filled('email'))
            $users->where('email', 'like', '%' . $request->email . '%');
        $users = $users->paginate(10);
        return response()->json($users);
    }

    public function create()
    {
        $user = new User();
        return view('admin.register', ['user' => $user]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255',
                Rule::unique('users')->ignore($request->id),
            ],
            'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:6'
        ]);

        if ($validator->fails()) {
            return Response($validator->errors(), 400);
        }

        $user = User::updateOrCreate(['id' => $request->id],
            $request->all()
        );
        $user->fill(['password' => Hash::make($request->password)]);
        $user->save();

        if ($user) {
            return Response('true', 200);;
        }
        return Response('false', 200);;

    }

    public function show($id)
    {
        $user = User::find($id);
        return view('admin.register', ['user' => $user]);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if ($user != null) {
            $user->delete();
            return response('true', 200);
        }
        return response('false', 200);

    }
}
