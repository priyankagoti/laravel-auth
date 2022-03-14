<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $url=route('admin.products.index');
        $authId = Auth::user()->id;
       // dd($authId);
        $user = User::find($authId);
       // dd($user);
       // $user = Auth::user();
       // $products = Product::latest()->paginate(5);
        $products=$user->products;
        //dd($products);
        return view('products.index',compact('products','user','url'))
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
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'detail'=>'required',
            'price'=>'required',
            'category'=>'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        $input = $request->all();
        $imageName = time().'.'.$request->image->extension();
        $request->image->storeAs('images', $imageName);
        $input['image']=$imageName;
        $input['type'] = json_encode($request->type);
        $input['user_id']=Auth::user()->id;
       // $input['type']=$request->type->json_encode('type');

        Product::create($input);

        return redirect()-> route('admin.products.index')
            ->with('success','product created successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //dd($product);
      //$user = Auth::user();

       //$product = Product::find($id);
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

        return redirect()->route('admin.products.index')
            ->with('success','product updated successfully.');
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
}
