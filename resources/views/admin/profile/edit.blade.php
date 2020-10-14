@extends('layouts.backend.app')
@section('title')
   Edit Profile
@endsection
@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card mt-5">
                    <div class="card-header">
                      <h3 class="card-title float-left"><strong>Edit Profile</strong></h3>
                  
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                    @include('partial.errors')

                    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
					        <div class="form-group">
					          <label for="name">Name: </label>
					          <input type="text" class="form-control" placeholder="Name" id="name" name="name" value="{{ old('name', $profile->name) }}">
                            </div>

                            <div class="form-group">
                                <label for="username">Username: </label>
                                <input type="text" class="form-control" placeholder="Username" id="username" name="username" value="{{ old('username', $profile->username) }}">
                              </div>

                            <div class="form-group">
                                <label for="email">Email: </label>
                                <input type="text" class="form-control" placeholder="Email" id="email" name="email" value="{{ old('email', $profile->email) }}">
                            </div>

                            <div class="form-group">
                                <label for="nid">Nid: </label>
                                <input type="text" class="form-control" placeholder="Nid" id="nid" name="nid" value="{{ old('nid', $profile->nid) }}">
                            </div>

                            <div class="form-group">
                                <label for="contact">Contact: </label>
                                <input type="text" class="form-control" placeholder="contact (please add 88 before number)" id="contact" name="contact" value="{{ old('contact', $profile->contact) }}">
                            </div>

                            <div class="form-group">
                                <label for="image">Profile Picture</label>
                                <input type="file" name="image" class="form-control">
                            </div> 

                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Update</button>
                                <a href="{{ route('admin.profile.show') }}" class="btn btn-danger wave-effect" >Back</a>
                        </div>
                  </form>
                     
                      
                    </div>
                   
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
            </div>
        </div>
    </div><!-- /.container -->
 @endsection