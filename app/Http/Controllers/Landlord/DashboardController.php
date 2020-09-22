<?php

namespace App\Http\Controllers\Landlord;

use App\Area;
use App\House;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
   public function index(){
        $renters = User::where('role_id', 3)->get();
        $houses = House::where('user_id', Auth::id())->latest()->get();
        $areas = Area::latest()->get();
        return view('landlord.dashboard', compact('renters', 'houses', 'areas'));
    }
}
