@extends('layouts.frontend.app')

@section('title','Home')
    
@section('content')
    <div id="search">
        <div class="container-fluid">
            <div class="row justify-content-center py-4">
                <h2><strong>Search a house of your choice</strong></h2>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-9">
                    <form action="" method="get">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-3">
                                <input type="text" name="rooms" placeholder="rooms" class="form-control">
                            </div>
                            <div class="form-group col-md-3">
                                <input type="text" name="bathroom" placeholder="bathroom" class="form-control">
                            </div>
                            <div class="form-group col-md-3">
                                <input type="text" name="rent" placeholder="rent" class="form-control">
                            </div>
                            <div class="form-group col-md-3">
                                <button type="submit" class="btn btn-success">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div id="content">
       <div class="container">
        <div class="row justify-content-center py-5">
            <h1><strong>Available Houses</strong></h1>
            <hr>
        </div>
        <div class="row">
            <div class="col-md-9">
                
                   <div class="row">
                        @forelse ($houses as $house)
                            <div class="col-md-6">
                                <div class="card my-3">
                                    <div class="card-header">
                                        <img  src="{{ asset('storage/featured_house/'. $house->featured_image) }}" class="img-fluid" alt="Card image">
                                    </div>
                                    <div class="card-body">
                                        <p>Area: {{ $house->area->name }}</p>
                                        <p>Address: {{ $house->address }}</p>
                                        <p>Contact:  + 88 {{ $house->contact }}</p>
                                        <a href="{{ route('house.details', $house->id) }}" class="btn btn-info">Details</a>
                                    </div>
                                </div>
                            </div>
                        @empty 
                            <h2 class="m-auto py-2 text-white bg-dark p-3">House Not Available right now</h2>
                        @endforelse
                   </div>
            </div>
            <div class="col-md-3">
                    <ul class="list-group sort">
                        <li class="list-group-item bg-dark text-light"><strong>Sort By Price</strong></li>
                        <li class="list-group-item"><a href="">High to low</a></li>
                        <li class="list-group-item"><a href="">Low to High</a></li>
                    </ul>



                    <ul class="list-group area-show">
                        <li class="list-group-item bg-dark text-light"><strong>Areas</strong></li>
                        @forelse ($areas as $area)
                            <li class="list-group-item">
                                <a href="" class="area-name">{{ $area->name }}</a>
                            </li>
                        @empty  
                            <li class="list-group-item">Area not found</li>
                        @endforelse
                        
                    </ul>
            </div>
        </div>
       </div>
    </div>



@endsection