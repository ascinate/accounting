<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;

class SupplierController extends Controller
{
    public function view()
    {
        $suppliers = Supplier::all();  
        return view('suppliers', [
            'suppliers' => $suppliers,  
        ]);
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:suppliers,email',
            'phone' => 'required|numeric',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'address' => 'required|string|max:500',
            
        ]);

      
        Supplier::create($validatedData);

        return redirect()->back()->with('success', 'Record added successfully!');
    }

    public function destroy($id)
    {
        $supplier = Supplier::findOrFail($id);

        $supplier->delete();

        return redirect()->back()->with('success', 'Supplier deleted successfully!');
    }
}
