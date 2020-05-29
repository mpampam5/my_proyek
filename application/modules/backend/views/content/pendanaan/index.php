<!-- DataTables -->
<link href="<?=base_url()?>_template/backend/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<!-- Required datatable js -->
<script src="<?=base_url()?>_template/backend/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=base_url()?>_template/backend/plugins/datatables/dataTables.bootstrap4.min.js"></script>

<div class="wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 col-xl-12 mx-auto animated zoomIn delay-2s">

          <div class="card m-b-30">
            <div class="card-body">
              <div class="col-lg-12 mx-auto">
                <div class="row">

                  <div class="col-sm-3 pr-0 pl-1 form-group">
                    <select class="form-control form-control-sm" id="status_penggalangan" name="status_penggalangan">
                      <option value="">-- Status Penggalangan --</option>
                      <option value="approved">Approved</option>
                      <option value="dikembalikan">Di Kembalikan</option>
                    </select>
                  </div>

                  <div class="col-sm-2 pr-0 pl-1 form-group">
                    <input type="text" class="form-control form-control-sm" autocomplete="off" placeholder="ID-REG Pendana" id="id_reg">
                  </div>

                  <div class="col-sm-2 pr-0 pl-1 form-group">
                    <input type="text" class="form-control form-control-sm" autocomplete="off" placeholder="Nama Pendana" id="nama">
                  </div>

                  <div class="col-sm-2 pr-0 pl-1 form-group">
                    <input type="text" class="form-control form-control-sm" autocomplete="off" placeholder="Kode Pendanaan" id="code">
                  </div>

                  <div class="col-sm-3 pr-0 pl-1 form-group">
                    <input type="text" class="form-control form-control-sm" autocomplete="off" placeholder="Title Pendanaan" id="title">
                  </div>

                  <div class="col-sm-12">
                    <button class="btn btn-primary btn-sm" id="btn-search" type="button"><i class="fa fa-search"></i> Filter Search</button>
                    <button type="button" id="reload"  name="button" class="btn btn-warning btn-sm"><i class="fa fa-refresh"></i> Reload</button>
                    <button type="button" class="btn btn-success btn-sm"><i class="fa fa-file-excel-o"></i> Export Excell</button>
                  </div>
                </div>
              </div>
              <hr>
              <!-- <h4 class="mt-0 header-title"><?=ucfirst($title)?></h4> -->
              <table class="table table-bordered" id="table" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                  <tr>
                    <th>Waktu Pendanaan</th>
                    <th>Data Pendana</th>
                    <th>Jumlah Pendanaan</th>
                    <th>Data Pendanaan</th>
                    <th>Status Pendanaan</th>
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
          "url": "<?php echo site_url("backend/pendanaan/json")?>",
          "type": "POST",
          "data": function(data){
            data.status = $("#status_penggalangan option:selected").val();
            data.code = $("#code").val();
            data.title = $("#title").val();
            data.id_reg = $("#id_reg").val();
            data.nama = $("#nama").val();
          }
      },

      //Set column definition initialisation properties.
        "columnDefs": [
          {
              "className": "text-center",
              "targets": 2
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
      $("#status_penggalangan").removeAttr('selected').val("").attr('selected', 'selected');
      $("#code").val("");
      $("#title").val("");
      $("#nama").val("");
      $("#id_reg").val("");
      table.ajax.reload();  //just reload table
  });

});
</script>