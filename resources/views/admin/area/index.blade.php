@extends('layouts.backend.app')
@section('title')
    All Areas
@endsection
@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
             
               @include('partial.successMessage')  

                <div class="card mt-5">
                    <div class="card-header">
                      <h3 class="card-title float-left"><strong >Our All Areas ({{ $areacount }})</strong></h3>
                      
                    <a href="{{route('admin.area.create')}}" class="btn btn-success btn-md float-right c-white">Add new area <i class="fa fa-plus"></i></a>
                    </div>
                    <!-- /.card-header -->
                    @if ($areas->count() > 0)
                    <div class="">
                    <div class="table-responsive">
                      <table id="dataTableId" class="table table-bordered table-striped table-background">
                        <thead>
                        <tr>
                          <th>Name</th>
                          <th>Added</th>
                          <th>Number of House </th>
                          <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($areas as $key=>$area)
                        <tr>
                          <td>{{ $area->name }}</td>
                          <td>{{ $area->created_at->toFormattedDateString() }}</td>
                          <td>{{ $area->houses->count() }}</td>
                          <td>
                            @if ($area->user_id == Auth::id())
                              <a href="{{ route('admin.area.edit', $area->id) }}"  class="btn btn-info">Edit</a>
                            @endif
                           
                            <button class="btn btn-danger" type="button" onclick="deleteArea({{ $area->id }})">
                                Delete
                            </button>
                            
            
                          <form id="delete-form-{{ $area->id }}" action="{{ route('admin.area.destroy',$area->id) }}" method="POST" style="display: none;">
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
                 <h2 class="text-center text-info font-weight-bold m-3">No Area Found</h2>
              @endif

               <div class="pagination">
                  {{ $areas->links() }}
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
 function deleteArea(id){
     const swalWithBootstrapButtons = Swal.mixin({
          customClass: {
          confirmButton: 'btn btn-success',
          cancelButton: 'btn btn-danger'
          },
          buttonsStyling: false
      })
      
      swalWithBootstrapButtons.fire({
          title: 'Are you sure to delete this area?',
          type: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Yes, delete it!',
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