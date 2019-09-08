<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use const Grpc\STATUS_ABORTED;

class RegistrationController extends Controller
{
    public function index(){
        $users =User::paginate(3);

        return view('admin.users_list',['users' => $users]);
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
            return redirect()->to('/admin/register')->with(['success'=> 'ثبت با موفقیت انجام شد']);
        }
        return redirect()->to('/admin/register');

    }
   public function destroy($id){
       $user = User::find($id);
       if($user != null)
       {
           $user->delete();
           return response('delete',200);
       }
       return response('Not delete',404);

    }
}
