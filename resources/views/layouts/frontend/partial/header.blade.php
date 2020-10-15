<header>

    <style>
      .navbar ul li a{
          font-size: 18px;
          color: white! important;
          font-weight: bold;
        }
      .navbar ul li a:hover{
          background-color: rgb(203, 206, 205);
          color: black;
          padding: 5px;
          height: 100%;
      }
    </style>

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div>
                         <img src="{{ asset('frontend/img/logoo.png') }}" style="height: 80px; width: 140px" alt="logo" class="my-2 mx-2 text-center"> 
                        {{-- <strong class="name">House Rental</strong> --}}
                        {{-- <div class="mb-3" style="margin-left: 12px;" id="time"></div> --}}
                    </div>
                   
                </div>
            </div>
        </div>


        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            {{-- <a class="navbar-brand" href="{{ route('welcome') }}"></a> --}}
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
          
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item ">
                  <a class="nav-link" href="{{ route('welcome') }}">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('house.all') }}">All Available Houses</a>
                </li>
               

                @guest
                <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ route('register') }}">Register</a></li>
                @else
                    @if (Auth::user()->role_id == 2)
                        <li class="nav-item"><a class="nav-link" href="{{ route('landlord.dashboard') }}">Dashboard</a></li>
                    @endif
                    @if (Auth::user()->role_id == 3)
                        <li class="nav-item"><a class="nav-link" href="{{ route('renter.dashboard') }}">Dashboard</a></li>
                    @endif
                    @if (Auth::user()->role_id == 1)
                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    @endif
                @endguest
              </ul>
            </div>
          </nav>

    
</header>

<script type="text/javascript">
  
  var date = new Date();
  var days = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
  var months = ["January","February","March","April","May","June","July","August","September", "October", "November", "December"];
  document.getElementById("time").innerHTML = '<strong>' + days[date.getDay()] + '</strong>' + ', ' + months[date.getMonth()] + ' ' + date.getDate() + ', ' + date.getFullYear();

  
</script>