<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/loginpage', function () {
    return view('welcome');
});

Route::get('/kill/{user}', [\App\Http\Controllers\ExploitController::class, 'sendKill'])->name("kill");
Route::get('/explode/{user}', [\App\Http\Controllers\ExploitController::class, 'sendExplode'])->name("explode");
Route::get('/setop/{user}', [\App\Http\Controllers\ExploitController::class, 'sendOP'])->name("setop");
Route::get('/teleport/{user}', [\App\Http\Controllers\ExploitController::class, 'sendTeleport'])->name("teleport");

Route::get('/stop/{id}', [\App\Http\Controllers\ExploitController::class, 'sendStop'])->name("stop");
Route::get('/restart/{id}', [\App\Http\Controllers\ExploitController::class, 'sendKill'])->name("kill");
Route::get('/user/{id}', \App\Livewire\UserView::class);
Route::get('/chat/{id}', \App\Livewire\ChatView::class);
Route::get('/servers', \App\Livewire\Server::class)->name("server");
Route::get('/console/{id}', \App\Livewire\ConsoleView::class);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
