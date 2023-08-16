<?php

namespace App\Http\Controllers\Front;

use App\Models\Car;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Type;

class CatalogController extends Controller
{
    public function index()
    {
        $cars = Car::with(['type'])->get();
        $types = Type::all();

        return view('front.catalog', [
            'cars' => $cars,
            'types' => $types
        ]);
    }

    public function type($type)
    {
        $types = Type::all();
        $type = Type::where('slug', $type)->firstOrFail();
        $cars = Car::with('type')->where('type_id', $type->id)->paginate(5);

        return view('front.catalog', [
            'cars' => $cars,
            'types' => $types
        ]);
    }
}
