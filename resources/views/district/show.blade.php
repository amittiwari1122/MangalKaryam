@extends('layouts/afterlogin')

@section('content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">
      <div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
          <a class="breadcrumb-item" href="/dashboard">Dashboard</a>
          <a class="breadcrumb-item" href="/getDistrict">District</a>
          <span class="breadcrumb-item active">Edit Form</span>
        </nav>
      </div><!-- br-pageheader -->
      <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
        <h4 class="tx-gray-800 mg-b-5">District Edit Form</h4>
        <p class="mg-b-0">Master Tables</p>
      </div>

      <div class="br-pagebody">
        <div class="br-section-wrapper">
          <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">District Edit Page</h6>
          <p class="mg-b-30 tx-gray-600"></p>
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
          <form method="POST" action="/saveUpdateDistrict/<?php echo $city->id; ?>" />
          @csrf
          <div class="form-layout form-layout-1">
            <div class="row mg-b-25">
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label">District name: </label>
                  <input class="form-control" type="text" name="name" value="<?php echo $city->name; ?>" placeholder="Enter state name" disabled>
                </div>
              </div><!-- col-4 -->

              <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label">Description: </label>
                  <input class="form-control" type="text" name="description" value="<?php echo $city->description; ?>" placeholder="Enter description" disabled>
                </div>
              </div><!-- col-4 -->

              <div class="col-lg-6">
                <div class="form-group mg-b-10-force">
                  <label class="form-control-label">State: </label>
                  <select class="form-control select2" name="state_id" data-placeholder="Choose State" disabled>
                    <option label="Choose State"></option>
                    <?php foreach ($state as $ct) { ?>
                    <option value="<?php echo $ct->id; ?>" <?php if($ct->id == $city->state_id){ echo "selected"; }else{ echo ""; } ?>><?php echo $ct->name; ?></option>
                  <?php } ?>
                  </select>
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-6">
                <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Status: </label>
                  <select class="form-control select2" name="status" data-placeholder="Choose status" disabled>
                    <option label="Choose Status"></option>
                    <?php foreach ($status as $st) { ?>
                    <option value="<?php echo $st->id; ?>" <?php if($st->id == $city->status){ echo "selected"; }else{ echo ""; } ?>><?php echo $st->name; ?></option>
                  <?php } ?>
                  </select>
                </div>
              </div><!-- col-4 -->
            </div><!-- row -->

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
