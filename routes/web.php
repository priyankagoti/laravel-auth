<?php

use App\Http\Controllers\ProductController;
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

Route::resource('products', ProductController::class);

Route::get('products', [ProductController::class, 'index'])
        ->middleware(['auth'])->name('products.index');

//Route::get('products/create', [ProductController::class, 'create'])
//    ->middleware(['auth'])->name('products.create');
//Route::redirect('/products', '/products/create');

Route::get('products/create', function (){
    return view('products.create');
})->middleware(['auth'])->name('products.create');

Route::post('products', [ProductController::class, 'store'])
    ->middleware(['auth'])->name('products.store');

Route::get('products/{product}/edit', [ProductController::class, 'edit'])
    ->middleware(['auth'])->name('products.edit');

Route::put('products/{product}/edit', [ProductController::class, 'update'])
    ->middleware(['auth']);

Route::get('products/{id}', [ProductController::class, 'show'])
    ->middleware(['auth'])->name('products.show');

Route::delete('products/{product}', [ProductController::class, 'destroy'])
    ->middleware(['auth'])->name('products.destroy');


require __DIR__.'/auth.php';
