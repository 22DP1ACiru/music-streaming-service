<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'genre',
        'song_file',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function albums()
    {
        return $this->belongsToMany(Album::class, 'album_songs', 'song_id', 'album_id');
    }

    public function playlists()
    {
        return $this->belongsToMany(Playlist::class, 'playlist_songs', 'song_id', 'playlist_id');
    }
}
