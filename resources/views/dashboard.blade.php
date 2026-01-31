<x-app-layout>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
   <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                 
                   <x-nav-link :href="route('admin.order.add_to_cart')"   :active="request()->routeIs('admin.order.add_to_cart')">
                        {{ __('Click Here to Shop') }}
                    </x-nav-link>
                </div>
            

            </div>
        </div>
    </div>
</x-app-layout>
