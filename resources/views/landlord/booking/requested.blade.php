@extends('layouts.backend.app')
@section('title')
    All Booking Request
@endsection
@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
               @include('partial.successMessage')  

                <div class="card my-5 mx-4">
                    <div class="card-header">
                      <h3 class="card-title float-left"><strong>Booking Requests ({{ $books->count() }})</strong></h3>
                      
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
                          <th>Rent</th>
                          <th>Renter Name</th>
                          <th>Renter Contact</th>
                          <th>Renter Nid</th>
                          <th>Renter Email</th>
                          <th colspan="2">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($books as $book)
                        <tr>
                          <td>{{ $book->address }}</td>
                          <td>{{ $book->created_at->format('F d, Y') }}</td>
                          <td>{{ $book->rent }}</td>
                          <td>
                            @isset($book->renter->name)
                                {{ $book->renter->name }}
                            @else 
                                This renter is deleted by admin
                            @endisset
                          </td>
                          <td>
                            @isset($book->renter->contact)
                                {{ $book->renter->contact }}
                            @else 
                                This renter is deleted by admin
                            @endisset
                          </td>
                          <td>
                            @isset($book->renter->nid)
                                {{ $book->renter->nid }}
                            @else 
                                This renter is deleted by admin
                            @endisset  
                          </td>
                          <td>
                            @isset($book->renter->email)
                                {{ $book->renter->email }}
                            @else 
                                This renter is deleted by admin
                            @endisset
                          </td>
                          <td>
                             {{-- start accept form --}}
                            <button class="btn btn-info btn-sm" type="button" onclick="accept({{ $book->id }})">
                                Accept
                            </button>
              
                            <form id="accept-form-{{ $book->id }}" action="{{ route('landlord.request.accept', $book->id) }}" method="POST" style="display: none;">
                                @csrf
                            </form>

                            {{-- end accept form --}}

                        </td>

                        <td>
                            {{-- start accept form --}}
                           <button class="btn btn-danger btn-sm" type="button" onclick="reject({{ $book->id }})">
                               Reject
                           </button>
             
                           <form id="reject-form-{{ $book->id }}" action="{{ route('landlord.request.reject', $book->id) }}" method="POST" style="display: none;">
                               @csrf
                           </form>

                           {{-- end accept form --}}

                       </td>
                      
                        </tr>
                        @endforeach    
                        </tbody>
                      </table>
                    </div>
                      
            </div> <!-- /.card-body -->
              @else 
                 <h2 class="text-center text-info font-weight-bold m-3">No Booking Request Found</h2>
              @endif

               <div class="pagination">
                  
                </div>
                   
            </div>
                  <!-- /.card -->
            </div>
        </div>
    </div><!-- /.container -->
 @endsection

 @section('scripts')
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
 <script>
     function accept(id){
           const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })
            
            swalWithBootstrapButtons.fire({
                title: 'Are you sure to accept his/her booking?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes!',
                cancelButtonText: 'No!',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    
                    event.preventDefault();
                    document.getElementById('accept-form-'+id).submit();
            
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



        function reject(id){
           const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })
            
            swalWithBootstrapButtons.fire({
                title: 'Are you sure to reject his/her booking?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes!',
                cancelButtonText: 'No!',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    
                    event.preventDefault();
                    document.getElementById('reject-form-'+id).submit();
            
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