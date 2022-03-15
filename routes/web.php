<?php

use App\Http\Controllers\ProductController;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::view('/dashboard','dashboard')->middleware(['auth'])->name('dashboard');

//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth'])->name('dashboard');

//Route::resource('products', ProductController::class);

Route::name('admin.')->middleware(['auth'])->group(function(){
    Route::get('/products', [ProductController::class, 'index'])
        ->name('products.index');
});

Route::get('/posts', function (User $user){
    $user = Auth::user();
    return view('products.posts',[
        'products'=> $user->products
    ]);
})->middleware(['auth'])->name('posts');

Route::middleware(['auth','checkType'])->group(function (){
    Route::get('/posts/{product}', function (Product $product){
        return view('products.post',[
            'product'=> $product
        ]);
    })->name('posts.post');

    Route::get('products/create', function (){
        return view('products.create');
    })->name('products.create')->withoutMiddleware('checkType');

    Route::post('products', [ProductController::class, 'store'])
        ->name('products.store');

    Route::get('products/{product}/edit', [ProductController::class, 'edit'])
        ->name('products.edit');

    Route::put('products/{product}/edit', [ProductController::class, 'update'])
        ->middleware(['auth']);

    Route::get('products/{product}', [ProductController::class, 'show'])
        ->name('products.show')->missing(function (Request $request) {
            return Redirect::route('admin.products.index');
        });

    Route::delete('products/{product}', [ProductController::class, 'destroy'])
        ->name('products.destroy')->where('product','[0-9]+');
});



//Route::match(['get', 'delete'], 'products/{product}',[ProductController::class,'show','destroy']);
Route::fallback(function () {
    return view('dashboard');
});
require __DIR__.'/auth.php';
