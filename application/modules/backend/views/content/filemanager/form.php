<div class="alert alert-info">
  Ekstensi file PNG, JPG Maksimal ukuran file 1mb.
</div>

<form action="<?=$action?>" id="form" enctype="multipart/form-data">
  <div class="row">
    <div class="form-group col-md-12">
      <label for="">Title</label>
      <input type="text" class="form-control" id="title" name="title" placeholder="Title">
    </div>

    <div class="form-group col-md-12">
      <label for="">File</label>
      <input type="file" accept="image/*" class="form-control" name="files">
      <input type="hidden" id="files" name="files">
    </div>
  </div>

  <div class="text-right m-t-20">
    <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-sm btn-danger">Cancel</button>
    <button type="submit" id="submit" name="submit" class="btn btn-sm btn-primary">Upload</button>
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
        if (json.success==1) {
            $.toast({
              text: json.alert,
              showHideTransition: 'slide',
              icon: 'success',
              loaderBg: '#f96868',
              position: 'bottom-right',
							hideAfter: 3000,
              afterHidden: function () {
                  $("#modalGue").modal("hide");
                  $("#table").DataTable().ajax.reload();
              }
            });
        }else if (json.success==2) {
          $.toast({
            text: json.alert,
            showHideTransition: 'slide',
            icon: 'error',
            loaderBg: '#f96868',
            position: 'bottom-right',
            hideAfter: 5000
          });
          $("#submit").prop('disabled',false)
                      .html('Upload');
        }else {
          $("#submit").prop('disabled',false)
                      .html('Upload');
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
