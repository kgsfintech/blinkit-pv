
@extends('layouts.app')

@section('content')
<div class="d-flex align-items-center justify-content-center text-center h-100vh" style="background-image:url('backEnd/image/unnamed.jpg');">
    <div class="form-wrapper m-auto">
        <div class="form-container my-4" style="width: 352px;">
           
           <div class="panel">
                 @if(session()->has('error'))
                <div class="alert alert-danger">
                     {{ session()->get('error') }}
                 </div>
             @endif
					<a href="https://capitall.io/" target="blank">
              <div class="register-logo text-center mb-4">
                <h1 style="margin:0px;font-weight: 600;">CapITall</h1>
               <!-- <span style="color: white;font-size:12px;">Powered by K G Somani and Co LLP</span> -->
				</div></a>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <input type="email"  name="email" class="form-control @error('email') is-invalid @enderror" id="emial" placeholder="Enter Staff Email"  value="{{ old('email') }}" required autocomplete="email" autofocus>
                       
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                        <div class="invalid-feedback text-left">Enter your valid email</div>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" id="pass" placeholder="Password">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                    <div class="custom-control custom-checkbox mb-3">
                        <input class="custom-control-input" id="customCheck1" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="custom-control-label" for="customCheck1">    {{ __('Remember Me') }} next time </label>
                    </div>
                    <button style="background:#37A000;" type="submit" class="btn btn-success btn-block">Sign in</button>
                </form>
            </div>
            {{-- <div class="bottom-text text-center my-3">
                Don't have an account? <a href="register.html" class="font-weight-500">Sign Up</a><br>
                Remind 
                @if (Route::has('password.request'))
                <a  href="{{ route('password.request') }}" class="font-weight-500">Password</a>
                @endif
            </div> --}}
        </div>
    </div>
</div>
<script>
    document.onkeydown = function(e) {
            if (e.ctrlKey && 
                (e.keyCode === 85 )) {
                return false;
            }
    };
    document.addEventListener('contextmenu', event => event.preventDefault());
    </script>
@endsection