<?php

namespace App\Http\Controllers\Admin;

use App\Booking;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function bookedList(){
        $books = Booking::where('booking_status', '=', 'booked')->get();
        return view('admin.booking.booked', compact('books'));
    }


    public function historyList(){
        $books = Booking::where('booking_status', '!=', 'requested')->where('booking_status', '!=', 'booked')->get();
        return view('admin.booking.history', compact('books'));
    }
}
