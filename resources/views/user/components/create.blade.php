<x-app-layout>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Order') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if(session('order_message'))
                    <div class="bg-green-600 text-white p-2 mb-4 rounded">
                        {{ session('order_message') }}
                    </div>
                @endif

                <form action="{{ route('user.components.create') }}" method="POST">
                    @csrf
                    
                    <div class="mb-4">
                        <label class="block mb-1">Select Product</label>
                        <select name="product_id" id="productSelect" class="form-control">
                            <option value="" disabled selected>-- Select Product --</option>
                            @foreach($products as $product)
                                <option 
                                    value="{{ $product->id }}"
                                    data-price="{{ $product->product_price }}"
                                >
                                    {{ $product->product_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1">Unit Price</label>
                        <input type="number" id="productPrice" class="form-control" readonly>
                    </div>

                    <div class="mb-3">
    <label>Quantity</label>
    <input 
        type="number" 
        min="1" 
        value="1" 
        name="quantity" 
        id="quantityInput"
        class="form-control"
        required
    >
</div>

<script>
document.getElementById("quantityInput").addEventListener("input", function() {
    if (this.value < 1) {
        this.value = 1;
    }
});
</script>


                    <div class="mb-4">
                        <label class="block mb-1">Total Amount</label>
                        <input type="number" id="totalAmount" class="form-control" readonly>
                    </div>

                    <button type="submit" class="btn btn-primary mt-2">Place Order</button>
            
            </div>
        </div>
    </div>

    {{-- Auto Update Price & Total --}}
    <script>
        public function addToCart(Request $request)
{
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'quantity' => 'required|integer|min:1'
    ]);

    $product = Product::findOrFail($request->product_id);

    // Check if enough stock exists
    if ($product->stock < $request->quantity) {
        return back()->with('error', 'Not enough stock available.');
    }

    // Subtract stock
    $product->stock -= $request->quantity;
    $product->save();

    // Add to cart logic here...
    Cart::add($product->id, $product->product_name, $request->quantity, $product->product_price);

    return redirect()->route('admin.cart.view')->with('success', 'Product added to cart!');
}

        let productSelect = document.getElementById('productSelect');
        let priceInput = document.getElementById('productPrice');
        let qtyInput = document.getElementById('productQty');
        let totalInput = document.getElementById('totalAmount');

        function updateTotal() {
            let price = parseFloat(priceInput.value);
            let qty = parseInt(qtyInput.value);
            totalInput.value = price * qty;
        }

        productSelect.addEventListener('change', function(){
            let price = this.selectedOptions[0].getAttribute('data-price');
            priceInput.value = price;
            updateTotal();
        });

        qtyInput.addEventListener('input', updateTotal);
    </script>

</x-app-layout>
