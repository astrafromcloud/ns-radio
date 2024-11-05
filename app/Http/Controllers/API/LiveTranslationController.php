<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\LiveTranslation;
use Illuminate\Http\Request;

class LiveTranslationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $liveTranslations = LiveTranslation::all();
        return response()->json($liveTranslations);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(LiveTranslation $liveTranslation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LiveTranslation $liveTranslation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LiveTranslation $liveTranslation)
    {
        //
    }
}
