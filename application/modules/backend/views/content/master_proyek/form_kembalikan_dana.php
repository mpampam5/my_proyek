<div class="wrapper">
  <div class="container-fluid">
    <div class="col-md-6 mx-auto mb-5">
      <div class="card">
        <div class="card-body">

          <div class="alert alert-danger" role="alert">
            <strong><i class="fa fa-info-circle"></i> Peringatan</strong>
            <p>Dana yang terkumpul akan di kembalikan ke masing-masing Pendana. Silahkan isi Form di bawah jika ingin menyetujui.</p>
          </div>
          <form action="<?=site_url("backend/master_proyek/action_kembalikan_dana/".enc_url($dt->id_proyek))?>" id="form" autocomplete="off">

            <div class="form-group">
              <label for="">Keterangan Pengembalian Dana</label>
              <textarea class="form-control" id="keterangan" name="keterangan" rows="5" cols="80" placeholder="Keterangan"></textarea>
            </div>

            <div class="form-group">
              <label for="">Masukkan Password Akun</label>
              <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password Akun">
            </div>






            <div class="text-right">
              <a href="<?=site_url("backend/master_proyek")?>" class="btn btn-sm btn-danger">Batal</a>
              <button type="submit" id="submit" name="submit" class="btn btn-sm btn-primary">Kembalikan Dana</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div> <!-- Page content Wrapper -->

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
                  window.location.href = '<?=site_url('backend/master_proyek')?>'
              }
            });

          }else {
            $("#submit").prop('disabled',false)
                        .html('Kembalikan Dana');
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
