@extends('layouts.frontend.app')

@section('title','Login')
    

@section('content')
{{-- <div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}

<div class="container-fluid login-register">
    <div class="row">
      <div class="col-md-3 col-lg-4 col-sm-2 col-xs-2">
      
      </div>
      <div class="col-md-6 col-lg-4  col-sm-8 col-xs-8">
        <div class="card">
          <div class="card-header">
            
            <h3 style="color: white;"> <strong>Login</strong> </h3>
          </div>

          <div class="card-body">
            
             <form action="{{ route('login') }}" method="POST"> 

               @csrf

               @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                @endif



            <div class="input-group mb-3">
              <input type="text" class="form-control" placeholder="Enter your email" name="email" value="{{ old('email') }}">
            </div>

            <div class="input-group mb-3">
                <input type="password" class="form-control" placeholder="Enter your password" name="password">
              </div>
            
            <button type="submit" class="btn btn-primary btn-block">Login</button>
            @if (Route::has('password.request'))
                    <center> <a class="btn btn-link text-white" href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                            </a>
                    </center>
             @endif

             <a href="{{ url('auth/google') }}" style="margin-top: 20px;" class="btn btn-lg btn-success btn-block">

                <strong>Login With Google</strong>

              </a> 
          </form> 
          </div>
          
        </div>
      </div>
      <div class="col-md-3 col-lg-4  col-sm-2 col-xs-2">
        
      </div>
    </div>
  </div>
@endsection


@section('css')
<style>
    .card{
        background: black;
        background-color: rgba(0,0,0,.5);
        margin-top: 70px;
        margin-bottom: 70px;
    }
    .icon {
        font-size: 25px;
    }

</style>
@endsection