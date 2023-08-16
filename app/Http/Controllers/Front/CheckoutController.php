<?php

namespace App\Http\Controllers\Front;

use Carbon\Carbon;
use App\Models\Car;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CheckoutController extends Controller
{
    public function index(Request $request, $slug)
    {
        $car = Car::with(['type'])->whereSlug($slug)->firstOrFail();

        return view('front.checkout', [
            'car' => $car,
        ]);
    }

    public function store(Request $request, $slug)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'required',
            'end_date' => 'required',
            'address' => 'required',
        ]);
        // Format start_date and end_date from dd mm yyyy to timestamp
        $start_date = Carbon::createFromFormat('d m Y', $request->start_date);
        $end_date = Carbon::createFromFormat('d m Y', $request->end_date);

        // Count the number of days between start_date and end_date
        $days = $start_date->diffInDays($end_date);

        // Get the item
        $car = Car::whereSlug($slug)->firstOrFail();

        // Calculate the total price
        $total_price = $days * $car->price;

        // Add 10% tax
        $total_price = $total_price + ($total_price * 0.1);

        // Create a new booking
        $booking = $car->bookings()->create([
            'name' => $request->name,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'address' => $request->address,
            'user_id' => auth()->user()->id,
            'total_price' => $total_price
        ]);

        return redirect()->route('front.payment', $booking->id);
    }
}
