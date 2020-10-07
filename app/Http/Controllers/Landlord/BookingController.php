<?php

namespace App\Http\Controllers\Landlord;

use App\Booking;
use App\House;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function bookingRequestListForLandlord(){
        $books = Booking::where('landlord_id', Auth::id())->where('booking_status', 'requested')->get();
        return view('landlord.booking.requested', compact('books'));
    }

    public function bookingRequestAccept($id){

        $book = Booking::findOrFail($id);


        if(Booking::where('address', $book->address)->where('booking_status', "booked")->count() > 0){
            session()->flash('danger', 'This house is already booked. Please cancel his/her booking request');
            return redirect()->back(); 
        }


        $house = House::where('address', $book->address)->first();
        $house->status = 0;
        $house->save();


        $book->leave = "Currently Staying";
        $book->booking_status = "booked";
        $book->save();

        session()->flash('success', 'Booking Accepted Successfully');
        return redirect()->back(); 
    }

    public function bookingRequestReject($id){
        Booking::find($id)->delete();

        session()->flash('success', 'Booking Rejected Successfully');
        return redirect()->back(); 

    }


    public function bookingHistory(){
        $books = Booking::where('landlord_id', Auth::id())->where('booking_status', '!=', 'requested')->get();
        return view('landlord.booking.history', compact('books'));
    }

    public function leaveRenter($id){
        $book = Booking::findOrFail($id);

        $house = House::where('address', $book->address)->first();
        $house->status = 1;
        $house->save();

        $now = Carbon::now();
        $now = $now->format('F d, Y');

        $book->leave = $now;
        $book->booking_status = "";
        $book->save();

        session()->flash('success', 'Renter Leave Successfully');
        return redirect()->back(); 
    }
}
