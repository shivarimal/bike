<?php

namespace App\Http\Controllers;

use App\Models\Bike;
use Illuminate\Http\Request;

class BikeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Bike::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'size' =>'required|string|max:255',
            'brand' =>'required|string|max:255',
            'model' =>'required|string|max:255',
            'color' =>'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
         //   'status' => 'string|in:available,rented,maintenance',
            'image_url' => 'nullable|string|url'
        ]);

        $bike = Bike::create($validated);
        return response()->json($bike, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Bike $bike)
    {
        return response()->json($bike);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bike $bike)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bike $bike)
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'type' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'sometimes|required|numeric|min:0',
            'status' => 'sometimes|required|string|in:available,rented,maintenance',
            'image_url' => 'nullable|string|url'
        ]);

        $bike->update($validated);
        return response()->json($bike);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bike $bike)
    {
        $bike->delete();
        return response()->json(null, 204);
    }
}
