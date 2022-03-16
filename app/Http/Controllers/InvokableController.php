<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InvokableController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($page)
    {
        //dd($page);
       // $path = resource_path("views/pages/{$page}.blade.php");
        return view('pages.'.$page);
    }
}
