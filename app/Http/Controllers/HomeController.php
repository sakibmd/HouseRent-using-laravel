<?php

namespace App\Http\Controllers;

use App\Area;
use App\Booking;
use App\House;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $houses = House::where('status', 1)->latest()->paginate(6);
        $areas = Area::all();
        return view('welcome', compact('houses', 'areas'));
    }

    public function highToLow()
    {
        $houses = House::where('status', 1)->orderBy('rent', 'DESC')->paginate(6);
        $areas = Area::all();
        return view('welcome', compact('houses', 'areas'));
    }

    public function lowToHigh()
    {
        $houses = House::where('status', 1)->orderBy('rent', 'ASC')->paginate(6);
        $areas = Area::all();
        return view('welcome', compact('houses', 'areas'));
    }

    public function details($id){
        $house = House::findOrFail($id);
        return view('houseDetails', compact('house'));
    }

    public function allHouses(){
        $houses = House::latest()->where('status', 1)->paginate(12);
        return view('allHouses', compact('houses'));
    }

    public function areaWiseShow($id){
        $area = Area::findOrFail($id);
        $houses = House::where('area_id', $id)->get();
        return view('areaWiseShow', compact('houses', 'area'));
    }

    public function search(Request $request){
        
        $room = $request->room;
        $bathroom = $request->bathroom;
        $rent = $request->rent;
        $address = $request->address;
        

        if( $room == null && $bathroom == null && $rent == null && $address == null){
            session()->flash('search', 'Your have to fill up minimum one field for search');
            return redirect()->back();
        }

        $houses = House::where('rent', 'LIKE', $rent)
            ->where('number_of_toilet', 'LIKE', $bathroom)
            ->where('number_of_room', 'LIKE',  $room)
            ->where('address', 'LIKE', "%$address%")
            ->get();
        return view('search', compact('houses'));
    }

    public function searchByRange(Request $request){
        $digit1 =  $request->digit1;
        $digit2 =  $request->digit2;
        if($digit1 > $digit2){
            $temp = $digit1;
            $digit1 =  $digit2;
            $digit2 = $temp;
        }
        $houses = House::whereBetween('rent', [$digit1, $digit2])
                        ->orderBy('rent', 'ASC')->get();
        return view('searchByRange', compact('houses'));
    }


    public function booking($house){
        
        // if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2){
        //     session()->flash('danger', 'Sorry admin and landlord are not able to book any houses. Please login with renter account');
        //     return redirect()->back();
        // }


        $house = House::findOrFail($house);
        $landlord = User::where('id', $house->user_id)->first();

        if(Booking::where('address', $house->address)->where('booking_status', "booked")->count() > 0){
            session()->flash('danger', 'This house has already been booked!');
            return redirect()->back();
        }



        if(Booking::where('address', $house->address)->where('renter_id', Auth::id())->where('booking_status', "requested")->count() > 0){
            session()->flash('danger', 'Your have already sent booking request of this home');
            return redirect()->back();
        }


       

    
        //find current date month year
        // $now = Carbon::now();
        // $now = $now->format('F d, Y');
        
        
        $booking = new Booking();
        $booking->address = $house->address;
        $booking->rent = $house->rent;
        $booking->landlord_id = $landlord->id;
        $booking->renter_id = Auth::id();
        $booking->save();


        session()->flash('success', 'House Booking Request Send Successfully');
        return redirect()->back();
 

    }

}
