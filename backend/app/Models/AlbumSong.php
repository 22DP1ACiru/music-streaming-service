<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AlbumSong extends Model
{
    protected $fillable = [
        'album_id',
        'song_id',
    ];
}
