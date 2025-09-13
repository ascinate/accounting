<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use PDF;


class CustomerController extends Controller
{
    // public function view()
    // {
    //     $customers = Customer::select(
    //         'customers.*',
    //         'sales.product_id',
    //         'products.price as product_price'
    //     )
    //     ->leftJoin('sales', 'customers.id', '=', 'sales.customerid')
    //     ->leftJoin('products', 'sales.product_id', '=', 'products.id')
    //     ->get(); 
    //     return view('customers', [
    //         'customers' => $customers,  
    //     ]);
    // }
    // In CustomerController.php
    public function exportExcel()
{
    $customers = Customer::select(
        'customers.*',
        DB::raw('COUNT(sales.id) as total_sales'),
        DB::raw('COALESCE(SUM(saledetails.totalprice), 0) as total_amount'),
        DB::raw('COALESCE(SUM(payments.amount_paid), 0) as total_paid'),
        DB::raw('COALESCE(SUM(saledetails.totalprice), 0) - COALESCE(SUM(payments.amount_paid), 0) as total_debt')
    )
    ->leftJoin('sales', 'customers.id', '=', 'sales.customerid')
    ->leftJoin('saledetails', 'sales.id', '=', 'saledetails.saleid')
    ->leftJoin('payments', 'sales.id', '=', 'payments.saleid')
    ->groupBy('customers.id')
    ->get();

    // Generate CSV content
    $csv = "Name,Email,Phone,City,Address,Total Sales,Total Amount,Total Paid,Total Debt\n"; // Header row
    
    foreach ($customers as $customer) {
        $csv .= '"' . str_replace('"', '""', $customer->name) . '",';
        $csv .= '"' . str_replace('"', '""', $customer->email) . '",';
        $csv .= '"' . str_replace('"', '""', $customer->phone) . '",';
        $csv .= '"' . str_replace('"', '""', $customer->city) . '",';
        $csv .= '"' . str_replace('"', '""', $customer->address) . '",';
        $csv .= '"' . str_replace('"', '""', $customer->total_sales) . '",';
        $csv .= '"' . str_replace('"', '""', $customer->total_amount) . '",';
        $csv .= '"' . str_replace('"', '""', $customer->total_paid) . '",';
        $csv .= '"' . str_replace('"', '""', $customer->total_debt) . '"';
        $csv .= "\n";
    }
    
    // Set headers for download
    $headers = [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => 'attachment; filename="customers.csv"',
    ];
    
    return response()->make($csv, 200, $headers);
}

public function exportPDF()
{
    $customers = Customer::select(
        'customers.*',
        DB::raw('COUNT(sales.id) as total_sales'),
        DB::raw('COALESCE(SUM(saledetails.totalprice), 0) as total_amount'),
        DB::raw('COALESCE(SUM(payments.amount_paid), 0) as total_paid'),
        DB::raw('COALESCE(SUM(saledetails.totalprice), 0) - COALESCE(SUM(payments.amount_paid), 0) as total_debt')
    )
    ->leftJoin('sales', 'customers.id', '=', 'sales.customerid')
    ->leftJoin('saledetails', 'sales.id', '=', 'saledetails.saleid')
    ->leftJoin('payments', 'sales.id', '=', 'payments.saleid')
    ->groupBy('customers.id')
    ->get();

    $pdf = PDF::loadView('pdf.customers-pdf', compact('customers'));
    
    return $pdf->download('customers.pdf');
}

public function view()
{
    $customers = Customer::select(
        'customers.*',
        DB::raw('COUNT(sales.id) as total_sales'),
        DB::raw('COALESCE(SUM(saledetails.totalprice), 0) as total_amount'),
        DB::raw('COALESCE(SUM(payments.amount_paid), 0) as total_paid'),
        DB::raw('COALESCE(SUM(saledetails.totalprice), 0) - COALESCE(SUM(payments.amount_paid), 0) as total_debt')
    )
    ->leftJoin('sales', 'customers.id', '=', 'sales.customerid')
    ->leftJoin('saledetails', 'sales.id', '=', 'saledetails.saleid')
    ->leftJoin('payments', 'sales.id', '=', 'payments.saleid')
    ->groupBy('customers.id')
    ->get();
    

    return view('customers', [
        'customers' => $customers,  
    ]);
}


public function show($id)
{
    $customer = Customer::findOrFail($id);
    
    $salesData = DB::table('sales')
        ->select(
            DB::raw('COUNT(sales.id) as total_sales'),
            DB::raw('COALESCE(SUM(saledetails.totalprice), 0) as total_amount'),
            DB::raw('COALESCE(SUM(payments.amount_paid), 0) as total_paid'),
            DB::raw('COALESCE(SUM(saledetails.totalprice), 0) - COALESCE(SUM(payments.amount_paid), 0) as total_debt')
        )
        ->leftJoin('saledetails', 'sales.id', '=', 'saledetails.saleid')
        ->leftJoin('payments', 'sales.id', '=', 'payments.saleid')
        ->where('sales.customerid', $id)
        ->first();

    return view('customer_detail', [
        'customer' => $customer,
        'salesData' => $salesData
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
            $file->move('uploads', $imagePath);
            $validatedData['image'] = $imagePath; 
        }

   


     Customer::create($validatedData);

        return redirect()->back()->with('success', 'Record added successfully!');
    }

  public function update(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required|exists:customers,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email,' . $request->id,
            'phone' => 'required|numeric',
            'city' => 'required|string|max:255',
            'address' => 'required|string|max:500',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $customer = Customer::findOrFail($request->id);
    
        // If a new image is uploaded, delete the old one
        if ($request->hasFile('image')) {
            // Delete the old image
            if ($customer->image) {
                $oldImagePath = 'uploads/' . $customer->image;
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
    
            // Upload the new image
            $file = $request->file('image');
            $imagePath = time() . '_' . $file->getClientOriginalName();
            $file->move('uploads', $imagePath);
            $validatedData['image'] = $imagePath;
        } else {
            // If no new image is uploaded, keep the old image
            $validatedData['image'] = $customer->image;
        }
    
        // Update the customer record
        $customer->update($validatedData);
    
        return redirect()->back()->with('success', 'Record updated successfully!');
    }
    
    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);

        $customer->delete();

        return redirect()->back()->with('success', 'Customer deleted successfully!');
    }

}
