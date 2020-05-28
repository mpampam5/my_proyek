<style media="screen">
  .tables tr th,td{
    padding:5px!important;
  }

  .tables tr th{
    color:#464646;
  }

  .tables tr td{
    color:#949494;
  }
</style>
<div class="page-content-wrapper">
  <div class="container-fluid">
    <div class="col-md-12 mx-auto mb-2">
      <div class="card">
        <div class="card-body">
          <table class="table tables table-borderless">
            <tr>
              <th>Waktu Pendanaan</th>
              <td>: <?=date("d/m/Y H:i",strtotime($dt->created_at))?></td>
            </tr>

              <tr>
                <th>Kode Proyek</th>
                <td>: <?=$dt->kode?></td>
              </tr>

              <tr>
                <th>Pendanaan</th>
                <td>: <?=ucfirst($dt->title)?></td>
              </tr>

              <tr>
                <th>Durasi / Tenor</th>
                <td>: <?=$dt->durasi_proyek?> Bulan</td>
              </tr>

              <tr>
                <th>Dana Yang di Butuhkan</th>
                <td>: Rp.<?=format_rupiah($dt->dana_dibutuhkan)?></td>
              </tr>

              <tr>
                <th>Tanggal Pendanaan</th>
                <td>: <?=date("d/m/Y",strtotime($dt->date_join))?> (Hari ke <?=selisih_hari($dt->akhir_penggalangan, $dt->date_join)?>)</td>
              </tr>

              <tr>
                <th>Total Pendanaan Anda</th>
                <td>: Rp.<?=format_rupiah($dt->total_rupiah)?> (<?=cari_persen($dt->dana_dibutuhkan,$dt->total_rupiah)?> % dari dana yang di butuhkan)</td>
              </tr>

              <tr>
                <th>Tanggal Mulai Proyek</th>
                <td>: <?=date("d/m/Y",strtotime($dt->tgl_mulai_proyek))?></td>
              </tr>

              <tr>
                <th>Tanggal Selesai Proyek</th>
                <td>: <?=date("d/m/Y",strtotime($dt->tgl_selesai_proyek))?></td>
              </tr>

              <tr>
                <td colspan="2">
                  &nbsp;
                </td>
              </tr>


              <tr>
                <td colspan="2">
                  <div class="alert alert-primary" role="alert">
                    <strong><i class="fa fa-info-circle"></i> INFORMASI</strong>
                    <ul>
                      <li>Imbal hasil pertama dibagikan 1 bulan setelah proyek dimulai yaitu tanggal <?=date('d/m/Y', strtotime("+1 month", strtotime(date("$dt->tgl_mulai_proyek"))));?>.</li>
                      <li>Dana Akan di kembalikan pada masing-masing pendana jika dana terkumpul di bawah <?=master_config('FINANCIAL-PD')?>%.</li>
                      <li>Info lebih lanjut silahkan hubungi admin.</li>
                    </ul>
                  </div>
                </td>
              </tr>


              <tr>
                <td colspan="2">
                  &nbsp;
                </td>
              </tr>


              <tr>
                <th>Status Pendanaan</th>
                <td>:
                    <?php if ($dt->status=="approved"): ?>
                      <span class="badge badge-success">Approved</span>
                      <?php else: ?>
                        <span class="badge badge-danger">Dana Di Kembalikan</span>
                    <?php endif; ?>
                </td>
              </tr>

              <tr>
                <th>Keterangan Pengembalian Dana</th>
                <td>:
                  <?php if ($dt->status=="dikembalikan"): ?>
                    <?=$dt->keterangan?>
                  <?php endif; ?>
                </td>
              </tr>

              <tr>
                <td colspan="2">
                  &nbsp;
                </td>
              </tr>

              <tr>
                <td colspan="2">
                  <a href="<?=site_url("user/master_proyek/detail/$dt->id_proyek/$dt->kode")?>" class="btn btn-info btn-sm">Lihat Detail Proyek</a>
                </td>
              </tr>
          </table>
        </div>
      </div>
    </div>

    <?php $profit = $this->db->select("trans_profit.id_trans_profit,
                                      trans_profit.id_proyek,
                                      trans_profit.id_pendana,
                                      trans_profit.id_trans_pendanaan_proyek,
                                      trans_profit.waktu_pembagian,
                                      trans_profit.nominal_rupiah,
                                      trans_profit.penggalangan,
                                      trans_profit.sisa_imbal_hasil,
                                      trans_profit.pendanaan,
                                      trans_profit.total,
                                      trans_profit.status AS status_profit,
                                      trans_penggalangan_dana.status")
                              ->from("trans_profit")
                              ->join("trans_penggalangan_dana","trans_penggalangan_dana.id_penggalangan_dana_proyek = trans_profit.id_trans_pendanaan_proyek")
                              ->where("trans_profit.id_proyek",$dt->id_proyek)
                              ->where("trans_profit.id_pendana",sess("id_user"))
                              ->where("trans_profit.id_trans_pendanaan_proyek",$dt->id_penggalangan_dana_proyek)
                              ->where("trans_penggalangan_dana.status","approved")
                              ->get();

     ?>

    <?php if ($profit->num_rows() > 0): ?>
    <div class="col-md-12 mx-auto mb-5">
      <div class="card">
        <div class="card-body">
          <h4 class="header-title">Dividen</h4>
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead>
                <th>Waktu Pembagian</th>
                <th>Profit Ke</th>
                <th>Modal Pendanaan</th>
                <th>Dividen Bulanan</th>
                <th>Bonus Penggalangan</th>
                <th>Sisa Imbal Hasil</th>
                <th>Status</th>
                <th>Total</th>
              </thead>

              <tbody>
                  <?php $no = 1; ?>
                  <?php foreach ($profit->result() as $pr): ?>
                    <tr>
                      <td><?=date("d/m/Y",strtotime($pr->waktu_pembagian))?></td>
                      <td class="text-center">Profit ke-<?=$no++?></td>
                      <td>Rp.<?=format_rupiah($pr->pendanaan)?></td>
                      <td>Rp.<?=format_rupiah($pr->nominal_rupiah)?></td>
                      <td>Rp.<?=format_rupiah($pr->penggalangan)?></td>
                      <td>Rp.<?=format_rupiah($pr->sisa_imbal_hasil)?></td>
                      <td class="text-center">
                        <?php if ($pr->status_profit == 1): ?>
                          <span class="badge badge-success"> Telah Di Bagikan</span>
                          <?php else: ?>
                            <span class="badge badge-danger"> Belum Di Bagikan</span>
                        <?php endif; ?>
                      </td>
                      <td>Rp.<?=format_rupiah($pr->total)?></td>
                    </tr>

                    <?php $total[] = $pr->total; ?>
                  <?php endforeach; ?>
                  <tr>
                    <td colspan="7" class="text-right"><b>Total Dividen :</b></td>
                    <td><b>Rp.<?=format_rupiah(array_sum($total))?></b></td>
                  </tr>
              </tbody>


            </table>
          </div>

        </div>
      </div>
    </div>
  <?php endif; ?>


  </div>
</div> <!-- Page content Wrapper -->
