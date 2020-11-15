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


        $renterContact = $book->renter->contact;
        $renterName = $book->renter->name;
        $houseAddress = $book->address;
        
//         $url = "http://66.45.237.70/api.php";
//         $number="$renterContact";
//         $text="Hello $renterName,
// Your Booking Request for Address: $houseAddress, has been ACCEPTED.

// Regards,
// House Rental";
//         $data= array(
//         'username'=>"01670605075",
//         'password'=>"Cefixime*58#",
//         'number'=>"$number",
//         'message'=>"$text"
//         );

//         $ch = curl_init(); // Initialize cURL
//         curl_setopt($ch, CURLOPT_URL,$url);
//         curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
//         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//         $smsresult = curl_exec($ch);
//         $p = explode("|",$smsresult);
//         $sendstatus = $p[0];



        $house->save();
        $book->leave = "Currently Staying";
        $book->booking_status = "booked";
        $book->save();

        session()->flash('success', 'Booking Accepted Successfully');
        return redirect()->back(); 
    }

    public function bookingRequestReject($id){

        $book = Booking::find($id);
        
        $renterContact = $book->renter->contact;
        $renterName = $book->renter->name;
        $houseAddress = $book->address;
        
//         $url = "http://66.45.237.70/api.php";
//         $number="$renterContact";
//         $text="Hello $renterName,
// Your Booking Request for Address: $houseAddress, has been REJECTED.

// Regards,
// House Rental";
//         $data= array(
//         'username'=>"01670605075",
//         'password'=>"Cefixime*58#",
//         'number'=>"$number",
//         'message'=>"$text"
//         );

//         $ch = curl_init(); // Initialize cURL
//         curl_setopt($ch, CURLOPT_URL,$url);
//         curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
//         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//         $smsresult = curl_exec($ch);
//         $p = explode("|",$smsresult);
//         $sendstatus = $p[0];
        
        
        
        
        $book->delete();

        session()->flash('success', 'Booking Rejected Successfully');
        return redirect()->back(); 

    }


    public function bookingHistory(){
        $books = Booking::where('landlord_id', Auth::id())->where('booking_status', '!=', 'requested')->where('booking_status', '!=', 'booked')->get();
        return view('landlord.booking.history', compact('books'));
    }

    public function currentlyStaying(){
        $books = Booking::where('landlord_id', Auth::id())->where('booking_status', '=', 'booked')->get();
        return view('landlord.booking.currentRenter', compact('books'));
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
