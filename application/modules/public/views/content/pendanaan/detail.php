<?php
  $total_dana = $dt->harga_paket * $dt->jumlah_paket; //dana di butuhkan
  $dana_terkumpul = $this->proyek->total_dana_terkumpul($dt->id_proyek);
  $persen = cari_persen($total_dana,$dana_terkumpul);
  $imbal_hasil = $dt->imbal_hasil_pendana;
  $total_imbal_hasil = $dt->ujroh_penyelenggara + $dt->imbal_hasil_pendana;
  $rupiah_imbal_hasil = ($dt->imbal_hasil_pendana+$dt->ujroh_penyelenggara)/100*$total_dana;
  $foto = array($dt->foto_1,$dt->foto_2,$dt->foto_3);
  $slides = 0;

  if ($this->session->userdata("login_user_status")) {
    $this->load->library("user/balance_user");
    $cek_pendanaan = $this->balance_user->get_pendanaan(sess('id_user'),$dt->id_proyek);
  }else {
  $cek_pendanaan = 0;
  }
 ?>

 <style media="screen">
.image-corousel{
  width: 100%;
  height: 390px;
  background: #1a9880;
  background-repeat: no-repeat!important;
  background-size: cover!important;
  background-position: center!important;
}

table tr,td{
  font-size:12px;
}
 </style>

