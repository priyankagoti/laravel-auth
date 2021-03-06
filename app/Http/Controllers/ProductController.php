<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\City;
use App\Models\Country;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\User;
use App\Rules\Uppercase;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //middleware in controller.
    /*public function __construct(){
        $this->middleware(function($request,$next){
            if($request->type!=2){
                return response()->json('wrong type');
            }
            return $request($next);
        });
    }*/

    public function index(Request $request)
    {
        //dd($request->session());
        //print_r('index get');
        /*Product::withTrashed()
            ->restore();*/
        if ($request->accepts(['text/html', 'application/json'])) {
            $contentTypes='TRUE';
        }
        else{
            $contentTypes='false';
        }
        $sessionVal = $request->session()->get('_token','fsdf');
        $authId = Auth::user()->id;
        $token = $request->session()->token();
        $route = Route::current();
        $name = Route::currentRouteName();
        $action = Route::currentRouteAction();
        $user = User::find($authId);
        $products=Product::latest()
            ->where('user_id',$user->id)
            ->paginate($perPage = 5, $columns = ['*'], $pageName = 'products')->fragment('user');;
        //$products->appends(['sort' => 'price']);
        //$product = $user->currentProduct;
        //dd($products);
        /*$results= DB::table('users')->whereExists(function ($query){
            $query->select(DB::raw(1))
                ->from('products')
                ->whereColumn('products.user_id','users.id');
        })->get();*/
        //$results = DB::table('products')->select('detail')->whereColumn('products.user_id','users.id')->orderByDesc('created_at')->get();
        $results = User::where(function ($query){
            $query->select('name')
                ->from('products')
                ->whereColumn('products.user_id','users.id')
                ->orderByDesc('products.created_at')
                ->limit(1);

        },'sdfsd')->get();
        //dd($results);
        $results1 = Product::where('price','<',function ($query){
            $query->selectRaw('avg(p.price)')->from('products as p');
        })->get();
        // dd($results1);
        $results2 = Product::orderBy('name','asc')->get();
        // dd($results2);
        //$removeOrder = $results2->reorder('price', 'desc')->get();
        //dd($removeOrder);
         $randomProduct=Product::inRandomOrder()->first();
        // dd($randomProduct);
        $groupResults=Product::groupBy('user_id')->having('user_id', '>', 1)->get();
        //dd($groupResults);
        $skipTake =DB::table('products')->offset(2)->limit(5)->get();
        //dd($skipTake);
        $results3 = Product::when('user_id',function ($query){
            $query->where('user_id','=',2);
        })->get();
        //dd($results3);

        $results4 = User::has('products','>=',5)->get();
       // dd($results4);

        $results5 = User::whereHas('products',function (Builder $query){
            $query->where('name','like','x%');
        },'>=',5)->get();
        //dd($results5);

        $results6 = User::whereRelation('products','created_at','>=',now()->subDay(2))->get();

        $results7 = User::doesntHave('products')->get();

        $results8 = User::whereDoesntHave('products',function (Builder $query){
            $query->where('name','like','h%');
        })->get();

        User::whereDoesntHave('products.owner',function (Builder $query){
            $query->where('name',0);
        })->get();

       User::withCount('products')->get();

        $results9=User::withCount(['products','products as products_with_x'=> function (Builder $query){
            $query->where('name','like','x%');
       }])->get();

//        echo $results9[2]->products_count;
//        echo '</br>';
//        echo $results9[2]->products_with_x;

        $user = User::find(2);
        //dd($user);
        $results10=$user->loadCount('products');
       // dd($results10);

        User::select('name','email')->withCount('products')->get();

        User::withSum('products as total_price','price')->get();
        User::withExists('products','price')->get();

        $results11=$user->loadSum('products','price');
       // dd($results11);
        User::select('name','email')->withExists('products')->get();

        //User::with('products')->get()->dd();
        //$results12=Product::with('owner')->get();
        $results12=Product::all();
        //dd($results12->collect()->all());
        $results12->load('owner');
        /*foreach($results12 as $p){
            dd($p->owner) ;

        }*/
        //dd($results12);
        //$increment=Product::increment('price',1,['name'=>'xyz']);
       // Product::decrement('price',9);
        //dd($increment);
        //$products= DB::table('products')->where('user_id',$user->id)->get();
        //$products= Product::latest()->where('user_id',$user->id)->get();
        //$products= Product::whereBelongsTo($user,'owner')->get()->latestProduct;

        /*$product = Product::chunk(1,function ($products){
            foreach ($products as $product){
               // echo $product->name;
                //echo '</br>';
              //  dd($result);
            }
            //echo '</br>';
        });*/
        //$result=Product::all();
        /*$result=Product::where('price','=',500)->firstOr(function (){
            dd('not found');
        })*/;
        $result=Product::firstOrNew(['name'=>'Latte'],['detail'=>'tea type','price'=>300,'image'=>'1649480203.png']);
       // dd($result);


        //$products= DB::table('products')->selectRaw('SUM(price)')->whereRaw("user_id='$user->id'")->groupBy('name')->havingRaw('SUM(price)<?',[500])->get();
        //dd($products);
       // dd(Schema::hasColumn('products','email'));
       //dd(DB::table('products')->orderBy('price','desc')->get());
        $product_count = DB::table('products')->where('user_id',$user->id)->count();
        $price = DB::table('products')->where('user_id',$user->id)->max('price');
       // dd(DB::table('products')->where('user_id',$user->id)->where('name','tyf')->doesntExist());
        //dd(DB::table('products')->where('user_id',$user->id)->select('name','detail as detail of product')->get());
       // dd(DB::table('products')->where('user_id',$user->id)->select('name')->distinct()->get());
        //dd(DB::select(DB::raw("select name,detail from products where user_id='$user->id'" )));
        $name1=DB::table('products')->where('user_id',$user->id)->select('name');
       // dd($name1->addSelect('detail')->get());
       /*$names= DB::table('products')->orderBy('id')->chunk(10,function ($product_name) use ($product_array){
           $product_array[]=$product_name;
       });*/

       // dd($product_array);
        //dd($names);
        /*foreach ($names as $product){
            dd($product);
        }*/
       // dd($products);

        return view('products.index',compact('results','price','product_count','products','user','contentTypes','route','name','action','token','sessionVal'))
            ->with('i',(request()->input('page',1)-1)*5);
    }

    public function productIndex(){
        //return Product::latest()->get();
        //return ProductResource::collection(Product::with('user')->latest()->get());
       // DB::table('products')->where('name', 'asd')->first();
       // $products=Product::latest()->paginate(5);
        $products=Cache::remember('products',60,function (){
            return Product::latest()->paginate(5);

        });
        return ProductResource::collection($products);



        //return new ProductResource($products);
        //return $users;
    }

    public function productEdit($id){
        $product= Product::find($id);

        return ProductResource::make($product);
        //return new ProductResource($product);
    }


    public function create(Request $request)
    {
        $countries=Country::latest()->get();
       // $cities=City::where('country_id',C)->get();
        $product=$request->all();
        //$cities=City::where('country_id',$country_id);
        return view('products.create',compact('countries','product','request'));
    }

