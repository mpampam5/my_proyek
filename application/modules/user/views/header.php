<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title><?=$title?></title>
        <meta content="Dashboard" name="description" />
        <meta content="IDEA" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App Icons -->
        <link rel="shortcut icon" href="<?=base_url()?>_template/usrp/images/favicon.ico">

        <!--Morris Chart CSS -->
        <link rel="stylesheet" href="<?=base_url()?>_template/usrp/plugins/morris/morris.css">

        <!-- Basic Css files -->
        <link href="<?=base_url()?>_template/usrp/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="<?=base_url()?>_template/usrp/css/icons.css" rel="stylesheet" type="text/css">
        <link href="<?=base_url()?>_template/usrp/css/style.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="<?=base_url()?>_template/backend/plugins/jquery-toast-plugin/jquery.toast.min.css">

        <!-- jQuery  -->
        <script src="<?=base_url()?>_template/usrp/js/jquery.min.js"></script>
        <script src="<?=base_url()?>_template/usrp/js/bootstrap.bundle.min.js"></script>
                <script src="<?=base_url()?>_template/backend/plugins/jquery-toast-plugin/jquery.toast.min.js"></script>
        <script src="<?=base_url()?>_template/usrp/js/modernizr.min.js"></script>
        <script src="<?=base_url()?>_template/usrp/js/jquery.slimscroll.js"></script>
        <script src="<?=base_url()?>_template/usrp/js/waves.js"></script>
        <script src="<?=base_url()?>_template/usrp/js/jquery.nicescroll.js"></script>
        <script src="<?=base_url()?>_template/usrp/js/jquery.scrollTo.min.js"></script>
    </head>


    <body class="fixed-left">

        <!-- Loader -->
        <div id="preloader"><div id="status"><div class="spinner"></div></div></div>

        <!-- Begin page -->
        <div id="wrapper">

            <!-- ========== Left Sidebar Start ========== -->
            <div class="left side-menu">

                <!-- LOGO -->


                <div class="sidebar-inner slimscrollleft">
                    <div id="sidebar-menu">
                        <ul>

                            <li class="menu-title">Main Menu</li>

                            <li>
                                <a href="<?=site_url("user/dashboard")?>" class="waves-effect"><i class="dripicons-device-desktop"></i><span> Dashboard </span></a>
                            </li>

                            <li>
                                <a href="<?=site_url("user/master_proyek")?>" class="waves-effect"><i class="dripicons-copy"></i><span> Daftar Proyek </span></a>
                            </li>

                            <li>
                                <a href="<?=site_url("user/deposit")?>" class="waves-effect"><i class="fa fa-file"></i><span> Deposit </span></a>
                            </li>

                            <li>
                                <a href="<?=site_url("user/withdraw")?>" class="waves-effect"><i class="fa fa-file"></i><span> Withdraw </span></a>
                            </li>

                            <li>
                                <a href="<?=site_url("user/profile")?>" class="waves-effect"><i class="fa fa-user"></i><span> Profile </span></a>
                            </li>

                            <!-- <li>
                                <a href="index.html" class="waves-effect"><i class="fa fa-book"></i><span> Baca panduan </span></a>
                            </li> -->

                            <li>
                                <a href="<?=site_url("user/login/logout")?>" class="waves-effect"><i class="fa fa-sign-out"></i><span> Logout </span></a>
                            </li>

                        </ul>
                    </div>
                    <div class="clearfix"></div>
                </div> <!-- end sidebarinner -->
            </div>
            <!-- Left Sidebar End -->


            <!-- Start right Content here -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">

                    <!-- Top Bar Start -->
                    <div class="topbar">

                        <nav class="navbar-custom">
                            <!-- Search input -->
                            <div class="search-wrap" id="search-wrap">
                                <div class="search-bar">
                                    <input class="search-input" type="search" placeholder="Search" />
                                    <a href="#" class="close-search toggle-search" data-target="#search-wrap">
                                        <i class="mdi mdi-close-circle"></i>
                                    </a>
                                </div>
                            </div>

                            <ul class="list-inline float-right mb-0">
                                <!-- User-->
                                <li class="list-inline-item dropdown notification-list">
                                    <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button"
                                       aria-haspopup="false" aria-expanded="false">
                                        <img src="<?=base_url()?>_template/usrp/images/users/avatar-1.jpg" alt="user" class="rounded-circle">
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                        <a class="dropdown-item" href="#"><i class="dripicons-user text-muted"></i> Profile</a>
                                        <a class="dropdown-item" href="#"><i class="dripicons-wallet text-muted"></i> My Wallet</a>
                                        <a class="dropdown-item" href="#"><span class="badge badge-success float-right m-t-5">5</span><i class="dripicons-gear text-muted"></i> Settings</a>
                                        <a class="dropdown-item" href="#"><i class="dripicons-lock text-muted"></i> Lock screen</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#"><i class="dripicons-exit text-muted"></i> Logout</a>
                                    </div>
                                </li>
                            </ul>

                            <!-- Page title -->
                            <ul class="list-inline menu-left mb-0">
                                <li class="list-inline-item">
                                    <button type="button" class="button-menu-mobile open-left waves-effect">
                                        <i class="ion-navicon"></i>
                                    </button>
                                </li>
                                <li class="hide-phone list-inline-item app-search">
                                    <h3 class="page-title"><?=$title?></h3>
                                </li>
                            </ul>

                            <div class="clearfix"></div>
                        </nav>

                    </div>
                    <!-- Top Bar End -->
