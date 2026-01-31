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
                     @if(session('addproduct_message'))
                        <div class="bg bg-gray-800" style="color:white;">                       
                                {{session('addproduct_message')}}
                        </div>
                    @endif
                    <form action="{{route('admin.postaddproduct')}}" method ="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputPassword1">Product Image</label>
                        <input type="file" min="0"class="form-control" id="exampleInputPassword1" name="product_image">
                    </div> 

                    <div class="form-group">
                        <label for="exampleInputEmail1">Product Name</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" name="product_name" placeholder="Enter Product Name">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Product Description</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" name="product_description">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword1">Product Quantity</label>
                        <input type="number" min="1" class="form-control" id="exampleInputPassword1" name="product_quantity"  placeholder="Enter Quantity">
                    </div>

                     <div class="form-group">
                        <label for="exampleInputPassword1">Product Price</label>
                        <input type="number" min="0"class="form-control" id="exampleInputPassword1" name="product_price"  placeholder="Enter Price">
                    </div> 
                    <div class="form-group">
                        <label for="exampleInputPassword1">Product Code</label>
                        <input type="number" class="form-control" id="" name="product_code"  placeholder="Enter Code">
                    </div> 

                     <div class="form-group">
                        <label for="exampleInputPassword1">Category</label>
                        <select name="category_name">
                            @foreach($categories as $category)
                            <option>{{$category->category_name}}</option>
                            @endforeach
                        </select>
                    </div>

                     <div class="form-group">
                        <label for="exampleInputPassword1">Suppliers</label>
                        <select name="supplier_name" >
                            @foreach($suppliers as $supplier)
                            <option>{{$supplier->supplier_name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Add Product</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
