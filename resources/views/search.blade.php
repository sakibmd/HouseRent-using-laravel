@extends('layouts.frontend.app')

@section('title')
    House Renter - Search Result
@endsection
    
@section('content')


    <div class="container-fluid">
        <div class="row justify-content-center py-5 area-wise-show">
            <h1>Search Result: <strong>"{{ $houses->count() }}"</strong> results found</h1>
            <br>
        </div>
    </div>
    <div class="container">
        <div class="row my-5">
            @forelse ($houses as $house)
                <div class="col-md-4">
                    <div class="card my-3">
                        <div class="card-header">
                            <img  src="{{ asset('storage/featured_house/'. $house->featured_image) }}" width="100%" class="img-fluid" alt="Card image">
                        </div>
                        <div class="card-body">
                            <p>Area: {{ $house->area->name }}</p>
                            <p>Address: {{ $house->address }}</p>
                            <p>Rent: {{ $house->rent }}</p>
                            <a href="{{ route('house.details', $house->id) }}" class="btn btn-info">Details</a>
                        </div>
                    </div>
                </div>
            @empty 
                <h2 class="m-auto py-2 text-white bg-dark p-3 area-wise-not-available">No Houses Found</h2>
            @endforelse
       </div>
       <a  href="{{ route('welcome') }}" class="btn btn-danger mb-5">Go Back</a>
    </div>


@endsection