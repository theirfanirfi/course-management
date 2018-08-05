<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;

class LoginController extends Controller
{
    //

    public function login(Request $req)
    {
      $email = $req->input('email');
      $password = $req->input('password');

      if(Auth::attempt(['email'=> $email, 'password' => $password]))
      {
        $user = User::where('email','=',$email)->first();

        if($user->role == 1)
        {
          return redirect('/admin');
        }
        else {
          return redirect('/home');
        }
      }
      else {
        return redirect()->back()->with('error','User credentials are not matching our record.');
      }
    }
}
