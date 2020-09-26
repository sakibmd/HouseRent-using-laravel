@extends('layouts.frontend.app')

@section('title','Home')
    
@section('content')

<div id="content">
    <div class="container">
     <div class="row justify-content-center py-5">
         <h1><strong>All Available Houses List</strong></h1>
         <hr>
     </div>
     <div class="row">
         <div class="col-12">
                <div class="row">
                     @forelse ($houses as $house)
                         <div class="col-md-4">
                             <div class="card my-3">
                                 <div class="card-header">
                                     <img  src="{{ asset('storage/featured_house/'. $house->featured_image) }}" class="img-fluid" alt="Card image">
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
                         <h2 class="m-auto py-2 text-white bg-dark p-3">House Not Available right now</h2>
                     @endforelse

                     
                </div>
                {{ $houses->links() }}
         </div>
     </div>
    </div>
 </div>

@endsection