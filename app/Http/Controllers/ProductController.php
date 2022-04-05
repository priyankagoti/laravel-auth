<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\City;
use App\Models\Country;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

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
        $products=$user->products;
        return view('products.index',compact('products','user','contentTypes','route','name','action','token','sessionVal'))
            ->with('i',(request()->input('page',1)-1)*5);
    }

    public function productIndex(){
        //return Product::latest()->get();
        return ProductResource::collection(Product::latest()->get());
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
    public function store(StoreProductRequest $request)
    {
        //dd($request);
        /*$request->validate([
            'name'=>'bail|required|unique:products|max:255',
            'detail'=>'required',
            'price'=>'required',
            'category'=>'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);*/
       /* $request->whenHas('color',function ($input){
            dd($input);
        });*/
       // $request->mergeIfMissing(['votes'=>23]);
       // $request->flash();
         $validate=$request->validate();
         //dd($validate);
        $input=$request->all();
        //$request->all();
        //$input=$request->cookie('name');
        //$file = $request->image->store('images');
        //return redirect('/products')->withInput();
      // dd($file);

        $imageName = time().'.'.$request->image->extension();
        $request->image->storeAs('images', $imageName);
        $input['image']=$imageName;
        $input['type'] = json_encode($request->type);
        $input['user_id']=Auth::user()->id;
        //dd($input);
        Product::create($input);

        //$request->session()->flash('success','Product created successfully....');

        return redirect()-> route('products.index')
            ->with(['success'=>'product created successfully','input'=>$input]);


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
