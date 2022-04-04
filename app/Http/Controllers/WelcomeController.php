<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index(Request $request)
    {
        $request->session()->put(['name'=>'xyz1','detail'=>'detail of xyz']);
        //$request->session()->put('count',1);
        //$request->session()->flush();
        $request->session()->increment('count',$incrementBy=4);
        $request->session()->decrement('count',$decrementBy=2);

        //$request->session()->push('user.teams', 'designers');
        //$request->session()->pull('user.teams');
        /*$name=$request->session()->get('name',function (){
            return redirect()-> route('products.index');
        });*/

            $data=session()->all();
           // dd($data);

       // $data=['name'=>$name];
        return view('welcome',$data);
    }
}
