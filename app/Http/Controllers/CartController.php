<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    // Show Add to Cart page
    public function addPage() {
        $products = Product::all();
        return view('admin.order.add_to_cart', compact('products'));
    }

    // Add item to cart
    public function add(Request $request) {
        $product = Product::findOrFail($request->product_id);

        $cart = session()->get('cart', []);

        if(isset($cart[$request->product_id])) {
            $cart[$request->product_id]['quantity'] += $request->quantity;
        } else {
            $cart[$request->product_id] = [
                'id' => $product->id,
                'name' => $product->product_name,
                'price' => $product->product_price,
                'quantity' => $request->quantity
            ];
        }

        session()->put('cart', $cart);

        return back()->with('cart_message', 'Item added to cart!');
    }

    // Show cart
    public function viewCart() {
        $cart = session()->get('cart', []);
        return view('admin.order.cart', compact('cart'));
    }

    // Remove item
    public function remove(Request $request) {
        $cart = session()->get('cart');

        if(isset($cart[$request->product_id])) {
            unset($cart[$request->product_id]);
            session()->put('cart', $cart);
        }

        return back();
    }

    // Checkout
    public function checkout() {
        $cart = session()->get('cart');

        if(!$cart || count($cart) == 0){
            return back();
        }

        foreach($cart as $item){
            Order::create([
                'product_id' => $item['id'],
                'quantity' => $item['quantity'],
                'total_amount' => $item['price'] * $item['quantity'],
            ]);
        }

        // Clear cart
        session()->forget('cart');

        return redirect()->back()->with('checkout_message', 'Order placed successfully!');
    }
}

