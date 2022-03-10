<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Products') }}
                </h2>
            </div>
        </div>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="mt-4 ml-4">
                    {{$url}}
                    <div>
                        <strong class="text-gray-800">User id</strong> : <span class="font-semibold text-gray-600">  {{$user->id}}</span>
                    </div>
                    <div>
                        <strong class="text-gray-800">User Email</strong> : <span class="font-semibold text-gray-600">  {{$user->email}}</span>
                    </div>
                    <div>
                        <strong class="text-gray-800">User Name</strong> : <span class="font-semibold text-gray-600">  {{$user->name}}</span>
                    </div>
                </div>

                <div class="p-6 bg-white border-b border-gray-200 space-y-1">
                    <div>
                        <img class="w-16 h-16 rounded-md" src="{{ asset('storage/images/'.$product->image) }}" alt="">
                    </div>

                    <div>
                        <strong class="text-gray-800">Product name</strong> : <span class="font-semibold text-gray-600">  {{$product->name}}</span>
                    </div>
                    <div>
                        <strong class="text-gray-800">Product detail</strong> : <span class="font-semibold text-gray-600">  {{$product->detail}}</span>
                    </div>
                    <div>
                        <strong class="text-gray-800">Product price</strong> : <span class="font-semibold text-gray-600">  {{$product->price}} rs</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
