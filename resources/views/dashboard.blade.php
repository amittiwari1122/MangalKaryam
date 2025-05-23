@extends('layouts/afterlogin')

@section('content')
<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    You are Logged In
                </div>
            </div>
        </div>
    </div>
</div> -->

<!-- ########## START: RIGHT PANEL ########## -->
<div class="br-sideright">
  <ul class="nav nav-tabs sidebar-tabs" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" data-toggle="tab" role="tab" href="#contacts"><i class="icon ion-ios-contact-outline tx-24"></i></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" role="tab" href="#attachments"><i class="icon ion-ios-folder-outline tx-22"></i></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" role="tab" href="#calendar"><i class="icon ion-ios-calendar-outline tx-24"></i></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" role="tab" href="#settings"><i class="icon ion-ios-gear-outline tx-24"></i></a>
    </li>
  </ul><!-- sidebar-tabs -->

  <!-- Tab panes -->
  <div class="tab-content">
    <div class="tab-pane pos-absolute a-0 mg-t-60 overflow-y-auto active" id="contacts" role="tabpanel">
      <label class="sidebar-label pd-x-25 mg-t-25">Online Contacts</label>
      <div class="contact-list pd-x-10">
        <a href="" class="contact-list-link new">
          <div class="d-flex">
            <div class="pos-relative">
              <img src="http://via.placeholder.com/280x280" class="wd-40 rounded-circle" alt="">
              <div class="contact-status-indicator bg-success"></div>
            </div>
            <div class="contact-person">
              <p class="mg-b-0">Marilyn Tarter</p>
              <span class="tx-12 op-5 d-inline-block">Clemson, CA</span>
            </div>
            <span class="tx-info tx-12"><span class="square-8 bg-info rounded-circle"></span> 1 new</span>
          </div><!-- d-flex -->
        </a><!-- contact-list-link -->
        <a href="" class="contact-list-link">
          <div class="d-flex">
            <div class="pos-relative">
              <img src="http://via.placeholder.com/280x280" class="wd-40 rounded-circle" alt="">
              <div class="contact-status-indicator bg-success"></div>
            </div>
            <div class="contact-person">
              <p class="mg-b-0 ">Belinda Connor</p>
              <span class="tx-12 op-5 d-inline-block">Fort Kent, ME</span>
            </div>
          </div><!-- d-flex -->
        </a><!-- contact-list-link -->
        <a href="" class="contact-list-link new">
          <div class="d-flex">
            <div class="pos-relative">
              <img src="http://via.placeholder.com/280x280" class="wd-40 rounded-circle" alt="">
              <div class="contact-status-indicator bg-success"></div>
            </div>
            <div class="contact-person">
              <p class="mg-b-0">Britanny Cevallos</p>
              <span class="tx-12 op-5 d-inline-block">Shiboygan Falls, WI</span>
            </div>
            <span class="tx-info tx-12"><span class="square-8 bg-info rounded-circle"></span> 3 new</span>
          </div><!-- d-flex -->
        </a><!-- contact-list-link -->
        <a href="" class="contact-list-link new">
          <div class="d-flex">
            <div class="pos-relative">
              <img src="http://via.placeholder.com/280x280" class="wd-40 rounded-circle" alt="">
              <div class="contact-status-indicator bg-success"></div>
            </div>
            <div class="contact-person">
              <p class="mg-b-0">Brandon Lawrence</p>
              <span class="tx-12 op-5 d-inline-block">Snohomish, WA</span>
            </div>
            <span class="tx-info tx-12"><span class="square-8 bg-info rounded-circle"></span> 1 new</span>
          </div><!-- d-flex -->
        </a><!-- contact-list-link -->
        <a href="" class="contact-list-link">
          <div class="d-flex">
            <div class="pos-relative">
              <img src="http://via.placeholder.com/280x280" class="wd-40 rounded-circle" alt="">
              <div class="contact-status-indicator bg-success"></div>
            </div>
            <div class="contact-person">
              <p class="mg-b-0">Andrew Wiggins</p>
              <span class="tx-12 op-5 d-inline-block">Springfield, MA</span>
            </div>
          </div><!-- d-flex -->
        </a><!-- contact-list-link -->
        <a href="" class="contact-list-link">
          <div class="d-flex">
            <div class="pos-relative">
              <img src="http://via.placeholder.com/280x280" class="wd-40 rounded-circle" alt="">
              <div class="contact-status-indicator bg-success"></div>
            </div>
            <div class="contact-person">
              <p class="mg-b-0">Theodore Gristen</p>
              <span class="tx-12 op-5 d-inline-block">Nashville, TN</span>
            </div>
          </div><!-- d-flex -->
        </a><!-- contact-list-link -->
        <a href="" class="contact-list-link">
          <div class="d-flex">
            <div class="pos-relative">
              <img src="http://via.placeholder.com/280x280" class="wd-40 rounded-circle" alt="">
              <div class="contact-status-indicator bg-success"></div>
            </div>
            <div class="contact-person">
              <p class="mg-b-0">Deborah Miner</p>
              <span class="tx-12 op-5 d-inline-block">North Shore, CA</span>
            </div>
          </div><!-- d-flex -->
        </a><!-- contact-list-link -->
      </div><!-- contact-list -->


      <label class="sidebar-label pd-x-25 mg-t-25">Offline Contacts</label>
      <div class="contact-list pd-x-10">
        <a href="" class="contact-list-link">
          <div class="d-flex">
            <div class="pos-relative">
              <img src="http://via.placeholder.com/280x280" class="wd-40 rounded-circle" alt="">
              <div class="contact-status-indicator bg-gray-500"></div>
            </div>
            <div class="contact-person">
              <p class="mg-b-0">Marilyn Tarter</p>
              <span class="tx-12 op-5 d-inline-block">Clemson, CA</span>
            </div>
          </div><!-- d-flex -->
        </a><!-- contact-list-link -->
        <a href="" class="contact-list-link">
          <div class="d-flex">
            <div class="pos-relative">
              <img src="http://via.placeholder.com/280x280" class="wd-40 rounded-circle" alt="">
              <div class="contact-status-indicator bg-gray-500"></div>
            </div>
            <div class="mg-l-10">
              <p class="mg-b-0">Belinda Connor</p>
              <span class="tx-12 op-5 d-inline-block">Fort Kent, ME</span>
            </div>
          </div><!-- d-flex -->
        </a><!-- contact-list-link -->
        <a href="" class="contact-list-link">
          <div class="d-flex">
            <div class="pos-relative">
              <img src="http://via.placeholder.com/280x280" class="wd-40 rounded-circle" alt="">
              <div class="contact-status-indicator bg-gray-500"></div>
            </div>
            <div class="contact-person">
              <p class="mg-b-0">Britanny Cevallos</p>
              <span class="tx-12 op-5 d-inline-block">Shiboygan Falls, WI</span>
            </div>
          </div><!-- d-flex -->
        </a><!-- contact-list-link -->
        <a href="" class="contact-list-link">
          <div class="d-flex">
            <div class="pos-relative">
              <img src="http://via.placeholder.com/280x280" class="wd-40 rounded-circle" alt="">
              <div class="contact-status-indicator bg-gray-500"></div>
            </div>
            <div class="contact-person">
              <p class="mg-b-0">Brandon Lawrence</p>
              <span class="tx-12 op-5 d-inline-block">Snohomish, WA</span>
            </div>
          </div><!-- d-flex -->
        </a><!-- contact-list-link -->
        <a href="" class="contact-list-link">
          <div class="d-flex">
            <div class="pos-relative">
              <img src="http://via.placeholder.com/280x280" class="wd-40 rounded-circle" alt="">
              <div class="contact-status-indicator bg-gray-500"></div>
            </div>
            <div class="contact-person">
              <p class="mg-b-0">Andrew Wiggins</p>
              <span class="tx-12 op-5 d-inline-block">Springfield, MA</span>
            </div>
          </div><!-- d-flex -->
        </a><!-- contact-list-link -->
        <a href="" class="contact-list-link">
          <div class="d-flex">
            <div class="pos-relative">
              <img src="http://via.placeholder.com/280x280" class="wd-40 rounded-circle" alt="">
              <div class="contact-status-indicator bg-gray-500"></div>
            </div>
            <div class="contact-person">
              <p class="mg-b-0">Theodore Gristen</p>
              <span class="tx-12 op-5 d-inline-block">Nashville, TN</span>
            </div>
          </div><!-- d-flex -->
        </a><!-- contact-list-link -->
        <a href="" class="contact-list-link">
          <div class="d-flex">
            <div class="pos-relative">
              <img src="http://via.placeholder.com/280x280" class="wd-40 rounded-circle" alt="">
              <div class="contact-status-indicator bg-gray-500"></div>
            </div>
            <div class="contact-person">
              <p class="mg-b-0">Deborah Miner</p>
              <span class="tx-12 op-5 d-inline-block">North Shore, CA</span>
            </div>
          </div><!-- d-flex -->
        </a><!-- contact-list-link -->
      </div><!-- contact-list -->

    </div><!-- #contacts -->


    <div class="tab-pane pos-absolute a-0 mg-t-60 overflow-y-auto" id="attachments" role="tabpanel">
      <label class="sidebar-label pd-x-25 mg-t-25">Recent Attachments</label>
      <div class="media-file-list">
        <div class="media">
          <div class="pd-10 bg-primary wd-50 ht-60 tx-center d-flex align-items-center justify-content-center">
            <i class="fa fa-file-image-o tx-28 tx-white"></i>
          </div>
          <div class="media-body">
            <p class="mg-b-0 tx-13">IMG_43445</p>
            <p class="mg-b-0 tx-12 op-5">JPG Image</p>
            <p class="mg-b-0 tx-12 op-5">1.2mb</p>
          </div><!-- media-body -->
          <a href="" class="more"><i class="icon ion-android-more-vertical tx-18"></i></a>
        </div><!-- media -->
        <div class="media mg-t-20">
          <div class="pd-10 bg-purple wd-50 ht-60 tx-center d-flex align-items-center justify-content-center">
            <i class="fa fa-file-video-o tx-28 tx-white"></i>
          </div>
          <div class="media-body">
            <p class="mg-b-0 tx-13">VID_6543</p>
            <p class="mg-b-0 tx-12 op-5">MP4 Video</p>
            <p class="mg-b-0 tx-12 op-5">24.8mb</p>
          </div><!-- media-body -->
          <a href="" class="more"><i class="icon ion-android-more-vertical tx-18"></i></a>
        </div><!-- media -->
        <div class="media mg-t-20">
          <div class="pd-10 bg-success wd-50 ht-60 tx-center d-flex align-items-center justify-content-center">
            <i class="fa fa-file-word-o tx-28 tx-white"></i>
          </div>
          <div class="media-body">
            <p class="mg-b-0 tx-13">Tax_Form</p>
            <p class="mg-b-0 tx-12 op-5">Word Document</p>
            <p class="mg-b-0 tx-12 op-5">5.5mb</p>
          </div><!-- media-body -->
          <a href="" class="more"><i class="icon ion-android-more-vertical tx-18"></i></a>
        </div><!-- media -->
        <div class="media mg-t-20">
          <div class="pd-10 bg-warning wd-50 ht-60 tx-center d-flex align-items-center justify-content-center">
            <i class="fa fa-file-pdf-o tx-28 tx-white"></i>
          </div>
          <div class="media-body">
            <p class="mg-b-0 tx-13">Getting_Started</p>
            <p class="mg-b-0 tx-12 op-5">PDF Document</p>
            <p class="mg-b-0 tx-12 op-5">12.7mb</p>
          </div><!-- media-body -->
          <a href="" class="more"><i class="icon ion-android-more-vertical tx-18"></i></a>
        </div><!-- media -->
        <div class="media mg-t-20">
          <div class="pd-10 bg-warning wd-50 ht-60 tx-center d-flex align-items-center justify-content-center">
            <i class="fa fa-file-pdf-o tx-28 tx-white"></i>
          </div>
          <div class="media-body">
            <p class="mg-b-0 tx-13">Introduction</p>
            <p class="mg-b-0 tx-12 op-5">PDF Document</p>
            <p class="mg-b-0 tx-12 op-5">7.7mb</p>
          </div><!-- media-body -->
          <a href="" class="more"><i class="icon ion-android-more-vertical tx-18"></i></a>
        </div><!-- media -->
        <div class="media mg-t-20">
          <div class="pd-10 bg-primary wd-50 ht-60 tx-center d-flex align-items-center justify-content-center">
            <i class="fa fa-file-image-o tx-28 tx-white"></i>
          </div>
          <div class="media-body">
            <p class="mg-b-0 tx-13">IMG_43420</p>
            <p class="mg-b-0 tx-12 op-5">JPG Image</p>
            <p class="mg-b-0 tx-12 op-5">2.2mb</p>
          </div><!-- media-body -->
          <a href="" class="more"><i class="icon ion-android-more-vertical tx-18"></i></a>
        </div><!-- media -->
        <div class="media mg-t-20">
          <div class="pd-10 bg-primary wd-50 ht-60 tx-center d-flex align-items-center justify-content-center">
            <i class="fa fa-file-image-o tx-28 tx-white"></i>
          </div>
          <div class="media-body">
            <p class="mg-b-0 tx-13">IMG_43447</p>
            <p class="mg-b-0 tx-12 op-5">JPG Image</p>
            <p class="mg-b-0 tx-12 op-5">3.2mb</p>
          </div><!-- media-body -->
          <a href="" class="more"><i class="icon ion-android-more-vertical tx-18"></i></a>
        </div><!-- media -->
        <div class="media mg-t-20">
          <div class="pd-10 bg-purple wd-50 ht-60 tx-center d-flex align-items-center justify-content-center">
            <i class="fa fa-file-video-o tx-28 tx-white"></i>
          </div>
          <div class="media-body">
            <p class="mg-b-0 tx-13">VID_6545</p>
            <p class="mg-b-0 tx-12 op-5">AVI Video</p>
            <p class="mg-b-0 tx-12 op-5">14.8mb</p>
          </div><!-- media-body -->
          <a href="" class="more"><i class="icon ion-android-more-vertical tx-18"></i></a>
        </div><!-- media -->
        <div class="media mg-t-20">
          <div class="pd-10 bg-success wd-50 ht-60 tx-center d-flex align-items-center justify-content-center">
            <i class="fa fa-file-word-o tx-28 tx-white"></i>
          </div>
          <div class="media-body">
            <p class="mg-b-0 tx-13">Secret_Document</p>
            <p class="mg-b-0 tx-12 op-5">Word Document</p>
            <p class="mg-b-0 tx-12 op-5">4.5mb</p>
          </div><!-- media-body -->
          <a href="" class="more"><i class="icon ion-android-more-vertical tx-18"></i></a>
        </div><!-- media -->
      </div><!-- media-list -->
    </div><!-- #history -->
    <div class="tab-pane pos-absolute a-0 mg-t-60 overflow-y-auto" id="calendar" role="tabpanel">
      <label class="sidebar-label pd-x-25 mg-t-25">Time &amp; Date</label>
      <div class="pd-x-25">
        <h2 id="brTime" class="tx-white tx-lato mg-b-5"></h2>
        <h6 id="brDate" class="tx-white tx-light op-3"></h6>
      </div>

      <label class="sidebar-label pd-x-25 mg-t-25">Events Calendar</label>
      <div class="datepicker sidebar-datepicker"></div>


      <label class="sidebar-label pd-x-25 mg-t-25">Event Today</label>
      <div class="pd-x-25">
        <div class="list-group sidebar-event-list mg-b-20">
          <div class="list-group-item">
            <div>
              <h6 class="tx-white tx-13 mg-b-5 tx-normal">Roven's 32th Birthday</h6>
              <p class="mg-b-0 tx-white tx-12 op-2">2:30PM</p>
            </div>
            <a href="" class="more"><i class="icon ion-android-more-vertical tx-18"></i></a>
          </div><!-- list-group-item -->
          <div class="list-group-item">
            <div>
              <h6 class="tx-white tx-13 mg-b-5 tx-normal">Regular Workout Schedule</h6>
              <p class="mg-b-0 tx-white tx-12 op-2">7:30PM</p>
            </div>
            <a href="" class="more"><i class="icon ion-android-more-vertical tx-18"></i></a>
          </div><!-- list-group-item -->
        </div><!-- list-group -->

        <a href="" class="btn btn-block btn-outline-secondary tx-uppercase tx-11 tx-spacing-2">+ Add Event</a>
        <br>
      </div>

    </div>
    <div class="tab-pane pos-absolute a-0 mg-t-60 overflow-y-auto" id="settings" role="tabpanel">
      <label class="sidebar-label pd-x-25 mg-t-25">Quick Settings</label>

      <div class="pd-y-20 pd-x-25 tx-white">
        <h6 class="tx-13 tx-normal">Sound Notification</h6>
        <p class="op-5 tx-13">Play an alert sound everytime there is a new notification.</p>
        <div class="pos-relative">
          <input type="checkbox" name="checkbox" class="switch-button" checked>
        </div>
      </div>

      <div class="pd-y-20 pd-x-25 tx-white">
        <h6 class="tx-13 tx-normal">2 Steps Verification</h6>
        <p class="op-5 tx-13">Sign in using a two step verification by sending a verification code to your phone.</p>
        <div class="pos-relative">
          <input type="checkbox" name="checkbox2" class="switch-button">
        </div>
      </div>

      <div class="pd-y-20 pd-x-25 tx-white">
        <h6 class="tx-13 tx-normal">Location Services</h6>
        <p class="op-5 tx-13">Allowing us to access your location</p>
        <div class="pos-relative">
          <input type="checkbox" name="checkbox3" class="switch-button">
        </div>
      </div>

      <div class="pd-y-20 pd-x-25 tx-white">
        <h6 class="tx-13 tx-normal">Newsletter Subscription</h6>
        <p class="op-5 tx-13">Enables you to send us news and updates send straight to your email.</p>
        <div class="pos-relative">
          <input type="checkbox" name="checkbox4" class="switch-button" checked>
        </div>
      </div>

      <div class="pd-y-20 pd-x-25 tx-white">
        <h6 class="tx-13 tx-normal">Your email</h6>
        <div class="pos-relative">
          <input type="email" name="email" class="form-control form-control-inverse transition pd-y-10" value="janedoe@domain.com">
        </div>
      </div>

      <div class="pd-y-20 pd-x-25">
        <h6 class="tx-13 tx-normal tx-white mg-b-20">More Settings</h6>
        <a href="" class="btn btn-block btn-outline-secondary tx-uppercase tx-11 tx-spacing-2">Account Settings</a>
        <a href="" class="btn btn-block btn-outline-secondary tx-uppercase tx-11 tx-spacing-2">Privacy Settings</a>
      </div>

    </div>
  </div><!-- tab-content -->
