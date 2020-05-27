

<div class="page-content-wrapper">

  <div class="header-bg">
      <div class="container-fluid">
          <div class="row">
              <div class="col-12 mb-4 pt-5">
                  <h4 class="text-center font-style" style="text-transform :uppercase">Hi, <?=profile("nama")?></h4>
                  <p class="text-center font-style" style="color:#555555;font-size:16px"><?=profile("email")?><br>#<?=profile("id_reg")?></p>
                  <?php if (!complate_data()): ?>
                    <div class="col-md-6 mx-auto text-center alert alert-info">
                      <p style="font-size:18px">
                        <strong>DATA ANDA BELUM LENGKAP!</strong><br>
                         Mungkin beberapa fitur belum bisa anda gunakan. mohon untuk melengkapi data anda terlebih dahulu.
                      </p>
                      <a href="<?=site_url("user/wizard")?>" class="btn btn-sm btn-primary"><i class="fa fa-arrow-right"></i> Lengkapi Data</a>
                    </div>
                    <?php else: ?>
                      <?php echo $this->session->flashdata('info_data'); ?>
                      <div class="mt-4 text-center">
                          <a href="<?=site_url("user/deposit/add")?>" class="btn btn-outline-primary ml-1 waves-effect waves-light">Deposit</a>
                          <a href="<?=site_url("user/withdraw/add")?>" class="btn btn-outline-primary ml-1 waves-effect waves-light">Withdraw</a>
                          <a href="<?=site_url("user/profile")?>" class="btn btn-outline-primary ml-1 waves-effect waves-light">Lihat Profile</a>
                      </div>
                  <?php endif; ?>

              </div>
          </div>
      </div>
  </div>

  <div class="container-fluid">


    <div class="row">
        <div class="col-lg-10 mx-auto font-style">
          <div class="row">
            <div class="col-md-6 col-xl-4">
                <div class="card text-center m-b-30">
                    <div class="mb-2 card-body text-muted">
                        <h5 class="text-info">Rp.<?=format_rupiah($this->balance_user->init())?></h5>
                        Saldo
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="card text-center m-b-30">
                    <div class="mb-2 card-body text-muted">
                        <h5 class="text-purple">Rp.<?=format_rupiah($this->balance_user->get_withdraw(sess('id_user'))) ?></h5>
                        Total Withdraw
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="card text-center m-b-30">
                    <div class="mb-2 card-body text-muted">
                        <h5 class="text-primary">Rp.<?=format_rupiah($this->balance_user->get_pendanaan(sess('id_user'))) ?></h5>
                        Total Omset
                    </div>
                </div>
            </div>
          </div>
        </div>
    </div>




    <div class="row mt-5">
      <div class="col-lg-11 mx-auto">
      <div class="mb-3 animated fadeInRight delay-2s font-style">
        <h3 class="pb-2 text-primary">Penggalangan Dana Sedang Berlangsung</h3>
        <p style="color:#141414;font-size:18px">Berikan Pendanaan Terbaikmu, dan Nikmati Imbal Hasil Terbaik.</p>
        <a href="<?=site_url("user/master_proyek")?>" class="btn btn-sm btn-primary">Lihat Semua Penggalangan</a>
      </div>

        <div class="row">
          <?php foreach ($poryek_publish as $pb): ?>
            <?php
            $total_dana = $pb->harga_paket * $pb->jumlah_paket; //dana di butuhkan
            $dana_terkumpul = $this->proyek->total_dana_terkumpul($pb->id_proyek);
            $persen = cari_persen($total_dana,$dana_terkumpul);
            $imbal_hasil = $pb->imbal_hasil_pendana;
            $rupiah_imbal_hasil = ($pb->imbal_hasil_pendana+$pb->ujroh_penyelenggara)/100*$total_dana;

            if ($pb->foto_1!="") {
              $image = base_url().'_template/files/proyek/'.$pb->kode.'/'.$pb->foto_1;
            }else {
              $image = base_url().'_template/files/no-image.png';
            }
             ?>
            <div class="col-md-6 col-lg-6 col-xl-4 animated zoomIn delay-2s">
                <div class="card m-b-30" style="position:relative">
                  <div class="card-img-top" style="height:150px;background:url(<?=$image?>)">
                    <span class="label-hari">Tersisa <?=selisih_hari($pb->akhir_penggalangan)?> hari lagi</span>
                  </div>
                    <div class="card-body" style="height:80px;max-height:80px!important;">
                        <p class="card-text" style="color:#6b6b6b;font-size:15px">Pendanaan <b><?=$pb->kode?></b>. <?=$pb->title?></p>
                    </div>
                    <div class="card-body">
                      <span>Dana terkumpul (<?=$persen?>%)</span>
                      <div class="mt-1">
                        <div class="progress" style="background-color:#ebebeb;height:0.5rem;">
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" role="progressbar" aria-valuenow="<?=$persen?>" aria-valuemin="0" aria-valuemax="100" style="width: <?=$persen?>%; color:#fff;"></div>
                        </div>
                      </div>
                    </div>
                    <ul class="list-group list-group-flush list-custom">
                        <li class="list-group-item">Dana Dibutuhkan <span class="float-right badge badge-primary">Rp.<?=format_rupiah($total_dana)?></span></li>
                        <li class="list-group-item">Minimum Pendanaan <span class="float-right badge badge-primary">Rp.<?=format_rupiah($pb->harga_paket)?></span></li>
                        <li class="list-group-item">Durasi Proyek <span class="float-right badge badge-primary"><?=$pb->durasi_proyek?> bulan</span></li>
                        <li class="list-group-item">Imbal Hasil /tahun <span class="float-right badge badge-primary"> Rp.<?=format_rupiah(($pb->imbal_hasil_pendana+$pb->ujroh_penyelenggara)/100*$total_dana)?> (<?=$pb->imbal_hasil_pendana+$pb->ujroh_penyelenggara?>%)</span></li>
                        <li class="list-group-item">Terima Imbal Hasil <span class="float-right badge badge-primary">Tiap Bulan</span></li>
                    </ul>
                    <div class="card-body">
                        <a href="<?=site_url("user/master_proyek/detail/".$pb->id_proyek."/".$pb->kode)?>" class="btn btn-sm btn-block btn-primary">Danai Sekarang</a>
                    </div>
                </div>
            </div>
          <?php endforeach; ?>


        </div>
      </div>
    </div>



  </div>
</div> <!-- Page content Wrapper -->

<script type="text/javascript">
  $(document).ready(function(){
    setTimeout(function() {
      $('#alert-data-success').fadeOut('slow');
    }, 8000); // <-- time in milliseconds
  });
</script>
