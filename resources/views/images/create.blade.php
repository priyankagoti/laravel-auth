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

                    <form method="POST" enctype="multipart/form-data" action="{{ route('images.store') }}">
                    @csrf

                    <!--Country Name -->
                        <div class="mt-4">
                            <x-label for="url" :value="__('Upload Image')" />

                            <input type="file" id="url" class="form-file"  name="url"/>

                            @if ($errors->has('url'))
                                <span class="text-red-600">{{ $errors->first('url') }}</span>
                            @endif
                        </div>
                        <div class="mt-4">
                            <div class="flex items-center space-x-8">
                                <label>
                                    <input type="radio"  name="imageable_type" value="App\Models\Post" >
                                    For post
                                </label>
                                <label>
                                    <input type="radio" name="imageable_type" value="App\Models\User" >
                                    For user
                                </label>
                            </div>
                            @if ($errors->has('imageable_type'))
                                <span class="text-red-600">{{ $errors->first('imageable_type') }}</span>
                            @endif
                        </div>
                        {{--@php
                        $type=$_REQUEST('imageable_type');
                        @endphp--}}
                       {{-- <p>{{$type}}</p>--}}
                        <div class="flex space-x-8">
                            <div class="mt-4" >
                                <x-label for="imageable_id" :value="__('Post of image')" />

                                <select type="select" name="imageable_id">
                                    <option disabled value="" selected>Select country</option>
                                    @foreach($posts as $post)
                                        <option value="{{$post->id}}">{{$post->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mt-4">
                                <x-label for="imageable_id" :value="__('User of Image')" />

                                <select type="select" name="imageable_id">
                                    <option disabled value="" selected>Select country</option>
                                    @foreach($users as $user)
                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach
                                </select>
                            </div>
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
