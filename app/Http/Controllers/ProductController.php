<?php

// app/Http/Controllers/ProductController.php

// app/Http/Controllers/ProductController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory; // Make sure to use your Model

class ProductController extends Controller
{
    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        // 1. Validate the incoming request data
        $request->validate([
            'name' => 'required|max:255',
            'quantity' => 'required',
            'price' => 'required|max:255',
            'total' => 'required',
            
        ]);

        // 2. Create a new product instance and save it
        $product = new Inventory;
        $product->name = $request->name;
        $product->detail = $request->detail;
        $product->save();

        // 3. Redirect the user after successful submission
        return redirect()->back()->with('success', 'Product saved successfully!');
    }
}

