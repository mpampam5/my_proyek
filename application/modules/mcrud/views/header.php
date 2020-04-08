<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title><?=strtoupper($title)?></title>
        <meta content="Admin Dashboard" name="description" />
        <meta content="Themesbrand" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App Icons -->
        <link rel="shortcut icon" href="<?=base_url()?>_template/backend/images/favicon.ico">

        <!--Animate CSS -->
        <link href="<?=base_url()?>_template/backend/plugins/animate/animate.min.css" rel="stylesheet" type="text/css">

        <!-- App css -->
        <link href="<?=base_url()?>_template/backend/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url()?>_template/backend/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url()?>_template/backend/css/style.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url()?>_template/backend/custom.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="<?=base_url()?>_template/backend/plugins/jquery-toast-plugin/jquery.toast.min.css">
        <link href="<?=base_url()?>_template/backend/plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">

                <!-- jQuery  -->
      <script src="<?=base_url()?>_template/backend/js/jquery.min.js"></script>
      <script src="<?=base_url()?>_template/backend/js/bootstrap.bundle.min.js"></script>
      <script src="<?=base_url()?>_template/backend/js/modernizr.min.js"></script>
      <script src="<?=base_url()?>_template/backend/js/waves.js"></script>
      <script src="<?=base_url()?>_template/backend/js/jquery.slimscroll.js"></script>
      <script src="<?=base_url()?>_template/backend/js/jquery.nicescroll.js"></script>
      <script src="<?=base_url()?>_template/backend/js/jquery.scrollTo.min.js"></script>
      <script src="<?=base_url()?>_template/backend/plugins/jquery-toast-plugin/jquery.toast.min.js"></script>
      <script src="<?=base_url()?>_template/backend/plugins/sweet-alert2/sweetalert2.min.js"></script>
    
      <style media="screen">
      body.modal-open{
        padding-right: 0 !important;
      }
      </style>
    </head>


    <body>

        <!-- Loader -->
        <div id="preloader"><div id="status"><div class="spinner"></div></div></div>

        <div class="header-bg">
            <!-- Navigation Bar-->
            <header id="topnav">
                <div class="topbar-main">
                    <div class="container-fluid">
                        <!-- End Logo container-->
                        <!-- end menu-extras -->

                        <div class="clearfix"></div>

                    </div> <!-- end container -->
                </div>
                <!-- end topbar-main -->

            </header>
            <!-- End Navigation Bar-->

            <div class="container-fluid">
                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box text-center">
                            <!-- <form class="float-right app-search">
                                <input type="text" placeholder="Search..." class="form-control">
                                <button type="submit"><i class="fa fa-search"></i></button>
                            </form> -->
                            <h4 class="page-title"><?=strtoupper($title)?></h4>
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->

                <!-- <div class="row">
                    <div class="col-12 mb-4">
                        <div id="morris-bar-example" class="dash-chart"></div>

                        <div class="mt-4 text-center">
                            <button type="button" class="btn btn-outline-light ml-1 waves-effect waves-light">Year 2017</button>
                            <button type="button" class="btn btn-outline-info ml-1 waves-effect waves-light">Year 2018</button>
                            <button type="button" class="btn btn-outline-light ml-1 waves-effect waves-light">Year 2019</button>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
