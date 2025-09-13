<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // public function adminlogin(Request $request)

    // {

    //     $request->validate([

    //         'email' => 'required|email',

    //         'password' => 'required',

    //     ]);



    //     $admin = DB::table('admins')

    //         ->where('email', $request->email)

    //         ->where('password', $request->password)

    //         ->first();



    //     if ($admin) {

    //         // Set the session

    //         $request->session()->put('adminuser', $admin->email);

    //         return redirect('/dashboard');

    //     }



    //     return redirect('/login')->with('error', 'Invalid email or password.');

    // }
    public function adminlogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return redirect()->back()->with('error', 'Invalid credentials.');
        }

        // Set session values
        session([
            'user_id' => $user->id,
            'user_name' => $user->name,
            'role_id' => $user->role_id,
        ]);

        return redirect('/dashboard');
    }


    public function logout()

    {

        Auth::logout();

        session()->flush(); 

        return redirect('/login'); 

    }

}
