<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white  shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if($errors->any())
                        <div class="text-red-600">
                            <span>Woops! There is something wrong with your input.</span>
                        </div>
                    @endif
                    {{--<div>{{$request}}</div>--}}
                    <form method="POST" enctype="multipart/form-data" action="{{ route('products.store') }}">
                    @csrf

                        <!--Product Name -->
                        <div>
                            <x-label for="name" :value="__('Product Name')" />

                            <input id="name" type="text" class="" name="name"  autofocus />

                            @if ($errors->has('name'))
                                <span class="text-red-600">{{ $errors->first('name') }}</span>
                            @endif
                        </div>

                        <!-- Product Detail -->
                        <div class="mt-4">
                            <x-label for="detail" :value="__('Product Detail')" />

                            <input id="price" type="text" name="detail" class="" />
                            @if ($errors->has('detail'))
                                <span class="text-red-600">{{ $errors->first('detail') }}</span>
                            @endif
                        </div>
                        <!-- Product Price -->
                        <div class="mt-4">
                            <x-label for="price" :value="__('Product Price')" />

                            <input type="text" id="price"
                                   class=""
                                   name="price"/>

                            @if ($errors->has('price'))
                                <span class="text-red-600">{{ $errors->first('price') }}</span>
                            @endif
                        </div>
                        <!-- Product Category -->
                        <div class="mt-4">
                            <x-label for="type" :value="__('Product Category')" />
                            <div class="flex items-center space-x-8">
                                <label>
                                    <input type="radio"  name="category" value="liquid">
                                    Liquid
                                </label>
                                <label >
                                    <input type="radio" name="category" value="solid">
                                    Solid
                                </label>
                            </div>
                            @if ($errors->has('category'))
                                <span class="text-red-600">{{ $errors->first('category') }}</span>
                            @endif
                        </div>

                        <!-- Product Type -->
                        <div class="mt-4">
                            <x-label for="type" :value="__('Product Type')" />
                            <div class="flex items-center space-x-8">
                                <label><input type="checkbox" class="" name="type[]" value="Laravel"> Laravel</label>
                                <label><input type="checkbox" class="" name="type[]" value="JQuery"> JQuery</label>
                                <label><input type="checkbox" class="" name="type[]" value="Bootstrap"> Bootstrap</label>
                                <label><input type="checkbox" class="" name="type[]" value="Codeigniter"> Codeigniter</label>
                            </div>


                            @if ($errors->has('type'))
                                <span class="text-red-600">{{ $errors->first('type') }}</span>
                            @endif
                        </div>
                        <!-- Product Color -->
                        <div class="mt-4">
                            <x-label for="type" :value="__('Product Color')" />

                            <select type="select" name="color" >
                                <option disabled value="" selected>Select color</option>
                                <option value="red">Red</option>
                                <option value="white">White</option>
                                <option value="black">Black</option>
                            </select>
                        </div>
                        <!-- Product Image -->
                        <div class="mt-4">
                            <x-label for="image" :value="__('Product Image')" />

                            <input type="file" id="image" class="form-file"  name="image"/>

                            @if ($errors->has('image'))
                                <span class="text-red-600">{{ $errors->first('image') }}</span>
                            @endif
                        </div>

                        <!-- Product Country -->
                        <div class="mt-4">
                            <x-label for="type" :value="__('Product Country')" />

                            <select type="select" name="country_name" >
                                <option disabled value="" selected>Select country</option>
                                @foreach($countries as $country)
                                <option value="{{$country->id}}">{{$country->name}}{{$country->cities}}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Product City -->
                        <div class="mt-4">
                            <x-label for="type" :value="__('Product City')" />

                            <select type="select" name="city_name">
                                <option disabled value="" selected>Select city</option>
                                <option value="Surat">Surat</option>
                                <option value="Ahmedabad">Ahmedabad</option>
                               {{-- @foreach($countries as $country)
                                    @foreach($country->cities as $city)
                                        --}}{{--@if($city->country_id===$product->country_name)
                                        <option value="{{$city->name}}">{{$city->name}}</option>
                                        @endif--}}{{--
                                    @endforeach
                                @endforeach--}}
                            </select>
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
