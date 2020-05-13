<form id="form" action="<?=site_url("user/wizard/form_foto_action")?>" autocomplete="off">
  <div class="form-group">
    <label for="">Foto Diri</label>
    <input type="file" name="upload-file" id="upload-file" style="display:none"   accept="image/*">
      <div class="bootstrap-filestyle input-group">
        <input type="text" class="form-control bg-white" name="foto_diri" id="value-file" placeholder="Upload Foto" readonly value="<?=$dt->foto_diri?>">
        <span class="group-span-filestyle input-group-append" tabindex="0">
          <button for="filestyle-0" type="button" id="btn-upload-file" class="btn btn-success">
            <span class="icon-span-filestyle fa fa-folder-open"></span>
            <span class="buttonText">Upload</span>
          </button>
        </span>
      </div>
      <div id="foto_diri"></div>
  </div>

  <div class="form-group">
    <label for="">Foto KTP</label>
    <input type="file" name="upload-file1" id="upload-file1" style="display:none"   accept="image/*">
      <div class="bootstrap-filestyle input-group">
        <input type="text" class="form-control bg-white" name="foto_ktp" id="value-file1" placeholder="Upload Foto" readonly value="<?=$dt->foto_ktp?>">
        <span class="group-span-filestyle input-group-append" tabindex="0">
          <button for="filestyle-0" type="button" id="btn-upload-file1" class="btn btn-success">
            <span class="icon-span-filestyle fa fa-folder-open"></span>
            <span class="buttonText">Upload</span>
          </button>
        </span>
      </div>
      <div id="foto_ktp"></div>
  </div>

<div class="form-group">
  <label for="">Foto Buku Rekening</label>
  <input type="file" name="upload-file2" id="upload-file2" style="display:none"   accept="image/*">
    <div class="bootstrap-filestyle input-group">
      <input type="text" class="form-control bg-white" name="foto_buku_rek" id="value-file2" placeholder="Upload Foto" readonly value="<?=$dt->foto_buku_rekening?>">
      <span class="group-span-filestyle input-group-append" tabindex="0">
        <button for="filestyle-0" type="button" id="btn-upload-file2" class="btn btn-success">
          <span class="icon-span-filestyle fa fa-folder-open"></span>
          <span class="buttonText">Upload</span>
        </button>
      </span>
    </div>
    <div id="foto_buku_rek"></div>
</div>

  <div class="text-right mt-5">
    <a class="btn btn-md btn-light" href="<?=site_url("user/wizard/form_wizard/2")?>" id="kembali">SEBELUMNYA</a>
    <button type="submit" name="button" class="btn btn-md btn-primary">SELANJUTNYA</button>
  </div>
</form>




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
          window.location.href = json.url;
        }else {
          $("#submit").prop('disabled',false)
                      .html('SELANJUTNYA');
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


$(function () {
      var fileupload = $("#upload-file");
      var button = $("#btn-upload-file");
      button.click(function () {
          fileupload.click();
      });
      fileupload.change(function () {
          var fileName = $(this).val().split('\\')[$(this).val().split('\\').length - 1];
          var file_data = $('#upload-file').prop('files')[0];
          var form_data = new FormData();
          $("#value-file").val(fileName);
          $("#btn-upload-file").html('Loading');

          form_data.append('upload-file', file_data);
          $.ajax({
             url: '<?=site_url("user/wizard/do_upload")?>',
             dataType: 'json',
             cache: false,
             contentType: false,
             processData: false,
             data: form_data,
             type: 'post',
             success: function(json){
               if (json.success==true) {
                 button.html('<span class="icon-span-filestyle fa fa-folder-open"></span><span class="buttonText">Upload</span>');
                 $("#value-file").val(json.file_name);
                 $.toast({
                   text: json.alert,
                   showHideTransition: 'slide',
                   icon: json.header_alert,
                   loaderBg: '#f96868',
                   position: 'top-center',
                 });
               }else {
                 button.html('<span class="icon-span-filestyle fa fa-folder-open"></span><span class="buttonText">Upload</span>');
                 fileupload.val("");
                 $("#value-file").val("");
                 $.toast({
                   text: json.alert,
                   showHideTransition: 'slide',
                   icon: json.header_alert,
                   loaderBg: '#f96868',
                   position: 'top-center',
                 });
               }
             }
         });
    });
  });



        $(function () {
              var fileupload = $("#upload-file1");
              var button = $("#btn-upload-file1");
              button.click(function () {
                  fileupload.click();
              });
              fileupload.change(function () {
                  var fileName = $(this).val().split('\\')[$(this).val().split('\\').length - 1];
                  var file_data = $('#upload-file1').prop('files')[0];
                  var form_data = new FormData();
                  $("#value-file1").val(fileName);
                  $("#btn-upload-file1").html('Loading');

                  form_data.append('upload-file1', file_data);
                  $.ajax({
                     url: '<?=site_url("user/wizard/do_upload")?>',
                     dataType: 'json',
                     cache: false,
                     contentType: false,
                     processData: false,
                     data: form_data,
                     type: 'post',
                     success: function(json){
                       if (json.success==true) {
                         button.html('<span class="icon-span-filestyle fa fa-folder-open"></span><span class="buttonText">Upload</span>');
                         $("#value-file1").val(json.file_name);
                         $.toast({
                           text: json.alert,
                           showHideTransition: 'slide',
                           icon: json.header_alert,
                           loaderBg: '#f96868',
                           position: 'top-center',
                         });
                       }else {
                         button.html('<span class="icon-span-filestyle fa fa-folder-open"></span><span class="buttonText">Upload</span>');
                         fileupload.val("");
                         $("#value-file1").val("");
                         $.toast({
                           text: json.alert,
                           showHideTransition: 'slide',
                           icon: json.header_alert,
                           loaderBg: '#f96868',
                           position: 'top-center',
                         });
                       }
                     }
                 });
            });
          });

          $(function () {
                var fileupload = $("#upload-file2");
                var button = $("#btn-upload-file2");
                button.click(function () {
                    fileupload.click();
                });
                fileupload.change(function () {
                    var fileName = $(this).val().split('\\')[$(this).val().split('\\').length - 1];
                    var file_data = $('#upload-file2').prop('files')[0];
                    var form_data = new FormData();
                    $("#value-file2").val(fileName);
                    $("#btn-upload-file2").html('Loading');

                    form_data.append('upload-file2', file_data);
                    $.ajax({
                       url: '<?=site_url("user/wizard/do_upload")?>',
                       dataType: 'json',
                       cache: false,
                       contentType: false,
                       processData: false,
                       data: form_data,
                       type: 'post',
                       success: function(json){
                         if (json.success==true) {
                           button.html('<span class="icon-span-filestyle fa fa-folder-open"></span><span class="buttonText">Upload</span>');
                           $("#value-file2").val(json.file_name);
                           $.toast({
                             text: json.alert,
                             showHideTransition: 'slide',
                             icon: json.header_alert,
                             loaderBg: '#f96868',
                             position: 'top-center',
                           });
                         }else {
                           button.html('<span class="icon-span-filestyle fa fa-folder-open"></span><span class="buttonText">Upload</span>');
                           fileupload.val("");
                           $("#value-file2").val("");
                           $.toast({
                             text: json.alert,
                             showHideTransition: 'slide',
                             icon: json.header_alert,
                             loaderBg: '#f96868',
                             position: 'top-center',
                           });
                         }
                       }
                   });
              });
            });
</script>
