<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>Register Penerima Modal</title>
        <meta content="Silahkan mendaftar untuk menjadi penerima modal dari proyek yang anda kerjakan." name="description" />
        <meta content="IDEA" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App Icons -->
        <link rel="shortcut icon" href="<?=base_url()?>_template/usrp/images/favicon.ico">

        <!-- App css -->
        <link href="<?=base_url()?>_template/usrp/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url()?>_template/usrp/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url()?>_template/usrp/css/style.css" rel="stylesheet" type="text/css" />

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
                        <h4 class="text-muted font-18 m-b-5 text-center">REGISTER PENERIMA MODAL</h4>
                        <p class="text-muted text-center">Silakan mendaftar untuk menjadi penerima modal.</p>

                        <div id="alert"></div>

                        <form class="form-horizontal m-t-30" id="form" action="<?=site_url("register/usrp/action")?>" autocomplete="off">
                          <div class="form-group">
                              <label for="nama">No KTP</label><span id="no_ktp"></span>
                              <input type="text" class="form-control"  name="no_ktp" placeholder="No KTP">
                          </div>

                            <div class="form-group">
                                <label for="nama">Nama Lengkap</label><span id="nama"></span>
                                <input type="text" class="form-control"  name="nama" placeholder="Nama Lengkap">
                            </div>

                            <div class="form-group">
                                <label for="telepon">Telepon</label><span id="telepon"></span>
                                <input type="text" class="form-control"  name="telepon" placeholder="Telepon">
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label><span id="email"></span>
                                <input type="text" class="form-control"  name="email" placeholder="Email">
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label><span id="password"></span>
                                <input type="password" class="form-control"  name="password" placeholder="Password">
                            </div>

                            <div class="form-group row m-t-20">
                                <div class="col-12 text-right">
                                    <button class="btn btn-primary w-md waves-effect waves-light" id="submit" name="submit" type="submit">Register</button>
                                </div>
                            </div>

                            <div class="form-group m-t-10 mb-0 row">
                                <div class="col-12 m-t-20">
                                    <p class="font-14 text-muted mb-1">Baca <a href="#" class="font-500 font-14 text-primary font-secondary">aturan & ketentuan</a> yang berlaku.</p>
                                    <p class="font-14 text-muted">Sudah punya akun ? <a href="<?=site_url("usrp/login")?>" class="font-500 font-14 text-primary font-secondary"> Login </a> </p>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>

            <div class="m-t-40 text-center">
                <p>© <?=date('Y')?>. Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesbrand</p>
            </div>
        </div>


        <!-- jQuery  -->
        <script src="<?=base_url()?>_template/usrp/js/jquery.min.js"></script>
        <script src="<?=base_url()?>_template/usrp/js/bootstrap.bundle.min.js"></script>
        <script src="<?=base_url()?>_template/usrp/js/modernizr.min.js"></script>
        <script src="<?=base_url()?>_template/usrp/js/waves.js"></script>
        <script src="<?=base_url()?>_template/usrp/js/jquery.slimscroll.js"></script>
        <script src="<?=base_url()?>_template/usrp/js/jquery.nicescroll.js"></script>
        <script src="<?=base_url()?>_template/usrp/js/jquery.scrollTo.min.js"></script>

        <!-- App js -->
        <script src="<?=base_url()?>_template/usrp/js/app.js"></script>


        <script type="text/javascript">
        $("#form").submit(function(e){
          e.preventDefault();
          var me = $(this);
          $("#submit").prop('disabled',true).html('Loading...');
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
                    $("#alert").hide().fadeIn(1000).html(`
                                        <div class="alert alert-success bg-success text-white" role="alert">
                                            `+json.alert+`
                                        </div>
                                    `);
                    $(".form-group").find('.text-danger').remove();
                    me.trigger("reset");
                    $("#submit").prop('disabled',false)
                                .html('Register');
                  }else {
                    $("#submit").prop('disabled',false)
                                .html('Register');
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
