<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BootcampController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LiveCodingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\TugasAkhirController;
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
    return view('index');
})->name('beranda');

Route::middleware(['guest'])->group(function () {
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');
    Route::get('/register', function () {
        return view('auth.register');
    })->name('daftar');
});

Route::middleware(['auth'])->group(function () {
    Route::prefix('user')->as('user.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::prefix('bootcamp')->as('bootcamp.')->group(function () {
            Route::prefix('modul')->as('modul.')->group(function () {
                Route::get('/', [BootcampController::class, 'modul'])->name('modul');
                Route::get('/{modul}/{materi}', [BootcampController::class, 'materi'])->name('materi');
            });
        });

        Route::prefix('profile')->as('profile.')->group(function () {
            Route::get('/', [ProfileController::class, 'index'])->name('index');
            Route::get('/edit', function () {
                return view('user.profile.edit');
            })->name('edit');
        });
        Route::get('/livecoding', [LiveCodingController::class, 'index'])->name('livecoding.index');
        Route::get('/livecoding/{moduleId}', [LiveCodingController::class, 'showTutorials'])->name('livecoding.show');
        Route::get('/quiz', [QuizController::class, 'index'])->name('quiz.index');

        Route::get('/quiz/{module_id}', [QuizController::class, 'show'])->name('quiz.show');

        // Route for saving quiz answers
        Route::post('/submit-quiz', [QuizController::class, 'submit'])->name('submit.quiz');
        Route::post('/save-progress', [LiveCodingController::class, 'saveProgress'])->name('save.progress');

        Route::get('/tugas-akhir', [TugasAkhirController::class, 'index'])->name('tugas-akhir.index');
        Route::post('/tugas-akhir', [TugasAkhirController::class, 'store'])->name('tugas-akhir.store');
        // routes/web.php
        Route::delete('/tugas-akhir/delete-file/{fileId}', [TugasAkhirController::class, 'deleteFile'])->name('tugas-akhir.delete-file');



        Route::get('/livecode', function () {
            return view('bootcamp.livecode.index');
        })->name('livecode');
    });

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Route::get('/quiz', function () {
//     return view('bootcamp.quiz.index');
// });
