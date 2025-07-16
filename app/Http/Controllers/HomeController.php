<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Maker;
use App\Models\Model;
use App\Models\FuelType;
use App\Models\CarFeatures;
use App\Models\CarImage;
use App\Models\CarType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Eloquent\Relations\HasOne;

class HomeController extends Controller
{
    public function index()
    {
        // Select latest published 30 cars and sort them by published_at date
        $carsdb = Car::where('published_at', '<', now())
            ->orderBy('published_at', 'desc')
            ->limit(30)
            ->get();

 //       $foundcars = [];

foreach ($carsdb as $car) {
    $primaryImage = $car->primaryImage;
    if ($primaryImage && $primaryImage->image_path) {
        $cars[] = $car;
    }
}


        //dd($car->primaryImage()->orderBy('position')->first()->image_path);
        //dd($cars); // Display the primary image path for the car
        return view('home.index', ['cars' => $cars]);
    }
}
