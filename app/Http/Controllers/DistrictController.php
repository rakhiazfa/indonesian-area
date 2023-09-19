<?php

namespace App\Http\Controllers;

use App\Models\District;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $q = $request->query('q', false);

        $districts = District::when($q, function ($query) use ($q) {
            $query->where('name', 'LIKE', "%{$q}%");
        })->paginate(25);

        return response()->json($districts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'regency_id' => ['required', 'numeric'],
        ]);

        District::create($request->all());

        return response()->json([
            'message' => 'Successfully created a new district.',
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(District $district)
    {
        return response()->json([
            'district' => $district,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, District $district)
    {
        $request->validate([
            'name' => ['required'],
            'regency_id' => ['required', 'numeric'],
        ]);

        $district->update($request->all());

        return response()->json([
            'message' => 'Successfully updated district.',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(District $district)
    {
        $district->delete();

        return response()->json([
            'message' => 'Successfully deleted district.',
        ]);
    }

    public function villages(District $district)
    {
        $villages = $district->villages;

        return response()->json([
            'villages' => $villages,
        ]);
    }
}
