<div class="page-content-wrapper">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12 col-xl-9 mx-auto animated fadeInRight delay-2s">
        <div class="card">
          <div class="card-body">
            <form id="form" action="<?=$action?>" method="post">
              <div class="form-group">
                <label for="">Progres (%)</label>
                <input type="text" class="form-control" id="progres" name="progres" placeholder="progres" value="<?=$progres?>">
              </div>

              <div class="form-group">
                <label for="">Deskripsi</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="8" cols="80" placeholder="deskripsi pengerjaan proyek"><?=$deskripsi?></textarea>
              </div>


              <a href="<?=site_url("usrp/master_proyek/get_progres_proyek/".$id_proyek)?>" class="btn btn-danger btn-sm">Batal</a>
              <button type="submit" id="submit" name="submit" class="btn btn-sm btn-primary"><?=ucfirst($button)?></button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


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
            loaderBg: '#f96868',
            position: 'bottom-right',
            hideAfter: 3000,
            afterHidden: function () {
                window.location.href = '<?=site_url('usrp/master_proyek/get_progres_proyek/'.$id_proyek)?>';
            }
          });

        }else {
          $("#submit").prop('disabled',false)
                      .html('<?=ucfirst($button)?>');
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
