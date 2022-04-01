<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index(Request $request)
    {
        $request->session()->put('name','Priyanka');
        $name=$request->session()->get('name');
        $data=['name'=>$name];
        return view('welcome',$data);
    }
}
