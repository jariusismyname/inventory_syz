<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Category; 
use App\Models\Supplier; 
use App\Models\Products; 
use App\Models\Inventory;
class AdminController extends Controller
{

 public function checkout(Request $request)
    {
        dd($request->all());

        DB::transaction(function () use ($request) {

            foreach ($request->items as $item) {
    $product = Products::lockForUpdate()->find($item['id']);

    if ($product->stock < $item['product_quantity']) {
        throw new \Exception('Not enough stock');
    }

    $product->decrement('stock', $item['product_quantity']);
}

            // save order here if needed
        });

        return redirect()->back()->with('success', 'Checkout completed!');
    }
    
public function destroy($id)
{
    Inventory::findOrFail($id)->delete();
    return redirect()->back()->with('success', 'Item cancelled successfully.');
}


      public function index()
    {
         // 1. Fetch the data
   $userId = Auth::id(); // Get the currently logged-in user's ID
    $inventories = \App\Models\Inventory::where('user_id', $userId)->get();

    return view('user.orders', compact('inventories'));  }
    public function addCategory()
    {
        return view('admin.addcategory');
    }
    public function postAddCategory(Request $request)
    {
        $category = new Category();

        $category->category_name=$request->category_name;
        $category->save();
        return redirect()->back();
    }

    public function viewCategory(){
        $categories= Category::all();
        return view('admin.viewcategory',compact('categories'));
    }

    public function viewInventory(){
        $inventories= Inventory::all();
        return view('admin.viewinventory',compact('inventories'));
    }

    public function deleteCategory($id){
        $category= Category::findOrFail($id);
        $category->delete();
        return redirect()->back();
    }
  
    public function updateCategory($id){
        $category= Category::findOrFail($id);
        return view('admin.updatecategory',compact('category'));
    }

    public function postUpdateCategory(Request $request, $id){
        $category= Category::findOrFail($id);
        $category->category_name=$request->category_name;
        $category->save();
        return redirect('/viewcategory');
    }

    public function addSupplier(){
        return view('admin.addsupplier');
    }

    public function postAddSupplier(Request $request){
        // Logic to handle adding a supplier
        $supplier = new Supplier();
        $supplier->supplier_name = $request->supplier_name;
        $supplier->supplier_contact = $request->supplier_contact;
        $supplier->save();
        return redirect()->back();
    }

    public function viewSupplier(){
        $suppliers= Supplier::all();
        return view('admin.viewsupplier',compact('suppliers'));
    }

    public function deleteSupplier($id){
        $supplier= Supplier::findOrFail($id);
        $supplier->delete();
        return redirect()->back();
    }

    public function updateSupplier($id){
        $supplier= Supplier::findOrFail($id);
        return view('admin.updatesupplier',compact('supplier'));
    }

    public function postUpdateSupplier(Request $request, $id){
        $supplier= Supplier::findOrFail($id);
        $supplier->supplier_name=$request->supplier_name;
        $supplier->supplier_contact=$request->supplier_contact;
        $supplier->save();
        return redirect('/admin.viewsupplier');
    }

    public function addProduct(){
        $categories = Category::all();
        $suppliers = Supplier::all();
        return view('admin.addproduct', compact('categories', 'suppliers'));
    }

    public function postAddProduct(Request $request){
        $product = new Products();
        
        $image=$request->product_image;
        if($image){
            $new_img_name=time().'.'. $image->getClientOriginalExtension();
            $product->product_image=$new_img_name;
        }

        
        $product->product_name=$request->product_name;   
        $product->product_quantity=$request->product_quantity;   
        $product->product_price=$request->product_price; 
      $product->product_code=$request->product_code; 
        $product->category_name=$request->category_name;  
        $product->supplier_name=$request->supplier_name;
        $product->save();

        if($image && $product->save()){
            $request->product_image->move('db_img',$new_img_name);
        }

        return redirect()->back()->with('addproduct_message','Product Added Successfully!');
    }

    public function viewProduct(){
        $products= Products::all();
        return view('admin.viewproduct',compact('products'));
    }

    public function deleteProduct($id){
        $product= Products::findOrFail($id);
        $product->delete();
        return redirect()->back();
    }

    public function updateProduct($id){
        $product= Products::findOrFail($id);
        $categories = Category::all();
        $suppliers = Supplier::all();

        return view('admin.updateproduct',compact('product','categories','suppliers'));
    }

    public function postUpdateProduct(Request $request, $id){
        $product= Products::findOrFail($id);

        $image=$request->product_image;
        if($image){
            $new_img_name=time().'.'. $image->getClientOriginalExtension();
            $product->product_image=$new_img_name;
        }

        $product->product_name=$request->product_name; 
        $product->product_description=$request->product_description;   
        $product->product_quantity=$request->product_quantity;   
        $product->product_price=$request->product_price; 
        $product->category_name=$request->category_name;  
        $product->supplier_name=$request->supplier_name;
        $product->save();

        if($image && $product->save()){
            $request->product_image->move('db_img',$new_img_name);
        }

        return redirect('/admin.viewproduct')->with('updateproduct_message','Product Updated Successfully!');
        
    }

