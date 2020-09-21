<?php

namespace App\Http\Controllers\Admin;

use App\Area;
use App\House;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
   public function index(){
      $landlords = User::where('role_id', 2)->get();
      $renters = User::where('role_id', 3)->get();
      $houses = House::latest()->get();
      $areas = Area::latest()->get();
   	return view('admin.dashboard', compact('landlords', 'renters', 'houses', 'areas'));
   }
}
