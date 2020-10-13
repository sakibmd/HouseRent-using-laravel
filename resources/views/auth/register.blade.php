@extends('layouts.frontend.app')

@section('title','Register')
    
@section('content')
{{-- <div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row"> 
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>




                        Role 
                        <div class="form-group row">
                            <label for="role_id" class="col-md-4 col-form-label text-md-right">{{ __('Role') }}</label>

                            <div class="col-md-6">
                                
                                <select name="role_id" class="form-control" @error('role_id') is-invalid @enderror" id="role_id" value="{{ old('role_id') }}" required autocomplete="role_id" autofocus>
                                    <option value="">select a role</option>
                                    <option value="2" {{ old('role_id') == 2 ? 'selected' : ''   }} >Landlord</option>
                                    <option value="3" {{ old('role_id') == 3 ? 'selected' : ''  }} >Renter</option>
                                </select>
                                
                                @error('role_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row"> 
                            <label for="nid" class="col-md-4 col-form-label text-md-right">{{ __('Nid') }}</label>

                            <div class="col-md-6">
                                <input id="nid" type="text" class="form-control @error('nid') is-invalid @enderror" name="nid" value="{{ old('nid') }}" required autocomplete="nid" autofocus>

                                @error('nid')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row"> 
                            <label for="contact" class="col-md-4 col-form-label text-md-right">{{ __('Contact') }}</label>

                            <div class="col-md-6">
                                <input id="contact" type="text" class="form-control @error('contact') is-invalid @enderror" name="contact" value="{{ old('contact') }}" required autocomplete="contact" autofocus>

                                @error('contact')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

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
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
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
      <div class="col-md-3 col-lg-3 col-sm-2 col-xs-2">
      
      </div>
      <div class="col-md-6 col-lg-6  col-sm-8 col-xs-8">
        <div class="card">
          <div class="card-header">
            
            <h3 style="color: white;"> <strong>Register</strong> </h3>
          </div>

          <div class="card-body">
            
             <form action="{{ route('register') }}" method="POST"> 
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
              <input type="text" class="form-control" placeholder="Enter your name" name="name" value="{{ old('name') }}">
            </div>

            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Enter your username" name="username" value="{{ old('username') }}">
            </div>


            <div class="input-group mb-3">
               <select name="role_id" class="form-control" value="{{ old('role_id') }}">
                        <option value="">select a role</option>
                        <option value="2" {{ old('role_id') == 2 ? 'selected' : ''   }} >Landlord</option>
                        <option value="3" {{ old('role_id') == 3 ? 'selected' : ''  }} >Renter</option>
                </select>
            </div>

            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Nid number" name="nid" value="{{ old('nid') }}">
            </div>

            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="contact (please add 88 before number)" name="contact" value="{{ old('contact') }}">
            </div>

            <div class="input-group mb-3">
                <input type="email" class="form-control" placeholder="email" name="email" value="{{ old('email') }}">
            </div>

            <div class="input-group mb-3">
                <input id="password" type="password" class="form-control" placeholder="password (must be 8 digits)" name="password">
            </div>


            <div class="input-group mb-3">
                <input id="password-confirm" type="password" placeholder="confirm password" class="form-control" name="password_confirmation" >

            </div>
            
            <button type="submit" class="btn btn-primary btn-block">Register</button>
        
          </form> 
          </div>
          
        </div>
      </div>
      <div class="col-md-3 col-lg-3  col-sm-2 col-xs-2">
        
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
