<x-app-layout>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                        <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">Product Images</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Product Description</th>
                            <th scope="col">Product Quantity</th>
                            <th scope="col">Product Price</th>
                            <th scope="col">Category Name</th>
                            <th scope="col">Supplier Name</th>
                            <th scope="col">Action</th>                        
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                            <tr>
                            <th scope="row"><img style="width:100px;"src="{{asset('db_img/'.$product->product_image)}}" alt="{{$product->product_image}}"></th>
                            <td>{{$product->product_name}}</td>
                            <td>{{$product->product_description}}</td>
                            <td>{{$product->product_quantity}}</td>
                            <td>{{$product->product_price}}</td>
                            <td>{{$product->category_name}}</td>
                            <td>{{$product->supplier_name}}</td>
                            <td><a href="{{route('admin.deleteproduct', $product->id)}}" class="btn btn-danger" href="" onclick="return confirm('Are you sure?')">Delete</a>
                                <a style="margin: 3px;" href="{{route('admin.updateproduct', $product->id)}}" class="btn btn-success">Update</a>
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
