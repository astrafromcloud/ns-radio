<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    // Display a listing of the contacts
    public function index()
    {
        $contacts = Contact::all();
        return response()->json($contacts);
    }

    // Show the form for creating a new contact
    public function create()
    {
        return view('contacts.create'); // Adjust the view path as needed
    }

    // Store a newly created contact in storage
    public function store(Request $request)
    {
        $request->validate([
            'phone_1' => 'required|string|max:15',
            'phone_2' => 'nullable|string|max:15',
            'phone_3' => 'nullable|string|max:15',
            'address' => 'required|string',
            'email' => 'nullable|email',
            'instagram_url' => 'nullable|url',
            'youtube_url' => 'nullable|url',
            'whatsapp_url' => 'nullable|url',
            'telegram_url' => 'nullable|url',
        ]);

        Contact::create($request->all());
        return redirect()->route('contacts.index')->with('success', 'Contact created successfully.');
    }

    // Show the specified contact
    public function show(Contact $contact)
    {
        return view('contacts.show', compact('contact')); // Adjust the view path as needed
    }

    // Show the form for editing the specified contact
    public function edit(Contact $contact)
    {
        return view('contacts.edit', compact('contact')); // Adjust the view path as needed
    }

    // Update the specified contact in storage
    public function update(Request $request, Contact $contact)
    {
        $request->validate([
            'phone_1' => 'required|string|max:15',
            'phone_2' => 'nullable|string|max:15',
            'phone_3' => 'nullable|string|max:15',
            'address' => 'required|string',
            'email' => 'nullable|email',
            'instagram_url' => 'nullable|url',
            'youtube_url' => 'nullable|url',
            'whatsapp_url' => 'nullable|url',
            'telegram_url' => 'nullable|url',
        ]);

        $contact->update($request->all());
        return redirect()->route('contacts.index')->with('success', 'Contact updated successfully.');
    }

    // Remove the specified contact from storage
    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->route('contacts.index')->with('success', 'Contact deleted successfully.');
    }
}
