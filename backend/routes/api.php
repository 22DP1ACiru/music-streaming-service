<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\AlbumSongController;
use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\PlaylistSongController;
use App\Http\Controllers\SongController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::resources([
    'users' => UserController::class,
    'albums' => AlbumController::class,
    'songs' => SongController::class,
    'playlists' => PlaylistController::class,
    'albumsongs' => AlbumSongController::class,
    'playlistsongs' => PlaylistSongController::class,
]);