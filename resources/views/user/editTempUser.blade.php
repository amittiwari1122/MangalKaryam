@extends('layouts/afterlogin')

@section('content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">
      <div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
          <a class="breadcrumb-item" href="/dashboard">Dashboard</a>
          <a class="breadcrumb-item" href="/getUser">User List</a>
          <span class="breadcrumb-item active">Edit Form</span>
        </nav>
      </div><!-- br-pageheader -->
      <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
        <h4 class="tx-gray-800 mg-b-5">User Edit Form</h4>
        <p class="mg-b-0">Master Tables</p>
      </div>

      <div class="br-pagebody">
        <div class="br-section-wrapper">
          @if ($errors->any())
            <div class="row  mt-3">
                <div class="col-md-12">
                    <div class="alert alert-warning alert-dismissable" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h3 class="alert-heading font-size-h4 font-w400">Error Message!</h3>
                        @foreach ($errors->all() as $error)
                            <p class="mb-0">{{ $error }}</p>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
        <?php //dd($user); ?>
          <form method="POST" action="/saveEditTempUser" />
          @csrf
          <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-t-80 mg-b-10">Basic Details</h6>
          <p class="mg-b-30 tx-gray-600"></p>

          <div class="form-layout form-layout-2">
            <div class="row no-gutters">
              <div class="col-md-4">
                <div class="form-group">
                <input class="form-control" type="hidden" name="id" value="<?php echo $user->id; ?>" >
                  <label class="form-control-label">Firstname: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="firstname" value="<?php echo $user->first_name; ?>"  placeholder="Enter first name">
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Middlename: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="middlename" value="<?php echo $user->middle_name; ?>" placeholder="Enter Middle name">
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Lastname: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="lastname" value="<?php echo $user->last_name; ?>" placeholder="Enter last name">
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Mobile: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="mobile" value="<?php echo $user->mobile; ?>" placeholder="Enter Mobile">
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Alternate Mobile: </label>
                  <input class="form-control" type="text" name="alt_number" value="<?php echo $user->alt_number; ?>" placeholder="Enter Alternate Mobile">
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Email address: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="email" value="<?php echo $user->email; ?>" placeholder="Enter email address">
                </div>
              </div><!-- col-4 -->

              <div class="col-md-4">
                <div class="form-group mg-md-l--1 bd-t-0-force">
                  <label class="form-control-label mg-b-0-force">Gender: <span class="tx-danger">*</span></label>
                  <select id="select2-a" class="form-control" name="gender" data-placeholder="Choose Gender">
                    <option label="Choose Gender"></option>
                    <option value="Male" <?php if($user->gender == "Male"){ echo "selected";} ?>>Male</option>
                    <option value="Female" <?php if($user->gender == "Female"){ echo "selected";} ?>>Female</option>
                  </select>
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Height: </label>
                  <input class="form-control" type="text" name="height" value="<?php echo $user->height; ?>" placeholder="Enter height">
                </div>
              </div><!-- col-4 -->

              <div class="col-md-4 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Qualification:</label>
                  <input class="form-control" type="text" name="qualification" value="<?php echo $user->qualification; ?>" placeholder="Enter Qualification">
                </div>
              </div><!-- col-4 -->
             
              <div class="col-md-4 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Address: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="address" value="<?php echo $user->address; ?>" placeholder="Enter Address">
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">State: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="state" value="<?php echo $user->state; ?>" placeholder="Enter State">
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Country: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="country" value="<?php echo $user->country; ?>" placeholder="Enter Country">
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Pincode: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="pincode" value="<?php echo $user->pincode; ?>" placeholder="Enter Pincode">
                </div>
              </div><!-- col-4 -->
              
              <div class="col-md-4">
                <div class="form-group">
                  
                  <label class="form-control-label">DOB: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="dob" placeholder="Enter DOB" value="<?php if($user != ''){ echo $user->dob; } ?>">
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-control-label">Created By:</label>
                  <input class="form-control" type="text" name="created_by" placeholder="Enter created_by" value="<?php echo $user->created_by; ?>">
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-control-label">Refer By:</label>
                  <input class="form-control" type="text" name="refer_by" placeholder="Enter Refer By" value="<?php echo $user->refer_by; ?>">
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-control-label">Height From:</label>
                  <input class="form-control" type="text" name="height_from" placeholder="Enter height_from" value="<?php echo $user->height_from ?>">
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-control-label">Height To:</label>
                  <input class="form-control" type="text" name="height_to"  placeholder="Enter Height from" value="<?php echo $user->height_from ?>">
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-control-label">Age From:</label>
                  <input class="form-control" type="text" name="age_from" placeholder="Enter age_from" value="<?php echo $user->age_from ?>">
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-control-label">Age To:</label>
                  <input class="form-control" type="text" name="age_to"  placeholder="Enter age to" value="<?php echo $user->age_to ?>">
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-control-label">Annual Income:</label>
                  <input class="form-control" type="text" name="annual_income" placeholder="Enter Annual Income" value="<?php echo $user->annual_income ?>">
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-control-label">Diet Type:</label>
                  <input class="form-control" type="text" name="diet_type"  placeholder="Enter Diet Type" value="<?php echo $user->diet_type ?>">
                </div>
              </div><!-- col-4 -->

              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-control-label">Work Type:</label>
                  <input class="form-control" type="text" name="work_type" placeholder="Enter Work Type" value="<?php echo $user->work_type ?>">
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-control-label">Caste:</label>
                  <input class="form-control" type="text" name="caste"  placeholder="Enter Caste" value="<?php echo $user->caste ?>">
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-control-label">Gotra:</label>
                  <input class="form-control" type="text" name="gotra" placeholder="Enter Gotra" value="<?php echo $user->gotra ?>">
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-control-label">Marital Status:</label>
                  <input class="form-control" type="text" name="marital_status"  placeholder="Enter Marital Status" value="<?php echo $user->marital_status ?>">
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-control-label">Quality:</label>
                  <input class="form-control" type="text" name="quality"  placeholder="Enter Quality" value="<?php echo $user->quality ?>">
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-control-label">Send Sms:</label>
                  <input class="form-control" type="checkbox" name="is_sms"  <?php if($user->is_sms){ echo "checked";} ?>>
                </div>
              </div><!-- col-4 -->
            </div><!-- row -->
            <div class="form-layout-footer bd pd-20 bd-t-0">
              <button class="btn btn-info">Update Records</button>
              <a class="btn btn-info" href="/saveTempMoveToMain/<?php echo $user->id; ?>">Move to Main Users</a>
              <button class="btn btn-secondary">Cancel</button>
            </div>
          </div><!-- form-layout -->
        </form>



        </div><!-- br-section-wrapper -->
      </div><!-- br-pagebody -->

      <footer class="br-footer">
        <div class="footer-left">
          <div class="mg-b-2">Copyright &copy; 2022. Manglam. All Rights Reserved.</div>
          <div>Attentively and carefully made by Manglam.</div>
        </div>
        <div class="footer-right d-flex align-items-center">
          <span class="tx-uppercase mg-r-10">Share:</span>
          <a target="_blank" class="pd-x-5" href="https://www.facebook.com/sharer/sharer.php?u=http%3A//themepixels.me/bracket/intro"><i class="fa fa-facebook tx-20"></i></a>
          <a target="_blank" class="pd-x-5" href="https://twitter.com/home?status=Bracket,%20your%20best%20choice%20for%20premium%20quality%20admin%20template%20from%20Bootstrap.%20Get%20it%20now%20at%20http%3A//themepixels.me/bracket/intro"><i class="fa fa-twitter tx-20"></i></a>
        </div>
      </footer>

    </div><!-- br-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->
  @endsection
