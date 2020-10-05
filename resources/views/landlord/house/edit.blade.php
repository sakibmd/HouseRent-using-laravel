@extends('layouts.backend.app')
@section('title')
   Edit House - {{ $house->address }}
@endsection
@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card mt-5">
                    <div class="card-header">
                      <h3 class="card-title float-left"><strong>Edit House</strong></h3>
                  
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                    @include('partial.errors')

                    <form action="{{ route('landlord.house.update', $house->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
					        <div class="form-group">
					          <label for="address">Address: </label>
					          <input type="text" class="form-control" placeholder="Enter address" id="address" name="address" value="{{ old('address', $house->address) }}">
                            </div>

                            <div class="form-group">
                                <label for="area_id">Area </label>
                                <select name="area_id" class="form-control" id="area_id">
                                    <option value="">select an area</option>
                                    @foreach ($areas as $area)
                                        <option value="{{ $area->id }}"  {{ old('area_id') == $area->id ? 'selected' : '' }} 
                                                @isset($house)
                                                    {{ $house->area_id == $area->id ? 'selected' : '' }}
                                                @endisset     
                                            >
                                        {{ $area->name }}
                                    </option>
                                    @endforeach
                                </select>
                              </div>
                            
                            <div class="form-group">
                                <label for="number_of_room">Number of  rooms: </label>
                                <input type="text" class="form-control" placeholder="number_of_room" id="number_of_room" name="number_of_room" value="{{ old('number_of_room',$house->number_of_room) }}">
                            </div>

                            <div class="form-group">
                                <label for="number_of_toilet">Number of toilet: </label>
                                <input type="text" class="form-control" placeholder="number_of_toilet" id="number_of_toilet" name="number_of_toilet" value="{{ old('number_of_toilet',$house->number_of_toilet) }}">
                            </div>

                            <div class="form-group">
                                <label for="number_of_belcony">Number of  belcony: </label>
                                <input type="text" class="form-control" placeholder="number_of_belcony" id="number_of_belcony" name="number_of_belcony" value="{{ old('number_of_belcony',$house->number_of_belcony) }}">
                            </div>

                            <div class="form-group">
                                <label for="rent">Rent: </label>
                                <input type="text" class="form-control" placeholder="rent" id="rent" name="rent" value="{{ old('rent', $house->rent) }}">
                            </div>

                            <div class="form-group">
                                <label for="featured_image">Featured Image</label>
                                <input type="file" name="featured_image" class="form-control" id="featured_image">
                            </div>
        
                            <div class="form-group">
                                <label for="images">House Images</label>
                                <input type="file" name="images[]" class="form-control" multiple>
                            </div>
					      

                            <div class="form-group">
                                    <button type="submit" class="btn btn-success">Update</button>
                                    <a href="{{ URL::previous() }}" class="btn btn-danger wave-effect" >Back</a>
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