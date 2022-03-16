<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Country') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    {{--@if($errors->any())
                        <div class="text-red-600">
                            <span>Woops! There is something wrong with your input.</span>
                        </div>
                    @endif--}}

                    <form method="POST" enctype="multipart/form-data" action="{{ route('cities.store') }}">
                    @csrf

                    <!--Country Name -->
                        <div>
                            <x-label for="name" :value="__('Country Name')" />

                            <select type="select" name="country_id">
                                <option value="" disabled selected>Select Country</option>
                                @foreach($countries as $country)
                                    <option value="{{$country->id}}">{{$country->name}}</option>
                                @endforeach
                            </select>

                            @if ($errors->has('name'))
                                <span class="text-red-600">{{ $errors->first('name') }}</span>
                            @endif
                        </div>

                    <!--City Name -->
                        <div>
                            <x-label for="name" :value="__('City Name')" />

                            <input id="name" type="text" class="" name="name"  />

                            @if ($errors->has('name'))
                                <span class="text-red-600">{{ $errors->first('name') }}</span>
                            @endif
                        </div>


                        <div class="flex items-center justify-end mt-4">

                            <x-button class="ml-4">
                                {{ __('Submit') }}
                            </x-button>
                        </div>
                    </form>
                </div>


            </div>
        </div>
    </div>
</x-app-layout>