<div class="main" role="main">
  <section class="page-header page-header-modern page-header-background page-header-background-sm overlay overlay-color-primary overlay-show overlay-op-8 mb-5" style="background-image: url(<?=base_url()?>_template/public/img/page-header/page-header-elements.jpg);">
		<div class="container">
			<div class="row">
				<div class="col-md-12 align-self-center p-static order-2 text-center">
					<h1><?=$title?></h1>
				</div>
			</div>
		</div>
	</section>

  <div class="container mb-5">
    <div class="row">
      <div class="col-lg-11 mx-auto">
        <div class="row">
          <div class="col-sm-7">
              <div class="owl-carousel owl-theme nav-inside nav-style-1 nav-light owl-loaded owl-drag owl-carousel-init" data-plugin-options="{'items': 1, 'margin': 10, 'loop': false, 'nav': true, 'dots': false}" style="height: auto;">
    							<div class="owl-stage-outer">
                    <div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: all 0.25s ease 0s; width: 1100px;">
                      <?php if (!array_filter($foto)): ?>
                        <div class="owl-item active" style="width: 540px; margin-right: 10px;">
                          <div>
          									<div class="img-thumbnail border-0 p-0 d-block">
                              <div class="image-corousel" style="background:url(<?=base_url()?>_template/files/no-image.png)"></div>
          									</div>
          								</div>
                        </div>
                        <?php else: ?>
                          <?php foreach ($foto as $fotos): ?>
                            <?php if ($fotos!=""): ?>
                              <div class="owl-item active" style="width: 540px; margin-right: 10px;">
                                <div>
                									<div class="img-thumbnail border-0 p-0 d-block">
                                    <div class="image-corousel" style="background-image:url('<?=base_url()?>_template/files/proyek/<?=$dt->kode?>/<?=$fotos?>')"></div>
                									</div>
                								</div>
                              </div>
                            <?php endif; ?>
                          <?php endforeach; ?>
                      <?php endif; ?>
                </div>
              </div>

            <div class="owl-nav">
              <button type="button" role="presentation" class="owl-prev disabled"></button>
              <button type="button" role="presentation" class="owl-next"></button>
            </div>

            <div class="owl-dots disabled"></div>
            </div>
          </div>

          <div class="col-lg-5">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <?php if ($cek_pendanaan > 0): ?>
                    <div class="col-sm-12 mb-3">
                        <span class="text-success"><i class="fa fa-check-circle"></i> TELAH ANDA DANAI SEBESAR Rp.<?=format_rupiah($cek_pendanaan)?></span>
                    </div>
                  <?php endif; ?>

                    <div class="col-sm-12 mb-3">
                      <?php if ($dt->status_penggalangan=="akan_datang"): ?>
                        <span class="badge badge-warning">AKAN DATANG</span>
                      <?php elseif($dt->status_penggalangan=="mulai"):?>
                        <span class="badge badge-info">SEDANG BERLANGSUNG</span>
                      <?php elseif($dt->status_penggalangan=="terpenuhi"):?>
                        <span class="badge badge-danger">TERPENUHI</span>
                      <?php elseif($dt->status_penggalangan=="selesai"):?>
                        <span class="badge badge-success">SELESAI</span>
                      <?php endif; ?>
                    </div>

                    <div class="col-lg-9">
                        <p style="margin-bottom: 3px;">Dana Terkumpul</p>
                    </div>
                    <div class="col-lg-3 text-right">
                        <h5 style="margin-bottom: 0px;"><?=$persen?>%</h5>
                    </div>
                    <div class="col-lg-12">
                        <div class="progress progress-sm mb-2">
                            <div class="progress-bar progress-bar-primary progress-bar-striped progress-bar-animated active" role="progressbar" aria-valuenow="<?=$persen?>" aria-valuemin="0" aria-valuemax="100" style="width: <?=$persen?>%">
                                <span class="sr-only"><?=$persen?>% Complete</span>
                            </div>
                        </div>
                    </div>
                  </div>

                  <div class="row mt-3">
                      <div class="col-lg-6">
                          <h6 class="mb-0">Dana Dibutuhkan</h6>
                          <h6 class="font-weight-bold">Rp. <?=format_rupiah($dt->dana_dibutuhkan)?></h6>

                          <h6 class="mb-0">Imbal Hasil/Tahun</h6>
                          <h6 class="font-weight-bold"><?=$dt->imbal_hasil_pendana?>%</h6>

                          <h6 class="mb-0">Terima Imbal Hasil</h6>
                          <h6 class="font-weight-bold">Tiap Bulan</h6>
                      </div>
                      <div class="col-lg-6">
                          <h6 class="mb-0">Durasi/Tenor Proyek</h6>
                          <h6 class="font-weight-bold"><?=$dt->durasi_proyek?> bulan</h6>

                          <h6 class="mb-0">Minimum Pendanaan</h6>
                          <h6 class="font-weight-bold">Rp. <?=format_rupiah($dt->harga_paket)?></h6>

                          <?php if ($dt->status_penggalangan=="mulai"): ?>
                            <h6 class="mb-0">Penggalangan Berakhir</h6>
                            <h6 class="font-weight-bold"><?=selisih_hari($dt->akhir_penggalangan)?> Hari lagi</h6>
                          <?php elseif($dt->status_penggalangan=="akan_datang"):?>
                            <h6 class="mb-0">Mulai Penggalangan</h6>
                            <h6 class="font-weight-bold"><?=date('d/m/Y',strtotime($dt->mulai_penggalangan))?></h6>
                          <?php elseif($dt->status_penggalangan=="terpenuhi" OR $dt->status_penggalangan=="selesai"):?>
                            <h6 class="mb-0">Status Penggalangan</h6>
                            <h6 class="font-weight-bold">Berakhir</h6>
                          <?php endif; ?>
                      </div>
                  </div>

                  <div class="row mt-3">
                    <div class="col-lg-12">
                      <?php
                      if ($dt->status == "publish") {
                        if ($dt->status_penggalangan=="akan_datang") {
                          echo    '<div class="mt-3">
                                      <h2 class="header-title text-5"><i class="fa fa-lock"></i> Akan Rilis</h2>
                                    </div>';
                        }elseif ($dt->status_penggalangan=="mulai") {
                          if ($this->session->userdata("login_user_status")) {
                            echo    '<div class="mt-3">
                                        <a id="danai" href="'.site_url("user/master_proyek/add/".$dt->id_proyek.'/'.$dt->kode).'" class="btn btn-lg btn-block btn-primary">Danai Sekarang</a>
                                      </div>';
                          }else {
                            echo    '<div class="mt-3">
                                        <a href="'.site_url("user/login").'" class="btn btn-lg btn-block btn-primary">Danai Sekarang</a>
                                      </div>';
                          }

                        }elseif ($dt->status_penggalangan=="terpenuhi") {
                          echo      '<div class="mt-3">
                                      <h2 class="header-title text-5"><i class="fa fa-lock"></i> Pendanaan Terpenuhi</h2>
                                    </div>';
                        }elseif ($dt->status_penggalangan=="selesai") {
                          echo      '<div class="mt-3">
                                      <h2 class="header-title"><i class="fa fa-lock"></i> Pendanaan Selesai</h2>
                                    </div>';
                        }
                      }elseif($dt->status == "unapproved") {
                        echo    '<div class="mt-3">
                                    <h2 class="header-title text-5"><i class="fa fa-lock"></i> Dana Telah Di Kembalikan</h2>
                                  </div>';
                      }
                       ?>
                    </div>
                  </div>
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
                <h5 class="text-primary text-5"><?=$imbal_hasil?>%</h5>
                <p>Imbal Hasil <br>Pertahun</p>
              </div>
            </div>
          </div>

          <div class="col-lg-3 text-center">
            <div class="card">
              <div class="card-body">
                <h1><i class="mdi mdi-calendar-text text-success"></i></h1>
                <h5 class="text-primary text-5"><?=date('d/m/Y',strtotime($dt->akhir_penggalangan))?></h5>
                <p>Selesai Penggalangan <br>Dana</p>
              </div>
            </div>
          </div>



          <div class="col-lg-3 text-center">
            <div class="card">
              <div class="card-body">
                <h1><i class="mdi mdi-calendar-clock text-success"></i></h1>
                <h5 class="text-primary text-5"><?=date('d/m/Y',strtotime($dt->tgl_mulai_proyek))?></h5>
                <p>Tanggal Mulai <br>Proyek</p>
              </div>
            </div>
          </div>

          <div class="col-lg-3 text-center">
            <div class="card">
              <div class="card-body">
                <h1><i class="mdi mdi-av-timer text-success"></i></h1>
                <h5 class="text-primary text-5"><?=$dt->durasi_proyek?> bulan</h5>
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

              <form id="form" action="<?=site_url("penggalangan-dana/simulasi/$dt->id_proyek/$dt->kode")?>" autocomplete="off">
                <div class="row">
                  <div class="col-sm-6 form-group">
                    <label for="">Masukkan Jumlah Dana</label>
                    <input type="text" class="form-control" name="nominal">
                    <div id="nominal"></div>
                  </div>

                  <div class="col-sm-6 form-group">
                    <label for="">Pilih Tanggal Pendanaan</label>
                    <input class="form-control" type="date" id="tanggal" name="tanggal" min="<?=$dt->mulai_penggalangan?>" max="<?=$dt->akhir_penggalangan?>">
                  </div>

                  <div class="form-group">
                    <input type="hidden" name="akhir_penggalangan" id="akhir_penggalangan" value="<?=$dt->akhir_penggalangan?>">
                    <input type="hidden" id="durasi_proyek" name="durasi_proyek" value="<?=$dt->durasi_proyek?>">
                    <input type="hidden" id="imbal_hasil" name="imbal_hasil" value="<?=$dt->imbal_hasil?>">
                  </div>

                  <div class="col-sm-3">
                    <button type="submit" id="submit" name="submit" class="btn btn-md btn-primary">Hitung Imbal Hasil</button>
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
                  <div class="tabs">
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
                                  <td>:  <b>*Dana Akan di kembalikan pada masing-masing pendana jika dana terkumpul di bawah <?=master_config("FINANCIAL-PD")?>%.</b></td>
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

    </div>
  </div>


</div>

<script src="<?=base_url()?>_template/usrp/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js"></script>
<script type="text/javascript">

<?php if ($dt->status_penggalangan=="mulai"): ?>
  $(document).on("click","#danai", function(e){
    e.preventDefault();
    $('.modal-dialog').removeClass('modal-sm')
                      .removeClass('modal-md')
                      .addClass('modal-lg');
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
