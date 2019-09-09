<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use const Grpc\STATUS_ABORTED;

class RegistrationController extends Controller
{
    public function index(){

        return view('admin.users_list');
    }
    public function users(Request $request)
    {
        $users = User::paginate(10);
        return response()->json($users);
    }
    public function create()
    {
        return view('admin.register');
    }
    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::create($request->all());
        $user->fill(['password' => Hash::make($request->password)]);
        $user->save();
        if($user){
            return redirect()->back()->with(['success'=> 'ثبت با موفقیت انجام شد']);
        }
        return redirect()->back();

    }
   public function destroy($id){
       $user = User::find($id);
       if($user != null)
       {
           $user->delete();
           return response('true',200);
       }
       return response('false',200);

    }
}
