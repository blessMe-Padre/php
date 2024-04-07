<?php

use Illuminate\Support\Facades\Route;

// Action-синтаксис (не забудьте импортировать класс контроллера)
use App\Http\Controllers\MainController;


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

Route::get('/', [MainController::class, 'home'])->name('home');
Route::get('/about', [MainController::class, 'about'])->name('about');


// Роуты отзывов
Route::get('/reviews', [MainController::class, 'reviews']) ->name('reviews');
Route::post('/reviews/check', [ MainController::class, 'reviews_check']);
Route::get('/reviews/{id}', [ MainController::class, 'show_one_reviews' ])->name('review-one');

// Редактирование/удаление отзывов
Route::get('/reviews/{id}/edit}', [ MainController::class, 'review_edit' ])->name('review-edit');
Route::post('/reviews/{id}/edit}', [ MainController::class, 'review_edit_submit' ])->name('review-edit-submit');
Route::get('/reviews/{id}/delete}', [ MainController::class, 'delete_review' ])->name('review-delete');