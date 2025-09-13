<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function view()
    {
        $category = Category::all();  
        
        return view('category', [
            'category' => $category,  
        ]);
    }


    public function update(Request $request)
{
    $request->validate([
        'id' => 'required|exists:categories,id',
        'name' => 'required|string|max:255',
        'code' => 'required|numeric',
    ]);

    $category = Category::findOrFail($request->id);
    $category->update([
        'name' => $request->name,
        'code' => $request->code,
    ]);

    return redirect()->back()->with('success', 'Category updated successfully!');
}

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|numeric',
        ]);

    
        Category::create([
            'name' => $request->name,
            'code' => $request->code,
        ]);

        
        return redirect()->back()->with('success', 'Category added successfully!');
    }
    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        $category->delete();

        return redirect()->back()->with('success', 'Category deleted successfully!');
    }
}
