@extends('layouts.backend.app')
@section('title')
    Landlords List
@endsection
@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
               @include('partial.successMessage')  

                <div class="card my-5 mx-4 p-0">
                    <div class="card-header">
                      <h3 class="card-title float-left"><strong>All Landlords ({{ $landlords->count() }})</strong></h3>
                
                    </div>
                    <!-- /.card-header -->
                    @if ($landlords->count() > 0)
                    <div class="">
                    <div class="table-responsive">
                      <table id="dataTableId" class="table table-bordered table-striped table-background">
                        <thead>
                        <tr>
                          <th>Name</th>
                          <th>Nid</th>
                          <th>Username</th>
                          <th>Houses</th>
                          <th>Email</th>
                          <th>Contact</th>
                          <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($landlords as $key=>$landlord)
                        <tr>
                          <td>{{ $landlord->name }}</td>
                          <td>{{ $landlord->nid }}</td>
                          <td>{{ $landlord->username }}</td>
                          <td>{{ $landlord->houses->count() }}</td>
                          <td>{{ $landlord->email }}</td>
                          <td>{{ $landlord->contact }}</td>
                          <td>
                            <button class="btn btn-danger m-2" type="button" onclick="deleteLandlord({{ $landlord->id }})">
                                Remove
                            </button>
            
                          <form id="delete-form-{{ $landlord->id }}" action="{{ route('admin.remove.landlord',$landlord->id) }}" method="POST" style="display: none;">
                              @csrf
                              @method('DELETE')
                              
                          </form>
                          </td>
                        </tr>
                        @endforeach    
                        </tbody>
                      </table>
                    </div>
                      
            </div> <!-- /.card-body -->
              @else 
                 <h2 class="text-center text-info font-weight-bold m-3">No House Found</h2>
              @endif

               <div class="pagination">
                  {{ $landlords->links() }}
                </div>
                   
            </div>
                  <!-- /.card -->
            </div>
        </div>
    </div><!-- /.container -->
 @endsection

 @section('scripts')
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
 <script type="text/javascript">
 function deleteLandlord(id){
     const swalWithBootstrapButtons = Swal.mixin({
          customClass: {
          confirmButton: 'btn btn-success',
          cancelButton: 'btn btn-danger'
          },
          buttonsStyling: false
      })
      
      swalWithBootstrapButtons.fire({
          title: 'Are you sure to remove this user?',
          type: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Yes, remove it!',
          cancelButtonText: 'No, cancel!',
          reverseButtons: true
      }).then((result) => {
          if (result.value) {
              
              event.preventDefault();
              document.getElementById('delete-form-'+id).submit();
      
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