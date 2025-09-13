<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\UsersExport; // or use App\Exports\UsersExport; if in Exports folder
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class UserController extends Controller
{
    // ... your existing methods ...

 public function exportExcel()
{
    $users = DB::table('users')
        ->join('roles', 'users.role_id', '=', 'roles.id')
        ->select(
            'users.name',
            'users.email',
            'roles.name as role', // Get role name from roles table
            'users.warehouse',
            'users.status'
        )
        ->get();
    
    // Generate CSV content
    $csv = "Name,Email,Role,Warehouse,Status\n"; // Header row
    
    foreach ($users as $user) {
        $csv .= '"' . str_replace('"', '""', $user->name) . '",';
        $csv .= '"' . str_replace('"', '""', $user->email) . '",';
        $csv .= '"' . str_replace('"', '""', $user->role) . '",';
        $csv .= '"' . str_replace('"', '""', $user->warehouse) . '",';
        $csv .= '"' . str_replace('"', '""', $user->status) . '"';
        $csv .= "\n";
    }
    
    // Set headers for download
    $headers = [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => 'attachment; filename="users.csv"',
    ];
    
    return response()->make($csv, 200, $headers);
}

    public function exportPDF()
    {
        $users = User::all();
        $pdf = PDF::loadView('pdf.users-pdf', compact('users'));
        
        return $pdf->download('users.pdf');
    }

   public function viewuser()
{
    $users = User::with('role')->get();  // Eager load the role relationship
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
            $file->move('uploads/', $imagePath);
            $validatedData['profile_image'] = $imagePath; 
        }
    
        $validatedData['password'] = Hash::make($request->password);
  
        User::create($validatedData);
    
        return redirect()->back()->with('success', 'Record added successfully!');
    }

    public function update(Request $request)
    {
        $request->validate([
            'id'            => 'required|exists:users,id',
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|max:255|unique:users,email,' . $request->id,
            'role_id'       => 'required|exists:roles,id',
            'status'        => 'required|in:Active,Inactive',
            'warehouse'     => 'nullable|string|max:255',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = User::findOrFail($request->id);

        // Update the user data
        $user->name      = $request->name;
        $user->email     = $request->email;
        $user->role_id   = $request->role_id;
        $user->status    = $request->status;
        $user->warehouse = $request->warehouse;

        if ($request->hasFile('profile_image')) {
            // Delete old image if exists
            if ($user->profile_image && file_exists('uploads/' . $user->profile_image)) {
                unlink('uploads/' . $user->profile_image);
            }

            // Upload new image
            $image     = $request->file('profile_image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move('uploads', $imageName);

            // Store only the filename (same as store())
            $user->profile_image = $imageName;
        }

        $user->save();

        return redirect()->back()->with('success', 'User updated successfully.');
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
            'description' => 'required|string|min:2',
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

public function exportExcelrole()
{
    $roles = Role::all();

    // Generate CSV content
    $csv = "Name,Description,Permissions\n";
    
    foreach ($roles as $role) {
        $csv .= '"' . str_replace('"', '""', $role->name) . '",';
        $csv .= '"' . str_replace('"', '""', $role->description) . '",';
        $csv .= '"' . str_replace('"', '""', $role->permissions) . '"';
        $csv .= "\n";
    }
    
    // Set headers for download
    $headers = [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => 'attachment; filename="roles.csv"',
    ];
    
    return response()->make($csv, 200, $headers);
}
public function exportPDFrole()
{
    $roles = Role::all();

    $pdf = PDF::loadView('pdf.roles-pdf', compact('roles'));
    
    return $pdf->download('roles.pdf');
}

}
