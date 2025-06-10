<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;

class HomeController extends Controller
{
    public function index()
    {
        $cars = Car::get();
        dump($cars);
        return view('home.index');
    }
}