</div><!-- br-sideright -->
<!-- ########## END: RIGHT PANEL ########## --->

<!-- ########## START: MAIN PANEL ########## -->
<div class="br-mainpanel">
  <div class="pd-30">
    <h4 class="tx-gray-800 mg-b-5">Dashboard</h4>
    <p class="mg-b-0">Do big things with Bracket, the responsive bootstrap 4 admin template.</p>
  </div><!-- d-flex -->

  <div class="br-pagebody mg-t-5 pd-x-30">
    <div class="row row-sm">
      <div class="col-sm-6 col-xl-3">
        <div class="bg-teal rounded overflow-hidden">
          <div class="pd-25 d-flex align-items-center">
            <i class="ion ion-earth tx-60 lh-0 tx-white op-7"></i>
            <div class="mg-l-20">
              <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase tx-white-8 mg-b-10">Total Contacts</p>
              <p class="tx-24 tx-white tx-lato tx-bold mg-b-2 lh-1"><?php echo $totalUser; ?></p>
              <!-- <span class="tx-11 tx-roboto tx-white-6">24% higher yesterday</span> -->
            </div>
          </div>
        </div>
      </div><!-- col-3 -->
      <div class="col-sm-6 col-xl-3 mg-t-20 mg-sm-t-0">
        <div class="bg-danger rounded overflow-hidden">
          <div class="pd-25 d-flex align-items-center">
            <i class="ion ion-bag tx-60 lh-0 tx-white op-7"></i>
            <div class="mg-l-20">
              <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase tx-white-8 mg-b-10">Total Executives</p>
              <p class="tx-24 tx-white tx-lato tx-bold mg-b-2 lh-1"><?php echo $executiveCount; ?></p>
              <!-- <span class="tx-11 tx-roboto tx-white-6">$390,212 before tax</span> -->
            </div>
          </div>
        </div>
      </div><!-- col-3 -->
      <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
        <div class="bg-primary rounded overflow-hidden">
          <div class="pd-25 d-flex align-items-center">
            <i class="ion ion-monitor tx-60 lh-0 tx-white op-7"></i>
            <div class="mg-l-20">
              <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase tx-white-8 mg-b-10">Total Users</p>
              <p class="tx-24 tx-white tx-lato tx-bold mg-b-2 lh-1"><?php echo $userCount; ?></p>
              <!-- <span class="tx-11 tx-roboto tx-white-6">23% average duration</span> -->
            </div>
          </div>
        </div>
      </div><!-- col-3 -->
      <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
        <div class="bg-br-primary rounded overflow-hidden">
          <div class="pd-25 d-flex align-items-center">
            <i class="ion ion-clock tx-60 lh-0 tx-white op-7"></i>
            <div class="mg-l-20">
              <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase tx-white-8 mg-b-10">Bounce Rate</p>
              <p class="tx-24 tx-white tx-lato tx-bold mg-b-2 lh-1">32.16%</p>
              <span class="tx-11 tx-roboto tx-white-6">65.45% on average time</span>
            </div>
          </div>
        </div>
      </div><!-- col-3 -->
    </div><!-- row -->

    <div class="row row-sm mg-t-20">
      <div class="col-8">
        <div class="card pd-0 bd-0 shadow-base">
          <div class="pd-x-30 pd-t-30 pd-b-15">
            <div class="d-flex align-items-center justify-content-between">
              <div>
                <h6 class="tx-13 tx-uppercase tx-inverse tx-semibold tx-spacing-1">Network Performance</h6>
                <p class="mg-b-0">Duis autem vel eum iriure dolor in hendrerit in vulputate...</p>
              </div>
              <div class="tx-13">
                <p class="mg-b-0"><span class="square-8 rounded-circle bg-purple mg-r-10"></span> TCP Reset Packets</p>
                <p class="mg-b-0"><span class="square-8 rounded-circle bg-pink mg-r-10"></span> TCP FIN Packets</p>
              </div>
            </div><!-- d-flex -->
          </div>
          <div class="pd-x-15 pd-b-15">
            <div id="ch1" class="br-chartist br-chartist-2 ht-200 ht-sm-300"></div>
          </div>
        </div><!-- card -->

        <div class="card bd-0 shadow-base pd-30 mg-t-20">
          <div class="d-flex align-items-center justify-content-between mg-b-30">
            <div>
              <h6 class="tx-13 tx-uppercase tx-inverse tx-semibold tx-spacing-1">Newly Registered Users</h6>
              <p class="mg-b-0"><i class="icon ion-calendar mg-r-5"></i> From October 2017 - December 2017</p>
            </div>
            <a href="" class="btn btn-outline-info btn-oblong tx-11 tx-uppercase tx-mont tx-medium tx-spacing-1 pd-x-30 bd-2">See more</a>
          </div><!-- d-flex -->

          <table class="table table-valign-middle mg-b-0">
            <tbody>
              <tr>
                <td class="pd-l-0-force">
                  <img src="http://via.placeholder.com/280x280" class="wd-40 rounded-circle" alt="">
                </td>
                <td>
                  <h6 class="tx-inverse tx-14 mg-b-0">Deborah Miner</h6>
                  <span class="tx-12">@deborah.miner</span>
                </td>
                <td>Nov 01, 2017</td>
                <td><span id="sparkline1">1,4,4,7,5,9,4,7,5,9,1</span></td>
                <td class="pd-r-0-force tx-center"><a href="" class="tx-gray-600"><i class="icon ion-more tx-18 lh-0"></i></a></td>
              </tr>
              <tr>
                <td class="pd-l-0-force">
                  <img src="http://via.placeholder.com/280x280" class="wd-40 rounded-circle" alt="">
                </td>
                <td>
                  <h6 class="tx-inverse tx-14 mg-b-0">Belinda Connor</h6>
                  <span class="tx-12">@belinda.connor</span>
                </td>
                <td>Oct 28, 2017</td>
                <td><span id="sparkline2">1,3,6,4,5,8,4,2,4,5,0</span></td>
                <td class="pd-r-0-force tx-center"><a href="" class="tx-gray-600"><i class="icon ion-more tx-18 lh-0"></i></a></td>
              </tr>
              <tr>
                <td class="pd-l-0-force">
                  <img src="http://via.placeholder.com/280x280" class="wd-40 rounded-circle" alt="">
                </td>
                <td>
                  <h6 class="tx-inverse tx-14 mg-b-0">Andrew Wiggins</h6>
                  <span class="tx-12">@andrew.wiggins</span>
                </td>
                <td>Oct 27, 2017</td>
                <td><span id="sparkline3">1,2,4,2,3,6,4,2,4,3,0</span></td>
                <td class="pd-r-0-force tx-center"><a href="" class="tx-gray-600"><i class="icon ion-more tx-18 lh-0"></i></a></td>
              </tr>
              <tr>
                <td class="pd-l-0-force">
                  <img src="http://via.placeholder.com/280x280" class="wd-40 rounded-circle" alt="">
                </td>
                <td>
                  <h6 class="tx-inverse tx-14 mg-b-0">Brandon Lawrence</h6>
                  <span class="tx-12">@brandon.lawrence</span>
                </td>
                <td>Oct 27, 2017</td>
                <td><span id="sparkline4">1,4,4,7,5,9,4,7,5,9,1</span></td>
                <td class="pd-r-0-force tx-center"><a href="" class="tx-gray-600"><i class="icon ion-more tx-18 lh-0"></i></a></td>
              </tr>
              <tr>
                <td class="pd-l-0-force">
                  <img src="http://via.placeholder.com/280x280" class="wd-40 rounded-circle" alt="">
                </td>
                <td>
                  <h6 class="tx-inverse tx-14 mg-b-0">Marilyn Tarter</h6>
                  <span class="tx-12">@marilyn.tarter</span>
                </td>
                <td>Oct 27, 2017</td>
                <td><span id="sparkline5">1,3,6,4,5,8,4,2,4,5,0</span></td>
                <td class="pd-r-0-force tx-center"><a href="" class="tx-gray-600"><i class="icon ion-more tx-18 lh-0"></i></a></td>
              </tr>
            </tbody>
          </table>
        </div><!-- card -->

        <div class="card shadow-base card-body pd-25 bd-0 mg-t-20">
          <div class="row">
            <div class="col-sm-6">
              <h6 class="card-title tx-uppercase tx-12">Statistics Summary</h6>
              <p class="display-4 tx-medium tx-inverse mg-b-5 tx-lato">25%</p>
              <div class="progress mg-b-10">
                <div class="progress-bar bg-primary progress-bar-xs wd-30p" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
              </div><!-- progress -->
              <p class="tx-12">Nulla consequat massa quis enim. Donec pede justo, fringilla vel...</p>
              <p class="tx-11 lh-3 mg-b-0">You can also use other progress variant found in <a href="progress.html" target="blank">progress section</a>.</p>
            </div><!-- col-6 -->
            <div class="col-sm-6 mg-t-20 mg-sm-t-0 d-flex align-items-center justify-content-center">
              <span class="peity-donut" data-peity='{ "fill": ["#0866C6", "#E9ECEF"],  "innerRadius": 60, "radius": 90 }'>30/100</span>
            </div><!-- col-6 -->
          </div><!-- row -->
        </div><!-- card -->


      </div><!-- col-9 -->
      <div class="col-4">


        <div class="card bd-0 shadow-base pd-30">
          <h6 class="tx-13 tx-uppercase tx-inverse tx-semibold tx-spacing-1">Server Status</h6>
          <p class="mg-b-25">Summary of the status of your server.</p>

          <label class="tx-12 tx-gray-600 mg-b-10">CPU Usage (40.05 - 32 cpus)</label>
          <div class="progress ht-5 mg-b-10">
            <div class="progress-bar wd-25p" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
          </div>

          <label class="tx-12 tx-gray-600 mg-b-10">Memory Usage (32.2%)</label>
          <div class="progress ht-5 mg-b-10">
            <div class="progress-bar bg-teal wd-60p" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
          </div>

          <label class="tx-12 tx-gray-600 mg-b-10">Disk Usage (82.2%)</label>
          <div class="progress ht-5 mg-b-10">
            <div class="progress-bar bg-danger wd-70p" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
          </div>

          <label class="tx-12 tx-gray-600 mg-b-10">Databases (63/100)</label>
          <div class="progress ht-5 mg-b-10">
            <div class="progress-bar bg-warning wd-50p" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
          </div>

          <label class="tx-12 tx-gray-600 mg-b-10">Domains (30/50)</label>
          <div class="progress ht-5 mg-b-10">
            <div class="progress-bar bg-info wd-45p" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
          </div>

          <label class="tx-12 tx-gray-600 mg-b-10">Email Account (13/50)</label>
          <div class="progress ht-5 mg-b-10">
            <div class="progress-bar bg-purple wd-65p" role="progressbar" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
          </div>

          <div class="mg-t-20 tx-13">
            <a href="" class="tx-gray-600 hover-info">Generate Report</a>
            <a href="" class="tx-gray-600 hover-info bd-l mg-l-10 pd-l-10">Print Report</a>
          </div>
        </div><!-- card -->

        <div class="card bg-transparent shadow-base bd-0 mg-t-20">
          <div class="bg-primary rounded-top">
            <div class="pd-x-30 pd-t-30">
              <h6 class="tx-13 tx-uppercase tx-white tx-semibold tx-spacing-1">Sale Status</h6>
              <p class="mg-b-20 tx-white-6">As of October 10 - 17, 2017</p>
              <h3 class="tx-lato tx-white mg-b-0">$12, 201 <i class="icon ion-android-arrow-up tx-white-5"></i></h3>
            </div>
            <div id="chartLine1" class="wd-100p ht-150"></div>
          </div>
          <div class="bg-white pd-20 rounded-bottom d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-start">
              <div><span id="sparkline6">5,4,7,5,9,7,4</span></div>
              <div class="mg-l-15">
                <label class="tx-uppercase tx-10 tx-medium tx-spacing-1 mg-b-0">Average Sales</label>
                <h6 class="tx-inverse mg-b-0 tx-lato tx-bold">$603, 201</h6>
              </div>
            </div><!-- d-flex -->
            <div class="d-flex align-items-center">
              <div><span id="sparkline7">4,7,5,9,4,7,5</span></div>
              <div class="mg-l-15">
                <label class="tx-uppercase tx-10 tx-medium tx-spacing-1 mg-b-0">Total Sales</label>
                <h6 class="tx-inverse mg-b-0 tx-lato tx-bold">$822, 677</h6>
              </div>
            </div><!-- d-flex -->
          </div><!-- d-flex -->
        </div><!-- card -->

        <div class="card bd-0 mg-t-20">
          <div id="carousel2" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#carousel2" data-slide-to="0" class="active"></li>
              <li data-target="#carousel2" data-slide-to="1"></li>
              <li data-target="#carousel2" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner" role="listbox">
              <div class="carousel-item active">
                <div class="bg-br-primary pd-30 ht-300 pos-relative d-flex align-items-center rounded">
                  <div class="pos-absolute t-15 r-25">
                    <a href="" class="tx-white-5 hover-info"><i class="icon ion-edit tx-16"></i></a>
                    <a href="" class="tx-white-5 hover-info mg-l-7"><i class="icon ion-stats-bars tx-20"></i></a>
                    <a href="" class="tx-white-5 hover-info mg-l-7"><i class="icon ion-gear-a tx-20"></i></a>
                    <a href="" class="tx-white-5 hover-info mg-l-7"><i class="icon ion-more tx-20"></i></a>
                  </div>
                  <div class="tx-white">
                    <p class="tx-uppercase tx-11 tx-medium tx-mont tx-spacing-2 tx-white-5">Recent Article</p>
                    <h5 class="lh-5 mg-b-20">20 Best Travel Tips After 5 Years Of Traveling The World</h5>
                    <nav class="nav flex-row tx-13">
                      <a href="" class="tx-white-8 hover-white pd-l-0 pd-r-5">12K+ Views</a>
                      <a href="" class="tx-white-8 hover-white pd-x-5">234 Shares</a>
                      <a href="" class="tx-white-8 hover-white pd-x-5">43 Comments</a>
                    </nav>
                  </div>
                </div><!-- d-flex -->
              </div>
              <div class="carousel-item">
                <div class="bg-info pd-30 ht-300 pos-relative d-flex align-items-center rounded">
                  <div class="pos-absolute t-15 r-25">
                    <a href="" class="tx-white-5 hover-info"><i class="icon ion-edit tx-16"></i></a>
                    <a href="" class="tx-white-5 hover-info mg-l-7"><i class="icon ion-stats-bars tx-20"></i></a>
                    <a href="" class="tx-white-5 hover-info mg-l-7"><i class="icon ion-gear-a tx-20"></i></a>
                    <a href="" class="tx-white-5 hover-info mg-l-7"><i class="icon ion-more tx-20"></i></a>
                  </div>
                  <div class="tx-white">
                    <p class="tx-uppercase tx-11 tx-medium tx-mont tx-spacing-2 tx-white-5">Recent Article</p>
                    <h5 class="lh-5 mg-b-20">How I Flew Around the World in Business Class for $1,340</h5>
                    <nav class="nav flex-row tx-13">
                      <a href="" class="tx-white-8 hover-white pd-l-0 pd-r-5">Edit</a>
                      <a href="" class="tx-white-8 hover-white pd-x-5">Unpublish</a>
                      <a href="" class="tx-white-8 hover-white pd-x-5">Delete</a>
                    </nav>
                  </div>
                </div><!-- d-flex -->
              </div>
              <div class="carousel-item">
                <div class="bg-purple pd-30 ht-300 d-flex pos-relative align-items-center rounded">
                  <div class="pos-absolute t-15 r-25">
                    <a href="" class="tx-white-5 hover-info"><i class="icon ion-edit tx-16"></i></a>
                    <a href="" class="tx-white-5 hover-info mg-l-7"><i class="icon ion-stats-bars tx-20"></i></a>
                    <a href="" class="tx-white-5 hover-info mg-l-7"><i class="icon ion-gear-a tx-20"></i></a>
                    <a href="" class="tx-white-5 hover-info mg-l-7"><i class="icon ion-more tx-20"></i></a>
                  </div>
                  <div class="tx-white">
                    <p class="tx-uppercase tx-11 tx-medium tx-mont tx-spacing-2 tx-white-5">Recent Article</p>
                    <h5 class="lh-5 mg-b-20">10 Reasons Why Travel Makes You a Happier Person</h5>
                    <nav class="nav flex-row tx-13">
                      <a href="" class="tx-white-8 hover-white pd-l-0 pd-r-5">Edit</a>
                      <a href="" class="tx-white-8 hover-white pd-x-5">Unpublish</a>
                      <a href="" class="tx-white-8 hover-white pd-x-5">Delete</a>
                    </nav>
                  </div>
                </div><!-- d-flex -->
              </div>
            </div><!-- carousel-inner -->
          </div><!-- carousel -->
        </div><!-- card -->

      </div><!-- col-3 -->
    </div><!-- row -->

  </div><!-- br-pagebody -->
@endsection
