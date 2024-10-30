<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Http\Resources\AlbumResource;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $albums = Album::all();

        return AlbumResource::collection($albums);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $album = Album::create($request->all());

        return response()->json($album, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(AlbumResource::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $album = Album::findOrFail($id);

        if ($request->User()->id !== $album->artist) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        $album->update($request->all());

        return response()->json($album);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $album = Album::findOrFail($id);
        $album->delete();

        return response()->json(['message' => 'Album deleted successfully']);
    }
}
