<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\Customer;
use App\Models\Warehouse;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;


class SaleController extends Controller
{
    public function view()
    {
        $sales = \DB::table('sales')
            ->join('customers', 'sales.customerid', '=', 'customers.id')
            ->join('warehouses', 'sales.warehouseid', '=', 'warehouses.id')
            ->join('saledetails', 'sales.id', '=', 'saledetails.saleid')
            ->select(
                'sales.*',
                'customers.name as customer_name',
                'warehouses.name as warehouse_name',
                'saledetails.totalprice as amount' // full sale amount
            )
            ->get();
    
        foreach ($sales as $sale) {
            $paid = \DB::table('payments')
                ->where('saleid', $sale->id)
                ->sum('amount_paid');
    
            $sale->paid_amount = $paid;
            $sale->due_amount = $sale->amount - $paid;
        }
    
        $customers = Customer::all();
        $warehouses = Warehouse::all();
    
        return view('sale', [
            'sales' => $sales,
            'customers' => $customers,
            'warehouses' => $warehouses,
        ]);
    }
    
    

    public function store(Request $request)
    {
       
        $request->validate([
            'date' => 'required|date',
            'category' => 'required|exists:customers,id', 
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
       
        $sale= Sale::create([
            'date' => $request->date,
            'customerid' => $request->category,
            'warehouseid' => $request->brand,
            'product_id' => $request->product_id,
            'tax' => $request->tax,
            'discount' => $request->discount,
            'shipping' => $request->shipping,
            'otherdetails' => $request->otherdetails,
        ]);
        SaleDetail::create([
            'saleid' => $sale->id,
            'productid' => $request->product_id,
            'quantity' => $request->final_quantity,
            'price' => $request->final_price,
            'TotalPrice' => $request->final_totalprice,
        ]);

        
        return redirect()->back()->with('success', 'Sales added successfully!');
    }
    

    public function destroy($id)
    {
        $sale = Sale::findOrFail($id);

        $sale->delete();

        return redirect()->back()->with('success', 'Sale deleted successfully!');
    }

  

    public function downloadPDF($id)
    {
        $sale = \DB::table('sales')
        ->join('products', 'sales.product_id', '=', 'products.id')
        ->join('saledetails', 'sales.id', '=', 'saledetails.saleid')
        ->select(
            'sales.*',
             'products.name as product_name',
            'saledetails.totalprice as amount' // full sale amount
        )
        ->where('sales.id', $id)
        ->first();
    
        // Pass $sale to PDF view
        $pdf = Pdf::loadView('pdf.sale', compact('sale'));
        return $pdf->download('sale_' . $sale->id . '.pdf');
    }
}
