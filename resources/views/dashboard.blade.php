@inject('countries', 'App\Http\Controllers\CountryController')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div>
        All Countries:
        @foreach($countries->allCountry() as $country)
            <ul>
                <li>{{$country->name}}</li>
                <li>{{$country->created_at->diffForHumans()}}</li>
                <li>@datetime($country->created_at)</li>
            </ul>
        @endforeach
    </div>
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
                <x-alert><h1>rgdfgdg</h1></x-alert>

                <x-include>
                    <p>fgdfgdf</p>
                    <x-include.header></x-include.header>
                </x-include>
                <x-card color="red">
                    <x-slot name="title"  class="text-gray-400">
                        custom title
                    </x-slot>
                    <x-slot name="body" class="font-semibold">
                        <p>dfgdfgfd</p>
                    </x-slot>
                </x-card>


            </div>
        </div>
    </div>
</x-app-layout>
