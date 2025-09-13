<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Warehouse;
use App\Models\Customer;
use App\Models\Setting;
use App\Models\Currency;



class SettingController extends Controller
{
    public function settings()
    {
        $warehouses = Warehouse::all(); 
        $customers = Customer::all(); 
        $settings = Setting::all();
    
        return view('settings', [
           'settings' => $settings,
            'customers' => $customers,
            'warehouses' => $warehouses,  
        ]);
       
    }

    public function storeSettings(Request $request)
    {
      
        $validated = $request->validate([
            'currency' => 'required|string',
            'email' => 'required|email',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'company_name' => 'required|string',
            'company_phone' => 'nullable|numeric',
            'pdf_footer' => 'nullable|string',
            'developer' => 'required|string',
            'app_name' => 'required|string',
            'footer' => 'required|string',
            'language' => 'required|string',
            'customer' => 'nullable|exists:customers,id',
            'warehouse' => 'nullable|exists:warehouses,id',
            'company_address' => 'required|string',
        ]);

  

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $imagePath = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $imagePath);
          
        }

      
        Setting::create([
            'currency' => $request->input('currency'),
            'email' => $request->input('email'),
            'logo' => $imagePath,
            'company_name' => $request->input('company_name'),
            'company_phone' => $request->input('company_phone'),
            'pdf_footer' => $request->input('pdf_footer'),
            'developer' => $request->input('developer'),
            'app_name' => $request->input('app_name'),
            'footer' => $request->input('footer'),
            'language' => $request->input('language'),
            'customer_id' => $request->input('customer'),
            'warehouse_id' => $request->input('warehouse'),
            'company_address' => $request->input('company_address'),
        ]);

        return redirect()->back()->with('success', 'Settings saved successfully!');
    }

    public function destroy($id)
    {
        $setting = Setting::findOrFail($id);

        $setting->delete();

        return redirect()->back()->with('success', 'setting deleted successfully!');
    }
    

  

    public function currency()
    {
        $currency = Currency::all();

        return view('currency', [
            'currency' => $currency,
             
         ]);
       
    }
    public function storeCurrency(Request $request)
    {
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|integer',
            'symbol' => 'required|string|max:10',
        ]);

        Currency::create([
            'name' => $validated['name'],
            'code' => $validated['code'],
            'symbol' => $validated['symbol'],
        ]);

      
        return redirect()->back()->with('success', 'Currency added successfully!');
    }
    public function destroyCurrency($id)
    {
        $currency = Currency::findOrFail($id);

        $currency->delete();

        return redirect()->back()->with('success', 'currency deleted successfully!');
    }
    
}
