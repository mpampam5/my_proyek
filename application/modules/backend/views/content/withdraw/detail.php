<div class="wrapper">
    <div class="container-fluid">
      <div class="row">


        <div class="col-md-11 mx-auto">
          <div class="row">
            <div class="col-lg-3">
              <div class="row">
                <div class="col-md-12 col-xl-12 animated fadeInRight delay-3s">
                  <div class="card m-b-10">
                    <div class="mb-2 card-body text-muted">
                        <a href="<?=site_url("backend/withdraw")?>" class="btn btn-md btn-secondary btn-block"><i class="fa fa-file"></i> Daftar withdraw</a>
                        <hr>
                        <?php if ($dt->status=="process"){ ?>
                          <form class="m-t-10" action="<?=site_url("backend/withdraw/action")?>" id="form">

                            <input type="hidden" name="id_act" id="id_act" value="<?=enc_url($dt->id_withdraw)?>">


                            <div class="form-group">
                              <label for="">Amount Acc</label>
                              <input type="text" class="form-control" readonly value="<?=format_rupiah($dt->nominal)?>">
                            </div>

                            <div class="form-group">
                              <label for="">Status</label>
                              <select class="form-control" name="status_approved" id="status_approved">
                                <option value="">-- Pilih --</option>
                                <option value="approved">Approved</option>
                                <option value="cancel">Cancel</option>
                              </select>
                            </div>

                            <div class="form-group">
                              <label for="">Keterangan</label>
                              <textarea class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan Approved/Cancel" rows="2" cols="80"></textarea>
                            </div>

                            <div class="form-group">
                              <label for="">Password Akun</label>
                              <input type="password" class="form-control" id="password_admin" name="password_admin" placeholder="*****">
                            </div>

                            <button type="submit" class="btn btn-md btn-block btn-success" id="submit" name="button">Proses</button>

                          </form>
                        <?php }else { ?>
                          <h6>Execution :</h6>
                          <ul style="list-style:none;padding-left:0!important">
                            <li>
                              <i class="fa fa-user"></i> <?=$dt->acc_by?>
                              <?=$dt->acc_by == "admin" ? "[".profile_where_id($dt->acc_by_id,"nama")."]":""?>
                            </li>
                            <li><i class="fa fa-calendar"></i> <?=date("d/m/Y H:i",strtotime($dt->acc_at))?></li>
                          </ul>
                        <?php } ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-9">
              <div class="row">
                <div class="col-md-12 col-xl-4 animated fadeInRight delay-3s">
                  <div class="card m-b-10 text-center">
                    <div class="mb-2 card-body text-muted">
                        WAKTU REQUEST
                        <h6 class="text-success"><?=date("d/m/Y H:i",strtotime($dt->created_at))?></h6>
                    </div>
                  </div>
                </div>

                <div class="col-md-12 col-xl-4 animated fadeInRight delay-5s">
                  <div class="card m-b-10 text-center">
                    <div class="mb-2 card-body text-muted">
                        AMOUNT REQUEST
                        <h6 class="text-primary">Rp. <?=format_rupiah($dt->nominal)?></h6>
                    </div>
                  </div>
                </div>

                <div class="col-md-12 col-xl-4 animated fadeInRight delay-4s">
                  <div class="card m-b-10 text-center">
                    <div class="mb-2 card-body text-muted">
                      STATUS
                      <?php if ($dt->status=="process"){ ?>
                        <h6 class="text-warning">WAITHING</h6>
                      <?php }elseif ($dt->status=="approved") { ?>
                        <h6 class="text-success">APPROVED</h6>
                      <?php } elseif ($dt->status=="cancel") { ?>
                        <h6 class="text-danger">CANCEL</h6>
                      <?php  } ?>
                    </div>
                  </div>
                </div>



                <!-- content -->

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
                <div class="col-md-12 col-xl-12 animated fadeInRight delay-6s">
                  <div class="card m-b-10">
                    <div class="mb-2 card-body text-muted">
                      <div class="row">
                        <div class="col-lg-6">
                          <table class="table tabless table-borderless">
                            <tr>
                              <th>ID-REG</th>
                              <td>: <a href="<?=site_url("backend/pendana/detail/".enc_url($dt->id_pendana))?>" target="_blank"><i class="fa fa-link"></i> <?=$dt->id_reg?></a></td>
                            </tr>

                            <tr>
                              <th>NAMA</th>
                              <td>: <?=$dt->nama?></td>
                            </tr>

                            <tr>
                              <th>EMAIL</th>
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
                              <th>AMOUNT REQUEST</th>
                              <td>: <?="Rp. ".format_rupiah($dt->nominal)?></td>
                            </tr>


                          </table>

                        </div>


                        <?php if ($dt->status!="process"): ?>
                        <div class="col-lg-12">
                          <hr>
                          <h5 style="font-size:15px;color:#222222">KETERANGAN :</h5>
                          <p><?=$dt->keterangan=="" ?"<i>Null</i>": $dt->keterangan?></p>
                        </div>
                        <?php endif; ?>
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
