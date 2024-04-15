<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\HomeController;

use App\Models\ReviewsModel;
use App\Models\User;

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

Route::get('/', [MainController::class, 'main'])->name('main');
Route::get('/about', [MainController::class, 'about'])->name('about');

Route::get('/home', [HomeController::class, 'index'])->middleware(['auth', 'admin'])->name('home');


Route::get('/test', function() {
    $users = new User();
    $users = $users->all();
    foreach ($users as $user) {
        echo 'Имя пользователя: ' . $user->name . '<br>';

        foreach ($user->reviews as $review) {
            echo 'отзыв ' . $review->massage . '<br>';
        }
        echo '--------------------------------------';
        echo '<br>';
    }
});

Route::post('/test2', [MainController::class, 'live_search'])->name('live-search');



// Роуты отзывов
Route::get('/reviews', [MainController::class, 'reviews']) ->name('reviews');
Route::post('/reviews/check', [ MainController::class, 'reviews_check']);
Route::get('/reviews/{id}', [ MainController::class, 'show_one_reviews' ])->name('review-one');


Route::get('/search', [MainController::class, 'search']) ->name('search');

// Редактирование/удаление отзывов
Route::get('/reviews/{id}/edit}', [ MainController::class, 'review_edit' ])->name('review-edit');
Route::post('/reviews/{id}/edit}', [ MainController::class, 'review_edit_submit' ])->name('review-edit-submit');
Route::get('/reviews/{id}/delete}', [ MainController::class, 'delete_review' ])->name('review-delete');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';