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
                     @if(session('updateproduct_message'))
                        <div class="bg bg-gray-800" style="color:white;">                       
                                {{session('updateproduct_message')}}
                        </div>
                    @endif
                    <form action="{{route('admin.postupdateproduct',$product->id)}}" method ="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputPassword1">Old Image</label>
                        <img  style="width: 100px;" src="{{asset('db_img/'.$product->product_image)}}" alt="">
                    </div> 


                    <div class="form-group">
                        <label for="exampleInputPassword1">Upload New Image</label>
                        <input type="file" min="0"class="form-control" id="exampleInputPassword1" name="product_image">
                    </div> 

                    <div class="form-group">
                        <label for="exampleInputEmail1">Product Name</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" name="product_name" value="{{$product->product_name}}"  >
                    </div>
                    
                     <div class="form-group">
                        <label for="exampleInputEmail1">Product Description</label>
                        <textarea type="text" class="form-control" id="exampleInputEmail1" name="product_description"  >
                            {{$product->product_description}}
                        </textarea>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword1">Product Quantity</label>
                        <input type="number" min="1" class="form-control" id="exampleInputPassword1" name="product_quantity" value="{{$product->product_quantity}}" >
                    </div>

                     <div class="form-group">
                        <label for="exampleInputPassword1">Product Price</label>
                        <input type="number" min="0"class="form-control" id="exampleInputPassword1" name="product_price"  value="{{$product->product_price}}" >
                    </div> 

                     <div class="form-group">
                        <label for="exampleInputPassword1">Category</label>
                        <select name="category_name">
                             <option value="{{$product->category_name}}">
                                {{$product->category_name}}
                             </option>   
                             @foreach($categories as $category)
                            <option >{{$category->category_name}}</option>
                            @endforeach
                        </select>
                    </div>

                     <div class="form-group">
                        <label for="exampleInputPassword1">Suppliers</label>
                        <select name="supplier_name" > 
                            <option value="{{$product->supplier_name}}">
                                {{$product->supplier_name}}
                             </option>                                              
                            @foreach($suppliers as $supplier)
                            <option>{{$supplier->supplier_name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Update Product</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
