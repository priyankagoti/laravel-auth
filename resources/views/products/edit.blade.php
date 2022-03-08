<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if($errors->any())
                        <div class="text-red-600">
                            <span>Woops! There is something wrong with your input.</span>
                        </div>
                        {{--<div>
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>--}}
                    @endif

                    <form method="POST" enctype="multipart/form-data" action="{{ route('products.update',$product->id)}}">
                    @csrf
                    @method('PUT')

                    <!--Product Name -->
                        <div>
                            <x-label for="name" :value="__('Product Name')" />

                            <x-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{$product->name}}" autofocus />
                            @if ($errors->has('name'))
                                <span class="text-red-600">{{ $errors->first('name') }}</span>
                            @endif
                        </div>

                        <!-- Product Detail -->
                        <div class="mt-4">
                            <x-label for="detail" :value="__('Product Detail')" />

                            <x-input id="price" class="block mt-1 w-full" type="text" name="detail" value="{{$product->detail}}" />
                            @if ($errors->has('detail'))
                                <span class="text-red-600">{{ $errors->first('detail') }}</span>
                            @endif
                        </div>

                        <div>
                            <x-label for="price" :value="__('Product Price')" />

                            <x-input id="price" class="block mt-1 w-full" type="text" name="price" value="{{$product->price}}" />

                            @if ($errors->has('price'))
                                <span class="text-red-600">{{ $errors->first('price') }}</span>
                            @endif
                        </div>
                        <div class="mt-2">
                            <label class="inline-flex items-center">
                                <input type="radio" name="category" value="liquid"  {{ $product->category == 'liquid' ? 'checked' : '' }}>
                                <span class="ml-2">Liquid</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" name="category" value="solid" {{ $product->category == 'solid' ? 'checked' : ''}} >
                                <span class="ml-2">Solid</span>
                            </label>
                        </div>
                        @if ($errors->has('category'))
                            <span class="text-red-600">{{ $errors->first('category') }}</span>
                        @endif

                        <div>
                            <x-label for="type" :value="__('Product Type')" />

                            <label><input type="checkbox" name="type[]" value="Laravel"  @if (!empty($type_type) && in_array('Laravel', $type_type)) checked @endif /> Laravel</label>
                            <label><input type="checkbox" name="type[]" value="JQuery" @if (!empty($type_type) && in_array('JQuery', $type_type)) checked @endif/> JQuery</label>
                            <label><input type="checkbox" name="type[]" value="Bootstrap" @if (!empty($type_type) && in_array('Bootstrap', $type_type)) checked @endif/> Bootstrap</label>
                            <label><input type="checkbox" name="type[]" value="Codeigniter" @if (!empty($type_type) && in_array('Codeigniter', $type_type)) checked  @endif/> Codeigniter</label>
                            @if ($errors->has('type'))
                                <span class="text-red-600">{{ $errors->first('type') }}</span>
                            @endif
                        </div>
                        <div>
                            <x-label for="type" :value="__('Product Color')" />

                            <select name="color" class="rounded-md w-32 h-8">
                                <option disabled value="" selected>Select color</option>
                                <option value="red" {{ $product->color == 'red' ? 'selected' : '' }}>Red</option>
                                <option value="white" {{ $product->color == 'white' ? 'selected' : '' }}>White</option>
                                <option value="black" {{ $product->color == 'black' ? 'selected' : '' }}>Black</option>
                            </select>
                        </div>
                        <div>
                            <x-label for="image" :value="__('Product Image')" />

                            <x-input id="image" class="block mt-1 w-full" type="file" name="image" value="{{$product->image}}"/>

                            @if ($errors->has('image'))
                                <span class="text-red-600">{{ $errors->first('image') }}</span>
                            @endif
                        </div>
                        <div class="flex items-center justify-end mt-4">

                            <x-button class="ml-4">
                                {{ __('Save') }}
                            </x-button>
                        </div>
                    </form>
                </div>


            </div>
        </div>
    </div>
</x-app-layout>
