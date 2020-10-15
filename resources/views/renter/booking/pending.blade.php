@extends('layouts.backend.app')
@section('title')
    Renter - All Booking History
@endsection
@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
               @include('partial.successMessage')  

                <div class="card my-5 mx-4">
                    <div class="card-header">
                      <h3 class="card-title float-left"><strong>Pending Booking Request ({{ $books->count() }})</strong></h3>
                      
                    </div>
                    <!-- /.card-header -->
                    @if ($books->count() > 0)
                    <div class="">
                    <div class="table-responsive">
                      <table id="dataTableId" class="table table-bordered table-striped table-background">
                        <thead>
                        <tr>
                          <th>Address</th>
                          <th>Entry</th>
                          <th>Leave</th>
                          <th>Rent</th>
                          <th>Landlord Name</th>
                          <th>Landlord Contact</th>
                          <th>Action</th>
                          
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($books as $book)
                        <tr>
                          <td>{{ $book->address }}</td>
                          <td>{{ $book->created_at->format('F d, Y') }}</td>
                          <td>{{ $book->leave }}</td>
                          <td>{{ $book->rent }}</td>
                          <td>
                            @isset($book->landlord->name)
                                {{ $book->landlord->name }}
                            @else 
                                This landlord is deleted by admin
                            @endisset
                          </td>
                          <td>
                            @isset($book->landlord->contact)
                                {{ $book->landlord->contact }}
                            @else 
                                This landlord is deleted by admin
                            @endisset
                          </td>
                          <td>
                           
                            <button class="btn btn-danger" type="button" onclick="cancel()">
                                Cancel Booking Request
                            </button>
            
                            <form id="cancel-form" action="{{ route('renter.cancel.booking.request', $book->id) }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        
                          </td>
                        </tr>
                        @endforeach    
                        </tbody>
                      </table>
                    </div>
                      
            </div> <!-- /.card-body -->
              @else 
                 <h2 class="text-center text-info font-weight-bold m-3">No Pending Request Found</h2>
              @endif

               
                   
            </div>
                  <!-- /.card -->
            </div>
        </div>
    </div><!-- /.container -->
 @endsection

 

 @section('scripts')
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
     <script>
         function cancel(){
           const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })
            
            swalWithBootstrapButtons.fire({
                title: 'Are you sure to remove this booking?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes!',
                cancelButtonText: 'No!',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    
                    event.preventDefault();
                    document.getElementById('cancel-form').submit();
            
                } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
                ) {
                swalWithBootstrapButtons.fire(
                    'Cancelled',
                )
                }
            })
       }	
     </script>
 @endsection