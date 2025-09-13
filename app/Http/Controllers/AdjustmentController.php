<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Adjustment;
use App\Models\Warehouse;
use App\Models\Product;

class AdjustmentController extends Controller
{
    public function view()
    {
      
        $warehouses = Warehouse::all();
        $adjustment = Adjustment::all();
       
        return view('adjustment', [
            'warehouses' => $warehouses,
            'adjustment' => $adjustment,
        ]);
    }

    public function search(Request $request)
    {
        $search = $request->query('query');

        $products = Product::where('code', 'LIKE', "%{$search}%")
            ->orWhere('name', 'LIKE', "%{$search}%")
            ->limit(5)
            ->get();
       
        return response()->json($products);
    }

    public function store(Request $request)
    {
       
        $request->validate([
            'warehouse' => 'required|exists:warehouses,id',
            'quantity' => 'required|numeric|min:1',
            'details' => 'required|string',
             'product_id' => 'required|exists:products,id',
           
        ]);

        $warehouse = Warehouse::findOrFail($request->warehouse);
     
       
      

     
        $ref_id = 'WW-' . strtoupper(substr(uniqid(), -5));

       
        $dbquery = Adjustment::create([
            'date' => now(),
            'ref_id' => $ref_id,
            'warehouse_id' => $warehouse->name,
            'product_id' => $request->product_id,
            'total_products' => $request->quantity,
            'details' => $request->details,
           
            
           
        ]);

        //dd($dbquery);

        
        return redirect()->back()->with('success', 'Adjustment added successfully!');
    }



    // Update Method
    public function update(Request $request, $id)
    {
        $request->validate([
            'warehouse' => 'required|exists:warehouses,id',
            'quantity' => 'required|numeric|min:1',
            'details' => 'required|string',
        ]);

        $warehouse = Warehouse::findOrFail($request->warehouse);
    
        $adjustment = Adjustment::findOrFail($id);
        $adjustment->warehouse_id = $warehouse->name;
        $adjustment->total_products = $request->quantity;
        $adjustment->details = $request->details;
        $adjustment->save();
    
        return redirect()->back()->with('success', 'Adjustment updated successfully!');
    }
    

    public function destroy($id)
    {
        $adjustment = Adjustment::findOrFail($id);
        $adjustment->delete();

        return redirect()->back()->with('success', 'Adjustment deleted successfully!');
    }

}

