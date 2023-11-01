<?php

use App\Http\Controllers\AdminController;
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



Route::prefix('admin')->group(function () {
    Route::view('/','admin.login')->name('admin.login');
    Route::post('auth',[AdminController::class,'auth'])->name('admin.auth');
    Route::middleware(['admin_auth'])->group(function () {
        Route::get('home', [AdminController::class,'home'])->name('admin.home');
        Route::get('logout', [AdminController::class, 'logout'])->name('admin.logout');
        Route::view('profile', 'admin.profile')->name('admin.profile');
        Route::post('update',[AdminController::class,'update'])->name('admin.update');

//        Pr exam control
        Route::get('pr-exam-days', [AdminController::class, 'pr_exam_days'])->name('admin.pr_exam_days');
        Route::post('new-exam-day', [AdminController::class, 'new_pr_exam'])->name('admin.new.pr.exam');
        Route::get('exam-day/{id?}', [AdminController::class, 'pr_exam'])->name('admin.pr.exam');
    });
});
