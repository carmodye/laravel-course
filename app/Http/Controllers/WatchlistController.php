<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Auth;
use Illuminate\Http\Request;

class WatchlistController extends Controller
{
    //
    public function index()
    {
        if (Auth::check()) {
            // User is authenticated
            $cars = Auth::user()
                ->favouriteCars()
                ->with(['primaryImage', 'city', 'carType', 'fuelType', 'maker', 'model'])
                ->paginate(15);

            return view('watchlist.index', ['cars' => $cars]); // Get the authenticated user
        } else {

            // User is not authenticated
            abort(403);
        }



    }


    public function storeDestroy(Car $car)
    {
        // Get the authenticated user
        $user = Auth::user();

        // Check if the current car is already added into favourite cars
        $carExists = $user->favouriteCars()->where('car_id', $car->id)->exists();

        // Remove if it exists
        if ($carExists) {
            $user->favouriteCars()->detach($car);

            return back()->with('success', 'Car was removed from watchlist');
        }

        // Add the car into favourite cars of the user
        $user->favouriteCars()->attach($car);
        return back()->with('success', 'Car was added to watchlist');
    }

}
