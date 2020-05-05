<form id="form" action="<?=site_url("usrp/wizard/form_rekening_action")?>" autocomplete="off">
  <div class="form-group row">
      <label class="col-sm-3 col-form-label">Nama Rekening</label>
      <div class="col-sm-9">
          <input class="form-control" type="text" value="" name="nama_rekening" id="nama_rekening">
      </div>
  </div>

  <div class="form-group row">
      <label class="col-sm-3 col-form-label">No Rekening</label>
      <div class="col-sm-9">
          <input class="form-control" type="text" value="" name="no_rekening" id="no_rekening">
      </div>
  </div>


  <div class="form-group row">
      <label class="col-sm-3 col-form-label">Bank</label>
      <div class="col-sm-9">
          <input class="form-control" type="text" value="" name="bank" id="bank">
      </div>
  </div>


  <div class="text-right">
    <a class="btn btn-md btn-light" href="<?=site_url("usrp/wizard/form_wizard/1")?>" id="kembali">SEBELUMNYA</a>
    <button type="submit" name="button" class="btn btn-md btn-primary">SELANJUTNYA</button>
  </div>

</form>

<script type="text/javascript">
  $(document).on("click","#kembali",function(e){
    e.preventDefault();
    $("#content-wizard").load($(this).attr('href'));
  });

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
            $("#content-wizard").load(json.url);
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
</script>
