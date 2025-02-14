<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('config:cache');
    Artisan::call('route:clear');
    Artisan::call('optimize:clear');
    Artisan::call('config:cache');
       Artisan::call('key:generate');
       echo  $exitCode;
    // return what you want
});
Route::get('/link', function() {
    $fromFolder = storage_path("app/public");
    $toFolder = $_SERVER['DOCUMENT_ROOT'].'/storage';
    if(!File::exists($toFolder)) {
        symlink($fromFolder, $toFolder);
        return redirect(route('index'));
    }
    return ('Storage folder already exist in public_html, delete Storage folder and refresh');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

Route::get('/ward/{id}', [HomeController::class, 'warddashboard'])->name('ward.dashboard');
Route::get('/house/{id}', [HomeController::class, 'familydashboard'])->name('house.dashboard');
Route::get('/familyMemberReport', [HomeController::class, 'familyMemberReport'])->name('familyMemberReport');

});


require __DIR__.'/auth.php';
