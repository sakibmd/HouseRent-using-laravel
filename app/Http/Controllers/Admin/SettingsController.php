<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    public function showProfile(){
        $profile = User::where('id', Auth::id())->first();
        return view('admin.profile.index', compact('profile'));
    }

    public function editProfile(){
        $profile = User::where('id', Auth::id())->first();
        return view('admin.profile.edit', compact('profile'));
    }

    public function updateProfile(Request $request){
        $profile = User::find(Auth::id());
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => 'required|email|unique:users,email,'. $profile->id,
            'nid' => 'required|numeric|unique:users,nid,'. $profile->id,
            'contact' => 'required|numeric|unique:users,contact,'. $profile->id,
            'username' => 'required|string|unique:users, username,'. $profile->id,
        ]);

        $profile->name =  $request->name;
        $profile->username =  $request->username;
        $profile->email =  $request->email;
        $profile->nid =  $request->nid;
        $profile->contact =  $request->contact;
        $profile->save();

        session()->flash('success', 'Profile Updated Successfully');
        return redirect(route('admin.profile.show'));
    }
}
