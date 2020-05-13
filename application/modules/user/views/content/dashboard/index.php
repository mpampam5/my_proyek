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
                          <button type="button" class="btn btn-outline-primary ml-1 waves-effect waves-light">Mulai Penggalangan Dana</button>
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



  </div>
</div> <!-- Page content Wrapper -->

<script type="text/javascript">
  $(document).ready(function(){
    setTimeout(function() {
      $('#alert-data-success').fadeOut('slow');
    }, 8000); // <-- time in milliseconds
  });
</script>
