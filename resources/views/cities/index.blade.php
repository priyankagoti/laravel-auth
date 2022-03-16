<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Cities') }}
                </h2>
            </div>

            <div>
                <a href="{{route('cities.create')}}">
                    <x-button class="ml-4">
                        {{ __('Add City') }}
                    </x-button>
                </a>
            </div>

        </div>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl  mx-auto sm:px-6 lg:px-8">
            <div class="bg-white  shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                                        @if($message=Session::get('success'))
                                            <div class="text-green-600">
                                                <span>{{$message}}</span>
                                            </div>
                                        @endif

                    <table>
                        <thead>
                        <tr class="space-x-8">
                            <th>Sr No</th>
                            <th>Country Name</th>
                            <th>City Name</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($cities as $city)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{$city->country->name}}</td>
                                <td>{{$city->name}}</td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