    public function create() {
        $products = Products::all();
        return view('user.components.create', compact('products'));
    }

    public function store(Request $request) 
    {
        $product = Products::findOrFail($request->product_id);

        $total = $product->product_price * $request->quantity;

        Order::create([
            'product_id' => $product->id,
            'quantity' => $request->quantity,
            'total_amount' => $total
        ]);

        return redirect()->back()->with('order_message', 'Order successfully placed!');
    }


      // Show Add to Cart page
    public function addPage() {
        $products = Products::all();
        return view('user.components.add_to_cart', compact('products'));
    }

    // Add item to cart
    public function add(Request $request)
{
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'quantity' => 'required|integer|min:1'
    ]);

    $product = Products::findOrFail($request->product_id);
    $qty = (int)$request->quantity;

    // 1. Check if entered quantity exceeds stock
    if ($qty > $product->product_quantity) {
        return back()->with('cart_message', '❌ Quantity exceeds available stock (' . $product->product_quantity . ')');
    }

    $cart = session()->get('cart', []);

    // 2. If product already in cart → update quantity
    if (isset($cart[$product->id])) {
        $newQty = $cart[$product->id]['quantity'] + $qty;

        // Check combined quantity vs stock
        if ($newQty > $product->product_quantity) {
            return back()->with('cart_message', '❌ Quantity exceeds stock. You already have '
                . $cart[$product->id]['quantity'] . ' in cart.');
        }

        $cart[$product->id]['quantity'] = $newQty;
    } 
    else 
    {
        // Add new product to cart
        $cart[$product->id] = [
            'id'       => $product->id,
            'name'     => $product->product_name,
            'price'    => $product->product_price,
            'quantity' => $qty,
            'stock'    => $product->product_quantity
        ];
    }

    session()->put('cart', $cart);

    return back()->with('cart_message', '✔ Added to cart successfully');
}


    // Show cart
    public function viewCart() {
        $cart = session()->get('cart', []);
        return view('user.components.cart', compact('cart'));
    }


    

//    public function checkout()
// {
//     $cart = session()->get('cart');

//     if(!$cart || count($cart) == 0){
//         return back()->with('checkout_message', '❌ Cart is empty.');
//     }

//     foreach($cart as $item){
//         $product = Products::find($item['id']);

//         // Check again if stock is enough
//         if($item['quantity'] > $product->product_quantity){
//             return back()->with('checkout_message',
//                 '❌ Not enough stock for ' . $product->product_name .
//                 '. Available: ' . $product->product_quantity
//             );
//         }
//     }

//     // IF ALL STOCKS ARE VALID → process order
//     foreach($cart as $item){
//         $product = Products::find($item['id']);

//         // Create order
//         AdminController::create([
//             'product_id'   => $item['id'],
//             'quantity'     => $item['quantity'],
//             'total_amount' => $item['price'] * $item['quantity'],
//         ]);

//         // Deduct stock
//         $product->product_quantity -= $item['quantity'];
//         $product->save();
//     }

//     // Clear cart
//     session()->forget('cart');

//     return redirect()->back()->with('checkout_message', '✔ Order placed & stock updated.');
// }
public function addToCart(Request $request)
{
    // Validate input
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'quantity' => 'required|integer|min:1'
    ]);

    // Fetch the product
    $product = Products::findOrFail($request->product_id);
    $quantity = $request->quantity;

    // Check if enough stock is available
    if ($quantity > $product->stock) {
        return back()->with('cart_message', "Only {$product->stock} items available for {$product->product_name}.");
    }

    // Get the current cart from session
    $cart = session()->get('cart', []);

    // If product already in cart, increase quantity
    if (isset($cart[$product->id])) {
        $newQuantity = $cart[$product->id]['quantity'] + $quantity;

        // Make sure total quantity doesn't exceed stock
        if ($newQuantity > $product->stock) {
            return back()->with('cart_message', "Cannot add {$quantity} more. Only {$product->stock} in stock for {$product->product_name}.");
        }

        $cart[$product->id]['quantity'] = $newQuantity;
    } else {
        // Add new product to cart
        $cart[$product->id] = [
            'id' => $product->id,
            'name' => $product->product_name,
            'price' => $product->product_price,
            'quantity' => $quantity
        ];
    }

    // Update session cart
    session()->put('cart', $cart);

    // Subtract stock in DB
    $product->stock -= $quantity;
    $product->save();

    return redirect()->route('admin.cart.view')->with('cart_message', "{$product->product_name} added to cart!");
}

public function postAddInventory(Request $request)
{
    // Get the logged-in user's ID
    $userId = Auth()->id(); // Or use auth()->id();

    foreach ($request->products as $product) {
        Inventory::create([
            'product_name' => $product['product_name'],
            'quantity'     => $product['quantity'],
            'price'        => $product['price'],
            'user_id'      => $userId, // Add the user ID
        ]);
    }

    session()->forget('cart');

    return redirect()->back()->with('checkout_message', 'Product added to order successfully!');
}

    
            // 'added_by'     => Auth::user()->name, // Or add the name directly if needed

    
}