<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
        public function Dashboard()
        {
            $role = Auth::user()->role;

            if($role == '1'){
                return view('admin.dashboard');
            }

           if ($role == '0') {
    return redirect()->route('admin.order.add_to_cart');
}

            else{
                return view('dashboard');
            } 
        }

         public function checkout()
{
    $cart = session()->get('cart');

    if(!$cart || count($cart) == 0){
        return back()->with('checkout_message', '❌ Cart is empty.');
    }

    foreach($cart as $item){
        $product = Products::find($item['id']);

        // Check again if stock is enough
        if($item['quantity'] > $product->product_quantity){
            return back()->with('checkout_message',
                '❌ Not enough stock for ' . $product->product_name .
                '. Available: ' . $product->product_quantity
            );
        }
    }

    // IF ALL STOCKS ARE VALID → process order
    foreach($cart as $item){
        $product = Products::find($item['id']);

        // Create order
        AdminController::create([
            'product_id'   => $item['id'],
            'quantity'     => $item['quantity'],
            'total_amount' => $item['price'] * $item['quantity'],
        ]);

        // Deduct stock
        $product->product_quantity -= $item['quantity'];
        $product->save();
    }

    // Clear cart
    session()->forget('cart');

    return redirect()->back()->with('checkout_message', '✔ Order placed & stock updated.');
}
}
