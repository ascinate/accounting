<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Warehouse;

class WarehouseController extends Controller
{
    public function view()
    {
   
        $warehouses = Warehouse::all();  
        return view('warehouse', [
            'warehouses' => $warehouses,  
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|numeric',
            'country' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:warehouses,email',
            'zipcode' => 'required|numeric',
        ]);

      
        Warehouse::create($validatedData);

    
        return redirect()->back()->with('success', 'Warehouse added successfully.');
    }
    public function destroy($id)
    {
        $warehouse = Warehouse::findOrFail($id);

        $warehouse->delete();

        return redirect()->back()->with('success', 'Warehouse deleted successfully!');
    }
}
