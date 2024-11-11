<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\BroadcasterResource;
use App\Models\Broadcaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Broadcast;

class BroadcasterController extends Controller
{

    public function index()
    {
        $broadcasters = Broadcaster::all();
        $type = \App\Models\BroadcasterViewType::first();
        return response()->json([
            'type' => $type->type,
            'broadcasters' => new BroadcasterResource($broadcasters)
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'image_path' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'bio' => 'required|string',
            'instagram_url' => 'nullable|url',
            'youtube_url' => 'nullable|url',
            'whatsapp_url' => 'nullable|url',
            'telegram_url' => 'nullable|url',
        ]);

        Broadcaster::create($request->all());
        return redirect()->route('broadcasters.index');
    }

    public function show(Broadcaster $broadcaster)
    {
        return view('broadcasters.show', compact('broadcaster'));
    }


    public function update(Request $request, Broadcaster $broadcaster)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'bio' => 'required|string',
            'instagram_url' => 'nullable|url',
            'youtube_url' => 'nullable|url',
            'whatsapp_url' => 'nullable|url',
            'telegram_url' => 'nullable|url',
        ]);

        $broadcaster->update($request->all());
        return redirect()->route('broadcasters.index');
    }

    public function destroy(Broadcaster $broadcaster)
    {
        $broadcaster->delete();
        return redirect()->route('broadcasters.index');
    }
}
