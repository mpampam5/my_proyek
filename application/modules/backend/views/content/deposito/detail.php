<div class="wrapper">
    <div class="container-fluid">
      <div class="row">


        <div class="col-md-9 mx-auto">
          <div class="row">
            <div class="col-md-12 col-xl-4 animated fadeInRight delay-3s">
              <div class="card m-b-10 text-center">
                <div class="mb-2 card-body text-muted">
                    <h5 class="text-success"><?=date("d/m/Y H:i",strtotime($dt->created_at))?></h5>
                    DATE REQUEST
                </div>
              </div>
            </div>

            <div class="col-md-12 col-xl-4 animated fadeInRight delay-5s">
              <div class="card m-b-10 text-center">
                <div class="mb-2 card-body text-muted">
                    <h5 class="text-primary">Rp. <?=format_rupiah($dt->nominal)?></h5>
                    AMOUNT REQUEST
                </div>
              </div>
            </div>

            <div class="col-md-12 col-xl-4 animated fadeInRight delay-4s">
              <div class="card m-b-10 text-center">
                <div class="mb-2 card-body text-muted">
                  <?php if ($dt->status=="process"){ ?>
                    <h5 class="text-warning">Waithing</h5>
                  <?php }elseif ($dt->status=="approved") { ?>
                    <h5 class="text-success">Approved</h5>
                  <?php } elseif ($dt->status=="cancel") { ?>
                    <h5 class="text-danger">Cancel</h5>
                  <?php  } ?>
                    STATUS
                </div>
              </div>
            </div>


            <style media="screen">
            .tabless tr th{
              color:#222222;
              padding: 3px 3px 3px 3px;
              font-size: 14px;
              width: 150px;
            }
              .tabless tr td{
                color:#8a8a8a;
                padding: 3px 3px 3px 3px!important;
                font-size: 14px;
              }
            </style>
            <!-- DATA PERSON -->
            <div class="col-md-12 col-xl-12 animated fadeInRight delay-6s">
              <div class="card m-b-10">
                <div class="mb-2 card-body text-muted">
                  <div class="row">
                    <div class="col-lg-6">
                      <table class="table tabless table-borderless">
                        <tr>
                          <th>ID-REG</th>
                          <td>: <a href=""><?=$dt->id_reg?></a></td>
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

                    <div class="col-lg-6">
                      <table class="table tabless table-borderless">
                        <tr>
                          <th>CODE-TRANSAKSI</th>
                          <td>: <?=$dt->code?></td>
                        </tr>

                        <tr>
                          <th>AMOUNT ACC</th>
                          <td>: <?=$dt->nominal_acc == "" ? "<i>Null</i>":"Rp. ".format_rupiah($dt->nominal_acc)?></td>
                        </tr>

                        <tr>
                          <th>DATE ACC</th>
                          <td>: <?=$dt->acc_at=="" ? "<i>Null</i>" : date("d/m/Y H:i",strtotime($dt->acc_at))?></td>
                        </tr>



                      </table>

                    </div>

                    <div class="col-lg-12">
                      <h5 style="font-size:15px;color:#222222">Keterangan :</h5>
                      <p><?=$dt->keterangan=="" ?"<i>Null</i>": $dt->keterangan?></p>
                    </div>

                  </div>
                </div>
              </div>
            </div>



            <!-- //button -->
            <div class="col-md-12 col-xl-6 mx-auto animated fadeInRight delay-6s">
              <div class="card m-b-10">
                <div class="mb-2 card-body text-muted">
                    <?php if ($dt->status=="process"){ ?>
                      <form class="" action="index.html" method="post">
                        <div class="form-group">
                          <label for="">AMOUNT ACC</label>
                          <input type="text" class="form-control" id="" placeholder="">
                        </div>

                        <div class="form-group">
                          <label for="">STATUS</label>
                          <select class="form-control" name="">
                            <option value="">-- Pilih --</option>
                            <option value="">Approved</option>
                            <option value="">Cancel</option>
                          </select>
                        </div>


                        <div class="form-group">
                          <label for="">PASSWORD ACCOUNT</label>
                          <input type="text" class="form-control" id="" placeholder="">
                        </div>

                      </form>
                    <?php } ?>

                </div>
              </div>
            </div>
            <!-- //end button -->

          </div>
        </div>

      </div>

    </div>
</div>
