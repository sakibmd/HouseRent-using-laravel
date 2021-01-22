@extends('layouts.frontend.app')

@section('title','Home')

@section('content')

<div id="content">
    <div class="container">
        <div class="row justify-content-center py-5">
            <h2 class="text-center"><strong>All Available Houses List</strong></h2>
            <hr>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="row">
                    @forelse ($houses as $house)
                    <div class="col-md-4">
                        <div class="card m-3">
                            <div class="card-header">
                                <img src="{{ asset('storage/featured_house/'. $house->featured_image) }}" width="100%"
                                    class="img-fluid" alt="Card image">
                            </div>
                            <div class="card-body">
                                <p>
                                    <h4><strong><i class="fas fa-map-marker-alt"> {{ $house->area->name }}, Sylhet</i>
                                        </strong></h4>
                                </p>

                                <p class="grey"><a class="address" href="{{ route('house.details', $house->id) }}"><i
                                            class="fas fa-warehouse"> {{ $house->address }}</i></a> </p>
                                <hr>
                                <p class="grey"><i class="fas fa-bed"></i> {{ $house->number_of_room }} Bedrooms <i
                                        class="fas fa-bath float-right"> {{ $house->number_of_toilet }} Bathrooms</i>
                                </p>
                                <p class="grey">
                                    <h4>৳ {{ $house->rent }} BDT</i></h4>
                                </p>
                            </div>
                            <div class="card-footer">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <a href="{{ route('house.details', $house->id) }}"
                                            class="btn btn-info">Details</a>
                                    </div>
                                    <div>

                                    </div>
                                </div>
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

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script>
    function guestBooking(){
                Swal.fire({
                    title: 'To book a house, You Need To Login First as a Renter!',
                    showClass: {
                        popup: 'animated fadeInDown faster'
                    },
                    hideClass: {
                        popup: 'animated fadeOutUp faster'
                    }
                    })
            }
</script>
@endsection