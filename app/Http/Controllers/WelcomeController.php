<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\LazyCollection;
use Illuminate\Support\Str;

class WelcomeController extends Controller
{
    public function index(Request $request)
    {
        /*about session*/
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

        /*about Collection*/

        $collection = collect(['Taylor', 'abigail', ''])->map(function ($name) {
            return strtolower($name);
        })->reject(function ($name) {
            return empty($name);
        });

        Collection::macro('toUpper',function (){
            return $this->map(function ($value){
                return Str::upper($value);
            });
        });
        $collection1 = collect(['first','second','first','second','first','second','first','second']);
        $result =$collection1->toUpper();
        //dd($collection1->all());
        $collection2 = collect(str_split('AABBBCCCD'));
            $collection2->countBy();
        //dd($collection2->duplicates());

        $chunks = $collection2->chunkWhile(function ($value, $key, $chunk) {
            return $value === $chunk->last();
        });
        $chunks->all();
       //dd(substr(strrchr("alice@gmail.com","@"),1));
        $collection3 = collect([
            [1, 2, 3],
            [4, 5, 6],
            [7, 8, 9],
        ])->collapse();
        //dd($collection3);
        $collection4=collect([1, 2, 3])->collect()->all();
        //dd($collection4);

        $collection5 = collect(['xyz@gmail.com','abc@yahoo.com','pqr@gmail.com','acz@fddfg.net','dfgd@fddfg.net'])
                        ->countBy(function ($value){
                            return substr(strrchr($value,"@"),1);
                        });
        //dd($collection5);

        $collection6=collect([1,2]);
       // $collection6->dump();
        $matrix =$collection6->crossJoin(['a','b'],['x','y']);
        //dd($matrix->all());
        $collection6->diff(['a','b',1]);
        $lazyCollection = LazyCollection::make(function () {
            yield 1;
            yield 2;
            yield 3;
        });
        $lazyCollection->collect()->all();
        return view('welcome',$data,compact('collection'));

    }
}
