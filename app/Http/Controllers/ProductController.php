<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\City;
use App\Models\Country;
use App\Models\Product;
use App\Models\User;
use App\Rules\Uppercase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
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
       /* Product::withTrashed()
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
        //$products=$user->products;

        //$products= DB::table('products')->where('user_id',$user->id)->get();
        //$products= Product::latest()->where('user_id',$user->id)->get();
        $products= Product::where('user_id',$user->id)->get();

        $product = Product::chunk(1,function ($products){
            foreach ($products as $product){
                echo $product->name;
                echo '</br>';
              //  dd($result);
            }
            echo '</br>';
        });
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

        return view('products.index',compact('product','price','product_count','products','user','contentTypes','route','name','action','token','sessionVal'))
            ->with('i',(request()->input('page',1)-1)*5);
    }

    public function productIndex(){
        //return Product::latest()->get();
        //return ProductResource::collection(Product::with('user')->latest()->get());
       // DB::table('products')->where('name', 'asd')->first();
        $users=DB::table('products')->get();
        return ProductResource::collection($users);
        //return $users;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $countries=Country::latest()->get();
        $product=$request->all();
        //$cities=City::where('country_id',$country_id);
        return view('products.create',compact('countries','product','request'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
            'password'=>['required', 'confirmed'],
            'createdDate'=>'required|date|after:09-04-2022',
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
        $input['image']= $imageName;
        $input['user_id']=Auth::user()->id;
        //dd($request->image);
        Product::create($input);
        return redirect()->route('products.index')->with('success','Successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {

        $type_type = json_decode($product->type);

        return view('products.edit',compact('product','type_type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'=>'required',
            'detail'=>'required',
            'price'=>'required',
            'category'=>'required',

            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $image_path=public_path().'/storage/images/'.$product->image;
        unlink($image_path);
        $input = $request->all();
        $imageName = time().'.'.$request->image->extension();
        $request->image->storeAs('images', $imageName);
        $input['image']=$imageName;
        $input['type'] = json_encode($request->type);
        $product->update($input);

        return redirect()->route('products.index')
            ->with('success','product updated successfully.');
        //return redirect()->action([CityController::class,'index']);
        //return redirect()->away('https://www.youtube.com');
       // return response()->json($product,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $image_path=public_path().'/storage/images/'.$product->image;
        unlink($image_path);
        $product->delete();
        return redirect()->route('products.index')
            ->with('success','product deleted successfully');
    }

    public function downloadImage(Product $product){

        $image_path=public_path().'/storage/images/'.$product->image;
        //$image=public_path().'/storage/images/'.$product->image;
        return response()->download($image_path);
    }

    public function downloadStream(){
        //$products = Product::all();
        return response()->streamDownload(function (){
            Product::all();
        }, 'laravel-readme.pdf');
    }
}
