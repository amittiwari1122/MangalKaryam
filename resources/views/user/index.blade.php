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
          <a class="breadcrumb-item" href="/getUser">Users</a>
          <span class="breadcrumb-item active">User List</span>
        </nav>
      </div><!-- br-pageheader -->
      <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
        <h4 class="tx-gray-800 mg-b-5">User List</h4>
        <p class="mg-b-0">User Related list page.</p>
        <form class="" action="/importUser" method="POST" enctype="multipart/form-data">
          @csrf
          <div style="float:right;">
            Upload Users File <input type="file" name="upload" accept=".csv" ><input type="submit" name="submit" value="submit" /> <a class="pd-x-20 pd-sm-x-3" href="/downloadfile">Download sample file</a>
          </div>
        </form>
      </div>
      <br/>


      <div class="br-pagebody">
        <div class="br-section-wrapper">
          <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Users List</h6>
          <p class="mg-b-25 mg-lg-b-50"><a href="/addUser" class="btn btn-info">Add New Users</a></p>
          @if (session('message'))
              <div class="alert" style="color:red">{{ session('message') }}</div>
          @endif
          <form class="" action="/getUser" method="post">
            @csrf
            <div class="form-layout">
              <div class="row no-gutters">
                <div class="col-md-2">

                  <div class="form-group">
                    <input class="form-control" placeholder="search by name" name="first_name" type="text">
                  </div>
                </div><!-- col-4 -->
                &nbsp;
                <div class="col-md-2">
                  <div class="form-group">
                    <input class="form-control" placeholder="search by email" name="email" type="text">
                  </div>
                </div><!-- col-4 -->
                &nbsp;
                <div class="col-md-2">
                  <div class="form-group">
                    <input class="form-control" placeholder="serach by mobile no." name="mobile" type="text">
                  </div>
                </div><!-- col-4 -->
                &nbsp;
                <div class="col-md-2">
                  <div class="form-group">
                    <input class="form-control" placeholder="Input box" type="text">
                  </div>
                </div><!-- col-4 -->
                &nbsp;
                <div class="col-md-2">
                  <div class="form-group">
                  <select id="select2-a" class="form-control" name="role_id" data-placeholder="Choose role">
                    <option label="Choose role"></option>
                    <option value="1">Admin</option>
                    <option value="2">Executive</option>
                    <option value="3">User</option>
                  </select>
                  </div>
                </div><!-- col-4 -->
                &nbsp;
                <div class="col-md-2">
                  <div class="form-group">
                    <button class="btn btn-info">Search</button>
                  </div>
                </div><!-- col-4 -->

              </div>

            </div>
          </form>
          <div class="table-wrapper">
            <table id="datatable" class="table display responsive nowrap">
              <thead>
                <tr>
                  <th class="wd-15p">User Name</th>
                  <th class="wd-15p">Email</th>
                  <th class="wd-15p">Mobile</th>
                  <th class="wd-15p">ProfileImage</th>
                  <th class="wd-15p">Role</th>
                  <th class="wd-15p">Created date</th>
                  <th class="wd-15p">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($user as $udata) { ?>
                <tr>
                  <td><?php echo $udata->name; ?></td>
                  <td><?php echo $udata->email; ?></td>
                  <td><?php echo $udata->mobile; ?></td>
                  <td><img src="<?php echo $udata->file_path; ?>" alt="Profile Image" width="150" height="100"></td>
                  <td><?php if($udata->role_id == 1){ echo "Admin";}elseif($udata->role_id == 2){ echo "Executive";}else{ echo "User";} ?></td>
                  <td><?php echo $udata->created_at; ?></td>
                  <td><a href="/updateUser/<?php echo $udata->id; ?>"><i class="fa fa-pencil" ></i></a> | <a href="/deleteUser/<?php echo $udata->id; ?>"><i class="fa fa-remove" ></i></a></td>
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
