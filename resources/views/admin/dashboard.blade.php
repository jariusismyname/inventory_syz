<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class=" justify-between h-16">
            <div class="">
               

                <div class="dropdown">
                    <ul class="dropdown-menu">
                        
                    </ul>
                </div>





                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex mar" style="margin:  20px 0px;">
                                        <!-- category -->
                <div class="hidden sm:flex sm:items-center sm:ms-0">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>Category</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                    <x-nav-link :href="route('admin.addcategory')" :active="request()->routeIs('admin.addcategory')">
                        {{ __('Add Category') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin.viewcategory')" :active="request()->routeIs('admin.viewcategory')">
                        {{ __('View Category') }}
                    </x-nav-link>
                       
                    </x-slot>
                </x-dropdown>
            </div>


            <!-- supplier -->
                <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>Supplier</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                    <x-nav-link :href="route('admin.addsupplier')" :active="request()->routeIs('admin.addsupplier')">
                        {{ __('Add Supplier') }}
                    </x-nav-link>
                    <br>
                    <x-nav-link :href="route('admin.viewsupplier')" :active="request()->routeIs('admin.viewsupplier')">
                        {{ __('View Supplier') }}
                    </x-nav-link>
                       
                    </x-slot>
                </x-dropdown>
            </div>


            <!-- product -->
                <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="center" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>Product</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>
                    
                    <x-slot name="content">
                    <x-nav-link :href="route('admin.addproduct')" :active="request()->routeIs('admin.addproduct')" >
                        {{ __('Add Product') }}
                    </x-nav-link>
                    <br>
                    <x-nav-link :href="route('admin.viewproduct')" :active="request()->routeIs('admin.viewproduct')">
                        {{ __('View Products') }}
                    </x-nav-link>
                       
                    </x-slot>
                    
                </x-dropdown>

             </div>
             <x-nav-link :href="route('admin.viewinventory')" :active="request()->routeIs('admin.viewinventory')">
             <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">Inventory</button>
             </x-nav-link>
   </div>

    

                    <!DOCTYPE html>
                    <html lang="en">
                    
                    <head>
                        <link href="/dashboard.css" media="all" rel="stylesheet">  
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <title>InventoryManagementSystem</title>
                    </head>
                    <body>
                        
                        <h1>Hello, {{ auth()->user()->name }}.  You are logged in as an admin. You have an authority to add Category. add Supplier, and add product. You are also authorized to let you view, update, and also to delete the products. You can also view the inventory and see the entire total of profit and the total amount of orders and many more!</h1>
                      
                    </body>
                    </html>
 
</x-app-layout>


