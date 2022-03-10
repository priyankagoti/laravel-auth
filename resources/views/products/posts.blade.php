<x-app-layout>
    <x-slot name="header">
        <div>
            <h1>Products</h1>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <table>
                        <tr>
                            <th>No</th>
                            <th>Product Image</th>
                            <th>Product Name</th>
                            <th>Product Detail</th>
                            <th>Product Price</th>
                            <th>Product Type</th>
                            <th>Product Color</th>
                        </tr>
                        @foreach($products as $product)
                            <tr>
                                <td>{{$product->id}}</td>
                                <td><img class="w-16 h-16 object-cover rounded-md" src="{{ asset('storage/images/'.$product->image) }}" alt=""></td>
                                <td>{{$product->name}}</td>
                                <td>{{$product->detail}}</td>
                                <td>{{$product->price}}</td>
                                <td>
                                    @foreach(json_decode($product->type) as $value)
                                        {{$value}},
                                    @endforeach
                                </td>
                                <td>{{$product->color}}</td>

                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
