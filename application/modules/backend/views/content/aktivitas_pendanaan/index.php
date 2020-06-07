<!-- DataTables -->
<link href="<?=base_url()?>_template/backend/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<!-- Required datatable js -->
<script src="<?=base_url()?>_template/backend/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=base_url()?>_template/backend/plugins/datatables/dataTables.bootstrap4.min.js"></script>

<div class="wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 col-xl-12 mx-auto animated fadeInRight delay-2s">

          <div class="card m-b-30">
            <div class="card-body">
              <!-- <h4 class="mt-0 header-title"><?=ucfirst($title)?></h4> -->
              <table class="table table-bordered" id="table" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead style="background:#dadada">
                  <tr>
                    <th width="100">Waktu</th>
                    <th>Keterangan</th>
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
      "pageLength": 25,
      oLanguage: {
          sProcessing: '<i class="fa fa-spinner fa-spin fa-fw"></i> Loading...'
      },

      // Load data for the table's content from an Ajax source
      "ajax": {
          "url": "<?php echo site_url("backend/aktivitas_pendanaan/json")?>",
          "type": "POST"
      },

      //Set column definition initialisation properties.
        "columnDefs": [
        {
            "orderable": false,
            "targets": 1
        }
      ],
    });




});
</script>
