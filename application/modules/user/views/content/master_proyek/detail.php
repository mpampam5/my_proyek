<?php
$total_dana = $dt->harga_paket * $dt->jumlah_paket; //dana di butuhkan
$dana_terkumpul = $this->proyek->total_dana_terkumpul($dt->id_proyek);
$persen = cari_persen($total_dana,$dana_terkumpul);
$imbal_hasil = $dt->imbal_hasil_pendana;
$total_imbal_hasil = $dt->ujroh_penyelenggara + $dt->imbal_hasil_pendana;
$rupiah_imbal_hasil = ($dt->imbal_hasil_pendana+$dt->ujroh_penyelenggara)/100*$total_dana;
$cek_pendanaan = $this->balance_user->get_pendanaan(sess('id_user'),$dt->id_proyek);
 ?>
<style media="screen">
  .selisih-hari{
    /* background-color: #ff5454; */
    padding: 5px;
    font-weight: bold;
    color:#e35c5c;
  }
  .content-corousel-image{
    /* background-color: red; */
    background-repeat: no-repeat!important;
    background-size: 100%!important;
    background-position: center!important;
    width: 100%;
    height: 300px;
  }

  .carousel-indicators{
    position: relative!important;
    margin-top: 10px!important;
    right: 0!important;
     bottom: 0!important;
     left: 0!important;
     justify-content: left!important;
     margin-right: 0!important;
    margin-left: 0!important;
  }

  .carousel-indicators li{
    background-color: red;
    height: 50px;
    width: 80px;
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center;
  }


  .carousel-indicators li:hover{
    opacity: 0.5;
  }

.table-deskripsi tr td,th{
  padding:5px!important;
}


</style>


