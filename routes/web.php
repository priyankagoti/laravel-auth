<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\InvokableController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Http\Request;

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

Route::get('/', [WelcomeController::class,'index']);

Route::view('/dashboard','dashboard')->middleware(['auth'])->name('dashboard');

/*Route::name('admin.')->middleware(['auth'])->group(function(){
    Route::get('/products', [ProductController::class, 'index'])
        ->name('products.index');
});*/


Route::middleware(['auth','signed'])->group(function (){
    Route::get('/products', [ProductController::class, 'index'])
        ->name('products.index')->withoutMiddleware(['signed']);
    Route::get('products/create', [ProductController::class,'create'])
        ->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])
        ->name('products.store');
    Route::get('products/{product}/edit', [ProductController::class, 'edit'])
        ->name('products.edit');
    Route::put('products/{product}/edit', [ProductController::class, 'update']);

    Route::get('products/{product}', [ProductController::class, 'show'])
        ->name('products.show');

    Route::get('products/download/{product}',[ProductController::class,'downloadImage'])
        ->name('products.download');

    Route::get('products/download-stream',[ProductController::class,'downloadStream'])
        ->name('products-stream.download');
    Route::delete('products/{product}', [ProductController::class, 'destroy'])
        ->name('products.destroy')->where('product','[0-9]+');
});

//Route::get('/{page}',[InvokableController::class,'__invoke']);

Route::resource('countries',CountryController::class);
Route::resource('cities',CityController::class);

Route::fallback(function () {
    return view('dashboard');
});
require __DIR__.'/auth.php';
