<?php

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
    return view('index');
});

Route::get('/zip/', function () {
    return response()->download('/home/muratsalakhov/Загрузки/Desktop (2)/program.zip');
});

// Выдача изображений
Route::get('/data/{id}/{name}', function ($id, $name) {
    $programPath = storage_path() . '/app/public/' . $id . '/';

    try {
        return response(file_get_contents($programPath . 'images-webp/' . $name . '.webp'), 200)->header('Content-Type', 'image/webp');
    } catch (Throwable $e) {}

    try {
        return response(file_get_contents($programPath . 'images-png/' . $name), 200)->header('Content-Type', 'image/png');
    } catch (Throwable $e) {}

    return response(array("status" => "File not found"), 404)->header('Content-Type', 'application/json');
});
