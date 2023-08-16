<?php

namespace App\Http\Controllers\Front;

use Carbon\Carbon;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
        $user_id = Auth::id();
            // Gunakan $user_id untuk mengambil data booking berdasarkan user_id
            $bookings = Booking::where('user_id', $user_id)->get();

            // Menghilangkan jam pada format tanggal di bookings
            foreach ($bookings as $booking) {
                 $booking->date = Carbon::parse($booking->date)->format('d-m-Y');
            }


            // Lakukan operasi lain dengan $bookings
            return view('front.bookings', [
                'bookings' => $bookings,
            ]);
        } else {
           return view('auth.login');
        }
    }
}
