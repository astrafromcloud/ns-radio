<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Guest;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function index()
    {
        $guests = Guest::all(); // Retrieve all guests
        return response()->json($guests);
    }

    public function show($id)
    {
        $guest = Guest::findOrFail($id); // Retrieve guest by ID
        return view('guests.show', compact('guest')); // Pass guest to the view
    }

    public function create()
    {
        return view('guests.create'); // Show form for creating a new guest
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image_url' => 'required|url',
            'views' => 'integer',
            'hashtag' => 'nullable|string|max:255',
        ]);

        Guest::create($request->all()); // Create a new guest
        return redirect()->route('guests.index'); // Redirect to guests index
    }

    public function edit($id)
    {
        $guest = Guest::findOrFail($id); // Retrieve guest for editing
        return view('guests.edit', compact('guest')); // Pass guest to the view
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image_url' => 'required|url',
            'views' => 'integer',
            'hashtag' => 'nullable|string|max:255',
        ]);

        $guest = Guest::findOrFail($id);
        $guest->update($request->all()); // Update guest
        return redirect()->route('guests.index'); // Redirect to guests index
    }

    public function destroy($id)
    {
        $guest = Guest::findOrFail($id);
        $guest->delete(); // Delete guest
        return redirect()->route('guests.index'); // Redirect to guests index
    }
}
