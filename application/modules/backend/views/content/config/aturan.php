<div class="wrapper">
  <div class="container-fluid">
    <div class="col-md-10 mx-auto mb-5">
      <div class="card">
        <div class="card-body">
          <form class="" action="<?=site_url("backend/aturan/action")?>" id="form" autocomplete="off">
            <div class="form-group">
              <label for="">Deskripsi</label>
              <textarea class="form-control" id="elm1" rows="5" cols="80" placeholder="Deskripsi"><?=config_system("aturan-dan-ketentuan","deskripsi")?></textarea>
              <input type="hidden" id="deskripsi" name="deskripsi" value="<?=config_system("aturan-dan-ketentuan","deskripsi")?>">
            </div>

            <div class="text-right">
              <button type="submit" id="submit" name="submit" class="btn btn-sm btn-primary">Simpan Perubahan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div> <!-- Page content Wrapper -->

<!--Wysiwig js-->
<script src="<?=base_url()?>_template/backend/plugins/tinymce/tinymce.min.js"></script>
<script src="<?=base_url()?>_template/backend//plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
tinymce.init({
    selector: "textarea#elm1",
    theme: "modern",
    height:500,
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
              loaderBg: '#f96868',
              position: 'bottom-right',
							hideAfter: 3000
            });
            $("#submit").prop('disabled',false)
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
