<?php

namespace App\Http\Controllers;

use App\Models\Village;
use Illuminate\Http\Request;

class VillageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $villages = Village::all();

        return response()->json([
            'villages' => $villages,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'district_id' => ['required', 'numeric'],
        ]);

        Village::create($request->all());

        return response()->json([
            'message' => 'Successfully created a new village.',
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Village $village)
    {
        return response()->json([
            'village' => $village,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Village $village)
    {
        $request->validate([
            'name' => ['required'],
            'district_id' => ['required', 'numeric'],
        ]);

        $village->update($request->all());

        return response()->json([
            'message' => 'Successfully updated village.',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Village $village)
    {
        $village->delete();

        return response()->json([
            'message' => 'Successfully deleted village.',
        ]);
    }
}
