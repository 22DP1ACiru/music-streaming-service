<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use App\Http\Resources\PlaylistResource;
use Illuminate\Http\Request;

class PlaylistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $playlists = Playlist::all();

        return PlaylistResource::collection($playlists);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $playlist = Playlist::create($request->all());

        return response()->json($playlist, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(PlaylistResource::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $playlist = Playlist::findOrFail($id);

        if ($request->User()->id !== $playlist->owner) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        $playlist->update($request->all());

        return response()->json($playlist);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $playlist = Playlist::findOrFail($id);
        $playlist->delete();

        return response()->json(['message' => 'Playlist deleted successfully']);
    }
}
