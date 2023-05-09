<?php

use App\Http\Controllers\FileuploadController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/test', function () {
    return 'Hello World!';
});

Route::post('images', [FileuploadController::class, 'store']);
Route::get('images', [FileuploadController::class, 'list']);
Route::get('images/{id}', [FileuploadController::class, 'show']);
Route::delete('images/{id}', [FileuploadController::class, 'delete']);
Route::get('images/{id}/steg', [FileuploadController::class, 'steg']);
// Route to post images using user api token
Route::post('images/{token}', [FileuploadController::class, 'storeToken']);
 