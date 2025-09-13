<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transfer;
use App\Models\Warehouse;
use App\Models\Customer;
use App\Models\Quotation;




class TransferController extends Controller
{
    public function view()
    {
        $transfers = \DB::table('transfers')
        ->join('warehouses as from_wh', 'transfers.from_warehouse', '=', 'from_wh.id')
        ->join('warehouses as to_wh', 'transfers.to_warehouse', '=', 'to_wh.id')
        ->select(
            'transfers.*',
            'from_wh.name as from_warehouse_name',
            'to_wh.name as to_warehouse_name'
        )
        ->get();  
        $warehouses = Warehouse::all();  
        
        return view('transfer', [
            'transfers' => $transfers,
            'warehouses' => $warehouses,  
        ]);
       
    }

    public function store(Request $request)
    {
       
        $request->validate([
            'date' => 'required|date',
            'from_warehouse' => 'required|exists:warehouses,id',
            'to_warehouse' => 'required|exists:warehouses,id|different:from_warehouse',
            'tax' => 'required|numeric|min:0',
            'discount' => 'required|numeric|min:0',
            'shipping' => 'required|numeric|min:0',
            'otherdetails' => 'required|string',
        ]);

       
        Transfer::create([
            'date' => $request->date,
            'from_warehouse' => $request->from_warehouse,
            'to_warehouse' => $request->to_warehouse,
            'tax' => $request->tax,
            'discount' => $request->discount,
            'shipping' => $request->shipping,
            'otherdetails' => $request->otherdetails,
        ]);

     
        return redirect()->back()->with('success', 'Transfer added successfully!');
    }
    public function destroy($id)
    {
        $transfer = Transfer::findOrFail($id);

        $transfer->delete();

        return redirect()->back()->with('success', 'transfer deleted successfully!');
    }

    public function quotationview()
    {
        $quotations = \DB::table('quotations')
                    ->join('customers', 'quotations.customer_id', '=', 'customers.id')
                    ->join('warehouses', 'quotations.warehouse_id', '=', 'warehouses.id')
                    ->select('quotations.*', 'customers.name as customer_name', 'warehouses.name as warehouse_name')
                    ->get();  
        $warehouses = Warehouse::all(); 
        $customers = Customer::all();    
        
        return view('quotations', [
            'quotations' => $quotations,
            'customers' => $customers,
            'warehouses' => $warehouses,  
        ]);
       
    }
    
    public function addquotations(Request $request)
    {
       
        $request->validate([
            'date' => 'required|date',
            'customer' => 'required|exists:customers,id', 
            'warehouse' => 'required|exists:warehouses,id', 
            'tax' => 'required|numeric',
            'discount' => 'required|numeric',
            'shipping' => 'required|numeric',
            'otherdetails' => 'required|string',
        ]);

      

       
        Quotation::create([
            'date' => $request->date,
            'customer_id' => $request->customer,
            'warehouse_id' => $request->warehouse,
            'tax' => $request->tax,
            'discount' => $request->discount,
            'shipping' => $request->shipping,
            'otherdetails' => $request->otherdetails,
        ]);

        
        return redirect()->back()->with('success', 'Purchase added successfully!');
    }

    public function quodestroy($id)
    {
        $quotation = Quotation::findOrFail($id);

        $quotation->delete();

        return redirect()->back()->with('success', 'Quotation deleted successfully!');
    }


}
