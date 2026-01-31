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
                    <form action="{{route('admin.postaddsupplier')}}" method ="POST">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Supplier Name</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" name="supplier_name" placeholder="Enter Supplier Name">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Contact Info</label>
                        <input type="text" class="form-control" id="exampleInputPassword1" name="supplier_contact"  placeholder="Enter Supplier Contact Info">
                    </div>
                    <button style="margin: 20px 0;" type="submit" class="btn btn-primary">Add Supplier</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
