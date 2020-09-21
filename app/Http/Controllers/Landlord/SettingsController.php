<?php

namespace App\Http\Controllers\Landlord;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class SettingsController extends Controller
{
    public function showProfile(){
        $profile = User::where('id', Auth::id())->first();
        return view('landlord.profile.index', compact('profile'));
    }

    public function editProfile(){
        $profile = User::where('id', Auth::id())->first();
        return view('landlord.profile.edit', compact('profile'));
    }

    public function updateProfile(Request $request){
        $profile = Auth::id();
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => 'required|email|unique:users,email,'. $profile,
            'nid' => 'required|numeric|unique:users,nid,'. $profile,
            'contact' => 'required|numeric|unique:users,contact,'. $profile,
            'username' => 'required|string|unique:users,username,'. $profile,
            'image' => 'mimes:jpeg,png,jpg',
        ]);

        $profile = User::findOrFail($profile);

        //handle featured image
        $image = $request->file('image');
        if($image)
        {
             // Make Unique Name for Image 
            $currentDate = Carbon::now()->toDateString();
            $image_name = $currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
  
  
          // Check Dir is exists
  
              if (!Storage::disk('public')->exists('profile_photo')) {
                 Storage::disk('public')->makeDirectory('profile_photo');
              }
  
  
              // Resize Image  and upload
              $cropImage = Image::make($image)->resize(300,400)->stream();
              Storage::disk('public')->put('profile_photo/'.$image_name,$cropImage);

              $profile->image = $image_name;
  
         }

        
        $profile->name =  $request->name;
        $profile->username =  $request->username;
        $profile->email =  $request->email;
        $profile->nid =  $request->nid;
        $profile->contact =  $request->contact;
        $profile->save();

        session()->flash('success', 'Profile Updated Successfully');
        return redirect(route('landlord.profile.show'));
    }
}
