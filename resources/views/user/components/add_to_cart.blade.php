<x-app-layout>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <x-slot name="header">
        <h2 class="font-semibold text-xl">Add to Cart</h2>
    </x-slot>

    <div class="py-10 max-w-5xl mx-auto">
        <div class="bg-white p-6 shadow rounded">

            @if(session('cart_message'))
                <div class="bg-green-600 text-black p-2 rounded mb-3">
                    {{ session('cart_message') }}
                </div>
            @endif

            <form action="{{ route('admin.cart.add') }}" method="POST">
                @csrf

                {{-- PRODUCT GALLERY --}}
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                    @foreach($products as $product)
                        <div class="border rounded p-2 text-center cursor-pointer hover:bg-gray-100 select-product"
                             data-id="{{ $product->id }}"
                             data-price="{{ $product->product_price }}">
                            
                             

                            <img src="{{ asset('db_img/'.$product->product_image) }}" 
                            alt="{{ $product->product_image }}"     
                            class="h-32 w-full object-cover rounded mx-auto mb-2" style="width:100px;">

                            <p class="font-bold">{{ $product->product_name }}</p>
                            <p class="text-sm text-gray-600">₱{{ $product->product_price }}</p>
                        </div>
                    @endforeach
                </div>

                {{-- HIDDEN SELECT INPUT (still needed for backend) --}}
                <input type="hidden" id="selectedProductInput" name="product_id">

                {{-- QUANTITY --}}
                <div class="mb-3">
                    <label>Quantity</label>
                    <input type="number" min="1" value="1" name="quantity" class="form-control">
                </div>

                <button class="btn btn-primary mt-2">Add to Cart</button>
                <a href="{{ route('admin.cart.view') }}" class="btn btn-secondary mt-2">View Cart</a>
            </form>
        </div>
    </div>

    <script>
        // Click to select product
     document.querySelectorAll('.select-product').forEach(product => {
    product.addEventListener('click', function () {
        // Remove highlight from others
        document.querySelectorAll('.select-product').forEach(p => {
            p.classList.remove('border-blue-500', 'ring-2', 'ring-blue-400');
        });

        // Highlight selected
        this.classList.add('border-blue-500', 'ring-2', 'ring-blue-400');

        // Set hidden input
        document.getElementById('selectedProductInput').value = this.dataset.id;
    });
});

document.querySelector('form').addEventListener('submit', function(e) {
    const selected = document.querySelector('.select-product.border-blue-500');
    const qtyInput = document.querySelector('input[name="quantity"]');

    if (!selected) {
        e.preventDefault();
        alert('Please select a product!');
        return;
    }

    let stock = parseInt(selected.dataset.stock);
    let qty = parseInt(qtyInput.value);

    if (qty > stock) {
        e.preventDefault();
        alert(`Only ${stock} items left in stock!`);
        return;
    }

    // Subtract stock visually
    stock -= qty;
    selected.dataset.stock = stock;
    selected.querySelector('.stock-count').textContent = stock;
});

    </script>

</x-app-layout>
