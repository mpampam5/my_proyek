<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>Login</title>
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
        <link rel="stylesheet" href="<?=base_url()?>_template/backend/plugins/jquery-toast-plugin/jquery.toast.min.css">

<style media="screen">
  .logo-admin h1{
    /* font-size: 24px; */
    color:#2e2e2e;
    text-transform: uppercase;
    padding-top: 30px;
  }
</style>
    </head>


    <body>

        <!-- Loader -->
        <div id="preloader"><div id="status"><div class="spinner"></div></div></div>

        <!-- Begin page -->
        <div class="accountbg"></div>
        <div class="wrapper-page">

            <div class="card animated zoomIn delay-2s">
                <div class="card-body">

                    <h3 class="text-center m-0">
                        <a href="#" class="logo logo-admin">
                          <!-- <img src="<?=base_url()?>_template/backend/images/logo_dark.png" height="30" alt="logo"> -->
                          <h1 class="animated zoomIn delay-50s"><?=config_system("title")?></h1>
                        </a>
                    </h3>

                    <div class="p-3">
                        <!-- <h4 class="text-muted font-18 m-b-5 text-center">Welcome Back !</h4> -->
                        <p class="text-muted text-center">Silahkan login untuk melanjutkan</p>

                        <form class="form-horizontal m-t-30" id="form" action="<?=site_url("backend/login/action")?>" autocomplete="off">

                            <div class="form-group">
                                <label for="username">Email</label><span id="email"></span>
                                <input type="text" class="form-control" name="email" placeholder="Enter email">
                            </div>

                            <div class="form-group">
                                <label for="userpassword">Password</label><span id="password"></span>
                                <input type="password" class="form-control" name="password" placeholder="Enter password">
                            </div>

                            <div class="form-group row m-t-20">
                                <div class="col-sm-12 text-right">
                                    <button class="btn btn-primary btn-block w-md waves-effect waves-light" id="submit" name="submit" type="submit">Log In</button>
                                </div>
                            </div>

                            <div class="form-group m-t-10 mb-0 row">
                                <div class="col-12 m-t-20 text-center">
                                    <p>© <?=date('Y')?> <i class="mdi mdi-heart text-primary"></i> Idea.</p>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>


        </div>


        <!-- jQuery  -->
        <script src="<?=base_url()?>_template/backend/js/jquery.min.js"></script>
        <script src="<?=base_url()?>_template/backend/js/bootstrap.bundle.min.js"></script>
        <script src="<?=base_url()?>_template/backend/js/modernizr.min.js"></script>
        <script src="<?=base_url()?>_template/backend/js/waves.js"></script>
        <script src="<?=base_url()?>_template/backend/plugins/jquery-toast-plugin/jquery.toast.min.js"></script>
        <script src="<?=base_url()?>_template/backend/js/jquery.slimscroll.js"></script>
        <script src="<?=base_url()?>_template/backend/js/jquery.nicescroll.js"></script>
        <script src="<?=base_url()?>_template/backend/js/jquery.scrollTo.min.js"></script>

        <!-- App js -->
        <script src="<?=base_url()?>_template/backend/js/app.js"></script>
        <script type="text/javascript">
        $("#form").submit(function(e){
        e.preventDefault();
        var me = $(this);
        $("#submit").prop('disabled',true).html('Loading...');
        $(".form-group").find('.text-danger').remove();
        $.ajax({
              url             : me.attr('action'),
              type            : 'post',
              data            :  new FormData(this),
              contentType     : false,
              cache           : false,
              dataType        : 'JSON',
              processData     :false,
              success:function(json){
                if (json.success==true) {
                  if (json.valid==true) {
                    window.location.href = json.url;
                  }else {
                    $("#submit").prop('disabled',false)
                                .html('Log In');
                    $("input[type=password]").val("");
                    $.toast({
                      text: json.alert,
                      showHideTransition: 'slide',
                      icon: 'error',
                      loaderBg: '#f7c800',
                      position: 'top-center',
        							hideAfter: 3000
                    });
                  }
                }else {
                  $("#submit").prop('disabled',false)
                              .html('Log In');
                  $.each(json.alert, function(key, value) {
                    var element = $('#' + key);
                    $(element)
                    .closest('.form-group')
                    .find('.text-danger').remove();
                    $(element).after(value);
                  });
                }
              }
            });
        });
        </script>
    </body>
</html>
