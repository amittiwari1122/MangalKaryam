@extends('layouts/afterlogin')

@section('content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">
      <div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
          <a class="breadcrumb-item" href="/dashboard">Dashboard</a>
          <a class="breadcrumb-item" href="/getFile">File</a>
          <span class="breadcrumb-item active">Edit File</span>
        </nav>
      </div><!-- br-pageheader -->
      <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
        <h4 class="tx-gray-800 mg-b-5">Edit File</h4>
        <p class="mg-b-0">Master Tables</p>
      </div>

      <div class="br-pagebody">
        <div class="br-section-wrapper">
          <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">File Edit Page</h6>
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
        @if(Session::has('message'))
        <div class="row  mt-3">
                <div class="col-md-12">
                    <div class="alert alert-warning alert-dismissable" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <p class="mb-0">{{ Session::get('message') }}</p>
                        
                    </div>
                </div>
            </div>
            @endif
          <form method="POST" action="/saveUpdateFile/<?php echo $file->id; ?>" enctype="multipart/form-data" />
          @csrf
          <div class="form-layout form-layout-1">
            <div class="row mg-b-25">
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label">File name:</label>
                  <input class="form-control" type="text" name="name" value="<?php echo $file->file_name; ?>" placeholder="Please enter file name">
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label">Coffee Banner:</label>
                  <input type="file" name="image" class="form-control">
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-6">
                <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Status: <span class="tx-danger">*</span></label>
                  <select class="form-control select2" name="status" data-placeholder="Choose status">
                    <option label="Choose Status"></option>
                    <?php foreach ($status as $st) { ?>
                    <option value="<?php echo $st->id; ?>" <?php if($st->id == $file->status){ echo "selected"; }else{ echo ""; } ?>><?php echo $st->name; ?></option>
                  <?php } ?>
                  </select>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Uploaded Image: <span class="tx-danger">*</span></label>
                  <img src="<?php echo $file->file_path; ?>" alt="Uploaded image"  width="400" height="200">
                </div>
              </div><!-- col-4 -->
              
            </div><!-- row -->

            <div class="form-layout-footer">
              <button class="btn btn-info">Upload Image</button>
              <button type="button" class="btn btn-secondary">Cancel</button>
            </div><!-- form-layout-footer -->
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
