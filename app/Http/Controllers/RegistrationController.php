<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function create()
    {
        return view('admin.register');
    }
    public function store()
    {
        $this->validate(request(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::create(request(['name', 'email', 'password']));
        if($user){
            return redirect()->to('/admin/register')->with(['success'=> 'ثبت با موفقیت انجام شد']);
        }
        return redirect()->to('/admin/register');

    }
}
