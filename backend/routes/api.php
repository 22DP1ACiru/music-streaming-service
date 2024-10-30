<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\SongController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [UserController::class, 'logout']);

    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    

    Route::apiResources([
        'users' => UserController::class,
        'albums' => AlbumController::class,
        'songs' => SongController::class,
        'playlists' => PlaylistController::class,
    ]);
});
