<?php

use App\Http\Livewire\Users;
use App\Http\Livewire\Socials;
use App\Http\Livewire\Chat\Chat;
use App\Http\Livewire\Chat\Index;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::middleware('auth')->group(function (){

    Route::get('/chat', Index::class)->name('chat.index');
    Route::get('/chat/{query?}/{messageid?}', Chat::class)->name('chat');
    Route::get('/users', Users::class)->name('users');
    Route::get('/socials', Socials::class)->name('socials');
    

});


