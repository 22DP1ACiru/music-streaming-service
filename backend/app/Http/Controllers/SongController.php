<?php

namespace App\Http\Controllers;

use App\Models\Song;
use App\Http\Resources\SongResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SongController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $songs = Song::all();
        
        return SongResource::collection($songs);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
            'song_file' => 'required|file|mimes:mp3,wav,flac|max:102400', // 100MB max
        ]);

        $path = $request->file('song_file')->store('songs', 'public');

        $song = Song::create([
            'user_id' => $request->user()->id,
            'name' => $request->name,
            'genre' => $request->genre,
            'song_file' => $path,
        ]);


        return response()->json($song, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(Song::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $song = Song::findOrFail($id);
        
        if ($request->User()->id !== $song->artist) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $song->update($request->all());

        return response()->json($song);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $song = Song::findOrFail($id);
        Storage::disk('public')->delete($song->song_file);
        $song->delete();

        return response()->json(['message' => 'Song deleted successfully']);
    }
}
