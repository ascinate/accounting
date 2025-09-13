<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function view()
    {
        $customers = Customer::select(
            'customers.*',
            'sales.product_id',
            'products.price as product_price'
        )
        ->leftJoin('sales', 'customers.id', '=', 'sales.customerid')
        ->leftJoin('products', 'sales.product_id', '=', 'products.id')
        ->get(); 
        return view('customers', [
            'customers' => $customers,  
        ]);
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email',
            'phone' => 'required|numeric',
            'city' => 'required|string|max:255',
            'address' => 'required|string|max:500',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

    
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imagePath = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $imagePath);
            $validatedData['image'] = $imagePath; 
        }

   


     Customer::create($validatedData);

        return redirect()->back()->with('success', 'Record added successfully!');
    }
    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);

        $customer->delete();

        return redirect()->back()->with('success', 'Customer deleted successfully!');
    }

}
