
<div class="wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 col-xl-11 mx-auto animated zoomIn delay-2s">
          <div class="card m-b-30">
            <div class="card-body">
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
                      <?php foreach ($prs->result() as $pr): ?>
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
      </div>
    </div>
</div>
