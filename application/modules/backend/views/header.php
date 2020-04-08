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
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />

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
      <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>

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

                        <!-- Logo container-->
                        <div class="logo">
                            <!-- Text Logo -->
                            <a href="<?=site_url("backend/dashboard")?>" class="logo logo-tilte" id="logo-tilte">
                                <?=config_system("title")?>
                            </a>
                            <!-- Image Logo -->
                            <!-- <a href="index.html" class="logo">
                                <img src="<?=base_url()?>_template/backend/images/logo-sm.png" alt="" height="22" class="logo-small">
                                <img src="<?=base_url()?>_template/backend/images/logo.png" alt="" height="24" class="logo-large">
                            </a> -->

                        </div>
                        <!-- End Logo container-->


                        <div class="menu-extras topbar-custom">

                            <ul class="list-inline float-right mb-0">

                                <!-- notification-->
                                <li class="list-inline-item dropdown notification-list">
                                    <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#" role="button"
                                    aria-haspopup="false" aria-expanded="false">
                                        <i class="ti-bell noti-icon"></i>
                                        <span class="badge badge-info badge-pill noti-icon-badge">3</span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-arrow dropdown-menu-lg">
                                        <!-- item-->
                                        <div class="dropdown-item noti-title">
                                            <h5>Notification (3)</h5>
                                        </div>

                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item notify-item active">
                                            <div class="notify-icon bg-success"><i class="mdi mdi-cart-outline"></i></div>
                                            <p class="notify-details"><b>Your order is placed</b><small class="text-muted">Dummy text of the printing and typesetting industry.</small></p>
                                        </a>

                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                                            <div class="notify-icon bg-warning"><i class="mdi mdi-message"></i></div>
                                            <p class="notify-details"><b>New Message received</b><small class="text-muted">You have 87 unread messages</small></p>
                                        </a>

                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                                            <div class="notify-icon bg-info"><i class="mdi mdi-martini"></i></div>
                                            <p class="notify-details"><b>Your item is shipped</b><small class="text-muted">It is a long established fact that a reader will</small></p>
                                        </a>

                                        <!-- All-->
                                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                                            View All
                                        </a>

                                    </div>
                                </li>
                                <!-- User-->
                                <li class="list-inline-item dropdown notification-list">
                                    <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button"
                                    aria-haspopup="false" aria-expanded="false">
                                        <img src="<?=base_url()?>_template/backend/images/users/avatar-1.jpg" alt="user" class="rounded-circle">
                                        <span class="ml-1">Denish J. <i class="mdi mdi-chevron-down"></i> </span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                        <a class="dropdown-item" href="<?=site_url("backend/login/logout")?>"><i class="dripicons-exit text-muted"></i> Logout</a>
                                    </div>
                                </li>
                                <li class="menu-item list-inline-item">
                                    <!-- Mobile menu toggle-->
                                    <a class="navbar-toggle nav-link">
                                        <div class="lines">
                                            <span></span>
                                            <span></span>
                                            <span></span>
                                        </div>
                                    </a>
                                    <!-- End mobile menu toggle-->
                                </li>

                            </ul>
                        </div>
                        <!-- end menu-extras -->

                        <div class="clearfix"></div>

                    </div> <!-- end container -->
                </div>
                <!-- end topbar-main -->

                <!-- MENU Start -->
                <div class="navbar-custom">
                    <div class="container-fluid">
                        <div id="navigation">
                            <!-- Navigation Menu-->
                            <ul class="navigation-menu">

                                <li class="has-submenu">
                                    <a href="<?=site_url("backend/dashboard")?>"><i class="dripicons-device-desktop"></i>Dashboard</a>
                                </li>

                                <?=get_main_menu();?>

                                <!-- <li class="has-submenu">
                                    <a href="#"><i class="fa fa-file"></i>Post <i class="mdi mdi-chevron-down mdi-drop"></i></a>
                                    <ul class="submenu">
                                        <li><a href="<?=site_url("backend/post")?>">Post</a></li>
                                        <li><a href="<?=site_url("backend/kategori")?>">Kategori</a></li>
                                        <li><a href="<?=site_url("backend/tags")?>">Tags</a></li>
                                    </ul>
                                </li>

                                <li class="has-submenu">
                                    <a href="#"><i class="fa fa-cogs"></i>Setting <i class="mdi mdi-chevron-down mdi-drop"></i></a>
                                    <ul class="submenu">
                                        <li><a href="<?=site_url("backend/setting_umum")?>">Umum</a></li>
                                        <li><a href="<?=site_url("backend/main_menu")?>">Main Menu</a></li>
                                        <li><a href="advanced-rating.html">Slider</a></li>
                                        <li><a href="advanced-nestable.html">Widget</a></li>
                                    </ul>
                                </li>


                                <li class="has-submenu">
                                    <a href="#"><i class="fa fa-user"></i>Manajemen Admin <i class="mdi mdi-chevron-down mdi-drop"></i></a>
                                    <ul class="submenu">
                                        <li><a href="<?=site_url("backend/administrator")?>">Administrator</a></li>
                                        <li><a href="<?=site_url("backend/level")?>">Level</a></li>
                                    </ul>
                                </li> -->


                            </ul>
                            <!-- End navigation menu -->
                        </div> <!-- end #navigation -->
                    </div> <!-- end container -->
                </div> <!-- end navbar-custom -->
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
