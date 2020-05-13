<form id="form" action="<?=site_url("user/wizard/form_data_pribadi_action")?>" autocomplete="off">
  <div class="form-group row">
    <label class="col-sm-3 col-form-label">No.KTP</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" value="<?=$dt->no_ktp?>" readonly>
    </div>
  </div>

  <div class="form-group row">
    <label class="col-sm-3 col-form-label">Nama</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" value="<?=$dt->nama?>" id="nama" name="nama">
    </div>
  </div>

  <div class="form-group row">
    <label class="col-sm-3 col-form-label">Email</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" value="<?=$dt->email?>" readonly>
    </div>
  </div>


  <div class="form-group row">
    <label class="col-sm-3 col-form-label">Telepon</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" value="<?=$dt->telepon?>" name="telepon" id="telepon">
    </div>
  </div>

  <div class="form-group row">
    <label class="col-sm-3 col-form-label">Tempat Lahir</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" placeholder="Tempat Lahir" value="<?=$dt->tempat_lahir?>" name="tempat_lahir" id="tempat_lahir">
    </div>
  </div>

  <div class="form-group row">
    <label class="col-sm-3 col-form-label">Tanggal Lahir</label>
    <div class="col-sm-9">
      <input type="date" class="form-control" value="<?=$dt->tgl_lahir?>" name="tgl_lahir" id="tgl_lahir">
    </div>
  </div>


  <div class="form-group row">
    <label class="col-sm-3 col-form-label">Jenis Kelamin</label>
    <div class="col-sm-9">
      <select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
        <option value="" style="color:#a4a4a4">-- Pilih --</option>
        <option <?=$dt->jenis_kelamin=="laki-laki"?"selected":""?> value="laki-laki">Laki - Laki</option>
        <option <?=$dt->jenis_kelamin=="perempuan"?"selected":""?> value="perempuan">Perempuan</option>
      </select>
    </div>
  </div>

  <div class="form-group row">
    <label class="col-sm-3 col-form-label">Pendidikan Terakhir</label>
    <div class="col-sm-9">
      <?=custom_select("trans_pendidikan","pendidikan","id_pendidikan","pendidikan",$dt->id_pendidikan)?>
    </div>
  </div>

  <div class="form-group row">
    <label class="col-sm-3 col-form-label">Pekerjaan</label>
    <div class="col-sm-9">
      <?=custom_select("trans_pekerjaan","pekerjaan","id_pekerjaan","pekerjaan",$dt->id_pekerjaan)?>
    </div>
  </div>

  <div class="form-group row">
    <label class="col-sm-3 col-form-label">Provinsi</label>
    <div class="col-sm-9">
      <select class="form-control" name="provinsi" id="provinsi" onchange="loadKabupaten()">
        <option value="" style="color:#a4a4a4">-- Pilih --</option>
          <?php $provinsi = $this->db->get("wil_provinsi")?>
          <?php foreach ($provinsi->result() as $prov): ?>
            <option <?=$dt->provinsi == $prov->id ? "selected":""?> value="<?=$prov->id?>"><?=$prov->name?></option>
          <?php endforeach; ?>
      </select>
    </div>
  </div>

  <div class="form-group row">
      <label class="col-sm-3 col-form-label">Kabupaten/Kota</label>
      <div class="col-sm-9">
        <select class="form-control" name="kabupaten" id="kabupaten">
          <?php if ($dt->kabupaten!=""): ?>
            <?php $kabupaten   = $this->db->get_where('wil_kabupaten',array('province_id'=>$dt->provinsi)); ?>
            <?php foreach ($kabupaten->result() as $kab): ?>
              <option <?=$dt->kabupaten == $kab->id ? "selected":""?> value="<?=$kab->id?>"><?=$kab->name?></option>
            <?php endforeach; ?>
            <?php else: ?>
              <option value="" style="color:#a4a4a4">-- Pilih --</option>
          <?php endif; ?>
          </select>
      </div>
  </div>

  <div class="form-group row">
    <label class="col-sm-3 col-form-label">Alamat Lengkap</label>
    <div class="col-sm-9">
      <textarea class="form-control" name="alamat" id="alamat" rows="3" cols="80" placeholder="Jl. example No., kecamatan , kelurahan "><?=$dt->alamat?></textarea>
    </div>
  </div>

  <div class="form-group row">
    <label class="col-sm-3 col-form-label">Kode Pos</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" value="<?=$dt->kode_pos?>" name="kode_pos" id="kode_pos" placeholder="Kode Pos">
    </div>
  </div>




  <div class="text-right">
    <a class="btn btn-md btn-light" href="<?=site_url("usrp/wizard/form_wizard/1")?>" id="kembali">SEBELUMNYA</a>
    <button type="submit" name="button" class="btn btn-md btn-primary">SELANJUTNYA</button>
  </div>

</form>



<script type="text/javascript">
function loadKabupaten()
{
    var provinsi = $("#provinsi").val();
    if (provinsi!="") {
      $.ajax({
          type:'GET',
          url:"<?php echo base_url(); ?>user/wizard/jsonkabupaten",
          data:"id=" + provinsi,
          success: function(html)
          {
             $("#kabupaten").html(html);
          }
      });
    }else {
      $("#kabupaten").html('<option value="">-- Pilih --</option>');
    }
}



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
