<style media="screen">
.table tr th{
  color:#222222;
  padding: 3px 3px 3px 3px;
  font-size: 14px;
  width: max-content;
}
  .table tr td{
    color:#8a8a8a;
    padding: 3px 3px 3px 3px!important;
    font-size: 14px;
  }

  .progress{
    background-color: #d5d5d5;
  }
</style>

<?php
  $total_dana = $dt->harga_paket * $dt->jumlah_paket; //dana di butuhkan
  $dana_terkumpul = $this->proyek->total_dana_terkumpul($dt->id_proyek);
  $persen = cari_persen($total_dana,$dana_terkumpul);
 ?>

<div class="page-content-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 col-xl-12 mx-auto">
          <div class="row">
            <div class="col-md-4 animated zoomIn delay-3s">
              <div class="card m-b-10">
                <div class="mb-2 card-body text-center text-muted">
                  <h6 class="text-info"><?=date("d/m/Y H:i",strtotime($dt->created_at))?></h6>
                  WAKTU
                </div>
              </div>
            </div>

            <div class="col-md-4 animated zoomIn delay-3s">
              <div class="card m-b-10">
                <div class="mb-2 card-body text-center text-muted">
                  <?php if ($dt->status=="process") {
                    echo '<h6 class="text-warning">MENUNGGU VERIFIKASI</h6>';
                  }elseif ($dt->status=="publish") {
                    echo '<h6 class="text-success">PUBLISH</h6>';
                  }elseif ($dt->status=="pengerjaan") {
                    echo '<h6 class="text-success">PROYEK DI KERJAKAN</h6>';
                  }elseif ($dt->status=="dana_dikembalikan") {
                    echo '<h6 class="text-danger">DANA DI KEMBALIKAN</h6>';
                  }elseif ($dt->status=="cancel") {
                    echo '<h6 class="text-danger">PERMOHONAN DI TOLAK</h6>';
                  }elseif ($dt->status=="done") {
                    echo '<h6 class="text-success">PROYEK SELESAI</h6>';
                  } ?>

                  STATUS
                </div>
              </div>
            </div>

            <div class="col-md-4 animated zoomIn delay-3s">
              <div class="card m-b-10">
                <div class="mb-2 card-body text-center text-muted">
                  <?php
                  if ($dt->status=="process") {
                    echo "<h6 class='text-warning'>BELUM DITENTUKAN</h6>";
                  }elseif ($dt->status=="publish") {
                    if ($dt->status_penggalangan=="mulai") {
                      echo "<h6 class='text-success font-13'>PENGGALANGAN BERLANGSUNG</h6>";
                    }elseif ($dt->status_penggalangan=="selesai") {
                      echo "<h6 class='text-danger'>TELAH BERAKHIR</h6>";
                    }
                  }elseif ($dt->status=="cancel") {
                    echo "<h6 class='text-danger'> BELUM DITENTUKAN </h6>";
                  }elseif ($dt->status=="done") {
                    echo "<h6 class='text-danger'>TELAH BERAKHIR</h6>";
                  }elseif ($dt->status=="pengerjaan") {
                    echo "<h6 class='text-danger'>TELAH BERAKHIR</h6>";
                  }elseif ($dt->status=="dana_dikembalikan") {
                    echo "<h6 class='text-danger'>TELAH BERAKHIR</h6>";
                  }
                   ?>
                  STATUS PENGGALANGAN
                </div>
              </div>
            </div>


            <!-- PROGRES BAR -->
            <?php if ($dt->status=="publish" OR $dt->status=="done"): ?>
            <div class="col-md-8 mb-5 mt-5 mx-auto animated zoomIn delay-3s">
                <h5 class="font-18 text-center">DANA TERKUMPUL Rp.<?=format_rupiah($dana_terkumpul)?> (<?=$persen?>%)</h5>
                <div class="progress">
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" role="progressbar" aria-valuenow="<?=$persen?>" aria-valuemin="0" aria-valuemax="100" style="width: <?=$persen?>%"><?=$persen?>%</div>
                </div>

                <div class="row mt-4">
                  <div class="col-lg-12 text-center">
                    <div class="row">
                      <div class="col-sm-4">
                        <div class="card m-b-30 card-primary">
                                <div class="card-body text-center text-white">
                                  <h6><?=$this->proyek->count_pendana($dt->id_proyek)?> Pendana</h6>
                                  PEMBERI DANA
                                </div>
                            </div>
                      </div>

                      <div class="col-sm-4">
                        <div class="card m-b-30 card-primary">
                                <div class="card-body text-center text-white">
                                  <h6><?=$this->proyek->total_paket($dt->id_proyek)?> Paket</h6>
                                  PAKET TERJUAL
                                </div>
                            </div>
                      </div>

                      <div class="col-sm-4">
                        <div class="card m-b-30 card-primary">
                                <div class="card-body text-center text-white">
                                  <h6>Rp. <?=format_rupiah($dana_terkumpul)?></h6>
                                  DANA TERKUMPUL
                                </div>
                            </div>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
          <?php endif; ?>

          <div class="col-md-12 col-xl-12 mx-auto">
            <div class="row">
              <div class="col-md-4 animated zoomIn delay-3s">
                <div class="card m-b-10">
                  <div class="mb-2 card-body text-muted">
                    <!-- <a href="<?=site_url("backend/master_proyek")?>" class="btn btn-md btn-secondary btn-block"><i class="fa fa-file"></i> Lihat Daftar Proyek</a> -->
                    <ul class="list-group list-group-flush mb-4">
                      <li class="list-group-item"><a href="<?=site_url("usrp/master_proyek")?>"><i class="fa fa-star"></i> Lihat Daftar Proyek</a></li>

                      <?php if ($dt->status == "pengerjaan"): ?>
                        <li class="list-group-item"><a href="<?=site_url("usrp/master_proyek/get_progres_proyek/".enc_url($dt->id_proyek))?>"><i class="fa fa-star"></i> Lihat Progres Proyek</a></li>
                      <?php endif; ?>

                      <?php if ($dt->status=="publish" OR $dt->status=="done" OR $dt->status == "pengerjaan"): ?>
                      <li class="list-group-item"><a href="" target="_blank"><i class="fa fa-star"></i> Lihat Akumulasi Imbal Hasil</a></li>
                      <?php endif; ?>

                      <?php if ($dt->status=="cancel" OR $dt->status=="process"): ?>
                        <li class="list-group-item"><a href="<?=site_url("usrp/master_proyek/delete/".enc_url($dt->id_proyek))?>" id="hapus"><i class="fa fa-star"></i> Hapus Proyek</a></li>
                      <?php endif; ?>
                    </ul>


                  </div>
                </div>
              </div>

              <div class="col-md-8 animated zoomIn delay-3s">
                <div class="card m-b-10">
                  <div class="mb-2 card-body text-muted">
                    <table class="table table-borderless">

                       <tr>
                         <td colspan="2">
                           <h4 class="header-title">Data Proyek</h4>
                         </td>
                       </tr>


                      <tr>
                        <th>Kode Proyek</th>
                        <td>: <span class="text-primary"><?=$dt->kode?></span></td>
                      </tr>

                      <tr>
                        <th>Title</th>
                        <td>: Pendanaan <b><?=$dt->kode?></b>. <?=$dt->title?></td>
                      </tr>

                      <tr>
                        <th>Harga Per Paket</th>
                        <td>: Rp. <?=format_rupiah($dt->harga_paket)?></td>
                      </tr>

                      <tr>
                        <th>Jumlah Paket</th>
                        <td>: <?=$dt->jumlah_paket?> paket</td>
                      </tr>

                      <tr>
                        <th>Total Dana yang di butuhkan</th>
                        <td>: Rp.<?=format_rupiah($total_dana)?> (harga paket * jumlah paket)</td>
                      </tr>

                      <tr>
                        <th>Priode/Tenor</th>
                        <td>: <?=$dt->durasi_proyek?> Bulan</td>
                      </tr>

                      <tr>
                        <th>Total Imbal Hasil</th>
                        <td>: <?=$dt->imbal_hasil_pendana+$dt->ujroh_penyelenggara?>% Pertahun setara dengan Rp.<?=format_rupiah(($dt->imbal_hasil_pendana+$dt->ujroh_penyelenggara)/100*$total_dana)?></td>
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
                        <th>Lama Penggalangan Dana</th>
                        <td>: <?=$dt->lama_penggalangan?> Hari</td>
                      </tr>

                      <?php if ($dt->status=="publish" OR $dt->status=="done" OR $dt->status=="pengerjaan" OR $dt->status=="dana_dikembalikan"): ?>
                        <tr>
                          <th>Waktu Penggalangan</th>
                          <td>: <?=date("d-m-Y",strtotime($dt->mulai_penggalangan))?> s/d <?=date("d-m-Y",strtotime($dt->akhir_penggalangan))?> (<?=selisih_hari($dt->akhir_penggalangan)?> Hari lagi)</td>
                        </tr>

                        <tr>
                          <th>Waktu Mulai Proyek</th>
                          <td>: <?=date("d-m-Y",strtotime($dt->tgl_mulai_proyek))?></td>
                        </tr>
                      <?php endif; ?>


                      <tr>
                        <th>Lokasi Proyek</th>
                        <td>: <?=$dt->lokasi_proyek?> Kab. <?=$dt->kabupaten?>, Prov. <?=$dt->provinsi?> </td>
                      </tr>

                      <tr>
                        <th>Foto</th>
                        <td>:
                          <?php if ($dt->foto_1!=""): ?>
                            <a href="<?=base_url()?>_template/files/proyek/<?=$dt->kode?>/<?=$dt->foto_1?>" target="_blank" class="badge badge-info font-14"> Foto 1</a>
                          <?php endif; ?>

                          <?php if ($dt->foto_2!=""): ?>
                            <a href="<?=base_url()?>_template/files/proyek/<?=$dt->kode?>/<?=$dt->foto_2?>" target="_blank" class="badge badge-info font-14"> Foto 2</a>
                          <?php endif; ?>

                          <?php if ($dt->foto_3!=""): ?>
                            <a href="<?=base_url()?>_template/files/proyek/<?=$dt->kode?>/<?=$dt->foto_3?>" target="_blank" class="badge badge-info font-14"> Foto 3</a>
                          <?php endif; ?>
                        </td>

                        <tr>
                          <td colspan="2">
                            <b style="color:#3d3d3d">Deskripsi :</b>
                            <p><?=$dt->deskripsi?></p>
                          </td>
                        </tr>
                      </tr>


                    </table>
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


