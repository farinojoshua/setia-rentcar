<?php

namespace App\Http\Controllers\Front;

use App\Models\Car;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $cars = Car::with(['type'])->latest()->take(4)->get()->reverse();

        return view('front.home', [
            'cars' => $cars,
        ]);
    }
}
