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

<div class="wrapper">
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
                  }elseif ($dt->status=="cancel") {
                    echo '<h6 class="text-danger">CANCEL</h6>';
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
                      <li class="list-group-item"><a href="<?=site_url("backend/master_proyek")?>"><i class="fa fa-star"></i> Lihat Daftar Proyek</a></li>
                      <?php if ($dt->status=="publish" OR $dt->status=="done"): ?>
                      <li class="list-group-item"><a href="<?=site_url("backend/master_proyek/get_pemberi_dana/".enc_url($dt->id_proyek))?>" target="_blank"><i class="fa fa-star"></i> Lihat Daftar Pemberi Dana</a></li>
                      <li class="list-group-item"><a href="<?=site_url("backend/master_proyek/get_progres_proyek/".enc_url($dt->id_proyek))?>" target="_blank"><i class="fa fa-star"></i> Lihat Progres Proyek</a></li>
                      <li class="list-group-item"><a href="" target="_blank"><i class="fa fa-star"></i> Lihat Akumulasi Imbal Hasil</a></li>
                      <?php endif; ?>
                    </ul>

                    <?php if ($dt->status=="process"): ?>
                      <h4 class="header-title">FORM APPROVED</h4>
                      <div class="mt-2">
                        <form autocomplete="off" action="<?=site_url("backend/master_proyek/action/".enc_url($dt->id_proyek))?>" id="form">
                          <div class="form-group">
                            <label for="">Status Approved</label>
                            <select class="form-control" name="status_publish" id="status_publish">
                              <option value=""> -- pilih -- </option>
                              <option value="cancel">Cancel</option>
                              <option value="publish">Publish</option>
                            </select>
                          </div>


                          <div class="form-group">
                                <label>Tanggal Mulai Penggalangan </label>
                                <div>
                                    <div class="input-daterange input-group" id="date-range">
                                        <input type="text"  class="form-control" name="start_proyek" placeholder="Tgl Mulai">
                                        <input type="text" class="form-control" name="end_proyek" placeholder="Tgl Berakhir">
                                    </div>
                                </div>
                                <div id="start_proyek"></div>
                                <div id="end_proyek"></div>
                            </div>

                          <div class="form-group">
                            <label for="">Keterangan</label>
                            <textarea name="keterangan" id="keterangan" class="form-control" rows="3" cols="80" placeholder="Keterangan publish/cancel"></textarea>
                          </div>

                          <div class="form-group">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password akun">
                          </div>


                          <button type="submit" id="submit" class="btn btn-success btn-md" name="button">Approved</button>
                        </form>
                      </div>


                      <script type="text/javascript">
                      jQuery('#date-range').datepicker({
                          toggleActive: true
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
                                  $.toast({
                                    text: json.alert,
                                    showHideTransition: 'slide',
                                    icon: 'success',
                                    loaderBg: '#f96868',
                                    position: 'bottom-right',
                                    hideAfter: 3000,
                                    afterHidden: function () {
                                        location.href="<?=site_url('backend/'.$this->uri->segment(2))?>";
                                    }
                                  });
                              }else {
                                $("#submit").prop('disabled',false)
                                            .html('Approved');
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
                      <?php else: ?>

                        <div class="mt-4">
                          <h6 class="font-12">Execution :</h6>
                          <ul style="list-style:none;padding-left:0!important;">
                            <li class="pb-1">
                              <small>
                              <i class="fa fa-user"></i> <?=strtoupper($dt->acc_by)?>
                              <?=$dt->acc_by == "admin" ? "[ ".profile_where_id($dt->acc_by_id,"nama")." ]":""?>
                              </small>
                            </li>
                            <li><small><i class="fa fa-calendar"></i> <?=date("d/m/Y H:i",strtotime($dt->acc_at))?></small></li>
                          </ul>
                          <h6 class="font-12">Keterangan :</h6>
                          <p><small><?=$dt->keterangan !="" ? $dt->keterangan:"Null"?></small></p>
                        </div>

                    <?php endif; ?>
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

                      <?php if ($dt->status=="publish" OR $dt->status=="done"): ?>
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
                          <a href="#" class="badge badge-info font-14"> Foto 1</a>
                          <a href="#" class="badge badge-info font-14"> Foto 1</a>
                          <a href="#" class="badge badge-info font-14"> Foto 1</a>
                        </td>
                      </tr>

                      <tr>
                        <td colspan="2">&nbsp;</td>
                      </tr>

                      <tr>
                        <td colspan="2">
                          <h4 class="header-title">Data Pemilik Proyek</h4>
                        </td>
                      </tr>

                      <tr>
                        <th>ID-REG</th>
                        <td>: <a href=""><i class="fa fa-link"></i> <?=$dt->id_reg?></a></td>
                      </tr>

                      <tr>
                        <th>Perusahaan</th>
                        <td>: <?=$dt->nama_perusahaan?></td>
                      </tr>

                      <tr>
                        <th>Penanggung Jawab</th>
                        <td>: <?=$dt->nama?></td>
                      </tr>

                      <tr>
                        <th>Email</th>
                        <td>: <?=$dt->email?></td>
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
