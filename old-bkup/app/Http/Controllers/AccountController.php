<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Category;
use App\Models\Deposit;
use App\Models\Expense;



class AccountController extends Controller
{
    public function view()
    {
        $accounts = Account::all();  
        
        return view('account', [
            'accounts' => $accounts,  
        ]);
       
    }
    public function store(Request $request)
    {
       
        $request->validate([
            'name' => 'required|string|max:255',
            'number' => 'required|numeric|unique:accounts,number',
            'amount' => 'required|numeric|min:0',
            'otherdetails' => 'nullable|string',
        ]);

     
        Account::create([
            'name' => $request->input('name'),
            'number' => $request->input('number'),
            'balance' => $request->input('amount'), 
            'otherdetails' => $request->input('otherdetails'),
        ]);

   
        return redirect()->back()->with('success', 'Account added successfully!');
    }

  

    public function deposits()
    {
        $deposits = \DB::table('deposits')
                    ->join('accounts', 'deposits.account_id', '=', 'accounts.id')
                    ->join('categories', 'deposits.category_id', '=', 'categories.id')
                    ->select('deposits.*', 'accounts.name as account_name', 'categories.name as category_name')
                    ->get();
        $accounts = Account::all();  
        $category = Category::all(); 
        
        return view('deposits', [
            'deposits' => $deposits,
            'accounts' => $accounts, 
            'category' => $category,  
        ]);
       
    }

    public function adddeposit(Request $request)
    {
        
        $request->validate([
            'account' => 'required|exists:accounts,id',
            'category' => 'required|exists:categories,id',
            'deposit_ref' => 'required|string|max:255',
            'date' => 'required|date',
            'amount' => 'required|numeric|min:0',
            'paymentmethod' => 'required|in:Check,Credit Card,Paypal,Bank Transfer',
            'attachment' => 'required|file|mimes:jpeg,png,pdf|max:2048', 
            'otherdetails' => 'required|string',
        ]);

       
        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $imagePath = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $imagePath);
            
        }

   
        Deposit::create([
            'account_id' => $request->input('account'),
            'category_id' => $request->input('category'),
            'deposit_ref' => $request->input('deposit_ref'),
            'date' => $request->input('date'),
            'amount' => $request->input('amount'),
            'payment_method' => $request->input('paymentmethod'),
            'attachment' => $imagePath,
            'otherdetails' => $request->input('otherdetails'),
        ]);

   
        return redirect()->back()->with('success', 'Deposit added successfully!');
    }

    public function expenses()
    {
        $expenses = \DB::table('expenses')
                    ->join('accounts', 'expenses.account_id', '=', 'accounts.id')
                    ->join('categories', 'expenses.category_id', '=', 'categories.id')
                    ->select('expenses.*', 'accounts.name as account_name', 'categories.name as category_name')
                    ->get();
        $accounts = Account::all();  
        $category = Category::all(); 
        
        return view('expenses', [
            'expenses' => $expenses,
            'accounts' => $accounts, 
            'category' => $category,  
        ]);
       
    }

    public function addexpense(Request $request)
    {
        
        $request->validate([
            'account' => 'required|exists:accounts,id',
            'category' => 'required|exists:categories,id',
            'expense_ref' => 'required|string|max:255',
            'date' => 'required|date',
            'amount' => 'required|numeric|min:0',
            'paymentmethod' => 'required|in:Check,Credit Card,Paypal,Bank Transfer',
            'attachment' => 'required|file|mimes:jpeg,png,pdf|max:2048', 
            'otherdetails' => 'required|string',
        ]);

       
        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $imagePath = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $imagePath);
            
        }

   
        Expense::create([
            'account_id' => $request->input('account'),
            'category_id' => $request->input('category'),
            'expense_ref' => $request->input('expense_ref'),
            'date' => $request->input('date'),
            'amount' => $request->input('amount'),
            'payment_method' => $request->input('paymentmethod'),
            'attachment' => $imagePath,
            'otherdetails' => $request->input('otherdetails'),
        ]);

   
        return redirect()->back()->with('success', 'Expense added successfully!');
    }
    public function accdestroy($id)
    {
        $account = Account::findOrFail($id);

        $account->delete();

        return redirect()->back()->with('success', 'account deleted successfully!');
    }

    public function depodestroy($id)
    {
        $deposit = Deposit::findOrFail($id);

        $deposit->delete();

        return redirect()->back()->with('success', 'Deposit deleted successfully!');
    }
    
    public function exdestroy($id)
    {
        $expense = Expense::findOrFail($id);

        $expense->delete();

        return redirect()->back()->with('success', 'Expense deleted successfully!');
    }


}
