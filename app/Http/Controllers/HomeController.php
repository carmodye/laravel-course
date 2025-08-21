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
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index(Request $request)
    {

        $cars = Cache::remember('home-cars', 30, function () {
            return Car::where('published_at', '<', now())
                ->with([
                    'primaryImage',
                    'city',
                    'carType',
                    'fuelType',
                    'maker',
                    'model',
                    'favouredUsers'
                ])
                ->orderBy('published_at', 'desc')
                ->limit(30)
                ->get();
        });

        // Select latest published 30 cars and sort them by published_at date
        // $cars = Car::where('published_at', '<', now())
        //     ->with(['primaryImage', 'city', 'carType', 'fuelType', 'maker', 'model', 'favouredUsers'])
        //     ->orderBy('published_at', 'desc')
        //     ->limit(30)
        //     ->get();



        // foreach ($carsdb as $car) {
        //     $primaryImage = $car->primaryImage;
        //     if ($primaryImage && $primaryImage->image_path) {
        //         $cars[] = $car;
        //     } else {
        //         $noprimaryImage[] = $car->id;
        //     }
        // }
        // if (!empty($noprimaryImage)) {
        //     //dd($noprimaryImage);
        // }

        return view('home.index', ['cars' => $cars]);
    }
}
