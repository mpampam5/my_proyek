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
              <table class="table table-borderless" >
                <tr>
                  <td>
                    <select class="form-control" id="status_view" name="status">
                      <option value="">All</option>
                      <option value="process">Waithing</option>
                      <option value="approved">Approved</option>
                      <option value="cancel">Cancel</option>
                    </select>
                  </td>
                  <td><input type="text" class="form-control" autocomplete="off" placeholder="CODE-TRANSAKSI" id="code"></td>
                  <td><input type="text" class="form-control" autocomplete="off" placeholder="ID-REG" id="id_reg"></td>
                  <td><input type="text" class="form-control" autocomplete="off" placeholder="Nama" id="nama"></td>
                  <td>
                    <button class="btn btn-primary" id="btn-search" type="button"><i class="fa fa-search"></i></button>
                    <button type="button" id="reload"  name="button" class="btn btn-warning"><i class="fa fa-refresh"></i></button>
                    <button type="button" class="btn btn-success">Export Excell</button>
                  </td>
                </tr>
              </table>


              <!-- <h4 class="mt-0 header-title"><?=ucfirst($title)?></h4> -->
              <table class="table table-bordered" id="table" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead style="background:#dadada">
                  <tr>
                    <th>DATE REQUEST</th>
                    <th>CODE-TRANSAKSI</th>
                    <th>PENDANA</th>
                    <th>STATUS</th>
                    <th>AMOUNT REQUEST</th>
                    <th>###</th>
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
          "url": "<?php echo site_url("backend/withdraw/json")?>",
          "type": "POST",
          "data": function(data){
            data.status = $("#status_view option:selected").val();
            data.code = $("#code").val();
            data.id_reg = $("#id_reg").val();
            data.nama = $("#nama").val();
          }
      },

      //Set column definition initialisation properties.
        "columnDefs": [
        {
            "className": "text-center",
            "orderable": false,
            "targets": 5
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
      $("#nama").val("");
      $("#email").val("");
      $("#telepon").val("");
      table.ajax.reload();  //just reload table
  });

});
</script>
