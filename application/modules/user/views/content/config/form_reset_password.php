<form class="" action="<?=site_url("user/config/action_password")?>" id="form-password">
  <div class="form-group">
    <input type="password" class="form-control form-control-sm" name="password" id="password" value="" placeholder="Masukkan Password Lama">
  </div>

  <div class="form-group">
    <input type="password" class="form-control form-control-sm" name="password_baru" id="password_baru" value="" placeholder="Masukkan Password Baru">
  </div>

  <div class="form-group">
    <input type="password" class="form-control form-control-sm" name="konfirmasi_password" id="konfirmasi_password" value="" placeholder="Konfirmasi Password Baru">
  </div>

  <div class="mt-3 float-right">
    <button type="button" data-dismiss="modal" class="btn btn-sm btn-danger">Batal</button>
    <button type="submit" id="submit-reset" name="submit-reset" class="btn btn-sm btn-primary">Reset Password</button>
  </div>
</form>

<script type="text/javascript">
$("#form-password").submit(function(e){
e.preventDefault();
var me = $(this);
$("#submit-reset").prop('disabled',true).html('Loading...');
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
            $("#modalGue").modal("hide");
            $.toast({
              text: json.alert,
              showHideTransition: 'slide',
              icon: 'success',
              loaderBg: '#f96868',
              position: 'bottom-right',
							hideAfter: 3000,
              afterHidden: function () {
                window.location.href ="<?=site_url("user/auth/logout/1")?>"
              }
            });
        }else {
          $("#submit-reset").prop('disabled',false)
                      .html('Reset Password');
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
