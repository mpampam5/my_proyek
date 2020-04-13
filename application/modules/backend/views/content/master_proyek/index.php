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
              <div class="col-lg-12 mx-auto">
                <div class="row">
                  <div class="col-sm-2 pr-0 form-group">
                    <select class="form-control form-control-sm" id="status_publish" name="status_publish">
                      <option value="">-- Status Publish --</option>
                      <option value="process">Menunggu Verifikasi</option>
                      <option value="Publish">Terverifikasi</option>
                      <option value="cancel">Cancel</option>
                    </select>
                  </div>

                  <div class="col-sm-2 pr-0 pl-1 form-group">
                    <select class="form-control form-control-sm" id="status_penggalangan" name="status_penggalangan">
                      <option value="">-- Status Penggalangan --</option>
                      <option value="mulai">Sedang Berlangsung</option>
                      <option value="selesai">Telah Berakhir</option>
                    </select>
                  </div>

                  <div class="col-sm-2 pr-0 pl-1 form-group">
                    <input type="text" class="form-control form-control-sm" autocomplete="off" placeholder="Kode Proyek" id="code">
                  </div>

                  <div class="col-sm-2 pr-0 pl-1 form-group">
                    <input type="text" class="form-control form-control-sm" autocomplete="off" placeholder="Title" id="title">
                  </div>

                  <div class="col-sm-2 pr-0 pl-1 form-group">
                    <input type="text" class="form-control form-control-sm" autocomplete="off" placeholder="ID-REG Pemilik" id="id_reg">
                  </div>

                  <div class="col-sm-2 pr-0 pl-1 form-group">
                    <input type="text" class="form-control form-control-sm" autocomplete="off" placeholder="Nama Pemilik Proyek" id="nama">
                  </div>

                  <div class="col-sm-12">
                    <button class="btn btn-primary btn-sm" id="btn-search" type="button"><i class="fa fa-search"></i> Filter Search</button>
                    <button type="button" id="reload"  name="button" class="btn btn-warning btn-sm"><i class="fa fa-refresh"></i> Reload</button>
                    <button type="button" class="btn btn-success btn-sm">Export Excell</button>
                  </div>
                </div>
              </div>

              <hr>

              <!-- <h4 class="mt-0 header-title"><?=ucfirst($title)?></h4> -->
              <table class="table table-bordered" id="table" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead style="background:#dadada">
                  <tr>
                    <th>DATE REGIS</th>
                    <th>PEMILIK PROYEK</th>
                    <th>PROYEK</th>
                    <th>STATUS PENGGALANGAN</th>
                    <th>STATUS PUBLISH</th>
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
          "url": "<?php echo site_url("backend/master_proyek/json")?>",
          "type": "POST",
          "data": function(data){
            data.code = $("#code").val();
            data.title = $("#title").val();
            data.nama = $("#nama").val();
          }
      },

      //Set column definition initialisation properties.
        "columnDefs": [
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

  $("#btn-search").click(function(){
    table.ajax.reload();  //just reload table
  });

  $("#reload").click(function(){
      $("#code").val("");
      $("#title").val("");
      $("#nama").val("");
      table.ajax.reload();  //just reload table
  });

});
</script>
