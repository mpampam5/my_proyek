
        <div class="wrapper">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-lg-3">
                      <div class="row">
                        <div class="col-md-6 col-xl-12">
                            <div class="card m-b-30">
                                <div class="mb-2 card-body text-muted">
                                    <h3 class="text-info mb-4">Hi, <?=profile("nama")?></h3>
                                    <table class="table table-bordered">
                                      <tr>
                                        <td colspan="2" class="text-center text-bold">USER LOG</td>
                                      </tr>
                                      <tr>
                                        <td>Email</td>
                                        <td><?=profile("email")?></td>
                                      </tr>
                                      <tr>
                                        <td>IP Address</td>
                                        <td><?=$this->input->ip_address()?></td>
                                      </tr>
                                      <tr>
                                        <td>Waktu Server</td>
                                        <td><?=date("d/m/Y H:i")?></td>
                                      </tr>
                                      <tr>
                                        <td colspan="2" class="text-center text-bold">
                                          <a id="reset-pwd" href="<?=site_url("backend/core/reset_password")?>" class="btn btn-primary btn-sm"><i class="fa fa-key"></i> Reset Password</a>
                                        </td>
                                      </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                      </div>
                    </div>

                    <div class="col-lg-9">
                      <div class="row">
                        <div class="col-md-6 col-xl-4">
                            <div class="card text-center m-b-30">
                                <div class="mb-2 card-body text-muted">
                                    <h3 class="text-primary"><?=$total_pendana?></h3>
                                    Total Pendana
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-xl-4">
                            <div class="card text-center m-b-30">
                                <div class="mb-2 card-body text-muted">
                                    <h3 class="text-primary"><?=$total_penerima_dana?></h3>
                                    Total Penerima dana
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-xl-4">
                            <div class="card text-center m-b-30">
                                <div class="mb-2 card-body text-muted">
                                    <h3 class="text-primary"><?=$total_proyek?></h3>
                                    Total Proyek
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-xl-4">
                            <div class="card text-center m-b-30">
                                <div class="mb-2 card-body text-muted">
                                    <h5 class="text-primary">Rp.<?=format_rupiah($total_pendaan_aktif)?></h5>
                                    Total Pendanaan Aktif
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-xl-4">
                            <div class="card text-center m-b-30">
                                <div class="mb-2 card-body text-muted">
                                    <h5 class="text-primary">Rp.<?=format_rupiah($total_pendaan_dikembalikan)?></h5>
                                    Total Pendanaan Di Kembalikan
                                </div>
                            </div>
                        </div>


                        <div class="col-md-6 col-xl-4">
                            <div class="card text-center m-b-30">
                                <div class="mb-2 card-body text-muted">
                                    <h5 class="text-primary">Rp.<?=format_rupiah($total_pendaan)?></h5>
                                    Total Semua Pendanaan
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-xl-4">
                            <div class="card text-center m-b-30">
                                <div class="mb-2 card-body text-muted">
                                    <h5 class="text-primary">Rp.<?=format_rupiah($total_deposit_pendana)?></h5>
                                    Total Deposit Pendana
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-xl-4">
                            <div class="card text-center m-b-30">
                                <div class="mb-2 card-body text-muted">
                                    <h5 class="text-primary">Rp.<?=format_rupiah($total_withdraw_pendana)?></h5>
                                    Total Withdraw Pendana
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-xl-4">
                            <div class="card text-center m-b-30">
                                <div class="mb-2 card-body text-muted">
                                  <?php if (config_system('maintenance',"status") == "0"): ?>
                                    <h5 class="text-success">AKTIF</h5>
                                    <?php else: ?>
                                    <h5 class="text-danger">MAINTENANCE</h5>
                                  <?php endif; ?>
                                    Status System
                                </div>
                            </div>
                        </div>

                      </div>
                    </div>


                </div>
                <!-- end row -->



                <div class="row">
                    <div class="col-xl-8">
                        <div class="card m-b-30">
                            <div class="card-body">
                                <h4 class="mt-0 m-b-15 header-title">Aktivitas Pendanaan</h4>
                                <a href="<?=site_url("backend/aktivitas_pendanaan")?>" class="float-right btn btn-sm btn-primary">Lihat semua aktivitas pendanaan</a>
                                <ol class="activity-feed mb-0 mt-4">
                                  <?php foreach ($aktivitas_pendanaan->result() as $row): ?>
                                    <li class="feed-item">
                                        <span class="date"><?=date('d/m/Y H:i',strtotime($row->created_at))?></span>
                                        <span class="activity-text"><?=$row->keterangan?></span>
                                    </li>
                                  <?php endforeach; ?>
                                </ol>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4">
                      <h4 class="header-title">Info</h4>
                      <div class="row">
                        <div class="col-sm-12 alert alert-info" role="alert">
                          <strong>Pengembalian Modal Pendana</strong>
                          <p>Pengembalian modal pendana di lakukan secara manual & otomatis pada system. Pengembalian dana dengan manual dapat di lakukan sebelum pembagian dividen berlangsung. </p>
                        </div>

                        <div class="col-sm-12 alert alert-info" role="alert">
                          <strong>System maintenance</strong>
                          <p>Pada saat system maintenance, halaman user tidak dapat di akses, tetapi halaman public tetap bisa di akses. maintenance otomatis di lakukan system pada jam 23:57 dan kembali di matikan pada jam 02:00 dini hari (berlaku tiap hari). maintenance juga dapat di lakukan dengan manual pada menu <b>Pengaturan >> Pengaturan Umum</b></p>
                        </div>
                      </div>
                    </div>
                </div>
                <!-- end row -->




<script type="text/javascript">
$(document).on("click","#reset-pwd",function(e){
  e.preventDefault();
  $('.modal-dialog').removeClass('modal-lg')
                    .removeClass('modal-sm')
                    .addClass('modal-md');
  $("#modalTitle").text('Reset Password');
  $('#modalContent').load($(this).attr("href"));
  $("#modalGue").modal('show');
});
</script>
