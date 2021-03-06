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
                  <td><input type="text" class="form-control" autocomplete="off" placeholder="ID-REG" id="id_reg"></td>
                  <td><input type="text" class="form-control" autocomplete="off" placeholder="NIK" id="nik"></td>
                  <td><input type="text" class="form-control" autocomplete="off" placeholder="Nama" id="nama"></td>
                  <td><input type="text" class="form-control" autocomplete="off" placeholder="Email" id="email"></td>
                  <td><input type="text" class="form-control" autocomplete="off" placeholder="Telepon" id="nama_perusahaan"></td>
                  <td>
                    <button class="btn btn-primary" id="btn-search" type="button"><i class="fa fa-search"></i></button>
                    <button type="button" id="reload"  name="button" class="btn btn-warning"><i class="fa fa-refresh"></i></button>
                  </td>
                </tr>
              </table>
              <!-- <h4 class="mt-0 header-title"><?=ucfirst($title)?></h4> -->
              <table class="table table-bordered" id="table" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                  <tr>
                    <th>ID-REG</th>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Perusahaan</th>
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
      oLanguage: {
          sProcessing: '<i class="fa fa-spinner fa-spin fa-fw"></i> Loading...'
      },

      // Load data for the table's content from an Ajax source
      "ajax": {
          "url": "<?php echo site_url("backend/master_penerima_dana/json")?>",
          "type": "POST",
          "data": function(data){
            data.id_reg = $("#id_reg").val();
            data.nik = $("#nik").val();
            data.nama = $("#nama").val();
            data.email = $("#email").val();
            data.telepon = $("#nama_perusahaan").val();
          }
      },

      //Set column definition initialisation properties.
        "columnDefs": [
        {
            "targets": 0, //first column / numbering column
            "orderable": false
        },
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
      $("#id_reg").val("");
      $("#nik").val("");
      $("#nama").val("");
      $("#email").val("");
      $("#nama_perusahaan").val("");
      table.ajax.reload();  //just reload table
  });

});
</script>
