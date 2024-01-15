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
        Route::post('new-exam-section', [AdminController::class, 'new_pr_section'])->name('admin.new.pr.section');
        Route::post('delete-exam-section', [AdminController::class, 'delete_pr_section'])->name('admin.pr.section.delete');
        Route::get('exam-day/{id?}', [AdminController::class, 'pr_exam'])->name('admin.pr.exam');

//      Olympic control
        Route::get('olympic-exam-days', [AdminController::class, 'olympic_exam_days'])->name('admin.olympic_exam_days');
        Route::post('new-olympic-day', [AdminController::class, 'new_olympic_exam'])->name('admin.new.olympic.exam');


//        Pr exam quiz control
        Route::post('new-pr-exam-quiz', [AdminController::class, 'new_quiz_pr'])->name('admin.new.pr.quiz');
        Route::post('delete-pr-quiz', [AdminController::class, 'delete_pr_quiz'])->name('admin.pr.quiz.delete');
    });
});
