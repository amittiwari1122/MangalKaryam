@extends('layouts/beforelogin')

@section('content')


              <div class="d-flex align-items-center justify-content-center bg-br-primary ht-100v">

                <div class="login-wrapper wd-300 wd-xs-400 pd-25 pd-xs-40 bg-white rounded shadow-base">
                  <div class="signin-logo tx-center tx-28 tx-bold tx-inverse"><img src="{{ asset('/public/img/logo.png') }}" class="wd-100" alt=""></div>
                  <div class="tx-center mg-b-40">Reset Password</div>
                      <form action="{{ route('reset.password.post') }}" method="POST">
                          @csrf
                          <input type="hidden" name="token" value="{{ $token }}">
                          <div class="form-group">
                            <input type="text" id="email_address" class="form-control" placeholder="Enter your Email" name="email" required autofocus>
                            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                          </div><!-- form-group -->
                          <!-- <div class="form-group row">
                              <label for="email_address" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                              <div class="col-md-6">
                                  <input type="text" id="email_address" class="form-control" name="email" required autofocus>
                                  @if ($errors->has('email'))
                                      <span class="text-danger">{{ $errors->first('email') }}</span>
                                  @endif
                              </div>
                          </div> -->
                          <div class="form-group">
                            <input type="password" id="password" class="form-control" placeholder="Enter your New Password" name="password" required autofocus>
                            @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                          </div><!-- form-group -->
                          <!-- <div class="form-group row">
                              <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                              <div class="col-md-6">
                                  <input type="password" id="password" class="form-control" name="password" required autofocus>
                                  @if ($errors->has('password'))
                                      <span class="text-danger">{{ $errors->first('password') }}</span>
                                  @endif
                              </div>
                          </div> -->

                          <div class="form-group">

                            <input type="password" id="password-confirm" class="form-control" placeholder="Enter Confirm Password" name="password_confirmation" required autofocus>
                            @if ($errors->has('password_confirmation'))
                                <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                            @endif
                          </div><!-- form-group -->

                          <!-- <div class="form-group row">
                              <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>
                              <div class="col-md-6">
                                  <input type="password" id="password-confirm" class="form-control" name="password_confirmation" required autofocus>
                                  @if ($errors->has('password_confirmation'))
                                      <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                  @endif
                              </div>
                          </div> -->

                          <!-- <div class="col-md-6 offset-md-4"> -->
                              <button type="submit" class="btn btn-info btn-block">
                                  Reset Password
                              </button>
                          <!-- </div> -->
                      </form>
                    </div>
                  </div>

@endsection
