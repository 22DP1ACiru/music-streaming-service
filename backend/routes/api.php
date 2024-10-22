<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\SongController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

route::resource('users', UserController::class);
route::resource('albums', AlbumController::class);
route::resource('songs', SongController::class);
route::resource('playlists', PlaylistController::class);

