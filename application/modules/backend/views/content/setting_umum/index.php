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
                          <label for="example-search-input" class="col-sm-2 col-form-label">No. Hp (Whatsapp)</label>
                          <div class="col-sm-10">
                              <input class="form-control" type="text" name="telepon_wa" id="telepon_wa" value="<?=config_system("telepon_wa")?>">
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
          <div class="col-md-12 col-xl-9 mb-2 mx-auto animated fadeInRight delay-2s">
            <div class="card">
              <div class="card-body">
                <form class="" action="<?=site_url("backend/setting_umum/action_tentang")?>" id="form_tentang" autocomplete="off">

                  <div class="form-group">
                    <label for="">Deskripsi</label>&nbsp;&nbsp;|&nbsp;&nbsp;
                    <a href="<?=site_url("backend/filemanager")?>" target="_blank" class="btn btn-sm btn-primary">Buka File Manager</a>
                    <hr>
                    <textarea class="form-control" id="elm1" rows="5" cols="80" placeholder="Deskripsi"><?=config_system("tentang","deskripsi")?></textarea>
                    <textarea id="deskripsi" name="deskripsi" rows="0" cols="0" style="visibility:hidden"><?=config_system("tentang","deskripsi")?></textarea>
                  </div>

                  <div class="text-right">
                    <button type="submit" id="submit_tentang" name="submit_tentang" class="btn btn-sm btn-primary">Simpan Perubahan</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>


        <script src="<?=base_url()?>_template/backend/plugins/tinymce/tinymce.min.js"></script>
        <script src="<?=base_url()?>_template/backend//plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js"></script>
        <script type="text/javascript">
        $(document).ready(function(){
          tinymce.init({
              selector: "textarea#elm1",
              theme: "modern",
              height:500,
              plugins: [
                  "advlist autolink link image lists charmap print preview hr anchor pagebreak",
                  "code fullscreen insertdatetime",
                  "save table contextmenu directionality paste textcolor"
              ],
              toolbar: "insertfile undo redo |  bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview fullpage | forecolor backcolor",
              setup : function(ed) {
                ed.on('change', function(e) {
                // This will print out all your content in the tinyMce box
                console.log(ed.getContent());
                // Your text from the tinyMce box will now be passed to your text area …
                $("#deskripsi").val(ed.getContent());
                });
              }
            });
          });

          $("#form_tentang").submit(function(e){
          e.preventDefault();
          var me = $(this);
          $("#submit_tentang").prop('disabled',true).html('Loading...');
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
                      loaderBg: '#f96868',
                      position: 'bottom-right',
                      hideAfter: 3000
                    });
                    $("#submit_tentang").prop('disabled',false)
                                .html('Simpan Perubahan');

                  }else {
                    $("#submit").prop('disabled',false)
                                .html('Simpan Perubahan');
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

        <div class="row">
            <div class="col-md-12 col-xl-9 mx-auto animated fadeInRight delay-2s">
                <div class="card m-b-30">
                  <div class="card-body">
                    <h4 class="mt-0 header-title">System</h4>

                    <table class="table table-bordered">
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
