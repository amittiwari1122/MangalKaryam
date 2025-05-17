@extends('layouts/beforelogin')

@section('content')
<!-- <main class="login-form">
  <div class="cotainer">
      <div class="row justify-content-center">
          <div class="col-md-8">
              <div class="card">
                  <div class="card-header">Login</div>
                  <div class="card-body">

                      <form action="{{ route('login.post') }}" method="POST">
                          @csrf
                          <div class="form-group row">
                              <label for="email_address" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                              <div class="col-md-6">
                                  <input type="text" id="email_address" class="form-control" name="email" required autofocus>
                                  @if ($errors->has('email'))
                                      <span class="text-danger">{{ $errors->first('email') }}</span>
                                  @endif
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                              <div class="col-md-6">
                                  <input type="password" id="password" class="form-control" name="password" required>
                                  @if ($errors->has('password'))
                                      <span class="text-danger">{{ $errors->first('password') }}</span>
                                  @endif
                              </div>
                          </div>

                          <div class="form-group row">
                              <div class="col-md-6 offset-md-4">
                                  <div class="checkbox">
                                      <label>
                                          <input type="checkbox" name="remember"> Remember Me
                                      </label>
                                  </div>
                              </div>
                          </div>

                          <div class="col-md-6 offset-md-4">
                              <button type="submit" class="btn btn-primary">
                                  Login
                              </button>
                          </div>
                      </form>

                  </div>
              </div>
          </div>
      </div>
  </div>
</main> -->


<div class="d-flex align-items-center justify-content-center bg-br-primary ht-100v">

  <div class="login-wrapper wd-300 wd-xs-350 pd-25 pd-xs-40 bg-white rounded shadow-base">
    <div class="signin-logo tx-center tx-28 tx-bold tx-inverse"><img src="{{ asset('/public/img/logo.png') }}" class="wd-100" alt=""></div>
    <div class="tx-center mg-b-60"></div>
    <form action="{{ route('login.post') }}" method="POST">
      @csrf
    <div class="form-group">
      <!-- <input type="text" class="form-control" placeholder="Enter your username"> -->
      <input type="text" id="email_address" class="form-control" placeholder="Enter your username" name="email" required autofocus>
      @if ($errors->has('email'))
          <span class="text-danger">{{ $errors->first('email') }}</span>
      @endif
    </div><!-- form-group -->
    <div class="form-group">
      <!-- <input type="password" class="form-control" placeholder="Enter your password"> -->
      <input type="password" id="password" class="form-control" placeholder="Enter your password" name="password" required>
      @if ($errors->has('password'))
          <span class="text-danger">{{ $errors->first('password') }}</span>
      @endif
      <a href="{{ route('forget.password.get') }}" class="tx-info tx-12 d-block mg-t-10">Forgot password?</a>
    </div><!-- form-group -->
    <button type="submit" class="btn btn-info btn-block">Sign In</button>

    <div class="mg-t-60 tx-center">Not yet a member? <a href="/registration" class="tx-info">Sign Up</a></div>
  </form>
  </div><!-- login-wrapper -->
</div><!-- d-flex -->

@endsection
