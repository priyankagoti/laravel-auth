<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function create(){
        $posts=Post::all();
        $users=User::all();
        return view('images.create',compact('posts','users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'url'=>'required'
        ]);
        $input=$request->all();
        Image::create($input);
        return route('images.create')->with('success','images added successfully');
    }
}
