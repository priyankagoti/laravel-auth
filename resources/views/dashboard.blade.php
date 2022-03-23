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
                <?php $bool=true ?>
                <p>{{$bool}}</p>
               {{-- @include("products.alert",["width"=>'2/4',"type"=>'green','content'=>'this is success statement'])
                @includeWhen($bool,"products.alert",["width"=>'2/4',"type"=>'green','content'=>'this is true statement'])
                @includeUnless($bool,"products.alert",["width"=>'2/4',"type"=>'green','content'=>'this is  false statement'])
                @includeIf('view.name', ['status' => 'complete'])--}}
                {{--@include('products.alert',['width'=>'2/4','color'=>'red','content'=>'this is danger statement'])
                @include('products.alert',['width'=>'2/5','color'=>'blue','content'=>'this is blue statement'])
                @include('products.alert',['width'=>'2/6','color'=>'gray','content'=>'this is blue statement'])
                @include('products.alert',['width'=>'2/7','color'=>'green','content'=>'this is blue statement'])--}}
            </div>
        </div>
    </div>
</x-app-layout>
