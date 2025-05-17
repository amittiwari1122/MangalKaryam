@extends('layouts/afterlogin')

@section('content')
<script src="//code.jquery.com/jquery.js"></script>
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">
      <div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
          <a class="breadcrumb-item" href="/dashboard">Dashboard</a>
          <a class="breadcrumb-item" href="/getCity">District</a>
          <span class="breadcrumb-item active">District List</span>
        </nav>
      </div><!-- br-pageheader -->
      <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
        <h4 class="tx-gray-800 mg-b-5">District List Details</h4>
        <p class="mg-b-0">District Related list page.</p>
      </div>

      <div class="br-pagebody">
        <div class="br-section-wrapper">
          <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">District List</h6>
          <p class="mg-b-25 mg-lg-b-50"><a href="/addDistrict" class="btn btn-info">Add New Record</a></p>

          <div class="table-wrapper">
            <table id="datatable2" class="table display responsive nowrap">
              <thead>
                <tr>
                  <th class="wd-15p">District name</th>
                  <th class="wd-15p">Descripton</th>
                  <th class="wd-15p">State name</th>
                  <th class="wd-20p">Status</th>
                  <th class="wd-15p">Created date</th>
                  <th class="wd-15p">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($citydetails as $city) { ?>
                <tr>
                  <td><?php echo $city->name; ?></td>
                  <td><?php echo $city->description; ?></td>
                  <td><?php echo $city->state_name; ?></td>
                  <td><?php if($city->status == 1){ echo "Active"; }else{ echo "In-active";} ?></td>
                  <td><?php echo $city->created_at; ?></td>
                  <td><a href="/updateDistrict/<?php echo $city->id; ?>"><i class="fa fa-pencil" ></i></a> | <a href="/showDistrict/<?php echo $city->id; ?>"><i class="fa fa-eye" ></i></a></td>
                </tr>
              <?php } ?>
              </tbody>
            </table>
          </div><!-- table-wrapper -->



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
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js" defer></script>
    <script>
      $(function(){
        'use strict';



        $('#datatable2').DataTable({
          bLengthChange: false,
          searching: false,
          responsive: true
        });

        // Select2
        $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });

      });
    </script>

  @endsection
