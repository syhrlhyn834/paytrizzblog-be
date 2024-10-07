<?php

use Illuminate\Support\Facades\Route;

//group route with prefix "admin"
Route::prefix('admin')->group(function () {

    //route login
    Route::post('/login', [App\Http\Controllers\Api\Admin\LoginController::class, 'index']);

    //group route with middleware "auth"
    Route::group(['middleware' => 'auth:api'], function() {

        //data user
        Route::get('/user', [App\Http\Controllers\Api\Admin\LoginController::class, 'getUser']);

        //refresh token JWT
        Route::get('/refresh', [App\Http\Controllers\Api\Admin\LoginController::class, 'refreshToken']);

        //logout
        Route::post('/logout', [App\Http\Controllers\Api\Admin\LoginController::class, 'logout']);

        //Category
        Route::apiResource('/categories', App\Http\Controllers\Api\Admin\CategoryController::class);

        //Posts
        Route::apiResource('/posts', App\Http\Controllers\Api\Admin\PostController::class);

        //Menus
        Route::apiResource('/menus', App\Http\Controllers\Api\Admin\MenuController::class);

        //headers
        Route::apiResource('/headers', App\Http\Controllers\Api\Admin\HeaderController::class);

        //footers
        Route::apiResource('/footers', App\Http\Controllers\Api\Admin\FooterController::class);

        //sosmeds
        Route::apiResource('/sosmeds', App\Http\Controllers\Api\Admin\SosmedController::class);

        //Inboxes
        Route::apiResource('/inboxes', App\Http\Controllers\Api\Admin\InboxController::class);


        //dashboard
        Route::get('/dashboard', [App\Http\Controllers\Api\Admin\DashboardController::class, 'index']);

    });
});
//group route with prefix "web"
Route::prefix('web')->group(function () {

    //index categories
Route::get('/categories', [App\Http\Controllers\Api\Web\CategoryController::class, 'index']);

//show category
Route::get('/categories/{slug}', [App\Http\Controllers\Api\Web\CategoryController::class, 'show']);

//index posts
Route::get('/posts', [App\Http\Controllers\Api\Web\PostController::class, 'index']);

//show posts
Route::get('/posts/{slug}', [App\Http\Controllers\Api\Web\PostController::class, 'show']);

//store image
Route::post('/posts/storeImage', [App\Http\Controllers\Api\Web\PostController::class, 'storeImagePost']);

//posts homepage
Route::get('/postHomepage', [App\Http\Controllers\Api\Web\PostController::class, 'postHomepage']);

//index menus
Route::get('/menus', [App\Http\Controllers\Api\Web\MenuController::class, 'index']);

//index menus
Route::get('/footers', [App\Http\Controllers\Api\Web\FooterController::class, 'index']);

//index menus
Route::get('/headers', [App\Http\Controllers\Api\Web\HeaderController::class, 'index']);

//index menus
Route::get('/sosmeds', [App\Http\Controllers\Api\Web\SosmedController::class, 'index']);

//Index Inboxes
Route::post('/inboxes/storeInbox', [App\Http\Controllers\Api\Web\InboxController::class, 'storeInboxInboxes']);


});
