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
        <div class="max-w-7xl  mx-auto sm:px-6 lg:px-8">
            <div class="bg-white  shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                   {{-- @foreach($contentTypes as $type)
                        <p>{{$type}}</p>
                    @endforeach--}}
                   {{-- <p>{{$url}}</p>--}}
                    <P>{{$contentTypes}}</P>
                    {{--<div class="w-full overflow-auto space-y-2">
                        <p>{{$token}}dfgd</p>
                        <p>{{$url}}</p>
                        <p>{{json_encode($route)}}</p>
                        <p>{{$name}}</p>
                        <p>{{$action}}</p>
                    </div>--}}



                    @if($message=Session::get('success'))
                        <div class="text-green-600">
                            <span>{{$message}}</span>
                        </div>
                    @endif
                    {{--<a href="{{route('products-stream.download')}}"
                       class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
                    >
                        Download Stream
                    </a>--}}
                {{--
                    <script>

                       var app = {{Js::from($products)}} ;
                       console.log(app);

                    </script>--}}
                    @verbatim
                        <div class="container">
                            Hello, {{ $products }}.
                        </div>
                    @endverbatim
                    @each('products.alert',$products,'p')
                    <table class="">
                        <tr>
                            <th>No</th>
                            <th>Product Image</th>
                            <th>Product Name</th>
                            <th>Product Detail</th>
                            <th>Product Price</th>
                            <th>Product Type</th>
                            <th>Product Color</th>
                            <th>Actions</th>
                        </tr>
                        @foreach($products as $product)
                            @once
                                <div><p>{{$loop->count}}</p></div>
                            @endonce
                        <tr>
                            <td>{{$loop->index+1}}</td>
                            <td><img class="w-16 h-16 object-cover rounded-md" src="{{ asset('storage/images/'.$product->image) }}" alt=""></td>
                            <td @class(['text-gray-600'=>$loop->even])>{{$product->name}}{{$loop->even}}</td>
                            <td>{{$product->detail}}</td>
                            <td>{{$product->price}}</td>
                            <td>
                               {{-- {{gettype(json_decode($product->type))}}--}}
                                @foreach(json_decode($product->type) as $value)
                                    {{$value}},
                                @endforeach
                            </td>
                            <td>{{$product->color}}</td>
                            <td class="w-auto px-6">
                                <form method="POST" action="{{ route('products.destroy',[$product]) }}">

                                    <div class="flex items-center justify-end space-x-8">
                                        <a href="{{route('products.download',$product->id)}}"
                                           class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
                                        >
                                            Download Image
                                        </a>
                                        <a href="{{route('products.show',$product->id)}}"
                                           class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
                                        >
                                            Show
                                        </a>
                                        <a href="{{route('products.edit',$product->id)}}"
                                           class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
                                        >
                                            Edit
                                        </a>
                                        @csrf
                                        @method('DELETE')
                                        <x-button class="ml-4">
                                            {{ __('Delete') }}
                                        </x-button>

                                    </div>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
