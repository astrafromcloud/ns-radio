<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Song;
use Illuminate\Http\Request;

class SongController extends Controller
{
    public function index()
    {
        return Song::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'artist' => 'required|string',
            'rank' => 'nullable|integer',
            'image_url' => 'nullable|string',
            'likes' => 'integer'
        ]);

        $song = Song::create($request->all());
        return response()->json($song, 201);
    }

    public function show(Song $song)
    {
        return $song;
    }

    public function update(Request $request, Song $song)
    {
        $request->validate([
            'title' => 'string',
            'artist' => 'string',
            'rank' => 'integer',
            'image_url' => 'string',
            'likes' => 'integer'
        ]);

        $song->update($request->all());
        return response()->json($song, 200);
    }

    public function destroy(Song $song)
    {
        $song->delete();
        return response()->json(null, 204);
    }
}
