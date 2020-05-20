<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>PIN TRANSAKSI</title>
        <meta content="Silahkan Login untuk melihat aktifitas anda pada system kami." name="description" />
        <meta content="IDEA" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App Icons -->
        <link rel="shortcut icon" href="<?=base_url()?>_template/usrp/images/favicon.ico">

        <!-- App css -->
        <link href="<?=base_url()?>_template/usrp/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url()?>_template/usrp/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url()?>_template/usrp/css/style.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="<?=base_url()?>_template/backend/plugins/jquery-toast-plugin/jquery.toast.min.css">
    </head>


    <body>

        <!-- Loader -->
        <div id="preloader"><div id="status"><div class="spinner"></div></div></div>

        <!-- Begin page -->
        <div class="accountbg"></div>
        <div class="wrapper-page">
            <div class="card">
                <div class="card-body">

                    <div class="p-3">
                        <p class="text-muted text-center">Silahkan isi PIN Transaksi anda terlebih dahulu. PIN ini akan digunakan setiap kali anda melakukan transaksi</p>

                        <div id="alert"></div>

                        <form class="form-horizontal m-t-30" id="form" action="<?=site_url("user/pin/action")?>">
                            <div class="form-group">
                                <label for="password">PIN</label><span id="pin"></span>
                                <input type="password" class="form-control"  name="pin" placeholder="Masukkan PIN">
                            </div>

                            <div class="form-group">
                                <label for="password">ULANGI PIN</label><span id="pin_2"></span>
                                <input type="password" class="form-control"  name="pin_2" placeholder="Ulangi PIN">
                            </div>

                            <div class="form-group row m-t-20">
                                <div class="col-12 text-right">
                                    <button class="btn btn-primary w-md waves-effect waves-light" id="submit" name="submit" type="submit">Set PIN Transaksi</button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>

        </div>


        <!-- jQuery  -->
        <script src="<?=base_url()?>_template/usrp/js/jquery.min.js"></script>
        <script src="<?=base_url()?>_template/usrp/js/bootstrap.bundle.min.js"></script>
        <script src="<?=base_url()?>_template/backend/plugins/jquery-toast-plugin/jquery.toast.min.js"></script>
        <script src="<?=base_url()?>_template/usrp/js/modernizr.min.js"></script>
        <script src="<?=base_url()?>_template/usrp/js/waves.js"></script>
        <script src="<?=base_url()?>_template/usrp/js/jquery.slimscroll.js"></script>
        <script src="<?=base_url()?>_template/usrp/js/jquery.nicescroll.js"></script>
        <script src="<?=base_url()?>_template/usrp/js/jquery.scrollTo.min.js"></script>
        <!-- jQuery  -->

        <!-- App js -->
        <script src="<?=base_url()?>_template/usrp/js/app.js"></script>


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
                    $.toast({
                      text: json.alert,
                      showHideTransition: 'slide',
                      icon: 'success',
                      loaderBg: '#3d3d3d',
                      position: 'top-center',
        							hideAfter: 3000,
                      afterHidden: function () {
                          window.location.href = "<?=site_url("user/dashboard")?>"
                      }
                    });
                }else {
                  $("#submit").prop('disabled',false)
                              .html('Login');
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
