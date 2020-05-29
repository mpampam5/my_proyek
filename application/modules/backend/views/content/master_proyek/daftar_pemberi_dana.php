<!-- DataTables -->
<link href="<?=base_url()?>_template/backend/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<!-- Required datatable js -->
<script src="<?=base_url()?>_template/backend/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=base_url()?>_template/backend/plugins/datatables/dataTables.bootstrap4.min.js"></script>

<?php
  $total_dana = $dt->harga_paket * $dt->jumlah_paket; //dana di butuhkan
  $dana_terkumpul = $this->proyek->total_dana_terkumpul($dt->id_proyek);
  $persen = cari_persen($total_dana,$dana_terkumpul);
 ?>

<div class="wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 col-xl-10 mx-auto animated zoomIn delay-3s">
          <div class="card m-b-10">
            <div class="mb-2 card-body text-muted">
              <h4 class="header-title">Pendanaan <b class="text-info"> <?=$dt->kode?></b>. <?=$dt->title?></h4>
              <div class="row mt-4">
                <div class="col-lg-12 text-center">
                  <div class="row">
                    <div class="col-sm-3">
                      <div class="card m-b-30 card-primary">
                              <div class="card-body text-center text-white">
                                <h6>Rp.<?=format_rupiah($dt->harga_paket)?></h6>
                                HARGA PER PAKET
                              </div>
                          </div>
                    </div>

                    <div class="col-sm-3">
                      <div class="card m-b-30 card-primary">
                              <div class="card-body text-center text-white">
                                <h6>Rp.<?=format_rupiah($total_dana)?></h6>
                                TOTAL DANA DIBUTUHKAN
                              </div>
                          </div>
                    </div>

                    <div class="col-sm-3">
                      <div class="card m-b-30 card-primary">
                              <div class="card-body text-center text-white">
                                <h6><?=$this->proyek->total_paket($dt->id_proyek)?></h6>
                                TOTAL PAKET
                              </div>
                          </div>
                    </div>

                    <div class="col-sm-3">
                      <div class="card m-b-30 card-primary">
                              <div class="card-body text-center text-white">
                                <h6>Rp. <?=format_rupiah($dana_terkumpul)?> (<?=$persen?>%)</h6>
                                TOTAL DANA TERKUMPUL
                              </div>
                          </div>
                    </div>
                  </div>
                </div>
              </div>


              <table id="table" class="table table-bordered" style="width:100%">
                <thead style="background:#dadada;">
                  <tr>
                    <th>Waktu Pendanaan</th>
                    <th>Penggalangan</th>
                    <th>Data Pendana</th>
                    <th>Jumlah Paket</th>
                    <th>Setara Dengan (Rp)</th>
                    <th>#</th>
                  </tr>
                </thead>
              </table>

            </div>
          </div>
        </div>
      </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function(){
var table;
//datatables
  table = $('#table').DataTable({

      "processing": true, //Feature control the processing indicator.
      "serverSide": true, //Feature control DataTables' server-side processing mode.
      "order": [], //Initial no order.
      // "ordering": false,
      "searching": false,
      // "info": false,
      "bLengthChange": false,
      oLanguage: {
          sProcessing: '<i class="fa fa-spinner fa-spin fa-fw"></i> Loading...'
      },

      // Load data for the table's content from an Ajax source
      "ajax": {
          "url": "<?php echo site_url("backend/master_proyek/json_pemberi_dana/".enc_url($dt->id_proyek))?>",
          "type": "POST"
      },

      //Set column definition initialisation properties.
        "columnDefs": [
          {
              "className": "text-center",
              "orderable": false,
              "targets": 1
          },
          {
              "orderable": false,
              "targets": 2
          },
          {
              "className": "text-center",
              "orderable": false,
              "targets": 3
          },
          {
              "className": "text-center",
              "orderable": false,
              "targets": 4
          },
          {
              "className": "text-center",
              "orderable": false,
              "targets": 5
          }
      ],
    });

});
</script>
