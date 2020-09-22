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
        $houses = House::where('status', 1)->latest()->take(6)->get();
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

}
