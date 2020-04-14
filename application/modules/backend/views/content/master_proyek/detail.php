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


  .container-box {
    display: flex;
    flex-flow: row wrap;;
    }

    .container-box >div.box-file{
      background-color: #f1f1f1;
      background-position: center center!important;
      background-repeat: no-repeat!important;
      background-size: cover!important;
      width: 50px;
      height: 50px;
      margin: 10px;
      text-align: center;
    }

    .container-box >div.box-file:hover{
      cursor: zoom-in;
    }

</style>

<div class="wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 col-xl-4 mx-auto animated zoomIn delay-3s">
          <div class="card m-b-10">
            <div class="mb-2 card-body text-muted">
                <ul class="list-group list-group-flush mb-5">
                  <li class="list-group-item"><a href="<?=site_url("backend/master_proyek")?>">Lihat Daftar Proyek</a></li>
                  <?php if ($dt->status=="publish"): ?>
                  <li class="list-group-item"><a href="">Lihat Daftar Pemberi Dana <span class="badge badge-success float-right">1</span></a></li>
                  <li class="list-group-item"><a href="">Lihat Pendanaan Selesai</a></li>
                  <?php endif; ?>
                </ul>

              <?php if ($dt->status=="process"): ?>
                <h4 class="header-title">FORM APPROVED</h4>
                <div class="mt-2">
                  <form action="<?=site_url("backend/master_proyek/action/".enc_url($dt->id_proyek))?>" id="form">
                    <div class="form-group">
                      <select class="form-control" name="status_publish" id="status_publish">
                        <option value=""> -- pilih -- </option>
                        <option value="cancel">CANCEL</option>
                        <option value="publish">PUBLISH</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <textarea name="keterangan" id="keterangan" class="form-control" rows="3" cols="80" placeholder="Keterangan"></textarea>
                    </div>

                    <div class="form-group">
                      <input type="password" class="form-control" id="password" name="password" placeholder="Password akun">
                    </div>


                    <button type="submit" id="submit" class="btn btn-success btn-md" name="button">Proses</button>
                  </form>
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
                                  location.href="<?=site_url('backend/'.$this->uri->segment(2))?>";
                              }
                            });
                        }else {
                          $("#submit").prop('disabled',false)
                                      .html('Proses');
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

                  <h6 class="font-14">Execution :</h6>
                  <ul style="list-style:none;padding-left:0!important;font-size:12px;">
                    <li class="pb-2">
                      <i class="fa fa-user"></i> <?=strtoupper($dt->acc_by)?>
                      <?=$dt->acc_by == "admin" ? "[ ".profile_where_id($dt->acc_by_id,"nama")." ]":""?>
                    </li>
                    <li><i class="fa fa-calendar"></i> <?=date("d/m/Y H:i",strtotime($dt->acc_at))?></li>
                  </ul>
                  <h6 class="font-14">Keterangan :</h6>
                  <p><?=$dt->keterangan !="" ? $dt->keterangan:"Null"?></p>

              <?php endif; ?>
            </div>
          </div>
        </div>


        <div class="col-md-12 col-xl-8">
          <div class="row">
            <div class="col-md-4 animated zoomIn delay-3s">
              <div class="card m-b-10">
                <div class="mb-2 card-body text-center text-muted">
                  <h6 class="text-info"><?=date("d/m/Y H:i",strtotime($dt->created_at))?></h6>
                  WAKTU REGIS
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
                  } ?>

                  STATUS PUBLISH
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
                  }
                   ?>
                  STATUS PENGGALANGAN
                </div>
              </div>
            </div>


            <!-- PROGRES BAR -->
            <?php if ($dt->status=="publish"): ?>
            <div class="col-md-10 mb-5 mt-5 mx-auto animated zoomIn delay-3s">
                <h5 class="font-18 text-center">DANA TERKUMPUL Rp.7.500.000 (75%)</h5>
                <div class="progress">
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%">75%</div>
                </div>

                <div class="row mt-4">
                  <div class="col-lg-12 text-center">
                    <a href="#" class="btn btn-lg btn-info">LIHAT DAFTAR PEMBERI DANA</a>
                    <a href="#" class="btn btn-lg btn-primary">HITUNG IMBAL HASIL (*SIMULASI)</a>
                  </div>
                </div>
            </div>
          <?php endif; ?>



            <div class="col-md-12 animated zoomIn delay-3s">
              <div class="card m-b-10">
                <div class="mb-2 card-body text-muted">
                  <table class="table table-borderless">

                    <?php
                      $total_dana = $dt->harga_paket * $dt->jumlah_paket;

                     ?>

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

                    <?php if ($dt->status=="publish"): ?>
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
                      <th>Nama</th>
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
