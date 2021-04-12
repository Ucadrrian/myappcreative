<?php
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function(){
    Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'getDashboard'])->name('dashboard');
    
    //Module Users
    Route::get('/users/{status}', [App\Http\Controllers\Admin\UserController::class, 'getUsers'])->name('users_list');
    Route::get('/users/{id}/edit', [App\Http\Controllers\Admin\UserController::class, 'getUserEdit'])->name('users_edit');
    Route::get('/user/{id}/banned', [App\Http\Controllers\Admin\UserController::class, 'getUserBanned'])->name('users_banned');
    Route::get('/user/{id}/permissions', [App\Http\Controllers\Admin\UserController::class, 'getUserPermissions'])->name('users_banned');

    //Module de Comics
    Route::get('/comics', [App\Http\Controllers\Admin\ComicsController::class, 'getHome'])->name('comics');
    Route::get('/comics/add', [App\Http\Controllers\Admin\ComicsController::class, 'getComicsAdd'])->name('comic_add');
    Route::get('/comics/{id}/edit', [App\Http\Controllers\Admin\ComicsController::class, 'getComicsEdit'])->name('comic_edit');
    Route::post('/comics/add', [App\Http\Controllers\Admin\ComicsController::class, 'postComicsAdd'])->name('comic_add');
    Route::post('/comics/{id}/edit', [App\Http\Controllers\Admin\ComicsController::class, 'postComicsEdit'])->name('comic_edit');
    Route::post('/comics/{id}/gallery/add', [App\Http\Controllers\Admin\ComicsController::class, 'postComicsGalleryAdd'])->name('comic_gallery_add');
    Route::get('/comics/{id}/gallery/{gid}/delete', [App\Http\Controllers\Admin\ComicsController::class, 'getComicsGalleryDelete'])->name('comic_gallery_delete');
    

    //module de categorias
    Route::get('/categories/{module}', [App\Http\Controllers\Admin\CategoryController::class, 'getHome'])->name('categories');
    Route::post('/category/add', [App\Http\Controllers\Admin\CategoryController::class, 'postCategoryAdd'])->name('category_add');
    Route::get('/category/{id}/edit', [App\Http\Controllers\Admin\CategoryController::class, 'getCategoryEdit'])->name('category_edit');
    Route::post('/category/{id}/edit', [App\Http\Controllers\Admin\CategoryController::class, 'postCategoryEdit'])->name('category_edit');
    Route::get('/category/{id}/delete', [App\Http\Controllers\Admin\CategoryController::class, 'getCategoryDelete'])->name('category_delete');

});
