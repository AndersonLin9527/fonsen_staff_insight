<?php

use Illuminate\Support\Facades\Route;

// Guest (未登入)
Route::middleware('guest')->group(function () {
    Route::get('/loginPage', [App\Http\Controllers\Auth\LoginController::class, 'loginPage'])
        ->name('frontend.loginPage');

    Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])
        ->name('frontend.login');
});

// Auth (已登入)
Route::match(['get', 'post'], '/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('frontend.logout');

// Member 區（一般員工）
Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('welcome');
    })->name('frontend.home');
});

// ----------------------

// ----------------------
//Route::middleware('auth')->group(function () {
//
//    Route::get('/', [DashboardController::class, 'index'])
//        ->name('dashboard');
//
//    Route::get('/dashboard', [DashboardController::class, 'index']);
//
//    // 目前啟用的回饋（填寫）
//    Route::get('/feedback', [MemberFeedbackController::class, 'showForm'])
//        ->name('feedback.form');
//
//    Route::post('/feedback', [MemberFeedbackController::class, 'submit'])
//        ->name('feedback.submit');
//
//    // 目前啟用的回饋（個人結果）
//    Route::get('/feedback/result', [MemberFeedbackController::class, 'showResult'])
//        ->name('feedback.result');
//
//    // ※ 若未來要看歷史活動，可另外開：
//    // Route::get('/feedbacks', [MemberFeedbackController::class, 'index'])->name('feedback.index');
//    // Route::get('/feedbacks/{feedback}', [MemberFeedbackController::class, 'showSpecificForm'])->name('feedback.form.specific');
//    // Route::get('/feedbacks/{feedback}/result', [MemberFeedbackController::class, 'showSpecificResult'])->name('feedback.result.specific');
//});

// ----------------------
// Admin / Manager 區
// ----------------------
// 假設你之後實作一個 role:manager middleware，讓 administrator/boss/supervisor 可以看
//Route::prefix('admin')
//    ->middleware(['auth', 'role:manager']) // role:manager 先當作 placeholder
//    ->group(function () {
//
//        // 回饋活動管理
//        Route::get('/feedbacks', [AdminFeedbackController::class, 'index'])
//            ->name('admin.feedbacks.index');
//
//        Route::get('/feedbacks/create', [AdminFeedbackController::class, 'create'])
//            ->name('admin.feedbacks.create');
//
//        Route::post('/feedbacks', [AdminFeedbackController::class, 'store'])
//            ->name('admin.feedbacks.store');
//
//        Route::get('/feedbacks/{feedback}/edit', [AdminFeedbackController::class, 'edit'])
//            ->name('admin.feedbacks.edit');
//
//        Route::put('/feedbacks/{feedback}', [AdminFeedbackController::class, 'update'])
//            ->name('admin.feedbacks.update');
//
//        // 回饋結果總覽 / 個別員工細節
//        Route::get('/feedbacks/{feedback}/results', [AdminFeedbackResultController::class, 'summary'])
//            ->name('admin.feedbacks.results');
//
//        Route::get('/feedbacks/{feedback}/members/{member}', [AdminFeedbackResultController::class, 'memberDetail'])
//            ->name('admin.feedbacks.memberDetail');
//    });
