<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class ProductController extends Controller
{

    public function exportExcel()
{
    $products = Product::all();

    // Generate CSV content
    $csv = "Name,Code,Category,Brand,GST,Tax Method,Type,Price,Unit Name,Unit Sale,Unit Purchase,Quantity,Stock Alert,Other Details\n";
    
    foreach ($products as $product) {
        $csv .= '"' . str_replace('"', '""', $product->name) . '",';
        $csv .= '"' . str_replace('"', '""', $product->code) . '",';
        $csv .= '"' . str_replace('"', '""', $product->category) . '",';
        $csv .= '"' . str_replace('"', '""', $product->brand) . '",';
        $csv .= '"' . str_replace('"', '""', $product->gst) . '",';
        $csv .= '"' . str_replace('"', '""', $product->taxmethod) . '",';
        $csv .= '"' . str_replace('"', '""', $product->type) . '",';
        $csv .= '"' . str_replace('"', '""', $product->price) . '",';
        $csv .= '"' . str_replace('"', '""', $product->unit_name) . '",';
        $csv .= '"' . str_replace('"', '""', $product->unit_sale) . '",';
        $csv .= '"' . str_replace('"', '""', $product->unit_purchase) . '",';
        $csv .= '"' . str_replace('"', '""', $product->quantity) . '",';
        $csv .= '"' . str_replace('"', '""', $product->stock_alert) . '",';
        $csv .= '"' . str_replace('"', '""', $product->otherdetails) . '"';
        $csv .= "\n";
    }
    
    // Set headers for download
    $headers = [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => 'attachment; filename="products.csv"',
    ];
    
    return response()->make($csv, 200, $headers);
}

public function exportPDF()
{
    $products = Product::all();

    $pdf = PDF::loadView('pdf.products-pdf', compact('products'));
    
    return $pdf->download('products.pdf');
}
public function view()
{
    $products = Product::all();  
    $categories = Category::all(); // Get all categories
    
    return view('products', [
        'products' => $products,
        'categories' => $categories, // Pass categories to view
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
            $file->move('uploads', $imagePath);
            
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

  public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:products,id',
            'name' => 'required|string|max:255',
            'code' => 'required|numeric',
            'category' => 'required|string',
            'brand' => 'required|string',
            'gst' => 'required|numeric',
            'taxmethod' => 'required|string',
            'type' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'otherdetails' => 'required|string',
            'price' => 'nullable|numeric',
            'unit_name' => 'nullable|string',
            'unit_sale' => 'nullable|string',
            'unit_purchase' => 'nullable|string',
            'quantity' => 'nullable|numeric',
            'stock_alert' => 'nullable|numeric',
        ]);
    
        $product = Product::findOrFail($request->id);
    
        // Handle image upload if present
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imagePath = time() . '_' . $file->getClientOriginalName();
            $file->move('uploads', $imagePath);
            $product->image = $imagePath;
        }
    
        // Fill and save the rest of the fields
        $product->fill([
            'name' => $request->name,
            'code' => $request->code,
            'category' => $request->category,
            'brand' => $request->brand,
            'gst' => $request->gst,
            'taxmethod' => $request->taxmethod,
            'type' => $request->type,
            'otherdetails' => $request->otherdetails,
            'price' => $request->price,
            'unit_name' => $request->unit_name,
            'unit_sale' => $request->unit_sale,
            'unit_purchase' => $request->unit_purchase,
            'quantity' => $request->quantity,
            'stock_alert' => $request->stock_alert,
        ]);
    
        $product->save();
    
        return redirect()->back()->with('success', 'Product updated successfully!');
    }
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        $product->delete();

        return redirect()->back()->with('success', 'Supplier deleted successfully!');
    }
}
