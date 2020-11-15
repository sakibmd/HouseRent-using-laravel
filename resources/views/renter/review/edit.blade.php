@extends('layouts.backend.app')
@section('title')
Update Review
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card mt-5">
                <!-- /.card-header -->
                <div class="card-header">
                    <strong>Update Review</strong>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th>
                                    Enter Review
                                </th>
                                <td>
                                    <form action="{{ route('renter.review.update', $review->id) }}" method="POST">
                                        @csrf
                                        @method('POST')
                                        @include('partial.errors')
                                        <div class="form group">
                                            <textarea class="form-control" name="opinion" cols="30" rows="6"
                                                placeholder="enter here...">  {{ old('opinion', $review->opinion)  }}</textarea>
                                        </div>

                                        <button type="submit" class="btn btn-primary my-2">Update</button>
                                    </form>
                                </td>
                            </tr>


                        </table>
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
@endsection
@section('css')
@endsection