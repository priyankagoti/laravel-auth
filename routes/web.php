<?php

use App\Http\Controllers\ProductController;
use App\Models\Product;
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

/*Route::domain('blog.'.env('APP_URl'))->middleware(['auth'])->group(function (){
    Route::get('products', [ProductController::class, 'index'])->name('products.index');
    Route::get('products/create', function (){
        return view('products.create');
    })->name('products.create');
});*/
Route::name('admin.')->middleware(['auth'])->group(function(){
    Route::get('/products', [ProductController::class, 'index'])
        ->name('products.index');
});


    Route::get('/posts', function (){
        return view('products.posts',[
            'products'=> Product::latest()->get()
        ]);
    })->name('posts');

Route::get('products/create', function (){
    return view('products.create');
})->middleware(['auth'])->name('products.create');

Route::post('products', [ProductController::class, 'store'])
    ->middleware(['auth'])->name('products.store');

Route::get('products/{product}/edit', [ProductController::class, 'edit'])
    ->middleware(['auth'])->name('products.edit');

Route::put('products/{product}/edit', [ProductController::class, 'update'])
    ->middleware(['auth']);

Route::get('products/{product}/{id}/{name}', [ProductController::class, 'show'])
    ->middleware(['auth'])->name('products.show');

Route::delete('products/{product}', [ProductController::class, 'destroy'])
    ->middleware(['auth'])->name('products.destroy')->where('product','[0-9]+');


require __DIR__.'/auth.php';
