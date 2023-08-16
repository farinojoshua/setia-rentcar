<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Type;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    public function index($slug)
    {
        $car = Car::with(['type'])->whereSlug($slug)->firstOrFail();
        $similarCars = Car::where('type_id', $car->type_id)->where('id', '!=', $car->id)->get();
        $type = Type::where('id', $car->type_id)->firstOrFail();

        return view('front.detail', [
            'car' => $car,
            'similarCars' => $similarCars,
            'type' => $type,
        ]);
    }
}
