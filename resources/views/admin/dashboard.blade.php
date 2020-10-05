@extends('layouts.backend.app')
@section('title')
    Admin Dashboard
@endsection
<style>
    .welcome{
        padding: 10px;
    }
    .icon{
        color: rgb(235, 227, 227) !important;
        font-size:55px !important;
        padding-bottom: 20px;
    }


    .col-md-3{
        background-color: #18355d;
        transition: 1s;
        height: 200px;
        padding: 20px;
        margin: 20px 33px; 
    }
    .number{
        color:azure;
    }
    .boxs{
        margin-top: 30px;
    }

    .col-md-3:hover{
        background: rgb(79, 99, 143)
    }

 </style> 
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 welcome text-center my-4">
            <h1 class="name">Welcome to Admin Panel - <span style="padding: 6px;color:white;background:grey;"> {{ Auth::user()->name }}</span></h1>  
        </div>
    </div>
    <div class="row text-center boxs">
        <div class="col-md-3">
            <i class="fa fa-map-marker icon" aria-hidden="true"></i>
                <h3 class="number">Areas</h3>
                <h3 class="number"><span class="counter">{{ $areas->count() }}</span></h3>
        </div>
        <div class="col-md-3">
            <i class="fa fa-home icon" aria-hidden="true"></i>
            <h3 class="number">Houses</h3>
            <h3 class="number"><span class="counter">{{ $houses->count() }}</span></h3>
    </div>
        <div class="col-md-3">
            <i class="fas fa-laptop-house icon"></i>
            <h3 class="number">Landlords</h3>
            <h3 class="number"><span class="counter">{{ $landlords->count() }}</span></h3>
    </div>
    <div class="col-md-3">
        <i class="fas fa-users-cog icon"></i>
        <h3 class="number">Renters</h3>
        <h3 class="number"><span class="counter">{{ $renters->count() }}</span></h3>
    </div>
    </div>
</div>
@endsection



@section('scripts')
<script src="{{ asset('backend/js/jquery.min.js') }}"></script>
<script src="{{ asset('backend/js/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('backend/js/jquery.counterup.min.js') }}"></script>
<script>
    $('.counter').counterUp({
        delay: 100,
        time: 3000
    });
</script>
    
@endsection
