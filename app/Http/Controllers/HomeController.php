<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Maker;
use App\Models\FuelType;
use App\Models\CarFeatures;
use App\Models\CarImage;
use App\Models\CarType;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {

$user = User::find(1);

// Add cars with IDs 1, 2, and 3 into favourites
//$user->favouriteCars()->attach([1, 2, 3]);
//$user->favouriteCars()->detach([1, 2]);
// Delete all cars from favourites
//$user->favouriteCars()->detach();

        return view('home.index');
    }
}
