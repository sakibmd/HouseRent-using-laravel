@extends('layouts.frontend.app')

@section('title')
House Renter - Search Result
@endsection

@section('content')


<div class="container-fluid">
    <div class="row justify-content-center py-5 area-wise-show">
        <h2 class="text-center">Search Result: <strong>"{{ $houses->count() }}"</strong> results found</h2>
        <br>
    </div>
</div>
<div class="container">
    <div class="row my-5" id="content">
        @forelse ($houses as $house)
        <div class="col-md-4">
            <div class="card m-3">
                <div class="card-header">
                    <img src="{{ asset('storage/featured_house/'. $house->featured_image) }}" width="100%"
                        class="img-fluid" alt="Card image">
                </div>
                <div class="card-body">
                    <p>
                        <h4><strong><i class="fas fa-map-marker-alt"> {{ $house->area->name }}, Sylhet</i> </strong>
                        </h4>
                    </p>

                    <p class="grey"><a class="address" href="{{ route('house.details', $house->id) }}"><i
                                class="fas fa-warehouse"> {{ $house->address }}</i></a> </p>
                    <hr>
                    <p class="grey"><i class="fas fa-bed"></i> {{ $house->number_of_room }} Bedrooms <i
                            class="fas fa-bath float-right"> {{ $house->number_of_toilet }} Bathrooms</i> </p>
                    <p class="grey">
                        <h4>৳ {{ $house->rent }} BDT</i></h4>
                    </p>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <div>
                            <a href="{{ route('house.details', $house->id) }}" class="btn btn-info">Details</a>
                        </div>
                        <div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <h2 class="m-auto py-2 text-white bg-dark p-3 area-wise-not-available">No Houses Found</h2>
        @endforelse
    </div>
    <a href="{{ route('welcome') }}" class="btn btn-danger mb-5">Go Back</a>
</div>


@endsection