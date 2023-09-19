<?php

namespace App\Http\Controllers;

use App\Models\Province;
use Illuminate\Http\Request;

class ProvinceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $q = $request->query('q', false);

        $provinces = Province::when($q, function ($query) use ($q) {
            $query->where('name', 'LIKE', "%{$q}%");
        })->paginate(25);

        return response()->json($provinces);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
        ]);

        Province::create($request->all());

        return response()->json([
            'message' => 'Successfully created a new province.',
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Province $province)
    {
        return response()->json([
            'province' => $province,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Province $province)
    {
        $request->validate([
            'name' => ['required'],
        ]);

        $province->update($request->all());

        return response()->json([
            'message' => 'Successfully updated province.',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Province $province)
    {
        $province->delete();

        return response()->json([
            'message' => 'Successfully deleted province.',
        ]);
    }

    public function regencies(Province $province)
    {
        $regencies = $province->regencies;

        return response()->json([
            'regencies' => $regencies,
        ]);
    }
}
