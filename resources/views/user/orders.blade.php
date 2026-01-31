
<x-app-layout>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Your  Orders') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                        <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">Product</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Price</th>
                            <th scope="col">Total</th>
                            <th scope="col">Action</th>

                           </th>
                            </tr>
                        </thead>
                        <tbody>
                                                @foreach($inventories as $inventory)
                                        <tr>
                        <td>{{ $inventory->product_name }}</td>
                        <td>{{ $inventory->quantity }}</td>
                        <td>${{ number_format($inventory->price, 2) }}</td>
                        <td>${{ number_format($inventory->price * $inventory->quantity, 2) }}</td>
                        <td>
                            <form action="{{ route('inventory.destroy', $inventory->id) }}" method="POST" 
                                onsubmit="return confirm('Are you sure you want to cancel this item?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    Cancel Order
                                </button>
                            </form>
                        </td>
                    </tr>

                            @endforeach
                        </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
