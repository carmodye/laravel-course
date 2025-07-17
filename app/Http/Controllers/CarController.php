<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('car.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('car.create');
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
    public function show(Car $car)
    {
        return view('car.show', ['car' => $car]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car)
    {
        return view('car.edit', ['car' => $car]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Car $car)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *//**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        //
    }

    public function search(Request $request)
    {
       // Get the query builder instance with conditions
$query = Car::where('published_at', '<', now())
    ->orderBy('published_at', 'desc');

// Get total count of the cars
$carCount = $query->count();
// Select 30 cars
$carsdb = $query->limit(30)->get();

foreach ($carsdb as $car) {
    $primaryImage = $car->primaryImage;
    if ($primaryImage && $primaryImage->image_path) {
        $cars[] = $car;
    }
}

return view('car.search',  ['cars' => $cars, 'carCount' => $carCount]);

    }

}
