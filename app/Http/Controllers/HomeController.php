<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;

class HomeController extends Controller
{
    public function index()
    {
        // select all cars
        // $cars = Car::get();

        // select published cars
        //$cars = Car::where('published_at', operator: '=', value: null)->get();

        // select the first published car
        // $cars = Car::where('published_at', '!=', null)->first();

        /*        $car = new Car();
               $car->maker_id = 1;
               $car->model_id = 1;
               $car->year = 2024;
               $car->price = 20000;
               $car->vin = '999';
               $car->mileage = 5000;
               $car->car_type_id = 1;
               $car->fuel_type_id = 1;
               $car->user_id = 1;
               $car->city_id = 1;
               $car->address = 'Something';
               $car->phone = '999';
               $car->description = null;
               $car->published_at = now();
               $car->save();

               $cars = Car::get();
               dump($cars); */



        /* $car = Car::find(1);
        $car->price = 14000;
        $car->save(); */




        /*         $carData = [
                    'maker_id' => 1,
                    'model_id' => 1,
                    'year' => 2024,
                    'price' => 20000,
                    'vin' => '9999',
                    'mileage' => 5000,
                    'car_type_id' => 1,
                    'fuel_type_id' => 1,
                    'user_id' => 1,
                    'city_id' => 1,
                    'address' => 'Something',
                    'phone' => '999',
                    'description' => null,
                    'published_at' => now(),
                ];

                $car = Car::updateOrCreate(
                    ['vin_code' => 'NON_EXISTING', 'price' => 20000], // where condition
                    $carData // update or create data
                ); */


        $cars = Car::where('published_at', '=', null)
            ->where('user_id', 2)
            ->update(['published_at' => now()]);

        dump($cars);

        return view('home.index');
    }
}
