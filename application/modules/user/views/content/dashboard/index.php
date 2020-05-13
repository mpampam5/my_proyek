<div class="page-content-wrapper">

  <div class="header-bg">
      <div class="container-fluid">
          <div class="row">
              <div class="col-12 mb-4 pt-5">
                  <h4 class="text-center">Hi, <?=profile("nama")?></h4>
                  <p class="text-center" style="color:#555555;font-size:16px"><?=profile("email")?></p>
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
                          <button type="button" class="btn btn-outline-primary ml-1 waves-effect waves-light">Deposit</button>
                          <button type="button" class="btn btn-outline-primary ml-1 waves-effect waves-light">Withdraw</button>
                      </div>
                  <?php endif; ?>

              </div>
          </div>
      </div>
  </div>

  <div class="container-fluid">


    <div class="row">
        <div class="col-md-6 col-xl-3">
            <div class="card text-center m-b-30">
                <div class="mb-2 card-body text-muted">
                    <h5 class="text-info">Rp.<?=format_rupiah($this->balance_user->init())?></h5>
                    Saldo
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card text-center m-b-30">
                <div class="mb-2 card-body text-muted">
                    <h5 class="text-purple">Rp.<?=format_rupiah($this->balance_user->get_withdraw(sess('id_user'))) ?></h5>
                    Total Withdraw
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card text-center m-b-30">
                <div class="mb-2 card-body text-muted">
                    <h5 class="text-primary">289</h5>
                    Total Pendanaan
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card text-center m-b-30">
                <div class="mb-2 card-body text-muted">
                    <h5 class="text-danger">5,220</h5>
                    Unique Visitors
                </div>
            </div>
        </div>
    </div>


    <style media="screen">
      .list-group-item{
        padding: 5px 20px!important;
      }
    </style>

    <div class="row mt-5">
      <div class="col-lg-12">
      <div class="mb-3">
        <h3 class="pb-2">Penggalangan Dana Sedang Berlangsung</h3>
        <p style="color:#505050;font-size:18px">Berikan Pendanaan Terbaikmu, dan Nikmati Imbal Hasil Terbaik.</p>
        <a href="#" class="btn btn-sm btn-primary">Lihat Semua penggalangan</a>
      </div>

        <div class="row">
          <div class="col-md-6 col-lg-6 col-xl-4">
              <div class="card m-b-30">
                  <img class="card-img-top img-fluid" src="<?=base_url()?>_template/backend/images/small/img-2.jpg" alt="Card image cap">
                  <div class="card-body">
                      <p class="card-text" style="font-weight:bold">Pendanaan PR-05.20-000009. contoh pengadaan komputer</p>
                  </div>
                  <div class="card-body">
                    <span>Dana Terkumpul</span>
                    <div class="">
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: 15%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                        </div>
                    </div>
                  </div>
                  <ul class="list-group list-group-flush">
                      <li class="list-group-item">Dana Dibutuhkan <span class="float-right badge badge-success">Rp.100.000.000</span></li>
                      <li class="list-group-item">Minimum Pendanaan <span class="float-right badge badge-success">Rp.1.000.000</span></li>
                      <li class="list-group-item">Durasi Proyek <span class="float-right badge badge-success">6 bulan</span></li>
                      <li class="list-group-item">Imbal Hasil /tahun <span class="float-right badge badge-success">(18%) 18.000.000</span></li>
                      <li class="list-group-item">Terima Imbal Hasil <span class="float-right badge badge-success">Tiap Bulan</span></li>
                  </ul>
                  <div class="card-body">
                      <a href="#" class="btn btn-sm btn-block btn-success">Detail</a>
                  </div>
              </div>
          </div>

          <div class="col-md-6 col-lg-6 col-xl-4">
              <div class="card m-b-30">
                  <img class="card-img-top img-fluid" src="<?=base_url()?>_template/backend/images/small/img-2.jpg" alt="Card image cap">
                  <div class="card-body">
                      <p class="card-text" style="font-weight:bold">Pendanaan PR-05.20-000009. contoh pengadaan komputer</p>
                  </div>
                  <div class="card-body">
                    <span>Dana Terkumpul</span>
                    <div class="">
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: 10%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                        </div>
                    </div>
                  </div>
                  <ul class="list-group list-group-flush">
                      <li class="list-group-item">Dana Dibutuhkan <span class="float-right badge badge-success">Rp.100.000.000</span></li>
                      <li class="list-group-item">Minimum Pendanaan <span class="float-right badge badge-success">Rp.1.000.000</span></li>
                      <li class="list-group-item">Durasi Proyek <span class="float-right badge badge-success">6 bulan</span></li>
                      <li class="list-group-item">Imbal Hasil /tahun <span class="float-right badge badge-success">(18%) 18.000.000</span></li>
                      <li class="list-group-item">Terima Imbal Hasil <span class="float-right badge badge-success">Tiap Bulan</span></li>
                  </ul>
                  <div class="card-body">
                      <a href="#" class="btn btn-sm btn-block btn-success">Detail</a>
                  </div>
              </div>
          </div>

          <div class="col-md-6 col-lg-6 col-xl-4">
              <div class="card m-b-30">
                  <img class="card-img-top img-fluid" src="<?=base_url()?>_template/backend/images/small/img-2.jpg" alt="Card image cap">
                  <div class="card-body">
                      <p class="card-text" style="font-weight:bold">Pendanaan PR-05.20-000009. contoh pengadaan komputer</p>
                  </div>
                  <div class="card-body">
                    <span>Dana Terkumpul</span>
                    <div class="">
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: 15%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                        </div>
                    </div>
                  </div>
                  <ul class="list-group list-group-flush">
                      <li class="list-group-item">Dana Dibutuhkan <span class="float-right badge badge-success">Rp.100.000.000</span></li>
                      <li class="list-group-item">Minimum Pendanaan <span class="float-right badge badge-success">Rp.1.000.000</span></li>
                      <li class="list-group-item">Durasi Proyek <span class="float-right badge badge-success">6 bulan</span></li>
                      <li class="list-group-item">Imbal Hasil /tahun <span class="float-right badge badge-success">(18%) 18.000.000</span></li>
                      <li class="list-group-item">Terima Imbal Hasil <span class="float-right badge badge-success">Tiap Bulan</span></li>
                  </ul>
                  <div class="card-body">
                      <a href="#" class="btn btn-sm btn-block btn-success">Detail</a>
                  </div>
              </div>
          </div>


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
