<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{route('admin.postaddcategory')}}" method="POST">
                        @csrf
                        <input type="text" name="category_name" placeholder="Category Name" class="border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 me-4" required>
                        <input style="background-color:green; padding: 8px"type="submit" name="submit" value="Add Category" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
