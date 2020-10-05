<?php

namespace App\Http\Controllers\Landlord;

use App\Area;
use App\House;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $areas = Area::latest()->paginate(8);
        $areacount = Area::all()->count();
        return view('landlord.area.index', compact('areas', 'areacount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('landlord.area.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|unique:areas'
        ]);
    
        $area = new Area();
        $area->name = $request->name;
        $area->user_id = Auth::id();
        $area->save();
        return redirect(route('landlord.area.index'))->with('success', 'Area Added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Area $area)
    {
        return view('landlord.area.edit')->with('area', $area);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Area $area)
    {
        $this->validate($request,[
            'name' => 'required|unique:areas,name,'. $area->id ,
        ]);
    
        $area->name = $request->name;
        $area->save();

        return redirect(route('landlord.area.index'))->with('success', 'Area Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Area $area)
    {
        if(House::where('area_id', $area->id)->count() > 0){
            session()->flash('danger', 'You do not delete this area because it have some houses imformation');
            return redirect()->back();
        }
        $area->delete();
        return redirect(route('landlord.area.index'))->with('success', 'Area Removved Successfully');
    }
}
