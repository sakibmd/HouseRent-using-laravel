@extends('layouts.backend.app')
@section('title')
   Add Area
@endsection
@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card mt-5">
                    <div class="card-header">
                      <h3 class="card-title float-left"><strong>Add New Area</strong></h3>
                  
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                    @include('partial.errors')

                    <form action="{{ route('admin.area.store') }}" method="POST" >
					        @csrf
					        <div class="form-group">
					          <label for="name" style="color:#14455F;">Name: </label>
					          <input type="text" class="form-control" placeholder="Enter area name" id="name" name="name" value="{{ old('name') }}">
					        </div>
					      

                        <div class="form-group">
                                <button type="submit" class="btn btn-success">Add</button>
                                <a href="{{ route('admin.area.index') }}" class="btn btn-danger wave-effect" >Back</a>
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