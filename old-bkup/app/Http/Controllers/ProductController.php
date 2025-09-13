<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function view()
    {
        $products = Product::all();  
        
        return view('products', [
            'products' => $products,  
        ]);
    }

    public function store(Request $request)
    {
      
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|numeric',
            'category' => 'required|string',
            'brand' => 'required|string',
            'gst' => 'required|numeric',
            'taxmethod' => 'required|string',
            'type' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'otherdetails' => 'required|string',
            'price' => 'nullable|numeric',
            'unit_name' => 'nullable|string',
            'unit_sale' => 'nullable|string',
            'unit_purchase' => 'nullable|string',
            'quantity' => 'nullable|numeric',
            'stock_alert' => 'nullable|numeric',
        ]);

       
        
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imagePath = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $imagePath);
            
        }

      
        $product = Product::create([
            'name' => $request->name,
            'code' => $request->code,
            'category' => $request->category,
            'brand' => $request->brand,
            'gst' => $request->gst,
            'taxmethod' => $request->taxmethod,
            'type' => $request->type,
            'image' => $imagePath,
            'otherdetails' => $request->otherdetails,
            'price' => $request->price,
            'unit_name' => $request->unit_name,
            'unit_sale' => $request->unit_sale,
            'unit_purchase' => $request->unit_purchase,
            'quantity' => $request->quantity,
            'stock_alert' => $request->stock_alert,
        ]);

        return redirect()->back()->with('success', 'Product added successfully!');
    }
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        $product->delete();

        return redirect()->back()->with('success', 'Supplier deleted successfully!');
    }
}
