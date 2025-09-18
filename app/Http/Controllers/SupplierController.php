<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use Illuminate\Support\Facades\DB;

class SupplierController extends Controller
{

    public function exportExcel()
    {
        $suppliers = Supplier::select(
            'suppliers.*',
            DB::raw('COUNT(purchases.id) as total_purchases'),
            DB::raw('COALESCE(SUM(purchasedetails.totalprice), 0) as total_amount'),
            DB::raw('COALESCE(SUM(payments.amount_paid), 0) as total_paid'),
            DB::raw('COALESCE(SUM(purchasedetails.totalprice), 0) - COALESCE(SUM(payments.amount_paid), 0) as total_debt')
        )
        ->leftJoin('purchases', 'suppliers.id', '=', 'purchases.supplier_id')
        ->leftJoin('purchasedetails', 'purchases.id', '=', 'purchasedetails.purchaseid')
        ->leftJoin('payments', 'purchases.id', '=', 'payments.purchaseid')
        ->groupBy('suppliers.id')
        ->get();

        // Generate CSV content
        $csv = "Name,Email,Phone,City,Country,Address,Total Purchases,Total Amount,Total Paid,Total Debt\n"; // Header row
        
        foreach ($suppliers as $supplier) {
            $csv .= '"' . str_replace('"', '""', $supplier->name) . '",';
            $csv .= '"' . str_replace('"', '""', $supplier->email) . '",';
            $csv .= '"' . str_replace('"', '""', $supplier->phone) . '",';
            $csv .= '"' . str_replace('"', '""', $supplier->city) . '",';
            $csv .= '"' . str_replace('"', '""', $supplier->country) . '",';
            $csv .= '"' . str_replace('"', '""', $supplier->address) . '",';
            $csv .= '"' . str_replace('"', '""', $supplier->total_purchases) . '",';
            $csv .= '"' . str_replace('"', '""', $supplier->total_amount) . '",';
            $csv .= '"' . str_replace('"', '""', $supplier->total_paid) . '",';
            $csv .= '"' . str_replace('"', '""', $supplier->total_debt) . '"';
            $csv .= "\n";
        }
        
        // Set headers for download
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="suppliers.csv"',
        ];
        
        return response()->make($csv, 200, $headers);
    }

public function exportPDF()
{
    $suppliers = Supplier::select(
        'suppliers.*',
        DB::raw('COUNT(purchases.id) as total_purchases'),
        DB::raw('COALESCE(SUM(purchasedetails.totalprice), 0) as total_amount'),
        DB::raw('COALESCE(SUM(payments.amount_paid), 0) as total_paid'),
        DB::raw('COALESCE(SUM(purchasedetails.totalprice), 0) - COALESCE(SUM(payments.amount_paid), 0) as total_debt')
    )
    ->leftJoin('purchases', 'suppliers.id', '=', 'purchases.supplier_id')
    ->leftJoin('purchasedetails', 'purchases.id', '=', 'purchasedetails.purchaseid')
    ->leftJoin('payments', 'purchases.id', '=', 'payments.purchaseid')
    ->groupBy('suppliers.id')
    ->get();

    $pdf = PDF::loadView('pdf.suppliers-pdf', compact('suppliers'));
    
    return $pdf->download('suppliers.pdf');
}
public function view()
{
    $suppliers = Supplier::select(
        'suppliers.id',
        'suppliers.name',
        'suppliers.email',
        'suppliers.phone',
        'suppliers.address',
        DB::raw('COUNT(DISTINCT purchases.id) as total_purchases'),
        DB::raw('COALESCE(SUM(purchase_totals.total_amount), 0) as total_amount'),
        DB::raw('COALESCE(SUM(payments.amount_paid), 0) as total_paid'),
        DB::raw('COALESCE(SUM(purchase_totals.total_amount), 0) - COALESCE(SUM(payments.amount_paid), 0) as total_debt')
    )
    ->leftJoin('purchases', 'suppliers.id', '=', 'purchases.supplier_id')
    // Subquery to calculate each purchase total separately (avoids duplicate sums)
    ->leftJoin(DB::raw('(
        SELECT purchaseid, SUM(totalprice) as total_amount
        FROM purchasedetails
        GROUP BY purchaseid
    ) as purchase_totals'), 'purchases.id', '=', 'purchase_totals.purchaseid')
    ->leftJoin('payments', 'purchases.id', '=', 'payments.purchaseid')
    ->groupBy('suppliers.id', 'suppliers.name', 'suppliers.email', 'suppliers.phone', 'suppliers.address')
    ->get();

    return view('suppliers', [
        'suppliers' => $suppliers,
    ]);
}

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:suppliers,email',
            'phone' => 'required|numeric',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'address' => 'required|string|max:500',
            
        ]);

      
        Supplier::create($validatedData);

        return redirect()->back()->with('success', 'Record added successfully!');
    }


    public function update(Request $request)
{
    $validatedData = $request->validate([
        'id' => 'required|exists:suppliers,id',
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:suppliers,email,' . $request->id,
        'phone' => 'required|numeric',
        'city' => 'required|string|max:255',
        'country' => 'required|string|max:255',
        'address' => 'required|string|max:500',
    ]);

    $supplier = Supplier::find($request->id);
    $supplier->update($validatedData);

    return redirect()->back()->with('success', 'Supplier updated successfully!');
}

    public function destroy($id)
    {
        $supplier = Supplier::findOrFail($id);

        $supplier->delete();

        return redirect()->back()->with('success', 'Supplier deleted successfully!');
    }

    public function show($id)
{
    $supplier = Supplier::findOrFail($id);
    
    $purchaseData = DB::table('purchases')
        ->select(
            DB::raw('COUNT(purchases.id) as total_purchases'),
            DB::raw('COALESCE(SUM(purchasedetails.totalprice), 0) as total_amount'),
            DB::raw('COALESCE(SUM(payments.amount_paid), 0) as total_paid'),
            DB::raw('COALESCE(SUM(purchasedetails.totalprice), 0) - COALESCE(SUM(payments.amount_paid), 0) as total_debt')
        )
        ->leftJoin('purchasedetails', 'purchases.id', '=', 'purchasedetails.purchaseid')
        ->leftJoin('payments', 'purchases.id', '=', 'payments.purchaseid')
        ->where('purchases.supplier_id', $id)
        ->first();

    return view('supplier_detail', [
        'supplier' => $supplier,
        'purchaseData' => $purchaseData
    ]);
}
}
