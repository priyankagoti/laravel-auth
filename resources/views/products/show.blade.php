<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Products') }}
                </h2>
            </div>

            <div>
                <a href="{{route('products.create')}}">
                    <x-button class="ml-4">
                        {{ __('Add product') }}
                    </x-button>
                </a>
            </div>

        </div>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div>
                        <strong class="text-gray-800">Product name</strong> : <span class="font-semibold text-gray-600">  {{$product->name}}</span>
                    </div>
                    <div>
                        <strong class="text-gray-800">Product detail</strong> : <span class="font-semibold text-gray-600">  {{$product->detail}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
