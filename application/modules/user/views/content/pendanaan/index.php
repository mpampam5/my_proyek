<!-- DataTables -->
<link href="<?=base_url()?>_template/backend/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<!-- Required datatable js -->
<script src="<?=base_url()?>_template/backend/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=base_url()?>_template/backend/plugins/datatables/dataTables.bootstrap4.min.js"></script>


<div class="page-content-wrapper">
  <div class="container-fluid">
    <div class="col-md-12 mx-auto mb-5">
      <div class="card">
        <div class="card-body">
          <table class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="table">
            <thead>
              <tr>
                <th>Tgl Pendanaan</th>
                <th>Jumlah Dana</th>
                <th>Pendanaan</th>
                <th>Status</th>
                <th>#</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
  </div>
</div> <!-- Page content Wrapper -->


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
      // "bLengthChange": false,
      // "pageLength": 25,
      oLanguage: {
          sProcessing: '<i class="fa fa-spinner fa-spin fa-fw"></i> Loading...'
      },

      // Load data for the table's content from an Ajax source
      "ajax": {
          "url": "<?php echo site_url("user/pendanaan/json")?>",
          "type": "POST",
          "data": function(data){
            data.status = $("#status_view option:selected").val();
            data.code = $("#code").val();
          }
      },

      //Set column definition initialisation properties.
        "columnDefs": [
        {
            "className": "text-center",
            "orderable": false,
            "targets": 3
        },
        {
            "className": "text-center",
            "orderable": false,
            "targets": 4
        }
      ],
    });

  $("#btn-search").click(function(){
    table.ajax.reload();  //just reload table
  });

  $("#reload").click(function(){
      $("#status_view").removeAttr('selected').val("").attr('selected', 'selected');
      $("#id_reg").val("");
      $("#code").val("");
      table.ajax.reload();  //just reload table
  });

});
</script>
