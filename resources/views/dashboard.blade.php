<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 ">
                    <p class=" bg-blue-100 text-green-600">You're logged in!</p>
                </div>
                @php
                    $bool=true
                @endphp

                <p>{{$bool}}</p>
                {{--@include('products.alert', ['width' => '2/3','color'=>'red','content'=>'This is dangerous'])--}}

                <x-card title='Card title 1'/>
               <x-card title='Card title 2'/>
               <x-card title='Card title 3'/>
            </div>
        </div>
    </div>
</x-app-layout>
