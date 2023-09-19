<?php

namespace App\Http\Controllers;

use App\Models\Regency;
use Illuminate\Http\Request;

class RegencyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $q = $request->query('q', false);

        $regencies = Regency::when($q, function ($query) use ($q) {
            $query->where('name', 'LIKE', "%{$q}%");
        })->get();

        return response()->json([
            'regencies' => $regencies,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'province_id' => ['required', 'numeric'],
        ]);

        Regency::create($request->all());

        return response()->json([
            'message' => 'Successfully created a new regency.',
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Regency $regency)
    {
        return response()->json([
            'regency' => $regency,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Regency $regency)
    {
        $request->validate([
            'name' => ['required'],
            'province_id' => ['required', 'numeric'],
        ]);

        $regency->update($request->all());

        return response()->json([
            'message' => 'Successfully updated regency.',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Regency $regency)
    {
        $regency->delete();

        return response()->json([
            'message' => 'Successfully deleted regency.',
        ]);
    }

    public function districts(Regency $regency)
    {
        $districts = $regency->districts;

        return response()->json([
            'districts' => $districts,
        ]);
    }
}
