@extends('layouts/afterlogin')

@section('content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">
      <div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
          <a class="breadcrumb-item" href="/dashboard">Dashboard</a>
          <a class="breadcrumb-item" href="/getUser">User List</a>
          <span class="breadcrumb-item active">Add Form</span>
        </nav>
      </div><!-- br-pageheader -->
      <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
        <h4 class="tx-gray-800 mg-b-5">User Add Form</h4>
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
          <form method="POST" action="/saveStatus" />
          @csrf
          <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-t-80 mg-b-10">Basic Details</h6>
          <p class="mg-b-30 tx-gray-600"></p>

          <div class="form-layout form-layout-2">
            <div class="row no-gutters">
              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-control-label">Firstname: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="firstname"  placeholder="Enter first name">
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Middlename: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="middlename" placeholder="Enter Middle name">
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Lastname: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="lastname" placeholder="Enter last name">
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Mobile: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="mobile" placeholder="Enter Mobile">
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Email address: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="email" placeholder="Enter email address">
                </div>
              </div><!-- col-4 -->

              <div class="col-md-4">
                <div class="form-group mg-md-l--1 bd-t-0-force">
                  <label class="form-control-label mg-b-0-force">Gender: <span class="tx-danger">*</span></label>
                  <select id="select2-a" class="form-control" name="gender" data-placeholder="Choose Gender">
                    <option label="Choose Gender"></option>
                    <option value="Male" selected>Male</option>
                    <option value="Female">Female</option>
                  </select>
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4">
                <div class="form-group mg-md-l--1 bd-t-0-force">
                  <label class="form-control-label mg-b-0-force">Age: <span class="tx-danger">*</span></label>
                  <select id="select2-a" class="form-control" name="Age" data-placeholder="Choose Age">
                    <option label="Choose Age"></option>
                    <?php foreach ($age as $age) { ?>
                      <option value="<?php echo $age->id; ?>"><?php echo $age->name; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4">
                <div class="form-group mg-md-l--1 bd-t-0-force">
                  <label class="form-control-label mg-b-0-force">Height: <span class="tx-danger">*</span></label>
                  <select id="select2-a" class="form-control" name="height" data-placeholder="Choose Height">
                    <option label="Choose Height"></option>
                    <?php foreach ($height as $ht) { ?>
                      <option value="<?php echo $ht->id; ?>"><?php echo $ht->height; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4">
                <div class="form-group mg-md-l--1 bd-t-0-force">
                  <label class="form-control-label mg-b-0-force">Weight: <span class="tx-danger">*</span></label>
                  <select id="select2-a" class="form-control" name="weight" data-placeholder="Choose weight">
                    <option label="Choose weight"></option>
                    <?php foreach ($weight as $wt) { ?>
                      <option value="<?php echo $wt->id; ?>"><?php echo $wt->name; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4">
                <div class="form-group mg-md-l--1 bd-t-0-force">
                  <label class="form-control-label mg-b-0-force">Manglik: <span class="tx-danger">*</span></label>
                  <select id="select2-a" class="form-control" name="manglik" data-placeholder="Choose manglik">
                    <option label="Choose Manglik"></option>
                    <?php foreach ($manglik as $mgk) { ?>
                      <option value="<?php echo $mgk->id; ?>"><?php echo $mgk->name; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4">
                <div class="form-group mg-md-l--1 bd-t-0-force">
                  <label class="form-control-label mg-b-0-force">Skin Tone: <span class="tx-danger">*</span></label>
                  <select id="select2-a" class="form-control" name="Skintone" data-placeholder="Choose Skin Tone">
                    <option label="Choose Skin Tone"></option>
                    <?php foreach ($skintone as $st) { ?>
                      <option value="<?php echo $st->id; ?>"><?php echo $st->name; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4">
                <div class="form-group mg-md-l--1 bd-t-0-force">
                  <label class="form-control-label mg-b-0-force">Religion: <span class="tx-danger">*</span></label>
                  <select id="select2-a" class="form-control" name="religion" data-placeholder="Choose Religion">
                    <option label="Choose Religion"></option>
                    <?php foreach ($religion as $reli) { ?>
                      <option value="<?php echo $reli->id; ?>"><?php echo $reli->name; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4">
                <div class="form-group mg-md-l--1 bd-t-0-force">
                  <label class="form-control-label mg-b-0-force">Caste: <span class="tx-danger">*</span></label>
                  <select id="select2-a" class="form-control" name="caste" data-placeholder="Choose Caste">
                    <option label="Choose Caste"></option>
                    <?php foreach ($caste as $cst) { ?>
                      <option value="<?php echo $cst->id; ?>"><?php echo $cst->name; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4">
                <div class="form-group mg-md-l--1 bd-t-0-force">
                  <label class="form-control-label mg-b-0-force">Gotra: <span class="tx-danger">*</span></label>
                  <select id="select2-a" class="form-control" name="gotra" data-placeholder="Choose Gotra">
                    <option label="Choose Gotra"></option>
                    <?php foreach ($gotra as $gt) { ?>
                      <option value="<?php echo $gt->id; ?>"><?php echo $gt->name; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4">
                <div class="form-group mg-md-l--1 bd-t-0-force">
                  <label class="form-control-label mg-b-0-force">Body Type: <span class="tx-danger">*</span></label>
                  <select id="select2-a" class="form-control" name="bodytype" data-placeholder="Choose Body Type">
                    <option label="Choose Body Type"></option>
                    <?php foreach ($bodytype as $bt) { ?>
                      <option value="<?php echo $bt->id; ?>"><?php echo $bt->name; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4">
                <div class="form-group mg-md-l--1 bd-t-0-force">
                  <label class="form-control-label mg-b-0-force">Allergic: <span class="tx-danger">*</span></label>
                  <select id="select2-a" class="form-control" name="allergic" data-placeholder="Choose Allergic">
                    <option label="Choose Allerigic"></option>
                    <?php foreach ($allerigic as $allerig) { ?>
                      <option value="<?php echo $allerig->id; ?>"><?php echo $allerig->name; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4">
                <div class="form-group mg-md-l--1 bd-t-0-force">
                  <label class="form-control-label mg-b-0-force">Marrage Status: <span class="tx-danger">*</span></label>
                  <select id="select2-a" class="form-control" name="marital_status" data-placeholder="Choose Marrage Status">
                    <option label="Choose Marrage Status"></option>
                    <?php foreach ($marragestatus as $mstatus) { ?>
                      <option value="<?php echo $mstatus->id; ?>"><?php echo $mstatus->name; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-control-label">DOB: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="dob" placeholder="Enter DOB">
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-control-label">Birth Place: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="birth_place" placeholder="Enter Birth Place">
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-control-label">Birth time: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="birth_time" placeholder="Enter Birth Time">
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-control-label">Refer By: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="referBy" placeholder="Enter Refer By">
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-control-label">Nationality: <span class="tx-danger">*</span></label>
                  <select id="select2-a" class="form-control" data-placeholder="Choose Nationality">
                    <option label="Choose Nationality"></option>
                    <?php foreach ($nationality as $national) { ?>
                      <option value="<?php echo $national->id; ?>"><?php echo $national->name; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div><!-- col-4 -->
            </div><!-- row -->
            <!-- <div class="form-layout-footer bd pd-20 bd-t-0">
              <button class="btn btn-info">Submit Form</button>
              <button class="btn btn-secondary">Cancel</button>
            </div> -->
          </div><!-- form-layout -->

          <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-t-80 mg-b-10">Looking For</h6>
          <p class="mg-b-30 tx-gray-600"></p>

          <div class="form-layout form-layout-2">
            <div class="row no-gutters">
              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-control-label">Height From: <span class="tx-danger">*</span></label>
                  <select id="select2-a" class="form-control" name="heightfrom" data-placeholder="Choose Height form">
                    <option label="Choose Height From"></option>
                    <?php foreach ($height as $ht) { ?>
                      <option value="<?php echo $ht->id; ?>"><?php echo $ht->height; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Height To: <span class="tx-danger">*</span></label>
                  <select id="select2-a" class="form-control" name="heightTo" data-placeholder="Choose Height To">
                    <option label="Choose Height To"></option>
                    <?php foreach ($height as $ht) { ?>
                      <option value="<?php echo $ht->id; ?>"><?php echo $ht->height; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Work Type: <span class="tx-danger">*</span></label>
                  <select id="select2-a" class="form-control" name="work_type" data-placeholder="Choose work type">
                    <option label="Choose work type"></option>
                    <?php foreach ($work_type as $work) { ?>
                      <option value="<?php echo $work->id; ?>"><?php echo $work->name; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-control-label">Age From: <span class="tx-danger">*</span></label>
                  <select id="select2-a" class="form-control" name="AgeFrom" data-placeholder="Choose Age From">
                    <option label="Choose Age From"></option>
                    <?php foreach ($age as $agef) { ?>
                      <option value="<?php //echo $agef->id; ?>"><?php //echo $agef->name; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Age To: <span class="tx-danger">*</span></label>
                  <select id="select2-a" class="form-control" name="AgeTo" data-placeholder="Choose Age To">
                    <option label="Choose Age To"></option>
                    <?php foreach ($age as $aget) { ?>
                      <option value="<?php //echo $aget->id; ?>"><?php //echo $aget->name; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Annual Income: <span class="tx-danger">*</span></label>
                  <select id="select2-a" class="form-control" data-placeholder="Choose Annual Income">
                    <option label="Choose Annual Income"></option>
                    <?php foreach ($annualincome as $ai) { ?>
                      <option value="<?php echo $ai->id; ?>"><?php echo $ai->income; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Diet Type: <span class="tx-danger">*</span></label>
                  <select id="select2-a" class="form-control" data-placeholder="Choose Diet Type">
                    <option label="Choose Diet Type"></option>
                    <?php foreach ($diettype as $dt) { ?>
                      <option value="<?php echo $dt->id; ?>"><?php echo $dt->diet; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Marital Status: <span class="tx-danger">*</span></label>
                  <select id="select2-a" class="form-control" data-placeholder="Choose Marital Status">
                    <option label="Choose Marital Status"></option>
                    <?php foreach ($marragestatus as $mstatus) { ?>
                      <option value="<?php echo $mstatus->id; ?>"><?php echo $mstatus->name; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Qalities: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="lastname" value="McDoe" placeholder="Enter lastname">
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Caste: <span class="tx-danger">*</span></label>
                  <select id="select2-a" class="form-control" name="caste" data-placeholder="Choose Caste">
                    <option label="Choose Caste"></option>
                    <?php foreach ($caste as $cst) { ?>
                      <option value="<?php echo $cst->id; ?>"><?php echo $cst->name; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Gotra: <span class="tx-danger">*</span></label>
                  <select id="select2-a" class="form-control" name="gotra" data-placeholder="Choose Gotra">
                    <option label="Choose Gotra"></option>
                    <?php foreach ($gotra as $gt) { ?>
                      <option value="<?php echo $gt->id; ?>"><?php echo $gt->name; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div><!-- col-4 -->

            </div><!-- row -->
            <!-- <div class="form-layout-footer bd pd-20 bd-t-0">
              <button class="btn btn-info">Submit Form</button>
              <button class="btn btn-secondary">Cancel</button>
            </div> -->
          </div><!-- form-layout -->

          <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-t-80 mg-b-10">Contact Us Details</h6>
          <p class="mg-b-30 tx-gray-600"></p>

          <div class="form-layout form-layout-2">
            <div class="row no-gutters">
              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-control-label">Contact no.: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="firstname" placeholder="Enter Contact no.">
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Alt. Contact no.: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="lastname" placeholder="Enter alternate Contact No.">
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Email address: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="email" placeholder="Enter email address">
                </div>
              </div><!-- col-4 -->
              <div class="col-md-8">
                <div class="form-group bd-t-0-force">
                  <label class="form-control-label">Mail address: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="address" placeholder="Enter address">
                </div>
              </div><!-- col-8 -->
              <div class="col-md-4">
                <div class="form-group mg-md-l--1 bd-t-0-force">
                  <label class="form-control-label mg-b-0-force">Country: <span class="tx-danger">*</span></label>
                  <select id="select2-a" class="form-control" data-placeholder="Choose country">
                    <option label="Choose country"></option>
                    <?php foreach ($country as $ctry) { ?>
                      <option value="<?php echo $ctry->id; ?>"><?php echo $ctry->name; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4">
                <div class="form-group mg-md-l--1 bd-t-0-force">
                  <label class="form-control-label mg-b-0-force">State: <span class="tx-danger">*</span></label>
                  <select id="select2-a" class="form-control" data-placeholder="Choose country">
                    <option label="Choose country"></option>
                    <?php foreach ($state as $stat) { ?>
                      <option value="<?php echo $stat->id; ?>"><?php echo $stat->name; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4">
                <div class="form-group mg-md-l--1 bd-t-0-force">
                  <label class="form-control-label mg-b-0-force">District: <span class="tx-danger">*</span></label>
                  <select id="select2-a" class="form-control" name="contact_district" data-placeholder="Choose District">
                    <option label="Choose District"></option>
                    <?php foreach ($district as $dist) { ?>
                      <option value="<?php echo $dist->id; ?>"><?php echo $dist->name; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Pin Code: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="pincode" placeholder="Enter PINCODE">
                </div>
              </div><!-- col-4 -->
            </div><!-- row -->
            <!-- <div class="form-layout-footer bd pd-20 bd-t-0">
              <button class="btn btn-info">Submit Form</button>
              <button class="btn btn-secondary">Cancel</button>
            </div> -->
          </div><!-- form-layout -->

          <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-t-80 mg-b-10">Career & Education Details</h6>
          <p class="mg-b-30 tx-gray-600"></p>

          <div class="form-layout form-layout-2">
            <div class="row no-gutters">
              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-control-label">Profession: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="firstname" value="John Paul" placeholder="Enter firstname">
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Annual Income: <span class="tx-danger">*</span></label>
                  <select id="select2-a" class="form-control" data-placeholder="Choose Annual Income">
                    <option label="Choose Annual Income"></option>
                    <?php foreach ($annualincome as $ai) { ?>
                      <option value="<?php echo $ai->id; ?>"><?php echo $ai->income; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Height Qualification: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="email" value="johnpaul@yourdomain.com" placeholder="Enter email address">
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">English Eligility Test: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="eligility_test" placeholder="Enter email address">
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Education Field: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="education_field" placeholder="Enter Education Field">
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">University Name: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="university"  placeholder="Enter University Name">
                </div>
              </div><!-- col-4 -->

            </div><!-- row -->
            <!-- <div class="form-layout-footer bd pd-20 bd-t-0">
              <button class="btn btn-info">Submit Form</button>
              <button class="btn btn-secondary">Cancel</button>
            </div> -->
          </div><!-- form-layout -->
          <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-t-80 mg-b-10">Family Details</h6>
          <p class="mg-b-30 tx-gray-600"></p>

          <div class="form-layout form-layout-2">
            <div class="row no-gutters">
              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-control-label">Family Type: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="firstname" value="John Paul" placeholder="Enter firstname">
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Mother Tongue: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="mother_tongue" placeholder="Enter Mother Tongue">
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Father Occupation: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="lastname" value="McDoe" placeholder="Enter lastname">
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Mother Occupation: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="lastname" value="McDoe" placeholder="Enter lastname">
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Family Income: <span class="tx-danger">*</span></label>
                  <select id="select2-a" class="form-control" data-placeholder="Choose Annual Income">
                    <option label="Choose Annual Income"></option>
                    <?php foreach ($annualincome as $ai) { ?>
                      <option value="<?php echo $ai->id; ?>"><?php echo $ai->income; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">No. Of Brother: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="brother"  placeholder="Enter Brother Count">
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Married: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="sister_bro" placeholder="Enter sister Married Count">
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">No. of Sister: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="sister" placeholder="Enter Sister Count">
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Married: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="sister_married" placeholder="Enter sister Married Count">
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Family Based Out of: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="family_based" placeholder="Enter Family Related">
                </div>
              </div><!-- col-4 -->

            </div><!-- row -->
            <!-- <div class="form-layout-footer bd pd-20 bd-t-0">
              <button class="btn btn-info">Submit Form</button>
              <button class="btn btn-secondary">Cancel</button>
            </div> -->
          </div><!-- form-layout -->
          <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-t-80 mg-b-10">Location Details</h6>
          <p class="mg-b-30 tx-gray-600"></p>

          <div class="form-layout form-layout-2">
            <div class="row no-gutters">
              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-control-label">Persently Living: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="current_address"  placeholder="Enter Persently Living">
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">City: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="city" name="lastname" placeholder="Enter City">
                </div>
              </div><!-- col-4 -->

              <div class="col-md-4">
                <div class="form-group mg-md-l--1 bd-t-0-force">
                  <label class="form-control-label mg-b-0-force">Country: <span class="tx-danger">*</span></label>
                  <select id="select2-a" class="form-control" data-placeholder="Choose country">
                    <option label="Choose country"></option>
                    <?php foreach ($country as $ctry) { ?>
                      <option value="<?php echo $ctry->id; ?>"><?php echo $ctry->name; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4">
                <div class="form-group mg-md-l--1 bd-t-0-force">
                  <label class="form-control-label mg-b-0-force">State: <span class="tx-danger">*</span></label>
                  <select id="select2-a" class="form-control" data-placeholder="Choose state">
                    <option label="Choose state"></option>
                    <?php foreach ($state as $stat) { ?>
                      <option value="<?php echo $stat->id; ?>"><?php echo $stat->name; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4">
                <div class="form-group mg-md-l--1 bd-t-0-force">
                  <label class="form-control-label mg-b-0-force">District: <span class="tx-danger">*</span></label>
                  <select id="select2-a" class="form-control" data-placeholder="Choose District">
                    <option label="Choose District"></option>
                    <?php foreach ($district as $dist) { ?>
                      <option value="<?php echo $dist->id; ?>"><?php echo $dist->name; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div><!-- col-4 -->
            </div><!-- row -->
            <!-- <div class="form-layout-footer bd pd-20 bd-t-0">
              <button class="btn btn-info">Submit Form</button>
              <button class="btn btn-secondary">Cancel</button>
            </div> -->
          </div><!-- form-layout -->

          <!-- <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-t-80 mg-b-10">Hobbies Details</h6>
          <p class="mg-b-30 tx-gray-600"></p>

          <div class="form-layout form-layout-2">

             <div class="col-md-4">
                <div class="form-group mg-md-l--1 bd-t-0-force">
                  <label class="form-control-label mg-b-0-force">Hobbies: <span class="tx-danger">*</span></label>
                  <select id="select2-a" class="form-control" data-placeholder="Choose country">
                    <option label="Choose country"></option>
                    <option value="USA" selected>United States of America</option>
                    <option value="UK">United Kingdom</option>
                    <option value="China">China</option>
                    <option value="Japan">Japan</option>
                  </select>
                </div>
              </div>-->
            <!-- <div class="form-layout-footer bd pd-20 bd-t-0">
              <button class="btn btn-info">Submit Form</button>
              <button class="btn btn-secondary">Cancel</button>
            </div> -->
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
