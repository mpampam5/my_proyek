<?php
$total_dana = $dt->harga_paket * $dt->jumlah_paket; //dana di butuhkan
$dana_terkumpul = $this->proyek->total_dana_terkumpul($dt->id_proyek);
$persen = cari_persen($total_dana,$dana_terkumpul);
$imbal_hasil = $dt->imbal_hasil_pendana+$dt->ujroh_penyelenggara;
$rupiah_imbal_hasil = ($dt->imbal_hasil_pendana+$dt->ujroh_penyelenggara)/100*$total_dana;
 ?>

<div class="page-content-wrapper">
  <div class="container-fluid">
    <div class="col-md-11 mx-auto animated zoomIn delay-2s">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-sm-7">
              <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                  <ol class="carousel-indicators">
                      <li data-target="#carouselExampleIndicators" data-slide-to="0" class=""></li>
                      <li data-target="#carouselExampleIndicators" data-slide-to="1" class=""></li>
                      <li data-target="#carouselExampleIndicators" data-slide-to="2" class="active"></li>
                  </ol>
                  <div class="carousel-inner" role="listbox">
                      <div class="carousel-item">
                          <img class="d-block img-fluid" src="<?=base_url()?>_template/backend/images/small/img-1.jpg" alt="First slide">
                      </div>
                      <div class="carousel-item">
                          <img class="d-block img-fluid" src="<?=base_url()?>_template/backend/images/small/img-1.jpg" alt="Second slide">
                      </div>
                      <div class="carousel-item active">
                          <img class="d-block img-fluid" src="<?=base_url()?>_template/backend/images/small/img-1.jpg" alt="Third slide">
                      </div>
                  </div>
                  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="sr-only">Previous</span>
                  </a>
                  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="sr-only">Next</span>
                  </a>
              </div>
            </div>


            <div class="col-sm-5">
                  <h4 class="header-title">
                    Pendanaan <?=$dt->kode?>. <?=ucfirst($dt->title);?>
                  </h4>


                  <div class="mt-3 mb-3">
                    <span>Dana terkumpul (<?=$persen?>%)</span>
                    <div class="mt-1">
                      <div class="progress" style="background-color:#ebebeb;height:0.5rem;">
                          <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" role="progressbar" aria-valuenow="<?=$persen?>" aria-valuemin="0" aria-valuemax="100" style="width: <?=$persen?>%; color:#fff;"></div>
                      </div>
                    </div>
                  </div>

                  <ul class="list-group list-group-flush">
                      <li class="list-group-item">Dana Dibutuhkan <span class="float-right badge badge-primary">Rp.<?=format_rupiah($total_dana)?></span></li>
                      <li class="list-group-item">Minimum Pendanaan <span class="float-right badge badge-primary">Rp.<?=format_rupiah($dt->harga_paket)?></span></li>
                      <li class="list-group-item">Durasi Proyek <span class="float-right badge badge-primary"><?=$dt->durasi_proyek?> bulan</span></li>
                      <li class="list-group-item">Imbal Hasil /tahun <span class="float-right badge badge-primary">(<?=$imbal_hasil?>%) Rp.<?=format_rupiah($rupiah_imbal_hasil)?></span></li>
                      <li class="list-group-item">Terima Imbal Hasil <span class="float-right badge badge-primary">Tiap Bulan</span></li>
                  </ul>

                  <div class="mt-3">
                      <a href="#" class="btn btn-md btn-success btn-block">DANAI SEKARANG</a>
                  </div>
            </div>
          </div>
        </div>
      </div>
    </div>




    <div class="col-md-11 mx-auto mt-2 animated zoomInUp delay-2s mb-5">
      <div class="card">
          <div class="card-body">
            <h4 class="header-title">
              HITUNG IMBAL HASIL (*SIMULASI)
            </h4>

            <form id="form" action="<?=site_url("user/master_proyek/simulasi_act/$dt->id_proyek/$dt->kode")?>" autocomplete="off">
              <div class="row">
                <div class="col-sm-5 form-group">
                  <label for="">Masukkan Jumlah Dana</label>
                  <input type="text" class="form-control" name="nominal">
                  <div id="nominal"></div>
                </div>

                <div class="col-sm-4 form-group">
                  <label for="">Pilih Tanggal Pendanaan</label>
                  <input class="form-control" type="date" id="tanggal" name="tanggal" min="<?=$dt->mulai_penggalangan?>" max="<?=$dt->akhir_penggalangan?>">
                </div>

                <input type="hidden" name="akhir_penggalangan" id="akhir_penggalangan" value="<?=$dt->akhir_penggalangan?>">
                <input type="hidden" id="durasi_proyek" name="durasi_proyek" value="<?=$dt->durasi_proyek?>">

                <div class="col-sm-3 form-group">
                  <label for="">&nbsp;</label>
                  <button type="submit" id="submit" name="submit" class="btn btn-sm btn-primary form-control">Hitung Imbal Hasil</button>
                </div>
              </div>
            </form>

            <div id="hasil-simulasi" style="min-height:100px;padding-top:40px;"></div>

          </div>
      </div>
    </div>



  </div>
</div> <!-- Page content Wrapper -->

<script src="<?=base_url()?>_template/usrp/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js"></script>
<script type="text/javascript">
$("#form").submit(function(e){
e.preventDefault();
var me = $(this);
$("#submit").prop('disabled',true).html('Loading...');
$("#hasil-simulasi").html(`<p class="text-center"  style="font-size:18px"><i class="fa fa-spinner fa-spin"></i> Memproses perhitungan imbal hasil.</p>`);
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
          $("#submit").prop('disabled',false)
                      .html('Hitung Imbal Hasil');
          $('.form-group').find('.text-danger').remove();
          $("#hasil-simulasi").html(json.data);
        }else {
          $("#hasil-simulasi").html('');
          $("#submit").prop('disabled',false)
                      .html('Hitung Imbal Hasil');
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

$("input[name='nominal']").TouchSpin({
            min: 1000000,
            max: <?=$total_dana?>,
            step: 1000000,
            prefix: 'Rp',
            buttondown_class: 'btn btn-primary',
            buttonup_class: 'btn btn-primary'
        });
</script>
