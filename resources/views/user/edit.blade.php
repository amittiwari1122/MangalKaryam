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
        <?php //dd($userBasicDetail); ?>
          <form method="POST" action="/saveEditUser"  enctype="multipart/form-data" />
          @csrf
          <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-t-80 mg-b-10">Basic Details</h6>
          <p class="mg-b-30 tx-gray-600"></p>

          <div class="form-layout form-layout-2">
            <div class="row no-gutters">
              <div class="col-md-4">
                <div class="form-group">
                <input class="form-control" type="hidden" name="user_id" value="<?php echo $user->id; ?>" >
                  <label class="form-control-label">Firstname: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="firstname" value="<?php echo $userDetail->first_name; ?>"  placeholder="Enter first name">
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Middlename: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="middlename" value="<?php echo $userDetail->middle_name; ?>" placeholder="Enter Middle name">
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Lastname: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="lastname" value="<?php echo $userDetail->last_name; ?>" placeholder="Enter last name">
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
                  <label class="form-control-label">Email address: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="email" value="<?php echo $user->email; ?>" placeholder="Enter email address">
                </div>
              </div><!-- col-4 -->

              <div class="col-md-4">
                <div class="form-group mg-md-l--1 bd-t-0-force">
                  <label class="form-control-label mg-b-0-force">Gender: <span class="tx-danger">*</span></label>
                  <select id="select2-a" class="form-control" name="gender" data-placeholder="Choose Gender">
                    <option label="Choose Gender"></option>
                    <option value="Male" <?php if($userDetail->gender == "Male"){ echo "selected";} ?>>Male</option>
                    <option value="Female" <?php if($userDetail->gender == "Female"){ echo "selected";} ?>>Female</option>
                  </select>
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4">
                <div class="form-group mg-md-l--1 bd-t-0-force">
                  <label class="form-control-label mg-b-0-force">Age: <span class="tx-danger">*</span></label>
                  
                  <select id="select2-a" class="form-control" name="age" data-placeholder="Choose Age">
                    <option value=""></option>
                    <?php foreach ($age as $ageNew) { ?>
                      <?php if($userBasicDetail != null){ ?>
                      <option value="<?php echo $ageNew->id; ?>"  <?php if($userBasicDetail->age_id == $ageNew->id){ echo "selected";} ?>><?php echo $ageNew->name; ?></option>
                      <?php }else{ ?>
                        <option value="<?php echo $ageNew->id; ?>" ><?php echo $ageNew->name; ?></option>
                      <?php } ?>
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
                      <?php if($userBasicDetail != ""){ ?>
                        <option value="<?php echo $ht->id; ?>" <?php if($userBasicDetail->height_id == $ht->id){ echo "selected";} ?>><?php echo $ht->height; ?></option>
                      <?php }else{ ?>
                        <option value="<?php echo $ht->id; ?>" ><?php echo $ht->height; ?></option>
                      <?php } ?>
                      
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
                      <?php if($userBasicDetail != ""){ ?>
                        <option value="<?php echo $wt->id; ?>" <?php if($userBasicDetail->weight_id == $wt->id){ echo "selected";} ?>><?php echo $wt->name; ?></option>
                      <?php }else{ ?>
                        <option value="<?php echo $wt->id; ?>"><?php echo $wt->name; ?></option>
                      <?php } ?>
                      
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
                      <?php if($userBasicDetail != ""){ ?>
                        <option value="<?php echo $mgk->id; ?>" <?php if($userBasicDetail->manglik_type_id == $mgk->id){ echo "selected";} ?>><?php echo $mgk->name; ?></option>
                      <?php }else{ ?>
                        <option value="<?php echo $mgk->id; ?>" ><?php echo $mgk->name; ?></option>
                      <?php } ?>
                      
                    <?php } ?>
                  </select>
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4">
                <div class="form-group mg-md-l--1 bd-t-0-force">
                  <label class="form-control-label mg-b-0-force">Skin Tone: <span class="tx-danger">*</span></label>
                  <select id="select2-a" class="form-control" name="skintone" data-placeholder="Choose Skin Tone">
                    <option label="Choose Skin Tone"></option>
                    <?php foreach ($skintone as $st) { ?>
                      <?php if($userBasicDetail != ""){ ?>
                        <option value="<?php echo $st->id; ?>" <?php if($userBasicDetail->skin_tone_id == $st->id){ echo "selected";} ?>><?php echo $st->name; ?></option>
                      <?php }else{ ?>
                        <option value="<?php echo $st->id; ?>" ><?php echo $st->name; ?></option>
                      <?php } ?>
                      
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
                      <?php if($userBasicDetail != ""){ ?>
                        <option value="<?php echo $reli->id; ?>" <?php if($userBasicDetail->religion_id == $reli->id){ echo "selected";} ?>><?php echo $reli->name; ?></option>
                      <?php }else{ ?>
                        <option value="<?php echo $reli->id; ?>"><?php echo $reli->name; ?></option>
                      <?php } ?>
                      
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
                      <?php if($userBasicDetail != ""){ ?>
                        <option value="<?php echo $cst->id; ?>" <?php if($userBasicDetail->caste_id == $cst->id){ echo "selected";} ?>><?php echo $cst->name; ?></option>
                      <?php }else{ ?>
                        <option value="<?php echo $cst->id; ?>"><?php echo $cst->name; ?></option>
                      <?php } ?>
                      
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
                      <?php if($userBasicDetail != ""){ ?>
                        <option value="<?php echo $gt->id; ?>" <?php if($userBasicDetail->gotra_id == $gt->id){ echo "selected";} ?>><?php echo $gt->name; ?></option>
                      <?php }else{ ?>
                        <option value="<?php echo $gt->id; ?>"><?php echo $gt->name; ?></option>
                      <?php } ?>
                      
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
                      <?php if($userBasicDetail != ""){ ?>
                        <option value="<?php echo $bt->id; ?>" <?php if($userBasicDetail->body_type_id == $bt->id){ echo "selected";} ?>><?php echo $bt->name; ?></option>
                      <?php }else{ ?>
                        <option value="<?php echo $bt->id; ?>" ><?php echo $bt->name; ?></option>
                      <?php } ?>
                      
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
                      <?php if($userBasicDetail != ""){ ?>
                        <option value="<?php echo $allerig->id; ?>" <?php if($userBasicDetail->allergic_type_id == $allerig->id){ echo "selected";} ?>><?php echo $allerig->name; ?></option>
                      <?php }else{ ?>
                        <option value="<?php echo $allerig->id; ?>"><?php echo $allerig->name; ?></option>
                      <?php } ?>
                      
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
                      <?php if($userBasicDetail != ""){ ?>
                        <option value="<?php echo $mstatus->id; ?>" <?php if($userBasicDetail->marital_status == $mstatus->id){ echo "selected";} ?>><?php echo $mstatus->name; ?></option>
                      <?php }else{ ?>
                        <option value="<?php echo $mstatus->id; ?>"><?php echo $mstatus->name; ?></option>
                      <?php } ?>
                      
                    <?php } ?>
                  </select>
                </div>
              </div><!-- col-4 -->
             
              <div class="col-md-4">
                <div class="form-group">
                  
                  <label class="form-control-label">DOB: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="dob" placeholder="Enter DOB" value="<?php if($userBasicDetail != ''){ echo $userBasicDetail->dob; } ?>">
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-control-label">Birth Place: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="birth_place" placeholder="Enter Birth Place" value="<?php if($userBasicDetail != ''){ echo $userBasicDetail->birth_place;} ?>">
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-control-label">Birth time: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="birth_time" placeholder="Enter Birth Time" value="<?php if($userBasicDetail != ''){ echo $userBasicDetail->birth_time;} ?>">
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-control-label">Refer By: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="referBy" placeholder="Enter Refer By" value="<?php if($userDetail != ''){ echo $userDetail->refer_by;} ?>">
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-control-label">Nationality: <span class="tx-danger">*</span></label>
                  <select id="select2-a" class="form-control" name="nationality" data-placeholder="Choose work type">
                    <option label="Choose Nationality"></option>
                    <?php foreach ($nationality as $national) { ?>
                      <?php if($userBasicDetail != ""){ ?>
                        <option value="<?php echo $national->id; ?>" <?php if($userBasicDetail->nationality_id == $national->id){ echo "selected";} ?>><?php echo $national->name; ?></option>
                       <?php }else{ ?>
                        <option value="<?php echo $national->id; ?>"><?php echo $national->name; ?></option>
                       <?php } ?>
                      
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
                  <select id="select2-a" class="form-control" name="lookingfor_heightfrom" data-placeholder="Choose Height form">
                    <option label="Choose Height From"></option>
                    <?php foreach ($height as $ht) { ?>
                      <?php if($userSearching != ""){ ?>
                        <option value="<?php echo $ht->id; ?>" <?php if($userSearching->height_from == $ht->id){ echo "selected";} ?>><?php echo $ht->height; ?></option>
                      <?php }else{ ?>
                        <option value="<?php echo $ht->id; ?>"><?php echo $ht->height; ?></option>
                      <?php } ?>
                      
                    <?php } ?>
                  </select>
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Height To: <span class="tx-danger">*</span></label>
                  <select id="select2-a" class="form-control" name="lookingfor_heightTo" data-placeholder="Choose Height To">
                    <option label="Choose Height To"></option>
                    <?php foreach ($height as $ht) { ?>
                      <?php if($userSearching != ""){ ?>
                        <option value="<?php echo $ht->id; ?>" <?php if($userSearching->height_to == $ht->id){ echo "selected";} ?>><?php echo $ht->height; ?></option>
                      <?php }else{ ?>
                        <option value="<?php echo $ht->id; ?>"><?php echo $ht->height; ?></option>
                      <?php } ?>
                      
                    <?php } ?>
                  </select>
                </div>
              </div><!-- col-4 -->
              
              <div class="col-md-4 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Work Type: <span class="tx-danger">*</span></label>
                  <select id="select2-a" class="form-control" name="lookingfor_worktype" data-placeholder="Choose work type">
                    <option label="Choose work type"></option>
                    <?php foreach ($work_type as $work) { ?>
                      <?php if($userSearching != ""){ ?>
                        <option value="<?php echo $work->id; ?>" <?php if($userSearching->work_type == $work->id){ echo "selected";} ?>><?php echo $work->name; ?></option>
                       <?php }else{ ?>
                        <option value="<?php echo $work->id; ?>"><?php echo $work->name; ?></option>
                       <?php } ?>
                      
                    <?php } ?>
                  </select>
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-control-label">Age From: <span class="tx-danger">*</span></label>
                  <select id="select2-a" class="form-control" name="lookingfor_ageFrom" data-placeholder="Choose Age From">
                    <option label="Choose Age From"></option>
                    <?php foreach ($age as $agef) { ?>
                      <?php if($userSearching != ""){ ?>
                        <option value="<?php echo $agef->id; ?>" <?php if($userSearching->age_from == $agef->id){ echo "selected";} ?>><?php echo $agef->name; ?></option>
                       <?php }else{ ?>
                        <option value="<?php echo $agef->id; ?>"><?php echo $agef->name; ?></option>
                       <?php } ?>
                      
                    <?php } ?>
                  </select>
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Age To: <span class="tx-danger">*</span></label>
                  <select id="select2-a" class="form-control" name="lookingfor_ageTo" data-placeholder="Choose Age To">
                    <option label="Choose Age To"></option>
                    <?php foreach ($age as $aget) { ?>
                      <?php if($userSearching != ""){ ?>
                        <option value="<?php echo $aget->id; ?>" <?php if($userSearching->age_to == $aget->id){ echo "selected";} ?>><?php echo $aget->name; ?></option>
                       <?php }else{ ?>
                        <option value="<?php echo $aget->id; ?>"><?php echo $aget->name; ?></option>
                       <?php } ?>
                      
                    <?php } ?>
                  </select>
                </div>
              </div><!-- col-4 -->
  
              <div class="col-md-4 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Annual Income: <span class="tx-danger">*</span></label>
                  <select id="select2-a" class="form-control" name="lookingfor_annual_income" data-placeholder="Choose Annual Income">
                    <option label="Choose Annual Income"></option>
                    <?php foreach ($annualincome as $ai) { ?>
                      <?php if($userSearching != ""){ ?>
                        <option value="<?php echo $ai->id; ?>" <?php if($userSearching->annual_income_id == $ai->id){ echo "selected";} ?>><?php echo $ai->incomes; ?></option>
                      <?php }else{ ?>
                        <option value="<?php echo $ai->id; ?>" ><?php echo $ai->incomes; ?></option>
                      <?php } ?>
                      
                    <?php } ?>
                  </select>
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Diet Type: <span class="tx-danger">*</span></label>
                  <select id="select2-a" class="form-control" name="lookingfor_diet_type" data-placeholder="Choose Diet Type">
                    <option label="Choose Diet Type"></option>
                    <?php foreach ($diettype as $dt) { ?>
                      <?php if($userSearching != ""){ ?>
                        <option value="<?php echo $dt->id; ?>" <?php if($userSearching->diet_type_id == $dt->id){ echo "selected";} ?>><?php echo $dt->diet; ?></option>
                      <?php }else{ ?>
                        <option value="<?php echo $dt->id; ?>" ><?php echo $dt->diet; ?></option>
                      <?php } ?>
                      
                    <?php } ?>
                  </select>
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Marital Status: <span class="tx-danger">*</span></label>
                  <select id="select2-a" class="form-control" name="lookingfor_marital_status" data-placeholder="Choose Marital Status">
                    <option label="Choose Marital Status"></option>
                    <?php foreach ($marragestatus as $mstatus) { ?>
                      <?php if($userSearching != ""){ ?>
                        <option value="<?php echo $mstatus->id; ?>" <?php if($userSearching->marital_status == $mstatus->id){ echo "selected";} ?>><?php echo $mstatus->name; ?></option>
                      <?php }else{ ?>
                        <option value="<?php echo $mstatus->id; ?>"><?php echo $mstatus->name; ?></option>
                      <?php } ?>
                      
                    <?php } ?>
                  </select>
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Qalities: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="lookingfor_qalities" value="<?php if($userSearching != ""){ echo $userSearching->quality_id;} ?>" placeholder="Enter lastname">
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Caste: <span class="tx-danger">*</span></label>
                  <select id="select2-a" class="form-control" name="lookingfor_caste" data-placeholder="Choose Caste">
                    <option label="Choose Caste"></option>
                    <?php foreach ($caste as $cst) { ?>
                      <?php if($userSearching != ""){ ?>
                        <option value="<?php echo $cst->id; ?>" <?php if($userSearching->caste_id == $cst->id){ echo "selected";} ?>><?php echo $cst->name; ?></option>
                      <?php }else{ ?>
                        <option value="<?php echo $cst->id; ?>" ><?php echo $cst->name; ?></option>
                      <?php } ?>
                      
                    <?php } ?>
                  </select>
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Gotra: <span class="tx-danger">*</span></label>
                  <select id="select2-a" class="form-control" name="lookingfor_gotra" data-placeholder="Choose Gotra">
                    <option label="Choose Gotra"></option>
                    <?php foreach ($gotra as $gt) { ?>
                      <?php if($userSearching != ""){ ?>
                        <option value="<?php echo $gt->id; ?>" <?php if($userSearching->gotra_id == $gt->id){ echo "selected";} ?>><?php echo $gt->name; ?></option>
                      <?php }else{ ?>
                        <option value="<?php echo $gt->id; ?>"><?php echo $gt->name; ?></option>
                      <?php } ?>
                      
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
                  <input class="form-control" type="text" name="contact_mobile" value="<?php if(isset($userContact->mobile)){ echo $userContact->mobile;} ?>" placeholder="Enter Contact no.">
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Alt. Contact no.: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="contact_alt_mobile" value="<?php if(isset($userContact->alt_mobile)){ echo $userContact->alt_mobile;} ?>" placeholder="Enter alternate Contact No.">
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Email address: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="contact_email" value="<?php if(isset($userContact->email)){ echo $userContact->email;} ?>" placeholder="Enter email address">
                </div>
              </div><!-- col-4 -->
              <div class="col-md-8">
                <div class="form-group bd-t-0-force">
                  <label class="form-control-label">address: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="contact_address" value="<?php if(isset($userContact->address)){ echo $userContact->address;} ?>" placeholder="Enter address">
                </div>
              </div><!-- col-8 -->
              <div class="col-md-4">
                <div class="form-group mg-md-l--1 bd-t-0-force">
                  <label class="form-control-label mg-b-0-force">Country: <span class="tx-danger">*</span></label>
                  <select id="select2-a" class="form-control" name="contact_country" data-placeholder="Choose country">
                    <option label="Choose country"></option>
                    <?php foreach ($country as $ctry) { ?>
                      <?php if($userContact != ""){ ?>
                        <option value="<?php echo $ctry->id; ?>" <?php if($userContact->country_id == $ctry->id){ echo "selected";} ?>><?php echo $ctry->name; ?></option>
                      <?php }else{ ?>
                        <option value="<?php echo $ctry->id; ?>"><?php echo $ctry->name; ?></option>
                      <?php } ?>
                      
                    <?php } ?>
                  </select>
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4">
                <div class="form-group mg-md-l--1 bd-t-0-force">
                  <label class="form-control-label mg-b-0-force">State: <span class="tx-danger">*</span></label>
                  <select id="select2-a" class="form-control" name="contact_state" data-placeholder="Choose country">
                    <option label="Choose country"></option>
                    <?php foreach ($state as $stat) { ?>
                      <?php if($userContact != ""){ ?>
                        <option value="<?php echo $stat->id; ?>" <?php if($userContact->state == $stat->id){ echo "selected";} ?>><?php echo $stat->name; ?></option>
                      <?php }else{ ?>
                        <option value="<?php echo $stat->id; ?>"><?php echo $stat->name; ?></option>
                      <?php } ?>
                      
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
                    <?php if($userContact != ""){ ?>
                        <option value="<?php echo $dist->id; ?>" <?php if($userContact->district == $dist->id){ echo "selected";} ?>><?php echo $dist->name; ?></option>
                      <?php }else{ ?>
                        <option value="<?php echo $dist->id; ?>"><?php echo $dist->name; ?></option>
                      <?php } ?>
                      <?php } ?>
                  </select>
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">City:</label>
                  <input class="form-control" type="city" name="contact_city" value="<?php if(isset($userContact->city)){ echo $userContact->city;} ?>" placeholder="Enter City">
                </div>
              </div><!-- col-4 -->
              
              <div class="col-md-4 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Pin Code: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="contact_pincode" value="<?php if(isset($userContact->pincode)){ echo $userContact->pincode;} ?>" placeholder="Enter PINCODE">
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
                  <select id="select2-a" class="form-control" name="career_profession" data-placeholder="Choose Profession">
                    <option label="Choose Profession"></option>
                    <?php foreach ($profession as $pr) { ?>
                      <?php if($userCareer != ""){ ?>
                        <option value="<?php echo $pr->id; ?>" <?php if(isset($userCareer->profession) && $userCareer->profession == $pr->id){ echo "selected";} ?>><?php echo $pr->name; ?></option>
                      <?php }else{ ?>
                        <option value="<?php echo $pr->id; ?>" ><?php echo $pr->name; ?></option>
                      <?php } ?>
                      
                    <?php } ?>
                  </select>
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Annual Income: <span class="tx-danger">*</span></label>
                  <select id="select2-a" class="form-control" name="career_annual_income" data-placeholder="Choose Annual Income">
                    <option label="Choose Annual Income"></option>
                    <?php foreach ($annualincome as $ai) { ?>
                      <?php if($userCareer != ""){ ?>
                        <option value="<?php echo $ai->id; ?>" <?php if(isset($userCareer->annual_income_id) && $userCareer->annual_income_id == $ai->id){ echo "selected";} ?>><?php echo $ai->incomes; ?></option>
                      <?php }else{ ?>
                        <option value="<?php echo $ai->id; ?>" ><?php echo $ai->incomes; ?></option>
                      <?php } ?>
                      
                    <?php } ?>
                  </select>
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Highest Qualification: <span class="tx-danger">*</span></label>
                 <select id="select2-a" class="form-control" name="career_highest_qualification" data-placeholder="Choose Annual Income">
                    <option label="Choose Highest Qualification"></option>
                    <?php foreach ($qualification as $ai) { ?>
                      <?php if($userFamily != ""){ ?>
                        <option value="<?php echo $ai->id; ?>" <?php if(isset($userCareer->qualification_id) && $userCareer->qualification_id == $ai->id){ echo "selected";} ?>><?php echo $ai->qualification; ?></option>
                      <?php }else{ ?>
                        <option value="<?php echo $ai->id; ?>"><?php echo $ai->qualification; ?></option>
                      <?php } ?>
                      
                    <?php } ?>
                  </select>
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">English Eligility Test: <span class="tx-danger">*</span></label>
                  <select id="select2-a" class="form-control" name="career_eligility_test">
                    <option label="Choose English Eligility"></option>
                    <?php foreach ($eligility as $ai) { ?>
                      <?php if($eligility != ""){ ?>
                        <option value="<?php echo $ai->id; ?>" <?php if(isset($userCareer->job_id) && $userCareer->job_id == $ai->id){ echo "selected";} ?>><?php echo $ai->name; ?></option>
                      <?php }else{ ?>
                        <option value="<?php echo $ai->id; ?>"><?php echo $ai->name; ?></option>
                      <?php } ?>
                      
                    <?php } ?>
                  </select>
                </div>
              </div><!-- col-4 -->
              
              <div class="col-md-4 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">University Name: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="career_university" value="<?php if(isset($userCareer->university_name)){ echo $userCareer->university_name;} ?>"  placeholder="Enter University Name">
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
                  <input class="form-control" type="text" name="family_family_type" value="<?php  if(isset($userFamily->family_type)){ echo $userFamily->family_type;} ?>" placeholder="Enter family type">
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Mother Tongue: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="family_mother_tounge" value="<?php if(isset($userFamily->mother_tounge)){ echo $userFamily->mother_tounge;} ?>" placeholder="Enter Mother Tongue">
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Father Occupation: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="family_father_occupation" value="<?php if(isset($userFamily->father_occupation)){ echo $userFamily->father_occupation;} ?>" placeholder="Enter father occupations">
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Mother Occupation: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="family_mother_occupation" value="<?php if(isset($userFamily->mother_occupation)){ echo $userFamily->mother_occupation;} ?>" placeholder="Enter mother occupations">
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Family Income: <span class="tx-danger">*</span></label>
                  <select id="select2-a" class="form-control" name="family_family_income" data-placeholder="Choose Annual Income">
                    <option label="Choose Annual Income"></option>
                    <?php foreach ($annualincome as $ai) { ?>
                      <?php if($userFamily != ""){ ?>
                        <option value="<?php echo $ai->id; ?>" <?php if(isset($userFamily->family_income) && $userFamily->family_income == $ai->id){ echo "selected";} ?>><?php echo $ai->incomes; ?></option>
                      <?php }else{ ?>
                        <option value="<?php echo $ai->id; ?>"><?php echo $ai->incomes; ?></option>
                      <?php } ?>
                      
                    <?php } ?>
                  </select>
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">No. Of Brother: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="family_no_brothers" value="<?php if(isset($userFamily->no_brothers)){ echo $userFamily->no_brothers;} ?>"  placeholder="Enter Brother Count">
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Marriage Status: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="family_married_brothers" value="<?php if(isset($userFamily->married_brothers)){ echo $userFamily->married_brothers;} ?>" placeholder="Enter sister Married Count">
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">No. of Sister: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="family_no_sisters" value="<?php if(isset($userFamily->no_sisters)){ echo $userFamily->no_sisters;} ?>" placeholder="Enter Sister Count">
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Marriage Status: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="family_married_sisters" value="<?php if(isset($userFamily->married_sisters)){ echo $userFamily->married_sisters;} ?>" placeholder="Enter sister Married Count">
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Family Based Out of: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="family_family_based" value="<?php if(isset($userFamily->family_based_out)){ echo $userFamily->family_based_out;} ?>" placeholder="Enter Family Related">
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
          <?php //print_r($userFamily); ?>
          <div class="form-layout form-layout-2">
            <div class="row no-gutters">
              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-control-label">Persently Living: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="location_living_place" value="<?php if(isset($userLocation->living_place)){ echo $userLocation->living_place;} ?>"  placeholder="Enter Persently Living">
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">City:</label>
                  <input class="form-control" type="city" name="location_city" value="<?php if(isset($userLocation->city)){ echo $userLocation->city;} ?>" placeholder="Enter City">
                </div>
              </div><!-- col-4 -->

              <div class="col-md-4">
                <div class="form-group mg-md-l--1 bd-t-0-force">
                  <label class="form-control-label mg-b-0-force">Country: <span class="tx-danger">*</span></label>
                  <select id="select2-a" class="form-control" name="location_country" data-placeholder="Choose country">
                    <option label="Choose country"></option>
                    <?php foreach ($country as $ctry) { ?>
                      <?php if($userLocation != ""){ ?>
                        <option value="<?php echo $ctry->id; ?>" <?php if(isset($userLocation->country_id) && $userLocation->country_id == $ctry->id){ echo "selected";} ?>><?php echo $ctry->name; ?></option>
                      <?php }else{ ?>
                        <option value="<?php echo $ctry->id; ?>" ><?php echo $ctry->name; ?></option>
                      <?php } ?>
                      
                    <?php } ?>
                  </select>
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4">
                <div class="form-group mg-md-l--1 bd-t-0-force">
                  <label class="form-control-label mg-b-0-force">State: <span class="tx-danger">*</span></label>
                  <select id="select2-a" class="form-control" name="location_state" data-placeholder="Choose state">
                    <option label="Choose state"></option>
                    <?php foreach ($state as $stat) { ?>
                      <?php if($userLocation != ""){ ?>
                        <option value="<?php echo $stat->id; ?>" <?php if(isset($userLocation->state_id) && $userLocation->state_id == $stat->id){ echo "selected";} ?>><?php echo $stat->name; ?></option>
                      <?php }else{ ?>
                        <option value="<?php echo $stat->id; ?>"><?php echo $stat->name; ?></option>
                      <?php } ?>
                      
                    <?php } ?>
                  </select>
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4">
                <div class="form-group mg-md-l--1 bd-t-0-force">
                  <label class="form-control-label mg-b-0-force">District: <span class="tx-danger">*</span></label>
                  <select id="select2-a" class="form-control" name="location_district" data-placeholder="Choose District">
                    <option label="Choose District"></option>
                    <?php foreach ($district as $dist) { ?>
                    <?php if($userLocation != ""){ ?>
                        <option value="<?php echo $dist->id; ?>" <?php if($userLocation->district_id == $dist->id){ echo "selected";} ?>><?php echo $dist->name; ?></option>
                      <?php }else{ ?>
                        <option value="<?php echo $dist->id; ?>"><?php echo $dist->name; ?></option>
                      <?php } ?>
                      <?php } ?>
                  </select>
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Image Type: <span class="tx-danger">*</span></label>
                  <select id="select2-a" class="form-control" name="image_type_id" data-placeholder="Choose image type">
                    <option value="1">Profile Image</option>
                    <option value="2">Cover Image</option>
                  </select>
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Image: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="file" name="image" value="" placeholder="upload images">
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4">
                <div class="form-group mg-md-l--1">
                <label class="form-control-label">Profile Image:</label>
                <?php if(isset($profileImage)){ ?>
                <img src="<?php echo $profileImage->file_path; ?>" alt="Profile Image" width="100" height="100">
                <?php }else{ ?>
                  No Image.
                <?php } ?>
                </div>
              </div><!-- col-4 -->
              <?php $i=1; foreach($coverImages as $coverImage){ ?>
              <div class="col-md-4">
                <div class="form-group mg-md-l--1">
                <label class="form-control-label">Cover Image <?php echo $i; ?>:</label>
                <img src="<?php echo $coverImage->file_path; ?>" alt="Cover Image" width="200" height="100">
                </div>
              </div><!-- col-4 -->
              <?php $i++; } ?>
              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-control-label">Send Sms:</label>
                  <input class="form-control" type="checkbox" name="is_sms">
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
                  <select id="select2-a" class="form-control" name="hobbies" data-placeholder="Choose country">
                    <option label="Choose country"></option>
                    <option value="USA" selected>United States of America</option>
                    <option value="UK">United Kingdom</option>
                    <option value="China">China</option>
                    <option value="Japan">Japan</option>
                  </select>
                </div>
              </div>-->
            <div class="form-layout-footer bd pd-20 bd-t-0">
              <button class="btn btn-info">Update Form</button>
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
