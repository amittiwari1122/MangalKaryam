@extends('layouts/beforelogin')

@section('content')
<!-- <main class="login-form">
  <div class="cotainer">
      <div class="row justify-content-center">
          <div class="col-md-8">
              <div class="card">
                  <div class="card-header">Register</div>
                  <div class="card-body">

                      <form action="{{ route('register.post') }}" method="POST">
                          @csrf
                          <div class="form-group row">
                              <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
                              <div class="col-md-6">
                                  <input type="text" id="name" class="form-control" name="name" required autofocus>
                                  @if ($errors->has('name'))
                                      <span class="text-danger">{{ $errors->first('name') }}</span>
                                  @endif
                              </div>
                          </div>

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
                                  Register
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

  <div class="login-wrapper wd-300 wd-xs-400 pd-25 pd-xs-40 bg-white rounded shadow-base">
    <div class="signin-logo tx-center tx-28 tx-bold tx-inverse"><img src="{{ asset('/public/img/logo.png') }}" class="wd-100" alt=""></div>
    <div class="tx-center mg-b-40"></div>
    <form action="{{ route('register.post') }}" method="POST">
        @csrf
    <div class="form-group">
      <input type="text" id="email_address" class="form-control" placeholder="Enter your Email" name="email" required autofocus>
      @if ($errors->has('email'))
          <span class="text-danger">{{ $errors->first('email') }}</span>
      @endif
      <!-- <input type="text" class="form-control" placeholder="Enter your username"> -->
    </div><!-- form-group -->
    <div class="form-group">
      <input type="password" id="password" class="form-control" placeholder="Enter your password" name="password" required>
      @if ($errors->has('password'))
          <span class="text-danger">{{ $errors->first('password') }}</span>
      @endif
      <!-- <input type="password" class="form-control" placeholder="Enter your password"> -->
    </div><!-- form-group -->
    <div class="form-group">
      <input type="text" id="name" class="form-control" placeholder="Enter your fullname" name="name" required autofocus>
      @if ($errors->has('name'))
          <span class="text-danger">{{ $errors->first('name') }}</span>
      @endif
      <!-- <input type="password" class="form-control" placeholder="Enter your fullname"> -->
    </div><!-- form-group -->
    <div class="form-group">
      <label class="d-block tx-11 tx-uppercase tx-medium tx-spacing-1">Birthday</label>
      <div class="row row-xs">
        <div class="col-sm-4">
          <select class="form-control select2" data-placeholder="Month">
            <option label="Month"></option>
            <option value="1">January</option>
            <option value="2">February</option>
            <option value="3">March</option>
            <option value="4">April</option>
            <option value="5">May</option>
          </select>
        </div><!-- col-4 -->
        <div class="col-sm-4 mg-t-20 mg-sm-t-0">
          <select class="form-control select2" data-placeholder="Day">
            <option label="Day"></option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
          </select>
        </div><!-- col-4 -->
        <div class="col-sm-4 mg-t-20 mg-sm-t-0">
          <select class="form-control select2" data-placeholder="Year">
            <option label="Year"></option>
            <option value="1">2010</option>
            <option value="2">2011</option>
            <option value="3">2012</option>
            <option value="4">2013</option>
            <option value="5">2014</option>
          </select>
        </div><!-- col-4 -->
      </div><!-- row -->
    </div><!-- form-group -->
    <div class="form-group tx-12">By clicking the Sign Up button below, you agreed to our privacy policy and terms of use of our website.</div>
    <button type="submit" class="btn btn-info btn-block">Sign Up</button>
</form>
    <div class="mg-t-40 tx-center">You Have Already a member? <a href="/login" class="tx-info">Sign In</a></div>
  </div><!-- login-wrapper -->
</div><!-- d-flex -->
@endsection
