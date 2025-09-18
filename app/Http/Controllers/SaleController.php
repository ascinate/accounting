<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;

use App\Models\Sale;

use App\Models\SaleDetail;

use App\Models\Customer;

use App\Models\Warehouse;

use App\Models\Product;

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

    public function edit($id)
{
    // Get the sale with raw joins instead of relationships
    $sale = Sale::select('sales.*')
        ->join('customers', 'sales.customerid', '=', 'customers.id')
        ->join('warehouses', 'sales.warehouseid', '=', 'warehouses.id')
        ->with(['saledetails' => function($query) {
            $query->join('products', 'saledetails.productid', '=', 'products.id')
                  ->select('saledetails.*', 'products.name as product_name');
        }])
        ->findOrFail($id);

    // Get all customers and warehouses for dropdowns
    $customers = Customer::all();
    $warehouses = Warehouse::all();
    $products = Product::all(); // For adding new products if needed

    return view('edit-sale', [
        'sale' => $sale,
        'customers' => $customers,
        'warehouses' => $warehouses,
        'products' => $products
    ]);
}

public function update(Request $request, $id)
{
    $request->validate([
        'date' => 'required|date',
        'customerid' => 'required|exists:customers,id',
        'warehouseid' => 'required|exists:warehouses,id',
        'tax' => 'nullable|numeric',
        'discount' => 'nullable|numeric',
        'shipping' => 'nullable|numeric',
        'otherdetails' => 'nullable|string',
        'products' => 'required|array',
        'products.*.id' => 'required|exists:products,id',
        'products.*.quantity' => 'required|numeric|min:1',
        'products.*.price' => 'required|numeric|min:0',
    ]);

    DB::beginTransaction();

    try {
        $sale = Sale::findOrFail($id);
        
        $sale->update([
            'date' => $request->date,
            'customerid' => $request->customerid,
            'warehouseid' => $request->warehouseid,
            'tax' => $request->tax ?? 0,
            'discount' => $request->discount ?? 0,
            'shipping' => $request->shipping ?? 0,
            'otherdetails' => $request->otherdetails,
        ]);

        // Sync sale details
        $saleDetails = [];
        foreach ($request->products as $product) {
            $saleDetails[] = [
                'productid' => $product['id'],
                'quantity' => $product['quantity'],
                'price' => $product['price'],
                'TotalPrice' => $product['quantity'] * $product['price'],
            ];
        }

        $sale->saledetails()->delete();
        $sale->saledetails()->createMany($saleDetails);

        DB::commit();

        return redirect()->route('sales')->with('success', 'Sale updated successfully!');
    } catch (\Exception $e) {
        DB::rollBack();
        return back()->with('error', 'Error updating sale: ' . $e->getMessage());
    }
}

}

