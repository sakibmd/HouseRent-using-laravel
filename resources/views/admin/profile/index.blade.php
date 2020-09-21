@extends('layouts.backend.app')
@section('title')
   Profile Info
@endsection
@section('content')
<div class="container card">
    <div class="row p-3">
        <div class="col-md-4 text-center">
            <img src="{{asset('backend/img')}}/user2-160x160.jpg" style="height: 200px; width: 200px; margin-top:40px" class="elevation-2" alt="User Image">
        </div>
        <div class="col-md-8">
            
            <div class="table-responsive-md">
                <table class="table">
                    <tr>
                        <a href="{{ route('admin.profile.edit', $profile->id) }}" class="btn btn-info float-right my-2" >Edit Profile</a>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <td>{{ $profile->name }}</td>
                    </tr>
                    <tr>
                        <th>Username</th>
                        <td>{{ $profile->username }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $profile->email }}</td>
                    </tr>
                    <tr>
                        <th>Nid</th>
                        <td>{{ $profile->nid }}</td>
                    </tr>
                    <tr>
                        <th>Contact</th>
                        <td>{{ $profile->contact }}</td>
                    </tr>

                </table>
              </div>
            
        </div>
    </div>
</div>
 @endsection


