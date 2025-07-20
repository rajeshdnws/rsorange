@extends('admin.auth.auth_master')
@section('auth_title')
     Login | Admin Panel
@endsection

@section('auth-content')

<div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
          <!-- Register -->
          <div class="card">
            <div class="card-body">
              <!-- Logo -->
              <div class="app-brand justify-content-center">
                <a href="/admin" class="app-brand-link gap-2">
                  <span class="app-brand-logo demo">
                <img src="{{ asset('images/logo.png') }}" style="width:80%" />
                  </span>
                
                </a>
              </div>
              <!-- /Logo -->
              <h4 class="mb-2 text-center" >Admin Login</h4>

              <form method="POST" action="{{ route('admin.submit') }}">
              @csrf
              <div class="p-4 p-md-5">
                
                @include('admin.layouts.partials.messages')
                <div class="mb-4 input-group">
                    <span class="input-group-text"><i class="bi bi-person"></i></span>
		                <input type="text" id="exampleInputEmail1" name="email" class="form-control rounded-end @error('email') is-invalid @enderror" placeholder="Email/Username">
                    <i class="ti-email"></i>
                    <div class="text-danger"></div>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
               
                
                <div class="mb-4 input-group">
                  <span class="input-group-text"><i class="bi bi-lock"></i></span>
		              <input type="password" class="form-control rounded-end @error('password') is-invalid @enderror" placeholder="Password" id="exampleInputPassword1" name="password">
                  <i class="ti-lock"></i>
                  <div class="text-danger"></div>
                  @error('password')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>
                <div class="mb-3 d-flex justify-content-between flex-wrap">
                <div class="mb-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="remember-me">
                    <label class="form-check-label" for="remember-me"> Remember Me </label>
                  </div>
                </div>
                </div>
                <div class="text-end">
                <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
                </div>
              </div>
            </form>

         
            </div>
          </div>
          <!-- /Register -->
        </div>
      </div>
    </div>
    @endsection