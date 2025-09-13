<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\Warehouse;
use App\Models\PurchaseDetail;
use App\Models\Product; 
use Illuminate\Support\Facades\DB; // Add this line
use Barryvdh\DomPDF\Facade\Pdf;

class PurchaseController extends Controller
{
    public function view()
    {
        $purchases = \DB::table('purchases')
                ->join('suppliers', 'purchases.supplier_id', '=', 'suppliers.id')
                ->join('warehouses', 'purchases.warehouse_id', '=', 'warehouses.id')
                ->join('purchasedetails', 'purchases.id', '=', 'purchasedetails.purchaseid')
                ->select(
                    'purchases.*',
                    'suppliers.name as supplier_name',
                    'warehouses.name as warehouse_name',
                    'purchasedetails.totalprice as amount' // full sale amount
                )
                ->get();

                foreach ($purchases as $purchase) {
                    $paid = \DB::table('payments')
                        ->where('purchaseid', $purchase->id)
                        ->sum('amount_paid');
            
                    $purchase->paid_amount = $paid;
                    $purchase->due_amount = $purchase->amount - $paid;
                }
            
        $suppliers = Supplier::all(); 
        $warehouses = Warehouse::all(); 
        return view('purchase', [
            'purchases' => $purchases, 
            'suppliers' => $suppliers,
            'warehouses' => $warehouses, 
        ]);
    }





    public function store(Request $request)
    {
       
        $request->validate([
            'date' => 'required|date',
            'category' => 'required|exists:suppliers,id', 
            'brand' => 'required|exists:warehouses,id', 
            'tax' => 'required|numeric',
            'discount' => 'required|numeric',
            'shipping' => 'required|numeric',
            'otherdetails' => 'required|string',
            'product_id' => 'required|exists:products,id',
            'final_quantity' => 'required|numeric|min:1',
            'final_price' => 'required|numeric|min:0',
            'final_totalprice' => 'required|numeric|min:0',
        ]);

      

       
        $purchase= Purchase::create([
            'date' => $request->date,
            'supplier_id' => $request->category,
            'warehouse_id' => $request->brand,
            'product_id' => $request->product_id,
            'tax' => $request->tax,
            'discount' => $request->discount,
            'shipping' => $request->shipping,
            'other_details' => $request->otherdetails,
        ]);
        PurchaseDetail::create([
            'purchaseid' => $purchase->id,
            'productid' => $request->product_id,
            'quantity' => $request->final_quantity,
            'price' => $request->final_price,
            'totalprice' => $request->final_totalprice,
        ]);


        
        return redirect()->back()->with('success', 'Purchase added successfully!');
    }

    public function destroy($id)
    {
        $purchase = Purchase::findOrFail($id);

        $purchase->delete();

        return redirect()->back()->with('success', 'Purchase deleted successfully!');
    }

    public function edit($id)
    {
        // Get the purchase with raw joins instead of relationships
        $purchase = Purchase::select('purchases.*')
            ->join('suppliers', 'purchases.supplier_id', '=', 'suppliers.id')
            ->join('warehouses', 'purchases.warehouse_id', '=', 'warehouses.id')
            ->with(['purchaseDetails' => function($query) {
                $query->join('products', 'purchasedetails.productid', '=', 'products.id')
                      ->select('purchasedetails.*', 'products.name as product_name');
            }])
            ->findOrFail($id);
    
        // Get all suppliers and warehouses for dropdowns
        $suppliers = Supplier::all();
        $warehouses = Warehouse::all();
        $products = Product::all(); // For adding new products if needed
    
        return view('edit-purchase', [
            'purchase' => $purchase,
            'suppliers' => $suppliers,
            'warehouses' => $warehouses,
            'products' => $products
        ]);
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'date' => 'required|date',
            'supplier_id' => 'required|exists:suppliers,id',
            'warehouse_id' => 'required|exists:warehouses,id',
            'tax' => 'nullable|numeric',
            'discount' => 'nullable|numeric',
            'shipping' => 'nullable|numeric',
            'other_details' => 'nullable|string',
            'products' => 'required|array',
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|numeric|min:1',
            'products.*.price' => 'required|numeric|min:0',
        ]);
    
        DB::beginTransaction();
    
        try {
            $purchase = Purchase::findOrFail($id);
            
            $purchase->update([
                'date' => $request->date,
                'supplier_id' => $request->supplier_id,
                'warehouse_id' => $request->warehouse_id,
                'tax' => $request->tax ?? 0,
                'discount' => $request->discount ?? 0,
                'shipping' => $request->shipping ?? 0,
                'other_details' => $request->other_details,
            ]);
    
            // Sync purchase details
            $purchaseDetails = [];
            foreach ($request->products as $product) {
                $purchaseDetails[] = [
                    'productid' => $product['id'],
                    'quantity' => $product['quantity'],
                    'price' => $product['price'],
                    'totalprice' => $product['quantity'] * $product['price'],
                ];
            }
    
            $purchase->purchaseDetails()->delete();
            $purchase->purchaseDetails()->createMany($purchaseDetails);
    
            DB::commit();
    
            return redirect()->route('purchases')->with('success', 'Purchase updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error updating purchase: ' . $e->getMessage());
        }
    }
     public function downloadPDF($id)
    {
        $purchase = \DB::table('purchases')
            ->join('purchasedetails', 'purchases.id', '=', 'purchasedetails.purchaseid')
            ->join('products', 'purchasedetails.productid', '=', 'products.id')
            ->select(
                'purchases.*',
                'purchasedetails.quantity',
                'purchasedetails.price',
                'purchasedetails.totalprice as amount',
                'products.name as product_name'
            )
            ->where('purchases.id', $id)
            ->first();
    
        if (!$purchase) {
            abort(404, 'Purchase not found.');
        }
    
        $pdf = Pdf::loadView('pdf.purchase', compact('purchase'));
        return $pdf->download('purchase_' . $purchase->id . '.pdf');
    }
}