<div class="page-content-wrapper">
  <div class="container-fluid">
    <div class="col-md-11 mx-auto animated zoomIn delay-2s">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-sm-7">
              <?php
                $foto = array($dt->foto_1,$dt->foto_2,$dt->foto_3);
                $slides = 0;
               ?>
              <?php if ( !array_filter($foto)): ?>
                <div class="content-corousel-image" style="background:url(<?=base_url()?>_template/files/no-image.png)"></div>
                <?php else: ?>

              <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                  <div class="carousel-inner" role="listbox">
                      <?php foreach ($foto as $fotos): ?>
                        <?php if ($fotos!=""): ?>
                          <div class="carousel-item content-corousel-image" style="background-image:url('<?=base_url()?>_template/files/proyek/<?=$dt->kode?>/<?=$fotos?>')"></div>
                        <?php endif; ?>
                      <?php endforeach; ?>
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

              <ol class="carousel-indicators">
                <?php foreach ($foto as $fotoss): ?>
                  <?php if ($fotoss!=""): ?>
                    <li data-target="#carouselExampleIndicators" data-slide-to="<?=$slides++?>" style="background-image:url('<?=base_url()?>_template/files/proyek/<?=$dt->kode?>/<?=$fotoss?>')"></li>
                  <?php endif; ?>
                <?php endforeach; ?>
              </ol>
            <?php endif; ?>
            </div>
            <!-- //end col md -7 -->

            <div class="col-sm-5">
              <?php if ($cek_pendanaan > 0): ?>
                <span class="text-success"><i class="fa fa-check-circle"></i> TELAH ANDA DANAI SEBESAR Rp.<?=format_rupiah($cek_pendanaan)?></span>
              <?php endif; ?>
                  <h4 class="header-title">
                    Pendanaan <?=$dt->kode?>. <?=ucfirst($dt->title);?>
                  </h4>


                  <div class="mt-3 mb-3 row">
                    <div class="col-sm-12">
                      <span class="float-left" style="padding:5px">Dana terkumpul (<?=$persen?>%)</span>
                      <span class="selisih-hari float-right">Tersisa <?=selisih_hari($dt->akhir_penggalangan)?> Hari lagi</span>
                    </div>
                    <div class="col-sm-12 mt-1">
                      <div class="progress" style="background-color:#ebebeb;height:0.5rem;">
                          <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" role="progressbar" aria-valuenow="<?=$persen?>" aria-valuemin="0" aria-valuemax="100" style="width: <?=$persen?>%; color:#fff;"></div>
                      </div>
                    </div>
                  </div>

                  <ul class="list-group list-group-flush">
                      <li class="list-group-item">Dana Dibutuhkan <span class="float-right text-primary font-bold">Rp.<?=format_rupiah($total_dana)?></span></li>
                      <li class="list-group-item">Minimum Pendanaan <span class="float-right text-primary font-bold">Rp.<?=format_rupiah($dt->harga_paket)?></span></li>
                      <li class="list-group-item">Imbal Hasil /tahun <span class="float-right text-primary font-bold"> Rp.<?=format_rupiah($rupiah_imbal_hasil)?> (<?=$imbal_hasil?>%)</span></li>
                      <li class="list-group-item">Terima Imbal Hasil <span class="float-right text-primary font-bold">Tiap Bulan</span></li>
                  </ul>

                  <?php
                  if ($dt->status_penggalangan=="akan_datang") {
                    echo    '<div class="mt-3">
                                <h2 class="header-title"><i class="fa fa-lock"></i> Akan Rilis</h2>
                              </div>';
                  }elseif ($dt->status_penggalangan=="mulai") {
                    echo    '<div class="mt-3">
                                <a id="danai" href="'.site_url("user/master_proyek/add/".$dt->id_proyek.'/'.$dt->kode).'" class="btn btn-lg btn-block btn-primary">Danai Sekarang</a>
                              </div>';
                  }elseif ($dt->status_penggalangan=="terpenuhi") {
                    echo      '<div class="mt-3">
                                <h2 class="header-title"><i class="fa fa-lock"></i> Pendanaan Terpenuhi</h2>
                              </div>';
                  }elseif ($dt->status_penggalangan=="selesai") {
                    echo      '<div class="mt-3">
                                <h2 class="header-title"><i class="fa fa-lock"></i> Pendanaan Selesai</h2>
                              </div>';
                  }
                   ?>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-11 mx-auto animated zoomIn delay-2s mt-2">
      <div class="row">
        <div class="col-lg-3 text-center">
          <div class="card">
            <div class="card-body">
              <h1><i class="mdi mdi-chart-areaspline text-success"></i></h1>
              <h5><?=$imbal_hasil?>%</h5>
              <p>Imbal Hasil <br>Pertahun</p>
            </div>
          </div>
        </div>

        <div class="col-lg-3 text-center">
          <div class="card">
            <div class="card-body">
              <h1><i class="mdi mdi-calendar-text text-success"></i></h1>
              <h5><?=date('d/m/Y',strtotime($dt->akhir_penggalangan))?></h5>
              <p>Selesai Penggalangan <br>Dana</p>
            </div>
          </div>
        </div>



        <div class="col-lg-3 text-center">
          <div class="card">
            <div class="card-body">
              <h1><i class="mdi mdi-calendar-clock text-success"></i></h1>
              <h5><?=date('d/m/Y',strtotime($dt->tgl_mulai_proyek))?></h5>
              <p>Tanggal Mulai <br>Proyek</p>
            </div>
          </div>
        </div>

        <div class="col-lg-3 text-center">
          <div class="card">
            <div class="card-body">
              <h1><i class="mdi mdi-av-timer text-success"></i></h1>
              <h5><?=$dt->durasi_proyek?> bulan</h5>
              <p>Tenor/Durasi <br>Proyek</p>
            </div>
          </div>
        </div>

      </div>
    </div>




    <div class="col-md-11 mx-auto mt-2 animated zoomInUp delay-2s mb-2">
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

                <div class="form-group">
                  <input type="hidden" name="akhir_penggalangan" id="akhir_penggalangan" value="<?=$dt->akhir_penggalangan?>">
                  <input type="hidden" id="durasi_proyek" name="durasi_proyek" value="<?=$dt->durasi_proyek?>">
                  <input type="hidden" id="imbal_hasil" name="imbal_hasil" value="<?=$dt->imbal_hasil?>">
                </div>

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

    <div class="col-md-11 mx-auto mt-2 animated zoomInUp delay-2s mb-5">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active show" data-toggle="tab" href="#iktisar" role="tab" aria-selected="true">Iktisar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#legalitas" role="tab" aria-selected="false">Legalitas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#pemilik" role="tab" aria-selected="false">Pemilik Proyek</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#progres" role="tab" aria-selected="false">Progress</a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane p-3 active show" id="iktisar" role="tabpanel">
                        <h5>Deskripsi</h5>
                        <p class="font-14 mb-0">
                          <?=$dt->deskripsi?>
                          <table class="table table-borderless table-deskripsi mt-4">
                            <tr>
                              <th>Jumlah Pendanaan</th>
                              <td>: Rp.<?=format_rupiah($total_dana)?></td>
                            </tr>

                            <tr>
                              <th>Total Imbal Hasil</th>
                              <td>: <?=$dt->imbal_hasil_pendana+$dt->ujroh_penyelenggara?>% Pertahun setara dengan Rp.<?=format_rupiah(($total_imbal_hasil/100)*$total_dana)?></td>
                            </tr>

                            <tr>
                              <th>Imbal Hasil Pendana</th>
                              <td>: <?=$dt->imbal_hasil_pendana?>% Pertahun setara dengan Rp.<?=format_rupiah(($dt->imbal_hasil_pendana/100)*$total_dana)?></td>
                            </tr>

                            <tr>
                              <th>Ujroh Penyelenggara</th>
                              <td>: <?=$dt->ujroh_penyelenggara?>% Pertahun setara dengan Rp.<?=format_rupiah(($dt->ujroh_penyelenggara/100)*$total_dana)?></td>
                            </tr>

                            <tr>
                              <td colspan="2">&nbsp;</td>
                            </tr>


                            <tr>
                              <th>Pembagian Imbal Hasil</th>
                              <td>:  <b>*Imbal hasil pertama dibagikan 1 bulan setelah proyek dimulai</b></td>
                            </tr>

                            <tr>
                              <th>Pengembalian Dana</th>
                              <td>:  <b>*Dana Akan di kembalikan pada masing-masing pendana jika dana terkumpul di bawah 50%</b></td>
                            </tr>
                          </table>
                        </p>
                    </div>
                    <div class="tab-pane p-3" id="legalitas" role="tabpanel">
                        <p class="font-14 mb-0">
                            Silahkan Hubungi Admin.
                        </p>
                    </div>
                    <div class="tab-pane p-3" id="pemilik" role="tabpanel">
                        <p class="font-14 mb-0">
                            <?=strtoupper($dt->nama_perusahaan)?><br>
                            penanggung jawab : <?=$dt->nama?>
                        </p>
                    </div>
                    <div class="tab-pane p-3" id="progres" role="tabpanel">
                        <p class="font-14 mb-0">
                          <?php $result = $this->db->query("SELECT * from trans_progres_proyek where id_proyek = $dt->id_proyek") ?>
                          <?php if ($result->num_rows() > 0): ?>
                            <ol class="activity-feed mb-0">
                              <?php foreach ($result->result() as $row): ?>
                                <li class="feed-item">
                                    <span class="date"><i class="fa fa-calendar"></i> <?=date("d/m/Y",strtotime($row->created_at))?></span>
                                    <span class="activity-text">
                                      <b class="text-success">Progres pengerjaan <?=$row->persentase?>%</b> -
                                      <?=$row->deskripsi?>
                                    </span>
                                </li>
                              <?php endforeach; ?>
                            </ol>

                            <?php else: ?>
                              <i></i>
                          <?php endif; ?>
                        </p>
                    </div>
                </div>

            </div>
        </div>
        </div>
      </div>
    </div>



  </div>
</div> <!-- Page content Wrapper -->


<script src="<?=base_url()?>_template/usrp/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js"></script>
<script type="text/javascript">

<?php if ($dt->status_penggalangan=="mulai"): ?>
  $(document).on("click","#danai", function(e){
    e.preventDefault();
    $('.modal-dialog').removeClass('modal-sm')
                      .removeClass('modal-lg')
                      .addClass('modal-md');
    $("#modalTitle").text('Danai Proyek');
    $('#modalContent').load($(this).attr('href'));
    $("#modalGue").modal('show');
  });
<?php endif; ?>


$(document).ready(function(){
    $("#carouselExampleIndicators .carousel-item:first").addClass("active");
    $(".carousel-indicators li:first").addClass("active");
});



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
