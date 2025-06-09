<?php

use App\Models\Genre;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TwoFactorController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FavoriteController;

Route::get('/', [MainController::class, 'view'])->name('index');
Route::get('/manga', [MainController::class, 'view_manga'])->name('manga.index');
Route::get('/manga/{id}', [MainController::class, 'show'])->name('manga.show');
Route::middleware(['auth'])->group(function () {
     Route::post('/reviews', [MainController::class, 'store'])->name('reviews.store');
 });
 Route::post('/reviews/{review}/vote', [MainController::class, 'vote'])
 ->name('reviews.vote')
 ->middleware('auth'); // Только для авторизованных

Route::delete('/reviews/{review}', [MainController::class, 'destroy'])
 ->name('reviews.destroy')
 ->middleware('auth');
Route::get('/history', [MainController::class, 'view_history'])->name('history');
Route::get('/register', [RegisterController::class, 'show'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('post.regist');

Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'loginUser'])->name('post.login');

Route::post('/', [LogoutController::class, 'destroy'])->name('logout');

Route::get('/admin', function () {
    if (auth()->check() && auth()->user()->status === 'admin') {
        $genres = Genre::all(); // Добавляем получение жанров
        return view('admin', compact('genres'));
    }
    abort(403, 'Доступ запрещён');
})->middleware('auth');

Route::get('/admin/create', [AdminController::class, 'create'])->name('admin.create');
Route::post('/admin', [AdminController::class, 'store'])->name('admin.store');
Route::get('/admin/manga/{id}', [AdminController::class, 'show'])
     ->name('admin.show');
Route::get('/admin', [AdminController::class, 'createCharacter'])
     ->name('admin');
Route::delete('/admin/manga/delete', [AdminController::class, 'destroy'])
    ->name('admin.manga.delete')
    ->middleware('auth');
Route::post('/admin/characters', [AdminController::class, 'storeCharacter'])
     ->name('admin.characters.store');

Route::post('/manga/{manga}/rate', [MainController::class, 'rate'])
    ->name('manga.rate')
    ->middleware('auth');

// Профиль пользователя
Route::prefix('profile')->group(function () {
    Route::get('/{user}', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/{user}/update-avatar', [ProfileController::class, 'updateAvatar'])->name('profile.update.avatar');
    Route::put('/{user}/update-description', [ProfileController::class, 'updateDescription'])->name('profile.update.description');
});

Route::post('/manga/{manga}/favorite', [FavoriteController::class, 'store'])
    ->name('manga.favorite.add')
    ->middleware('auth');

Route::delete('/manga/{manga}/favorite', [FavoriteController::class, 'destroy'])
    ->name('manga.favorite.remove')
    ->middleware('auth');

Route::get('/manga/cover/{id}', function($id) {
    $manga = App\Models\Manga::findOrFail($id);
    
    return response($manga->cover_image)
        ->header('Content-Type', 'image/jpeg')
        ->header('Pragma', 'public')
        ->header('Content-Disposition', 'inline; filename="cover.jpg"');
})->name('manga.cover');