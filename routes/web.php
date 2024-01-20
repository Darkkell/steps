<?php

use App\Http\Controllers\ProfileController;
use App\Models\Tweet;
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
})->name('welcome');


Route::middleware('auth')->group(function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/tweets', function(){
        return view('tweets.index');
    })->name('tweets.index');
    Route::post('/tweets', function(){
        $tweet = request('tweet');
        //insert into db
        Tweet::create([
            'message'=>$tweet,
            'user_id'=> auth()->id()
        ]);
        return to_route('tweets.index')->with('status',  __('Tweet created'));
    });
});


require __DIR__.'/auth.php';
