@extends('layouts.backend.app')
@section('title')
    Renter - All Areas
@endsection
@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
             
               @include('partial.successMessage')  

              <div class="card mt-5">
                    <div class="card-header">
                      <h3 class="card-title float-left"><strong>Our All Areas ({{ $areacount }})</strong></h3>
                      
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
                          <th>Number of House</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($areas as $key=>$area)
                        <tr>
                          <td>{{ $area->name }}</td>
                          <td>{{ $area->created_at->toFormattedDateString() }}</td>
                          <td>{{ $area->houses->count() }}</td>
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

