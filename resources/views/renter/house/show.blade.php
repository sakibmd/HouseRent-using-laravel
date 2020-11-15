@extends('layouts.backend.app')
@section('title')
   Details - {{ $house->address }}
@endsection
@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card mt-5">
                    <div class="card-header">
                      <div class="d-flex justify-content-between">
                          <div>
                              <h3><strong>House Details</strong></h3>
                          </div>
                          <div>
                           
                            @if (Auth::user()->role_id == 3)
                            <button class="btn btn-warning" type="button" onclick="renterBooking({{ $house->id }})">
                                Apply for booking
                            </button>
            
                            <form id="booking-form-{{ $house->id }}" action="{{ route('booking', $house->id) }}" method="POST" style="display: none;">
                                @csrf
                               
                            </form>
                            @endif
                              <a class="btn btn-danger" href="{{ route('renter.allHouses') }}"> Back</a>
                          </div>
                      </div>
                  
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    @include('partial.successMessage')
                                </tr>
                                <tr>
                                    <th>Address</th>
                                    <td>{{ $house->address }}</td>
                                </tr>
                                <tr>
                                    <th>Area</th>
                                    <td>{{ $house->area->name }}</td>
                                </tr>
                                <tr>
                                    <th>Owner</th>
                                    <td>{{ $house->user->name }}</td>
                                </tr>
                                <tr>
                                    <th>Contact</th>
                                    <td>{{ $house->contact }}</td>
                                </tr>
                                <tr>
                                    <th>Number of rooms</th>
                                    <td>{{ $house->number_of_room }}</td>
                                </tr>

                                <tr>
                                    <th>Number of toilet</th>
                                    <td>{{ $house->number_of_toilet }}</td>
                                </tr>

                                <tr>
                                    <th>Number of belcony</th>
                                    <td>{{ $house->number_of_belcony }}</td>
                                </tr>

                                <tr>
                                    <th>Rent</th>
                                    <td>{{ $house->rent }}</td>
                                </tr>

                                <tr>
                                    <th>Status</th>
                                    <td>
                                        @if ($house->status == 1)
                                            <span class="btn btn-success">Available</span>
                                        @else
                                            <span class="btn btn-danger">Not Available</span>
                                        @endif
                                </td>
                                </tr>

                                

                                
                                    @if ($alreadyReviewed != null)
                                        <tr>
                                            <th>Your Review</th>
                                            <td style="text-align: justify">{{ $alreadyReviewed->opinion }}
                                            <br><a href="{{ route('renter.review.edit', $alreadyReviewed->id) }}" class="btn btn-info btn-sm my-2">Edit</a></td>
                                            
                                        </tr>
                                    @endif
                                


                                @if ($stayOnceUponATime!=null)
                                    @if ($alreadyReviewed == null)
                                    <tr>
                                        <th>
                                            Enter Review
                                        </th>
                                        <td>
                                            <form action="{{ route('renter.review') }}" method="POST">
                                                @csrf
                                                <div class="form group">
                                                    <textarea class="form-control" name="opinion" cols="30" rows="6" placeholder="enter here..."></textarea>
                                                </div>
                                                <input type="hidden" name="house_id" value="{{ $house->id }}">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endif
                                @endif

                                
                            </table>
                          </div>

                          <div class="row gallery">
                            @foreach (json_decode($house->images) as $picture)
                                       <div class="col-md-3">
                                           <a href="{{ asset('images/'.$picture) }}">
                                                       <img  src="{{ asset('images/'.$picture) }}" class="img-fluid m-2"
                                                        style="height: 150px;width: 100%; ">
                                           </a>
                                       </div>
                            @endforeach
                       </div>
                    </div>
                   
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
            </div>
        </div>
    </div><!-- /.container -->
 @endsection


 @section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.11.1/baguetteBox.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script>
   window.addEventListener('load', function() {
        baguetteBox.run('.gallery', {
            animation: 'fadeIn',
            noScrollbars: true
        });
   });

   function renterBooking(id){
           const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })
            
            swalWithBootstrapButtons.fire({
                title: 'Are you sure to booking this house?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        event.preventDefault();
                        document.getElementById('booking-form-'+id).submit();
                
                    } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                    ) {
                    swalWithBootstrapButtons.fire(
                        'Not Now!',
                        
                    )
                }
            })
       }

</script>
@endsection
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.11.1/baguetteBox.min.css">
@endsection