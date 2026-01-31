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
                            <th scope="col">Supplier Name</th>
                            <th scope="col">Supplier Contact</th>
                            <th scope="col">Action</th>                        
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($suppliers as $supplier)
                            <tr>
                            <th scope="row">{{$supplier->supplier_name}}</th>
                            <td>{{$supplier->supplier_contact}}</td>
                            <td><a href="{{route('admin.deletesupplier',$supplier->id)}}" class="btn btn-danger" href="" onclick="return confirm('Are you sure?')">Delete</a>
                                <a href="{{route('admin.updatesupplier',$supplier->id)}}" class="btn btn-success">Update</a>
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
