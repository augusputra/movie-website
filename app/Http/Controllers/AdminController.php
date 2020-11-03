<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\AdminController;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Session;
use Illuminate\support\Facades\Redirect;

class AdminController extends Controller
{
    public function login(Request $request){
        $email = $request->email;
        $password = $request->password;    

        $admin = User::where('email', $email)->first();

        if($admin == null){
            Session::put('message', 'Email atau Password salah');
    		return Redirect::to('/login-admin');
        }

        if($email != null && Hash::check($password, $admin->password)){
            Session::put('admin_email', $admin->email);
            Session::put('admin_name', $admin->name);
    		Session::put('admin_id', $admin->id);
            return redirect()->route('admin.movie');
        }else{
            Session::put('message', 'Invalid password combination');
    		return Redirect::to('/login-admin');
        }
    }

    public function logout(){
    	Session::flush();
    	return Redirect::to('/login-admin');
    }
}
