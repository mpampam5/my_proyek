<div class="wrapper">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12 col-xl-9 mx-auto animated fadeInRight delay-2s">
                <div class="card m-b-30">
                  <div class="card-body">
                    <h4 class="mt-0 header-title">Umum</h4>


                    <form id="form" action="<?=site_url("backend/setting_umum/umum_action")?>" autocomplete="off">
                      <div class="form-group row">
                          <label for="example-text-input" class="col-sm-2 col-form-label">Title System</label>
                          <div class="col-sm-10">
                              <input class="form-control" type="text" name="title" id="title" value="<?=config_system("title")?>">
                          </div>
                      </div>


                      <div class="form-group row">
                          <label for="example-search-input" class="col-sm-2 col-form-label">Telepon</label>
                          <div class="col-sm-10">
                              <input class="form-control" type="text" name="telepon" id="telepon" value="<?=config_system("telepon")?>">
                          </div>
                      </div>


                      <div class="form-group row">
                          <label for="example-email-input" class="col-sm-2 col-form-label">Email Kontak</label>
                          <div class="col-sm-10">
                              <input class="form-control" type="text" name="email" id="email" value="<?=config_system("email")?>">
                          </div>
                      </div>


                      <div class="form-group row">
                          <label for="example-url-input" class="col-sm-2 col-form-label">Domain</label>
                          <div class="col-sm-10">
                              <input class="form-control" type="text" name="domain" id="domain" value="<?=config_system("domain")?>">
                          </div>
                      </div>


                      <div class="form-group row">
                          <label for="example-tel-input" class="col-sm-2 col-form-label">Alamat</label>
                          <div class="col-sm-10">
                              <input class="form-control" type="text" name="alamat" id="alamat" value="<?=config_system("alamat")?>">
                          </div>
                      </div>


                      <div class="text-right">
                        <button type="submit" class="btn btn-sm btn-primary" id="submit" name="submit">Edit Perubahan</button>
                      </div>

                    </form>


                  </div>
                </div>
            </div>
        </div>
        <!-- end row -->

        <div class="row">
            <div class="col-md-12 col-xl-9 mx-auto animated fadeInRight delay-2s">
                <div class="card m-b-30">
                  <div class="card-body">
                    <h4 class="mt-0 header-title">System</h4>

                    <table class="table table-bordered">
                      <tr>
                        <td>Status SMTP [Aktif/Tidak]
                            <p style="font-size:12px;" class="text-primary">
                              * Semua MODUL yang mengirimkan Email Notoifikasi ke client/member akan di Nonaktifkan jika status NO.
                            </p>
                        </td>
                        <td>
                          <input type="checkbox" id="switch2" class="checkbox1" name="status_smtp" switch="success" <?=config_system("status_smtp","status")=="1" ? "checked":""?>/>
                          <label for="switch2" data-on-label="Yes" data-off-label="No"></label>
                        </td>
                      </tr>
                      <tr>
                        <td colspan="2">
                          <form id="form_email_smtp" action="<?=site_url("backend/setting_umum/email_smtp_action")?>" autocomplete="off">
                            <div class="form-group row">
                                <label for="example-url-input" class="col-sm-2 col-form-label">Email_SMTP</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" name="email_smtp" id="email_smtp" value="<?=config_system("email_smtp")?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="example-url-input" class="col-sm-2 col-form-label">Host_SMTP</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" name="host_smtp" id="host_smtp" value="<?=config_system("host_smtp")?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="example-url-input" class="col-sm-2 col-form-label">Port_SMTP</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" name="port_smtp" id="port_smtp" value="<?=config_system("port_smtp")?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="example-url-input" class="col-sm-2 col-form-label">Password_SMTP</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="password" name="password_smtp" id="password_smtp" placeholder="Password wajib di isi tiap kali ada perubahan SMTP">
                                </div>
                            </div>

                            <div class="text-right">
                              <button type="submit" class="btn btn-sm btn-primary" id="submit_smtp" name="submit_smtp">Edit Perubahan</button>
                            </div>
                          </form>


                        </td>
                      </tr>



                      <tr>
                        <td>Maintenance System [Aktif/Tidak]
                          <p style="font-size:12px;" class="text-primary">
                          * Halaman Public akan di maintenance jika status YES.
                          </p>
                        </td>
                        <td>
                          <input type="checkbox" id="switch1" class="checkbox1" name="maintenance" switch="success" <?=config_system("maintenance","status")=="1" ? "checked":""?>/>
                          <label for="switch1" data-on-label="Yes" data-off-label="No"></label>
                        </td>
                      </tr>
                    </table>

                  </div>
                </div>
            </div>
        </div>

    </div> <!-- end container -->
</div>

<script type="text/javascript">
$(document).ready(function(){
    if (<?=config_system("status_smtp","status")?>=="1") {
      $("#form_email_smtp .form-control, #submit_smtp").prop("disabled",false);
      $('#form_email_smtp .form-group').find('.text-danger').remove();
    }else {
      $("#form_email_smtp .form-control, #submit_smtp").prop("disabled",true);
      $('#form_email_smtp .form-group').find('.text-danger').remove();
    }
})

$("input[type='checkbox']").change(function() {
  if (this.checked) {
    var dataVal = 1;
  }else {
    var dataVal = 0;
  }

  if ($(this).attr('name')=="status_smtp") {
    if (this.checked) {
      $("#form_email_smtp .form-control, #submit_smtp").prop("disabled",false);
      $('#form_email_smtp .form-group').find('.text-danger').remove();
    }else {
      $("#form_email_smtp .form-control, #submit_smtp").prop("disabled",true);
      $('#form_email_smtp .form-group').find('.text-danger').remove();
    }
  }

  var dataName = $(this).attr('name');

  $.ajax({
        url             : "<?=site_url("backend/setting_umum/system_action")?>",
        type            : 'POST',
        data            : {name : dataName, value : dataVal},
        dataType        : 'JSON',
        success:function(json){
          if (json.success==true) {
            $.toast({
                text: json.alert,
                showHideTransition: 'slide',
                icon: "success",
                loaderBg: '#f96868',
                position: 'bottom-left',
              });
          }else {
            $.toast({
                text: json.alert,
                showHideTransition: 'slide',
                icon: "danger",
                loaderBg: '#f96868',
                position: 'bottom-left',
              });
          }
        }
  });
});





$("#form").submit(function(e){
e.preventDefault();
var me = $(this);
$("#submit").prop('disabled',true).html('<div class="spinner-border spinner-border-sm text-white"></div> Loading...');
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
              icon: "success",
              loaderBg: '#f96868',
              position: 'bottom-left',
            });
        $(".logo-tilte").text($("#title").val());
        $("#submit").prop('disabled',false)
                    .html('Edit Perubahan');
        $('.form-group').find('.text-danger').remove();
        }else {
          $("#submit").prop('disabled',false)
                      .html('Edit Perubahan');
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



$("#form_email_smtp").submit(function(e){
e.preventDefault();
var me = $(this);
$("#submit_smtp").prop('disabled',true).html('<div class="spinner-border spinner-border-sm text-white"></div> Loading...');
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
              icon: "success",
              loaderBg: '#f96868',
              position: 'bottom-left',
            });
        $('.form-group').find('.text-danger').remove();
        $("#password_smtp").val("");
        $("#submit_smtp").prop('disabled',false)
                    .html('Edit Perubahan');
        }else {
          $("#submit_smtp").prop('disabled',false)
                      .html('Edit Perubahan');
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
