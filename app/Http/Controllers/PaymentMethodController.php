<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use App\Models\Payment;
use App\Models\Sale;
use App\Models\Purchase;




class PaymentMethodController extends Controller
{
    public function view()
    {
        $paymentmethods = PaymentMethod::all();  
        
        return view('paymentmethods', [
            'paymentmethods' => $paymentmethods,  
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
           
        ]);

        PaymentMethod::create($validated);

        return redirect()->back()->with('success', 'Payment method added successfully!');
    }
    public function destroy($id)
    {
        $paymentMethod = PaymentMethod::findOrFail($id);

        $paymentMethod->delete();

        return redirect()->back()->with('success', 'Payment method deleted successfully!');
    }

    public function update(Request $request)
{
    // Validate the incoming request data
    $validated = $request->validate([
        'paymentmethod_id' => 'required|exists:payment_methods,id',  // Make sure the ID exists
        'name' => 'required|string|max:255',
    ]);

    // Find the payment method by ID
    $paymentMethod = PaymentMethod::findOrFail($request->paymentmethod_id);

    // Update the payment method name
    $paymentMethod->name = $request->name;
    $paymentMethod->save();

    // Redirect back with a success message
    return redirect()->back()->with('success', 'Payment method updated successfully!');
}


    public function createPayment(Request $request)
    
    {
      
        $payAmount = floatval($request->pay_amount);
    
        if ($request->filled('saleid')) {
            $saleId = $request->saleid;
    
            // Save payment with saleid
            Payment::create([
                'saleid' => $saleId,
                'amount_paid' => $payAmount,
            ]);
    
            $sale = Sale::with(['saledetails', 'payments'])->findOrFail($saleId);
    
            $totalAmount = $sale->saledetails->sum('totalprice');
            $paidAmount = $sale->payments->sum('amount_paid');
    
            $status = $paidAmount == 0 ? 'due' : ($paidAmount < $totalAmount ? 'partial' : 'paid');
    
            $sale->status = $status;
            $sale->save();
        } elseif ($request->filled('purchaseid')) {
            $purchaseId = $request->purchaseid;
    
            // Save payment with purchase_id
            Payment::create([
                'purchaseid' => $purchaseId,
                'amount_paid' => $payAmount,
            ]);
    
            $purchase = Purchase::with(['purchaseDetails', 'payments'])->findOrFail($purchaseId);
    
            $totalAmount = $purchase->purchasedetails->sum('totalprice');
            $paidAmount = $purchase->payments->sum('amount_paid');
    
            $status = $paidAmount == 0 ? 'due' : ($paidAmount < $totalAmount ? 'partial' : 'paid');
    
            $purchase->status = $status;
            $purchase->save();
        }
    
        return redirect()->back()->with('success', 'Payment recorded successfully.');
    }
    
}
