<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCarRequest;
use App\Models\Car;
use App\Models\CarImage;
use App\Models\User;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Validator;
use Illuminate\Validation\Rules\File;



// filepath: c:\Users\carmo\Desktop\laravel-course\app\Http\Controllers\CarController.php

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $cars = User::find(1)
            ->cars()
            ->with(['primaryImage', 'maker', 'model'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('car.index', ['cars' => $cars]);
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
    //  */
    public function store(StoreCarRequest $request)
    {
        // Get request data
        $data = $request->validated();

        // Get only maker_id and model_id
        $data2 = $request->safe()->only(['maker_id', 'model_id']);

        // Get everything except published_at
        $data3 = $request->safe()->except(['published_at']);

        // Merge existing request data with user_id
        $data4 = $request->safe()->merge(['user_id' => Auth::id()]);


        // Get features data
        $featuresData = $data['features'];
        // Get images
        $images = $request->file('images') ?: [];

        // Set user ID
        $data['user_id'] = 1;
        // Create new car
        $car = Car::create($data);

        // Create features
        $car->features()->create($featuresData);

        // Iterate and create images
        foreach ($images as $i => $image) {
            // Save image on file system
            $path = $image->store('public/images');
            // Create record in the database
            $car->images()->create(['image_path' => $path, 'position' => $i + 1]);
        }

        // Redirect to car.index route
        return redirect()->route('car.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Car $car)
    {
        if (!$car->published_at) {
            abort(404);
        }
        return view('car.show', ['car' => $car]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car)
    {
        return view('car.edit');
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
     */
    public function destroy(Car $car)
    {
        //
    }


    /**
     * Summary of search
     * @param mixed $request
     * @return \Illuminate\Contracts\View\View
     */
    public function search(Request $request)
    {

        $maker = $request->integer('maker_id');
        $model = $request->integer('model_id');
        $carType = $request->integer('car_type_id');
        $fuelType = $request->integer('fuel_type_id');
        $state = $request->integer('state_id');
        $city = $request->integer('city_id');
        $yearFrom = $request->integer('year_from');
        $yearTo = $request->integer('year_to');
        $priceFrom = $request->integer('price_from');
        $priceTo = $request->integer('price_to');
        $mileage = $request->integer('mileage');
        $sort = $request->input('sort', '-published_at');



        $query = Car::where('published_at', '<', now())
            ->with(['primaryImage', 'city', 'carType', 'fuelType', 'maker', 'model']);

        if ($maker) {
            $query->where('maker_id', $maker);
        }
        if ($model) {
            $query->where('model_id', $model);
        }

        if ($state) {
            $query->join('cities', 'cities.id', '=', 'cars.city_id')
                ->where('cities.state_id', $state);
        }
        if ($city) {
            $query->where('city_id', $city);
        }

        if ($carType) {
            $query->where('car_type_id', $carType);
        }
        if ($fuelType) {
            $query->where('fuel_type_id', $fuelType);
        }
        if ($yearFrom) {
            $query->where('year', '>=', $yearFrom);
        }
        if ($yearTo) {
            $query->where('year', '<=', $yearTo);
        }
        if ($priceFrom) {
            $query->where('price', '>=', $priceFrom);
        }
        if ($priceTo) {
            $query->where('price', '<=', $priceTo);
        }
        if ($mileage) {
            $query->where('mileage', '<=', $mileage);
        }

        if (str_starts_with($sort, '-')) {
            $sortBy = substr($sort, 1);
            $query->orderBy($sortBy, 'desc');
        } else {
            $query->orderBy($sort);
        }


        $cars = $query->paginate(15)
            ->withQueryString();

        return view('car.search', ['cars' => $cars]);
    }


    public function watchlist()
    {
        $cars = User::find(4)
            ->favouriteCars()
            ->with(['primaryImage', 'city', 'carType', 'fuelType', 'maker', 'model'])
            ->paginate(15);

        return view('car.watchlist', ['cars' => $cars]);
    }
}
