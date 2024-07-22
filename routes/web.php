<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\RegisterController;
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
})->name('home');

Route::get('/register', [RegisterController::class, 'getRegister'])->name('auth.getRegister');
Route::post('register', [RegisterController::class, 'register'])->name('auth.register');
Route::get('/login', [LoginController::class, 'getLogin'])->name('auth.getLogin');
Route::post('/login', [LoginController::class, 'login'])->name('auth.login');
Route::post('/logout', [LoginController::class, 'logout'])->name('auth.logout');
Route::get('/quiz', [QuizController::class, 'index'])->name('quiz.index')->middleware('auth');
Route::get('/question/{id}', [QuizController::class, 'show'])->name('question.show')->middleware('auth');
