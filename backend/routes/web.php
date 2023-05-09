<?php

use App\Http\Controllers\FileuploadController;
use App\Http\Controllers\ProfileController;
use App\Models\Fileupload;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/media', [FileuploadController::class, 'list'])->middleware(['auth', 'verified'])->name('media');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/api-token', [ProfileController::class, 'createToken'])->name('profile.api-token.create');
    Route::delete('/api-token', [ProfileController::class, 'deleteToken'])->name('profile.api-token.delete');
    Route::get('/media/{id}', [FileuploadController::class, 'show'])->name('media.id');
    Route::delete('/media/{id}', [FileuploadController::class, 'destroy'])->name('media.destroy');
});

require __DIR__ . '/auth.php';
