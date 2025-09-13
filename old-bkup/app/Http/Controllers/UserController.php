<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function viewuser()
    {
        $users = User::all();  
        $roles = Role::all();
        return view('user', [
            'users' => $users, 
            'roles' => $roles,  
        ]);
    }
    public function dashboard()
    {

        return view('dashboard');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
    
        $admin = DB::table('users')
            ->where('email', $request->email)
            ->where('password', $request->password)
            ->first();
    
        if ($admin) {
            $request->session()->put('adminuser', $admin->email);
            return view('index');
        } else {
            return redirect('/')->with('error', 'Invalid email or password.');
        }
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'role_id' => 'required|exists:roles,id',
            'status' => 'required|in:Active,Inactive',
            'warehouse' => 'required|string|max:255',
        ]);
    
        
        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            $imagePath = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $imagePath);
            $validatedData['profile_image'] = $imagePath; 
        }
    
        $validatedData['password'] = Hash::make($request->password);
  
        User::create($validatedData);
    
        return redirect()->back()->with('success', 'Record added successfully!');
    }
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return redirect()->back()->with('success', 'User deleted successfully!');
    }

    public function viewrole()
    {
        $roles = Role::all();  
        return view('role', [
            'roles' => $roles,  
        ]);
    }

    public function storerole(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|min:6',
            'permissions' => 'nullable|array',
        ]);
        $validatedData['permissions'] = json_encode($request->permissions ?? []);

        Role::create($validatedData);
    
        return redirect()->back()->with('success', 'Record added successfully!');
    }

    public function editprofile()
    {
        return view('profile');
    }

    
    

    // public function roledestroy($id)
    // {
    //     $role = Role::findOrFail($id);

    //     $role->delete();

    //     return redirect()->back()->with('success', 'User deleted successfully!');
    // }
}
