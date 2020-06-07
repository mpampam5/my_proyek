<!DOCTYPE html>
<html>

<head>

    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title><?=config_system("title")?> - <?=$title?></title>

    <meta name="keywords" content="IDEA Syariah" />
    <meta name="description" content="IDEA Syariah">
    <meta name="author" content="idea digital">

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?= base_url() ?>_template/public/img/favicon.ico" type="image/x-icon" />
    <link rel="apple-touch-icon" href="<?= base_url() ?>_template/public/img/apple-touch-icon.png">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">

    <!-- Web Fonts  -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800%7CShadows+Into+Light%7CPlayfair+Display:400" rel="stylesheet" type="text/css">

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>_template/public/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>_template/public/vendor/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>_template/public/vendor/animate/animate.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>_template/public/vendor/simple-line-icons/css/simple-line-icons.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>_template/public/vendor/owl.carousel/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>_template/public/vendor/owl.carousel/assets/owl.theme.default.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>_template/public/vendor/magnific-popup/magnific-popup.min.css">

    <!-- Theme CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>_template/public/css/theme.css">
    <link rel="stylesheet" href="<?= base_url() ?>_template/public/css/theme-elements.css">
    <link rel="stylesheet" href="<?= base_url() ?>_template/public/css/theme-blog.css">
    <link rel="stylesheet" href="<?= base_url() ?>_template/public/css/theme-shop.css">

    <!-- Current Page CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>_template/public/vendor/rs-plugin/css/settings.css">
    <link rel="stylesheet" href="<?= base_url() ?>_template/public/vendor/rs-plugin/css/layers.css">
    <link rel="stylesheet" href="<?= base_url() ?>_template/public/vendor/rs-plugin/css/navigation.css">
    <link rel="stylesheet" href="<?=base_url()?>_template/backend/plugins/jquery-toast-plugin/jquery.toast.min.css">

    <!-- Demo CSS -->


    <!-- Skin CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>_template/public/css/skins/skin-corporate-9.css">



    <!-- Theme Custom CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>_template/public/css/custom.css">

    <!-- Head Libs -->
    <script src="<?= base_url() ?>_template/public/vendor/jquery/jquery.min.js"></script>
    <script src="<?=base_url()?>_template/backend/plugins/jquery-toast-plugin/jquery.toast.min.js"></script>
    <!-- <script src="<?= base_url() ?>_template/public/vendor/modernizr/modernizr.min.js"></script> -->

    <style media="screen">
    body.modal-open{
            overflow: visible!important;
            position: fixed;
        }
    </style>
</head>

<body class="loading-overlay-showing" data-plugin-page-transition data-loading-overlay data-plugin-options="{'hideDelay': 500}">
    <div class="loading-overlay">
        <div class="bounce-loader">
            <div class="bounce1"></div>
            <div class="bounce2"></div>
            <div class="bounce3"></div>
        </div>
    </div>

    <div class="body">
        <header id="header" class="header-effect-shrink" data-plugin-options="{'stickyEnabled': true, 'stickyEffect': 'shrink', 'stickyEnableOnBoxed': true, 'stickyEnableOnMobile': true, 'stickyChangeLogo': true, 'stickyStartAt': 120, 'stickyHeaderContainerHeight': 70}">
            <div class="header-body border-top-0">
                <div class="header-container container">
                    <div class="header-row">
                        <div class="header-column">
                            <div class="header-row">
                                <div class="header-logo">
                                    <a href="<?= base_url() ?>">
                                        <img alt="Porto" width="100" height="48" data-sticky-width="82" data-sticky-height="40" src="<?= base_url() ?>_template/public/img/logo-corporate-9.png">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="header-column justify-content-end">
                            <div class="header-row">
                                <div class="header-nav header-nav-line header-nav-top-line header-nav-top-line-with-border order-2 order-lg-1">
                                    <div class="header-nav-main header-nav-main-square header-nav-main-effect-2 header-nav-main-sub-effect-1">
                                        <nav class="collapse">
                                            <ul class="nav nav-pills" id="mainNav">
                                                <li class="">
                                                    <a class="dropdown-item" href="<?=site_url("penggalangan-dana")?>">
                                                        Liat Semua Penggalangan
                                                    </a>
                                                </li>

                                                <li class="dropdown dropdown-reverse">
                      														<a class="nav-link dropdown-toggle" href="#">
                      															Tata Cara
                      														<i class="fas fa-chevron-down"></i></a>
                      														<ul class="dropdown-menu">
                      															<li><a href="<?=site_url("pages/cara-jadi-pendana")?>" class="dropdown-item">Jadi Pendana</a></li>
                      															<li><a href="<?=site_url("pages/cara-jadi-penerima-dana")?>" class="dropdown-item">Jadi Penerima Dana</a></li>
                                                    <li><a href="<?=site_url("pages/pengaduan")?>" class="dropdown-item">Mekanisme Layanan & Pengaduan Pengguna</a></li>
                      														</ul>
                      													</li>

                                                <li class="">
                                                    <a class="dropdown-item" href="<?=site_url("pages/aturan-dan-ketentuan")?>">
                                                        Aturan Dan Ketentuan
                                                    </a>
                                                </li>

                                                <li class="">
                                                    <a class="dropdown-item" href="<?=site_url("pages/tentang")?>">
                                                        Tentang Kami
                                                    </a>
                                                </li>


                                            </ul>
                                        </nav>
                                    </div>
                                    <button class="btn header-btn-collapse-nav" data-toggle="collapse" data-target=".header-nav-main nav">
                                        <i class="fas fa-bars"></i>
                                    </button>
                                </div>
                                <div class="header-nav-features header-nav-features-no-border header-nav-features-lg-show-border order-1 order-lg-2">
                                <?php if (!$this->session->userdata("login_user_status")): ?>
                                      <div class="header-nav-feature header-nav-features-search d-inline-flex">
                                          <a href="<?=site_url("user/login")?>" class="btn btn-outline btn-rounded btn-primary btn-sm">Masuk</a>
                                      </div>
                                      <div class="header-nav-feature header-nav-features-search d-inline-flex ml-">
                                          <a href="<?=site_url("user/register")?>" class="btn btn-outline btn-rounded btn-primary btn-sm">Daftar</a>
                                      </div>
                                  <?php else: ?>
                                    <div class="header-nav-feature header-nav-features-search d-inline-flex ml-">
                                        <a href="<?=site_url("user/dashboard")?>" class="btn btn-outline btn-rounded btn-primary btn-sm">Dashboard</a>
                                    </div>

                                    <div class="header-nav-feature header-nav-features-search d-inline-flex ml-">
                                        <a href="<?=site_url("user/login/logout/3")?>" class="btn btn-outline btn-rounded btn-primary btn-sm">Logout</a>
                                    </div>
                                <?php endif; ?>
                              </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
