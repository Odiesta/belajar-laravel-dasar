<?php

use App\Http\Controllers\FileController;
use App\Http\Controllers\HelloController;
use App\Http\Controllers\InputController;
use App\Http\Controllers\ResponseController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pzn', function () {
    return "Hello Programmer Zaman Now";
});

Route::redirect('/youtube', '/pzn');

Route::fallback(function () {
    return "404 by Programmer Zaman Now";
});

Route::view('/hello', 'hello', ['name' => 'Odis']);

Route::get('/hello-again', function () {
    return view('hello', ['name' => 'Odis']);
});

Route::view('/hello-world', 'hello.world', ['name' => 'Odis']);

Route::get('/products/{id}', function ($productId) {
    return "Products : $productId";
})->name('product.detail');

Route::get('/products/{product}/items/{item}', function ($productId, $itemId) {
    return "Products : $productId, Items : $itemId";
})->name('product.item.detail');

Route::get('/categories/{id}', function ($categoryId) {
    return "Categories : $categoryId";
})->where('id', '[0-9]+')->name('category.detail');

Route::get('/users/{id?}', function (string $userId = '404') {
    return "Users : $userId";
})->name('user.detail');

Route::get('conflict/odis', function () {
    return "Conflict odis ganteng";
});

Route::get('conflict/{name}', function (string $name) {
    return "Conflict $name";
});

Route::get('/produk/{id}', function ($id) {
    $link = route('product.detail', ['id' => $id]);
    return "Link $link";
});

Route::get('/product-redirect/{id}', function ($id) {
    return redirect()->route('product.detail', ['id' => $id]);
});

Route::get('/controller/hello/request', [HelloController::class, 'request']);
Route::get('/controller/hello/{name}', [HelloController::class, 'hello']);

Route::get('/input/hello', [InputController::class, 'hello']);

Route::post('/input/hello', [InputController::class, 'hello']);
Route::post('/input/hello/first', [InputController::class, 'helloFirstName']);
Route::post('/input/hello/input', [InputController::class, 'helloInput']);
Route::post('/input/hello/array', [InputController::class, 'arrayInput']);
Route::post('/input/type', [InputController::class, 'inputType']);

Route::post('/input/filter/only', [InputController::class, 'filterOnly']);
Route::post('/input/filter/except', [InputController::class, 'filterExcept']);
Route::post('/input/filter/merge', [InputController::class, 'filterMerge']);

Route::post('/file/upload', [FileController::class, 'upload']);

Route::get('/response/hello', [ResponseController::class, 'response']);
Route::get('/response/header', [ResponseController::class, 'header']);

Route::get('/response/type/view', [ResponseController::class, 'responseView']);
Route::get('/response/type/json', [ResponseController::class, 'responseJson']);
Route::get('/response/type/file', [ResponseController::class, 'responseFile']);
Route::get('/response/type/download', [ResponseController::class, 'responseDownload']);
