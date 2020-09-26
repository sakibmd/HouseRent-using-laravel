<?php

namespace App\Http\Controllers;

use App\Area;
use App\House;
use Illuminate\Http\Request;

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
        $houses = House::latest()->paginate(12);
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
        

        if( $room == null && $bathroom == null && $rent == null){
            session()->flash('search', 'Your have to fill up minimum one field for search');
            return redirect()->back();
        }

        $houses = House::where('rent', 'LIKE', $rent)
            ->where('number_of_toilet', 'LIKE', $bathroom)
            ->where('number_of_room', 'LIKE',  $room)
            ->get();
        return view('search', compact('houses'));
    }

}