//    public function store(StoreProductRequest $request)
//    {
//        //dd($request);
//        /*$request->validate([
//            'name'=>'bail|required|unique:products|max:255',
//            'detail'=>'required',
//            'price'=>'required',
//            'category'=>'required',
//            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
//        ]);*/
//       /* $request->whenHas('color',function ($input){
//            dd($input);
//        });*/
//       // $request->mergeIfMissing(['votes'=>23]);
//       // $request->flash();
//        //$request->validate();
//         //dd($validate);
//        $request->validated();
//        $input=$request->all();
//        //$request->all();
//        //$input=$request->cookie('name');
//        //$file = $request->image->store('images');
//        //return redirect('/products')->withInput();
//      // dd($file);
//
//        $imageName = time().'.'.$request->image->extension();
//        $request->image->storeAs('images', $imageName);
//        $input['image']=$imageName;
//        $input['type'] = json_encode($request->type);
//        $input['user_id']=Auth::user()->id;
//        //dd($input);
//        Product::create($input);
//
//        //$request->session()->flash('success','Product created successfully....');
//
//        return redirect()-> route('products.index')
//            ->with(['success'=>'product created successfully','input'=>$input]);
//
//
//    }

    public function store(Request $request){
        $validator=Validator::make($request->all(),[
            //'password'=>['required', 'confirmed'],
            //'createdDate'=>'required|date|after:09-04-2022',
            'name'=>['required'],
            'detail'=>'exclude_unless:name,tea|required',
            'price'=>['required'],
            'image'=>'required'
        ],
         $messages=[
             'name.required'=>'The :attribute is mandatory.'
         ],
         $attribute=[
             'detail'=>'detail of product'
         ])->validate();
        //$validated = $validator->safe()->merge(['name' => 'Taylor Otwell']);
        // $validator->safe()->except(['name', 'detail']);
        //$validator->validated();
        //$errors = $validator->errors();
        //dd($errors);
        //$validated = $validator->safe();
        //dd($validated);
       /* foreach ($validator->safe() as $key=>$value){
            $arr=[];
            $arr[]=$key;
            dd($arr);
        }*/
       // dd($validated['detail']);

        $input=$request->all();
        $input['type']=json_encode($request->type);
        $imageName=time().'.'.$request->image->extension();
       // $imageName=$request->image;
        $request->image->storeAs('images',$imageName);
        $input['image']= '/storage/images/'.$imageName;
        $input['user_id']=Auth::user()->id;
        //dd($request->image);
        Product::withoutEvents(function ()use($input){
            Product::create($input);
        });

        return redirect()->route('products.index')->with('success','Successfully created');
    }

    public function show(Product $product)
    {
        $image_path=$product->image;
       // echo $image_path;
        //dd(response()->download($image_path));
        //dd(Storage::download($image_path));
        //dd(Storage::url($product->image));
        return view('products.show', compact('product'));
    }


    public function edit(Product $product)
    {

        $type_type = json_decode($product->type);

        return view('products.edit',compact('product','type_type'));
    }


    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'=>'required',
            'detail'=>'required',
            'price'=>'required',
            'category'=>'required',

            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        //$image_path=public_path().'/storage/images/'.$product->image;
       // unlink($image_path);
        $input = $request->all();
        $imageName = time().'.'.$request->image->extension();
        $request->image->storeAs('images', $imageName);
        $input['image']=config('app.url') .'/storage/images/'.$imageName;
        $input['type'] = json_encode($request->type);
        $product->update($input);

        return redirect()->route('products.index')
            ->with('success','product updated successfully.');
        //return redirect()->action([CityController::class,'index']);
        //return redirect()->away('https://www.youtube.com');
       // return response()->json($product,200);
    }


    public function destroy(Product $product)
    {
       // $image_path=public_path().'/storage/images/'.$product->image;
       // unlink($image_path);
        $product->delete();
        return redirect()->route('products.index')
            ->with('success','product deleted successfully');
    }

    public function downloadImage(Product $product){

        $image_path=public_path().$product->image;
        echo $image_path;
        //$image=public_path().'/storage/images/'.$product->image;
       // dd(response()->download($image_path));
        return response()->download($image_path);
        //return Storage::download($image_path);
    }

    public function downloadStream(){
        //$products = Product::all();
        return response()->streamDownload(function (){
            Product::all();
        }, 'laravel-readme.pdf');
    }
}
