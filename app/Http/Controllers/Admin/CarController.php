<?php

namespace App\Http\Controllers\Admin;

use App\Models\Car;
use App\Models\Type;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\CarRequest;
use App\Http\Controllers\Controller;
use App\Models\Booking;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Car::with(['type']);

            return DataTables::of($query)
            ->editColumn('thumbnail', function ($car) {
                return '<img src="'. $car->thumbnail .'" alt="Thumbnail" class="w-20 mx-auto rounded-md">';
            })
            ->addColumn('action', function ($car) {
                return '
                    <a class="block w-full px-2 py-1 mb-1 text-xs text-center text-white transition duration-500 bg-gray-700 border border-gray-700 rounded-md select-none ease hover:bg-gray-800 focus:outline-none focus:shadow-outline"
                        href="' . route('admin.cars.edit', $car->id) . '">
                        Sunting
                    </a>
                    <form class="block w-full" onsubmit="return confirm(\'Apakah anda yakin?\');" -block" action="' . route('admin.cars.destroy', $car->id) . '" method="POST">
                    <button class="w-full px-2 py-1 text-xs text-white transition duration-500 bg-red-500 border border-red-500 rounded-md select-none ease hover:bg-red-600 focus:outline-none focus:shadow-outline" >
                        Hapus
                    </button>
                        ' . method_field('delete') . csrf_field() . '
                    </form>';
            })
            ->rawColumns(['action', 'thumbnail'])
            ->make();
        }
        return view('admin.cars.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::all();

        return view('admin.cars.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CarRequest $request)
    {
        $data = $request->all();

         // upload multiple photos
        if ($request->hasFile('photos')){
            $photos = [];

            foreach ($request->file('photos') as $photo){
                $photoPath = $photo->store('assets/car', 'public');

                array_push($photos, $photoPath);
            }

            $data['photos'] = json_encode($photos);
        }

        $data['slug'] = Str::slug($data['name']) . '-' . Str::lower(Str::random(5));

        Car::create($data);

        return redirect()->route('admin.cars.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car)
    {
        $car->load('type');

        $types = Type::all();

        return view('admin.cars.edit', compact('car', 'types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CarRequest $request, Car $car)
    {
        $data = $request->all();

        if ($request->hasFile('photos')){
            $photos = [];

            foreach ($request->file('photos') as $photo){
                $photoPath = $photo->store('assets/item', 'public');

                array_push($photos, $photoPath);
            }

            $data['photos'] = json_encode($photos);
        } else {
            $data['photos'] = $car->photos;
        }

        $car->update($data);

        return redirect()->route('admin.cars.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        $car->delete();

        return redirect()->route('admin.cars.index');
    }
}
