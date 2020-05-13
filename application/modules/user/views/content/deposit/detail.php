<style media="screen">
  table tr th,td{
    padding:5px!important;
  }

  table tr th{
    color:#464646;
  }

  table tr td{
    color:#949494;
  }
</style>

<div class="page-content-wrapper">
  <div class="container-fluid">
    <div class="col-md-10 mx-auto mb-5">
      <div class="card">
        <div class="card-body">
          <table class="table table-borderless">
            <tr>
              <th>Waktu Request</th>
              <td>: <?=date("d-m-Y H:i",strtotime($dt->created_at))?></td>
            </tr>

            <tr>
              <th>Status</th>
              <td>:
                <?php if ($dt->status=="process"){ ?>
                  <span class="text-warning">PROSESS</span>
                <?php }elseif ($dt->status=="approved") { ?>
                  <span class="text-success">APPROVED</span>
                <?php } elseif ($dt->status=="cancel") { ?>
                  <span class="text-danger">CANCEL</span>
                <?php  } ?>
              </td>
            </tr>

            <tr>
              <th>Kode Transaksi</th>
              <td>: <?=$dt->code?></td>
            </tr>

            <tr>
              <th>Kode Unik</th>
              <td>: <?=$dt->kode_unik?></td>
            </tr>

            <tr>
              <th>Nominal Request</th>
              <td>: Rp.<?=format_rupiah($dt->nominal)?></td>
            </tr>


            <tr>
              <th colspan="2"><h5 class="text-info" style="font-size:16px">Transfer Ke Rekening</h5> </th>
            </tr>

            <tr>
              <th>Nama Rekening</th>
              <td>: <?=where_bank($dt->id_rekening,"nama_rekening")?></td>
            </tr>

            <tr>
              <th>No Rekening</th>
              <td>: <?=where_bank($dt->id_rekening,"no_rekening")?></td>
            </tr>

            <tr>
              <th>Bank</th>
              <td>: <?=where_bank($dt->id_rekening,"nama_bank")?></td>
            </tr>


            <tr>
              <th>Nominal Transfer</th>
              <td>: Rp.<?=format_rupiah($dt->nominal+$dt->kode_unik)?></td>
            </tr>


          </table>


          <?php if ($dt->status=="process"): ?>
            <div class="alert alert-info">
              <strong><i class="fa fa-info"></i> INFO.</strong>
              Setelah melakukan transfer, silahkan konfirmasi ke admin untuk mempercepat proses verifikasi.
            </div>
          <?php endif; ?>


        </div>
      </div>
    </div>
  </div>
</div> <!-- Page content Wrapper -->
