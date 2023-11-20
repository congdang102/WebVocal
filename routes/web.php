<?php

use App\Http\Controllers\CategoryController;

use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\WordController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\StasticController;
use App\Http\Controllers\FolderController;
use App\Http\Controllers\FolderHistoryController;

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
    return view('auth.login');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::controller(UserController::class)->prefix('users')->group(function () {
        Route::get('', 'index')->middleware(['auth', 'admin'])->name('admin.users.index');
        Route::get('create', 'create')->middleware(['auth', 'admin'])->name('admin.users.create');
        Route::post('store', 'store')->middleware(['auth', 'admin'])->name('admin.users.store');
        Route::get('show/{id}', 'show')->middleware(['auth', 'admin'])->name('admin.users.show');
        Route::get('edit/{id}', 'edit')->middleware(['auth', 'admin'])->name('admin.users.edit');
        Route::put('edit/{id}', 'update')->middleware(['auth', 'admin'])->name('admin.users.update');
        Route::delete('destroy/{id}', 'destroy')->middleware(['auth', 'admin'])->name('admin.users.destroy');
    });
    Route::controller(CategoryController::class)->prefix('categories')->group(function () {
        Route::get('', 'index')->middleware(['auth', 'admin'])->name('admin.categories.index');
        Route::get('create', 'create')->middleware(['auth', 'admin'])->name('admin.categories.create');
        Route::post('store', 'store')->middleware(['auth', 'admin'])->name('admin.categories.store');
        Route::get('show/{id}', 'show')->middleware(['auth', 'admin'])->name('admin.categories.show');
        Route::get('edit/{id}', 'edit')->middleware(['auth', 'admin'])->name('admin.categories.edit');
        Route::put('edit/{id}', 'update')->middleware(['auth', 'admin'])->name('admin.categories.update');
        Route::delete('destroy/{id}', 'destroy')->middleware(['auth', 'admin'])->name('admin.categories.destroy');
    });
    Route::controller(SubCategoryController::class)->prefix('subcategories')->group(function () {
        Route::get('', 'index')->middleware(['auth', 'admin'])->name('admin.subcategories.index');
        Route::get('create', 'create')->middleware(['auth', 'admin'])->name('admin.subcategories.create');
        Route::post('store', 'store')->middleware(['auth', 'admin'])->name('admin.subcategories.store');
        Route::get('show/{id}', 'show')->middleware(['auth', 'admin'])->name('admin.subcategories.show');
        Route::get('edit/{id}', 'edit')->middleware(['auth', 'admin'])->name('admin.subcategories.edit');
        Route::put('edit/{id}', 'update')->middleware(['auth', 'admin'])->name('admin.subcategories.update');
        Route::delete('destroy/{id}', 'destroy')->middleware(['auth', 'admin'])->name('admin.subcategories.destroy');
    });
    Route::controller(TopicController::class)->prefix('topics')->group(function () {
        Route::get('', 'index')->middleware(['auth', 'admin'])->name('admin.topics.index');
        Route::get('create', 'create')->middleware(['auth', 'admin'])->name('admin.topics.create');
        Route::post('store', 'store')->middleware(['auth', 'admin'])->name('admin.topics.store');
        Route::get('show/{id}', 'show')->middleware(['auth', 'admin'])->name('admin.topics.show');
        Route::get('edit/{id}', 'edit')->middleware(['auth', 'admin'])->name('admin.topics.edit');
        Route::put('edit/{id}', 'update')->middleware(['auth', 'admin'])->name('admin.topics.update');
        Route::delete('destroy/{id}', 'destroy')->middleware(['auth', 'admin'])->name('admin.topics.destroy');
    });
    Route::controller(WordController::class)->prefix('words')->group(function () {
        Route::get('', 'index')->middleware(['auth', 'admin'])->name('admin.words.index');
        Route::get('create', 'create')->middleware(['auth', 'admin'])->name('admin.words.create');
        Route::post('store', 'store')->middleware(['auth', 'admin'])->name('admin.words.store');
        Route::get('show/{id}', 'show')->middleware(['auth', 'admin'])->name('admin.words.show');
        Route::get('edit/{id}', 'edit')->middleware(['auth', 'admin'])->name('admin.words.edit');
        Route::put('edit/{id}', 'update')->middleware(['auth', 'admin'])->name('admin.words.update');
        Route::delete('destroy/{id}', 'destroy')->middleware(['auth', 'admin'])->name('admin.words.destroy');
    });

    Route::controller(HomeController::class)->prefix('home')->group(function () {
        Route::get('', 'index')->name('home');
        Route::get('subcategory/{id}', 'showSubCategory')->name('subcategory');
        Route::get('topic/{id}', 'showTopic')->name('topic');
        Route::get('flashcard/{id}', 'showFlashCard')->name('flashcard');
        Route::get('review/{id}', 'showReview')->name('review');
    });
    Route::controller(SearchController::class)->prefix('search')->group(function () {
        Route::get('', 'search')->name('search');
    });
    Route::controller(StasticController::class)->prefix('statistics')->group(function () {
        Route::get('', 'statistics')->name('statistics');
    });
    Route::controller(HistoryController::class)->group(function () {
        Route::post('/save-history', 'store');
    });
   
    Route::controller(FolderController::class)->prefix('folder')->group(function () {
        Route::get('', 'showFolder')->name('folder');
        Route::get('folderflashcard', 'showFlashCard')->name('folderflashcard');
        Route::get('folderreview', 'showReview')->name('folderreview');
        Route::delete('destroy/{id}', 'destroy')->name('destroy');
    });
    Route::controller(FolderController::class)->group(function () {
        Route::post('/save-folder', 'store');
    });
    Route::controller(FolderHistoryController::class)->group(function () {
        Route::post('/save-folderhistory', 'store');
    });


});

require __DIR__.'/auth.php';
