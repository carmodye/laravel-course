<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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
    $user = Auth::user();

    $carExists = $user->favouriteCars()->where('car_id', $car->id)->exists();

    if ($carExists) {
        $user->favouriteCars()->detach($car);

        return response()->json([
            'added' => false,
            'message' => 'Car was removed from watchlist'
        ]);
    }

    $user->favouriteCars()->attach($car);
    return response()->json([
        'added' => true,
        'message' => 'Car was added to watchlist'
    ]);
}
}
