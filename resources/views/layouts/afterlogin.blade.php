<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <!-- Twitter -->
    <meta name="twitter:site" content="@themepixels">
    <meta name="twitter:creator" content="@themepixels">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Bracket">
    <meta name="twitter:description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="twitter:image" content="http://themepixels.me/bracket/img/bracket-social.png">

    <!-- Facebook -->
    <meta property="og:url" content="http://themepixels.me/bracket">
    <meta property="og:title" content="Bracket">
    <meta property="og:description" content="Premium Quality and Responsive UI for Dashboard.">

    <meta property="og:image" content="http://themepixels.me/bracket/img/bracket-social.png">
    <meta property="og:image:secure_url" content="http://themepixels.me/bracket/img/bracket-social.png">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="600">

    <!-- Meta -->
    <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="author" content="ThemePixels">

    <title>Manglam</title>

    <!-- vendor css -->

    <link href="{{asset('/public/lib/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('/public/lib/Ionicons/css/ionicons.css')}}" rel="stylesheet">
    <link href="{{asset('/public/lib/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet">
    <link href="{{asset('/public/lib/jquery-switchbutton/jquery.switchButton.css')}}" rel="stylesheet">
    <link href="{{asset('/public/lib/rickshaw/rickshaw.min.css')}}" rel="stylesheet">
    <link href="{{asset('/public/lib/chartist/chartist.css')}}" rel="stylesheet">
    <link href="{{asset('/public/lib/datatables/jquery.dataTables.css')}}" rel="stylesheet">
    <link href="{{asset('/public/lib/select2/css/select2.min.css')}}" rel="stylesheet">
    <link href="{{asset('/public/lib/highlightjs/github.css')}}" rel="stylesheet">

    <!-- Bracket CSS -->
    <link rel="stylesheet" href="{{asset('/public/css/bracket.css')}}">
  </head>

  <body>



    @include('includes.header')
    @include('includes.leftmenu')
    //print_r(resource_path());exit;

    		<!-- <div id="main" role="main"> -->
    			@yield('content')
    		<!-- </div> -->
    		<!-- END MAIN PANEL -->

    		<!-- PAGE FOOTER -->
        @include('includes.footer')


  </body>
</html>
