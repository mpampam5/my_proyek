<div class="page-content-wrapper">
  <div class="container-fluid">
    <div class="col-md-10 mx-auto mb-5">
      <div class="card">
        <div class="card-body">
          <form id="form" action="<?=site_url("user/profile/form_rekening_action")?>" autocomplete="off">
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Nama Rekening</label>
                <div class="col-sm-9">
                    <input class="form-control" type="text" value="<?=$dt->nama_rekening?>" name="nama_rekening" id="nama_rekening">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">No Rekening</label>
                <div class="col-sm-9">
                    <input class="form-control" type="text" value="<?=$dt->no_rekening?>" name="no_rekening" id="no_rekening">
                </div>
            </div>


            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Bank</label>
                <div class="col-sm-9">
                  <?php $bank = $this->db->get('trans_bank');?>
                  <select class="form-control" name="bank" id="bank">
                    <option value=""> -- pilih --</option>
                    <?php foreach ($bank->result() as $bk): ?>
                      <option <?=$dt->id_bank == $bk->id_bank ? "selected":""?> value="<?=$bk->id_bank?>"><?=$bk->nama_bank?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
            </div>

            <hr>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Masukkan Password Akun</label>
                <div class="col-sm-9">
                    <input class="form-control" type="password" name="password" id="password" placeholder="Masukkan Password">
                </div>
            </div>





            <div class="text-right">
              <a class="btn btn-md btn-light" href="<?=site_url("user/profile")?>" id="kembali">Batal</a>
              <button type="submit" name="button" class="btn btn-md btn-primary">Simpan Perubahan</button>
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
            window.location.href = "<?=site_url("user/profile")?>";
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
