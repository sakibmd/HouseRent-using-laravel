<?php

namespace App\Http\Controllers\Landlord;

use App\Area;
use App\House;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class HouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $houses = House::latest()->where('user_id', Auth::id())->paginate(8);
        $housecount = House::all()->count();
        return view('landlord.house.index', compact('houses', 'housecount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Area::count() < 1){
            session()->flash('danger','To add new house you have to add area first');
            return redirect()->back();
        }
        
        $areas = Area::all();
        return view('landlord.house.create', compact('areas'));
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
            'address' => 'required',
            'area_id' => 'required',
            'number_of_room' => 'required|numeric|integer',
            'number_of_toilet' => 'required|numeric|integer',
            'number_of_belcony' => 'required|numeric|integer',
            'rent' => 'required|numeric',
            'featured_image' => 'required|mimes:jpeg,png,jpg',
            'images.*' => 'required|mimes:jpeg,png,jpg',
        ]);

        //handle featured image
        $featured_image = $request->file('featured_image');
        if($featured_image)
        {
             // Make Unique Name for Image 
            $currentDate = Carbon::now()->toDateString();
            $featured_image_name = $currentDate.'-'.uniqid().'.'.$featured_image->getClientOriginalExtension();
  
  
          // Check Dir is exists
  
              if (!Storage::disk('public')->exists('featured_house')) {
                 Storage::disk('public')->makeDirectory('featured_house');
              }
  
  
              // Resize Image  and upload
              $cropImage = Image::make($featured_image)->resize(400,300)->stream();
              Storage::disk('public')->put('featured_house/'.$featured_image_name,$cropImage);
  
         }
       


        if($request->hasfile('images'))
        {
             foreach($request->file('images') as $file)
             {
                 $name = time() . '-'. uniqid() . '.'.$file->extension();
                 $file->move(public_path().'/images/', $name);  
                 $data[] = $name;  
             }
        }
    
        $house = new House();
        $house->address = $request->address;
        $house->user_id = Auth::id();
        $house->contact = Auth::user()->contact;
        $house->area_id = $request->area_id;
        $house->number_of_toilet = $request->number_of_toilet;
        $house->number_of_room = $request->number_of_room;
        $house->number_of_belcony = $request->number_of_belcony;
        $house->rent = $request->rent;
        $house->images = json_encode($data);
        $house->featured_image = $featured_image_name;
        $house->save();
        return redirect(route('landlord.house.index'))->with('success', 'House Added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(House $house)
    {
        return view('landlord.house.show')->with('house', $house); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(House $house)
    {
        $areas = Area::all();
        return view('landlord.house.edit', compact('areas', 'house'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function switch($id)
    {
        $house = House::find($id);
        if($house->status == 1){
            $house->status = 0;
        }else{
            $house->status = 1;
        }
        $house->save();

        session()->flash('success', 'House Status Changed Successfully');
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, House $house)
    {
        
        
        $this->validate($request,[
            'address' => 'required',
            'area_id' => 'required',
            'number_of_room' => 'required|numeric|integer',
            'number_of_toilet' => 'required|numeric|integer',
            'number_of_belcony' => 'required|numeric|integer',
            'rent' => 'required|numeric',
            'featured_image' => 'mimes:jpeg,png,jpg',
            'images.*' => 'mimes:jpeg,png,jpg',
        ]);

        //handle featured image

        $featured_image = $request->file('featured_image');

        if($featured_image)
        {
     
             // Make Unique Name for Image 
            $currentDate = Carbon::now()->toDateString();
            $featured_image_name =$currentDate.'-'.uniqid().'.'.$featured_image->getClientOriginalExtension();
  
  
             // Check Dir is exists
              if (!Storage::disk('public')->exists('featured_house')) {
                 Storage::disk('public')->makeDirectory('featured_house');
              }

              
              // Resize Image and upload
              $cropImage = Image::make($featured_image)->resize(400,300)->stream();
              Storage::disk('public')->put('featured_house/'.$featured_image_name,$cropImage);

              if(Storage::disk('public')->exists('featured_house/'.$house->featured_image)){
                 Storage::disk('public')->delete('featured_house/'.$house->featured_image);
             }
             $house->featured_image = $featured_image_name;
         }

       
        //handle multiple images update
        if($request->hasfile('images'))
        {
           
             foreach(json_decode($house->images) as $picture){
                     @unlink("images/". $picture);
             }
         
             foreach($request->file('images') as $file)
             {
                 $name = time() . '-'. uniqid() . '.'.$file->extension();
                 $file->move(public_path().'/images/', $name);  
                 $data[] = $name;  
             }

             $house->images=json_encode($data);
        }

        $house->address = $request->address;
        $house->area_id = $request->area_id;
        $house->number_of_toilet = $request->number_of_toilet;
        $house->number_of_room = $request->number_of_room;
        $house->number_of_belcony = $request->number_of_belcony;
        $house->rent = $request->rent;
        $house->save();
        return redirect(route('landlord.house.index'))->with('success', 'House Updated successfully');



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(House $house)
    {
        //delete multiple added images
        foreach(json_decode($house->images) as $picture){
            @unlink("images/". $picture);
        }

        //delete old featured image
        if(Storage::disk('public')->exists('featured_house/'.$house->featured_image)){
            Storage::disk('public')->delete('featured_house/'.$house->featured_image);
        }

        $house->delete();
        return redirect(route('landlord.house.index'))->with('success', 'House Removed Successfully');
    }
}



