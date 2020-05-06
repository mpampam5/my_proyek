<link href="<?=base_url()?>_template/usrp/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<script src="<?=base_url()?>_template/usrp/plugins/select2/js/select2.min.js"></script>
 <!-- <script src="<?=base_url()?>_template/usrp/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js"></script> -->
<style media="screen">
  .select2-container--default.select2-container--focus .select2-selection--multiple{
    border: 1px solid #268ad2;
  }
</style>

<h4 class="header-title">Data Perusahaan</h4>
<hr>
<form class="" id="form" action="<?=site_url("usrp/wizard/form_perusahaan_action")?>">
  <div class="form-group row">
      <label class="col-sm-3 col-form-label">Nama Perusahaan</label>
      <div class="col-sm-9">
          <input class="form-control" type="text" value="<?=$dt->nama_perusahaan?>" name="nama_perusahaan" id="nama_perusahaan">
      </div>
  </div>

  <div class="form-group row">
      <label class="col-sm-3 col-form-label">Bidang Usaha</label>
      <div class="col-sm-9">
        <select class="form-control" name="bidang_usaha" id="bidang_usaha">
          <option value="">-- Pilih --</option>
          <option <?=$dt->bidang_usaha == "peternakan" ? "selected":""?> value="peternakan"> Peternakan</option>
          <option <?=$dt->bidang_usaha == "pertanian" ? "selected":""?> value="pertanian"> Pertanian</option>
          <option <?=$dt->bidang_usaha == "perkebunan" ? "selected":""?> value="perkebunan"> Perkebunan</option>
          <option <?=$dt->bidang_usaha == "retail" ? "selected":""?> value="retail"> Retail</option>
          <option <?=$dt->bidang_usaha == "jasa" ? "selected":""?> value="jasa"> Jasa</option>
          <option <?=$dt->bidang_usaha == "properti" ? "selected":""?> value="properti"> Properti
          </option>
        </select>
      </div>
  </div>

  <div class="form-group row">
      <label class="col-sm-3 col-form-label">Provinsi</label>
      <div class="col-sm-9">
          <select class="form-control" name="provinsi" id="provinsi" onchange="loadKabupaten()">
            <option value="">-- Pilih --</option>
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
                  <option value="">-- Pilih Kabupaten/Kota --</option>
              <?php endif; ?>
              </select>
          </div>
      </div>


  <div class="form-group row">
      <label class="col-sm-3 col-form-label">Alamat Lengkap</label>
      <div class="col-sm-9">
          <textarea name="alamat_perusahaan" id="alamat_perusahaan" class="form-control" rows="3" cols="80"><?=$dt->alamat_perusahaan?></textarea>
      </div>
  </div>

  <div class="form-group row">
      <label class="col-sm-3 col-form-label">Bentuk Badan Usaha</label>
      <div class="col-sm-9">
        <select class="form-control" name="bentuk_badan_usaha" id="bentuk_badan_usaha">
          <option value=""> Belum Ada</option>
          <option <?=$dt->bentuk_badan_usaha == "PT" ? "selected":""?> value="PT"> PT</option>
          <option <?=$dt->bentuk_badan_usaha == "CV" ? "selected":""?> value="CV"> CV</option>
          <option <?=$dt->bentuk_badan_usaha == "UD" ? "selected":""?> value="UD"> UD</option>
          <option <?=$dt->bentuk_badan_usaha == "FIRMA" ? "selected":""?> value="FIRMA"> FIRMA</option>
          <option <?=$dt->bentuk_badan_usaha == "Yang lainnya" ? "selected":""?> value="Yang lainnya"> Yang lainnya</option>
        </select>
      </div>
  </div>

  <div class="form-group row">
      <label class="col-sm-3 col-form-label">File Badan Usaha</label>
      <div class="col-sm-9">
        <input type="file" name="value-files" id="upload-file"  style="display:none" accept=".pdf">
          <div class="bootstrap-filestyle input-group">
            <input type="text" class="form-control bg-white" id="value-file" placeholder="Upload Berkas" readonly>
            <span class="group-span-filestyle input-group-append" tabindex="0">
              <button for="filestyle-0" type="button" id="btn-upload-file" class="btn btn-success">
                <span class="icon-span-filestyle fa fa-folder-open"></span>
                <span class="buttonText">Upload file</span>
              </button>
            </span>
          </div>
      </div>
      <div class="col-sm-12 mt-3">
        <ul style="list-style:none;font-size:11px;margin-left:170px">
          <li><i class="fa fa-info-circle"></i> Tulisan harus berbahasa Indonesia dan terbaca dengan jelas</li>
          <li><i class="fa fa-info-circle"></i> Pastikan file dalam bentuk PDF</li>
          <li><i class="fa fa-info-circle"></i> Ukuran file maksimal 5 Mb</li>
        </ul>
      </div>
  </div>

  <!-- <div class="form-group row">
      <label class="col-sm-3 col-form-label">Dokumen Perizinan</label>
      <div class="col-sm-9">
        <select class="select2 form-control select2-multiple" name="dokumen_perizinan" id="dokumen_perizinan" multiple="multiple" multiple data-placeholder="  -- pilih --">
                <option value="akta perusahaan">Akta Perusahaan</option>
                <option value="SIUP">SIUP</option>
                <option value="TDP">TDP</option>
                <option value="SKDP">SKDP</option>
                <option value="NPWP">NPWP</option>
                <option value="yang lainnya">Yang lainnya</option>
                <option value="belum ada">Belum Ada</option>
        </select>
      </div>
  </div> -->

  <div class="form-group row">
      <label class="col-sm-3 col-form-label">File Dokumen Perizinan</label>
      <div class="col-sm-9">
        <div class="bootstrap-filestyle input-group">
          <input type="text" class="form-control bg-white" placeholder="Upload Berkas" readonly>
          <span class="group-span-filestyle input-group-append" tabindex="0">
            <label for="filestyle-0" class="btn btn-success">
              <span class="icon-span-filestyle fa fa-folder-open"></span>
              <span class="buttonText">Upload file</span>
            </label>
          </span>
        </div>
      </div>
      <div class="col-sm-12 mt-3">
        <ul style="list-style:none;font-size:11px;margin-left:170px">
          <li><i class="fa fa-info-circle"></i> File Perizinan digabung jadi satu file</li>
          <li><i class="fa fa-info-circle"></i> Tulisan harus berbahasa Indonesia dan terbaca dengan jelas</li>
          <li><i class="fa fa-info-circle"></i> Pastikan file dalam bentuk PDF</li>
          <li><i class="fa fa-info-circle"></i> Ukuran file maksimal 5 Mb</li>
        </ul>
      </div>
  </div>


  <div class="text-right mt-5">
    <button type="submit" id="submit" name="submit" class="btn btn-md btn-primary">SELANJUTNYA</button>
  </div>

</form>

<script type="text/javascript">
$(".select2").select2();

function loadKabupaten()
{
    var provinsi = $("#provinsi").val();
    if (provinsi!="") {
      $.ajax({
          type:'GET',
          url:"<?php echo base_url(); ?>usrp/wizard/jsonkabupaten",
          data:"id=" + provinsi,
          success: function(html)
          {
             $("#kabupaten").html(html);
          }
      });
    }else {
      $("#kabupaten").html('<option value="">-- Pilih Kabupaten/Kota --</option>');
    }
}


$(function () {
      var fileupload = $("#upload-file");
      var button = $("#btn-upload-file");
      button.click(function () {
          fileupload.click();
      });
      fileupload.change(function () {
          var fileName = $(this).val().split('\\')[$(this).val().split('\\').length - 1];
          // $("#data-info").text(fileName);

          var file_data = $('#upload-file').prop('files')[0];
          var form_data = new FormData();
          $("#value-file").val(fileName);
          $("#btn-upload-file").html('<div class="spinner-border spinner-border-sm text-white"></div>');

          form_data.append('value-files', file_data);
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
