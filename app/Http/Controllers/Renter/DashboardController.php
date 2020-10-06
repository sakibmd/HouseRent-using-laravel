<?php

namespace App\Http\Controllers\Renter;

use App\Booking;
use App\Area;
use App\House;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        $houses = House::where('user_id', Auth::id())->latest()->get();
        $areas = Area::latest()->get();
        $renters = User::where('role_id', 3)->get();
        $landlords = User::where('role_id', 2)->get();
        return view('renter.dashboard', compact('renters', 'houses', 'areas', 'landlords'));
    }

    public function areas(){
        $areas = Area::latest()->paginate(8);
        $areacount = Area::all()->count();
        return view('renter.area.index', compact('areas', 'areacount'));
    }



    public function allHouses(){
        $houses = House::latest()->paginate(8);
        $housecount = House::all()->count();
        return view('renter.house.index', compact('houses', 'housecount'));
    }

    public function housesDetails($id){
        $house = House::find($id);
        return view('renter.house.show', compact('house')); 
    }










    public function bookingHistory(){
        $books = Booking::where('renter_id', Auth::id())->where('booking_status', " ")->get();
        return view('renter.booking.history', compact('books'));
    }

    public function bookingPending(){
        $books = Booking::where('renter_id', Auth::id())->where('booking_status', "requested")->get();
        return view('renter.booking.pending', compact('books'));
    }

    public function cancelBookingRequest($id){
        Booking::find($id)->delete();

        session()->flash('success', 'Booking Request Removed Successfully');
        return redirect()->back();
    }
}
