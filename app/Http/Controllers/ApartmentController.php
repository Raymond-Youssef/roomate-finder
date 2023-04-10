<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use Illuminate\Http\Request;

class ApartmentController extends Controller
{

    /**
     * Display a listing of users.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $apartments = Apartment::all();
        return response()->json($apartments);
    }


    /**
     * Store a newly created user in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $params = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'address' => 'required',
            'price' => 'required|integer',
            'bedrooms' => 'required|integer',
            'bathrooms' => 'required|integer',
            'square_meters' => 'required|numeric',
        ]);

        $apartment = auth()->user()->apartments()->create($params);

        return response()->json($apartment, 201);
    }


    /**
     * Display the specified user.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Apartment $apartment)
    {
        return response()->json($apartment);
    }

    /**
     * Update the specified user in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, int $apartment)
    {
        $params = $request->validate([
            'title' => 'string',
            'description' => 'string',
            'address' => 'string',
            'price' => 'integer',
            'bedrooms' => 'integer',
            'bathrooms' => 'integer',
            'square_meters' => 'numeric',
        ]);


        $apartment = auth()->user()->apartments()->findOrFail($apartment);
        $apartment->update($params);

        return response()->json($apartment);
    }


    /**
     * Remove the specified user from the database.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Apartment $apartment)
    {
        $apartment->delete();
        return response()->json($apartment, 204);
    }
}
