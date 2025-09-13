<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\Warehouse;
use App\Models\PurchaseDetail;



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

}
