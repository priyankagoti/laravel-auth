<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Product;
use App\Models\User;
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

        $collection7 = collect([
            ['name' => 'Sally'],
            ['school' => 'Arkansas'],
            ['age' => 28]
        ]);

       $flattened = $collection7->flatMap(function ($values){
            return array_map('strtoupper',$values);
        })->all();
       // dd($flattened);

        $collection8 = collect([
            'name' => 'taylor',
            'languages' => [
                'php', 'javascript'
            ]
        ]);
       // dd($collection8);
        $flattened1=$collection8->flatten();
       // dd($flattened1);
        $collection9 = collect([
            'Apple' => [
                [
                    'name' => 'iPhone 6S',
                    'brand' => 'Apple'
                ],
            ],
            'Samsung' => [
                [
                    'name' => 'Galaxy S7',
                    'brand' => 'Samsung'
                ],
            ],
        ]);
        //dd($collection9);
        $flattened2=$collection9->flatten(1)->values()->all();
       // dd($flattened2);
        $collection9 = collect([1, 2, 3, 4, 5, 6, 7, 8, 9]);

        $chunk = $collection9->forPage(2, 4);
        //dd($chunk->all());
        $collection10 = collect([
            ['account_id' => 'account-x10', 'product' => 'Chair'],
            ['account_id' => 'account-x10', 'product' => 'Bookcase'],
            ['account_id' => 'account-x11', 'product' => 'Desk'],
        ]);
        //dd($collection10->groupBy('account_id')->all());

        $collection11 = collect([
            ['product_id' => 'prod-100', 'name' => 'Desk'],
            ['product_id' => 'prod-100', 'name' => 'again'],
            ['product_id' => 'prod-200', 'name' => 'Chair'],
            ['product_id' => 'prod-200', 'name' => 'new'],
        ]);
        $keyBy=$collection11->keyBy(function ($item){
            return strtoupper($item['product_id']);
        });
         //dd($keyBy->keys());
       // $array=collect([1, 2, 3, 4])->all();
        //dd($array);
        $collection12 = collect([0, 1, 2, 3, 4, 5, 6, 7, 8, 9]);
       $chunks=$collection12->chunk(3);
       $chunks->mapSpread(function ($value1,$value2){
            return $value1+$value2;
        });
        $collection13 = collect([
            [
                'name' => 'John Doe',
                'department' => 'Sales',
            ],
            [
                'name' => 'Jane Doe',
                'department' => 'Sales',
            ],
            [
                'name' => 'Johnny Doe',
                'department' => 'Marketing',
            ]
        ]);

        $collection13->mapToGroups(function ($item,$key){
            return [$item['department']=>$item['name']];
        })->all();

       $collection13->mapWithKeys(function ($item,$key){
           return [$item['department']=>$item['name']] ;
        })->all();

       $collection13->groupBy('department')->all();
        $mode = collect([1, 1, 1, 1, 2, 2, 2])->mode();
        //dd($mode);

        $collection14 = collect([ 2, 1,3,4,5]);

        $collection14->tap(function ($collection14){
            return $collection14->values()->all();
        });

       // dd($collection14);

        $collection14->takeUntil(3);
        $collection14->slice(2)->all();
        //dd($collection14);
        $collection14->splice(2)->all();
        //dd($collection14);
        $piped=$collection14->pipe(function ($collection14) {
            return $collection14->sum();
        });
        // dd($piped);
        //$collection14->shift();
       // dd($collection14->all());
        $chunk1=$collection14->sliding(3);
        //dd($chunk1->toArray());
        $collection14->sole(function ($value, $key) {
        return $value === 2;
        });

        $collection15 = collect([
            ['name' => 'Desk', 'price' => 200],
            ['name' => 'Chair', 'price' => 100],
            ['name' => 'Bookcase', 'price' => 150],
        ]);
        $collection15->toJson();
        $collection15->sortBy('price')->values()->all();

        $collection16 = Collection::times(5,function ($number){
            return $number*9;
        });

        //dd($collection16->toArray());

        $collection17 = collect([
            new User,
            new User,
            new Post,
        ]);
        $collection17->whereInstanceOf(Post::class);
        $collection18 = collect(['Chair', 'Desk','dfg']);

        $zipped = $collection18->zip([100, 200]);
        //dd($zipped->all());

        $products=Product::where('price','>',500)->get();
        //dd($products);

        $products->each(function ($item,$key){
            return $item['price']*2;
        });

        $lazyCollection = LazyCollection::make(function () {
            yield 1;
            yield 2;
            yield 3;
        });
        //Collection::times(1000*1000);
        function run(){
            yield 1;
            yield 2;
        }
        $generator=run();
        $generator->current();
        $generator->next();
        dd($generator->current());
        $lazyCollection->collect()->all();
        return view('welcome',$data,compact('collection'));

    }
}