<?php if ($dt->status=="cancel" OR $dt->status=="process"): ?>
  <script type="text/javascript">
  $(document).on("click","#hapus",function(e){
    e.preventDefault();
    $('.modal-dialog').removeClass('modal-lg')
                      .removeClass('modal-md')
                      .addClass('modal-sm');
    $("#modalTitle").text('Please Confirm');
    $('#modalContent').html(`<p>Are you sure you want to delete?</p>
                              <button type='button' class='btn btn-default btn-sm' data-dismiss='modal'>Cancel</button>
                              <button type='button' class='btn btn-primary btn-sm' id='ya-hapus' data-id=`+$(this).attr('alt')+`  data-url=`+$(this).attr('href')+`>Yes, i'm sure</button>
                              `);
    $("#modalGue").modal('show');
  });


  $(document).on('click','#ya-hapus',function(e){
    $(this).prop('disabled',true)
            .text('Processing...');
    $.ajax({
            url:$(this).data('url'),
            type:'POST',
            cache:false,
            dataType:'json',
            success:function(json){
              $('#modalGue').modal('hide');
              $.toast({
                text: json.message,
                showHideTransition: 'slide',
                icon: 'success',
                loaderBg: '#f96868',
                position: 'bottom-right',
                hideAfter: 3000,
                afterHidden: function () {
                    window.location.href = '<?=site_url('usrp/master_proyek')?>';
                }
              });
            }
          });
  });
  </script>
<?php endif; ?>
