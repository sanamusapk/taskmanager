<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request){
        $creds = [
            'email' => $request->email,
            'password' => $request->password
        ];
        //Checking User Registeration Code Start
        $user = User::where('email',$request->email)->first();
        if(!$user)
        {
            // toastr()->error('User is Not Registered.');
            return redirect()->back();
        }
        //Checking User Registeration Code End
        //User Authentication Code Start
        if(Auth::guard('web')->attempt($creds))
        {
            // toastr()->success('You Login Successfully');
            return redirect()->intended(route('task.index'));
        } else {
            // toastr()->error('Wrong Password.');
            return redirect()->back();
        }
        //User Authentication Code End
    }
    
    public function logout()
    {        
        Auth::logout();
        // toastr()->success('You Logout Successfully');
        return redirect('/');
    }
    
}
