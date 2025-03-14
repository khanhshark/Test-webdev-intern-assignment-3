<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentScoreController;


Route::get('/', function () {
    return view('dashboard');
});

Route::get('/search-scores', function () {
    return view('search-scores');
});

Route::get('/reports', function () {
    return view('reports');
});

Route::get('/settings', function () {
    return view('settings');
});
Route::post('/scores', [StudentScoreController::class, 'store']); // Thêm điểm
Route::get('/scores/{registration_number}', [StudentScoreController::class, 'checkScore']); // Kiểm tra điểm
Route::get('/scores/top10', [StudentScoreController::class, 'top10GroupA']); // Lấy top 10
Route::get('/search', [StudentScoreController::class, 'search'])->name('search');


Route::get('/reports', [StudentScoreController::class, 'report'])->name('reports');
Route::get('/export-scores', [StudentScoreController::class, 'export'])->name('export.scores');