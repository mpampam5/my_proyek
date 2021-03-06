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
                      <option value="">-- Status --</option>
                      <option value="process">Menunggu Verifikasi</option>
                      <option value="publish">Publish</option>
                      <option value="unapproved">Dana Di Kembalikan</option>
                      <option value="cancel">Cancel</option>
                    </select>
                  </div>

                  <div class="col-sm-2 pr-0 pl-1 form-group">
                    <select class="form-control form-control-sm" id="status_penggalangan" name="status_penggalangan">
                      <option value="">-- Status Penggalangan --</option>
                      <option value="akan_datang">Akan Rilis</option>
                      <option value="mulai">Sedang Berlangsung</option>
                      <option value="terpenuhi">Terpenuhi</option>
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
                    <a href="<?=site_url("backend/master_proyek/export")?>" target="_blank" class="btn btn-success btn-sm"><i class="fa fa-file-excel-o"></i> Export Excell</a>
                    <a href="<?=site_url("backend/master_proyek/add")?>" class="btn btn-info btn-sm"><i class="fa fa-file"></i> Tambah Proyek</a>
                  </div>
                </div>
              </div>

              <hr>

              <table class="table table-bordered" id="table" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead style="background:#dadada">
                  <tr>
                    <th>DATE REGIS</th>
                    <th>PEMILIK PROYEK</th>
                    <th>PROYEK</th>
                    <th>STATUS PENGGALANGAN</th>
                    <th>STATUS</th>
                    <th>STATUS DIVIDEN</th>
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
            data.status_publish = $("#status_publish option:selected").val();
            data.status_penggalangan = $("#status_penggalangan option:selected").val();
            data.code = $("#code").val();
            data.title = $("#title").val();
            data.id_reg = $("#id_reg").val();
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
          },
          {
              "className": "text-center",
              "orderable": false,
              "targets": 6
          }
      ],
    });

  $("#btn-search").click(function(){
    table.ajax.reload();  //just reload table
  });

  $("#reload").click(function(){
    $("#status_publish").removeAttr('selected').val("").attr('selected', 'selected');
    $("#status_penggalangan").removeAttr('selected').val("").attr('selected', 'selected');
      $("#code").val("");
      $("#title").val("");
      $("#nama").val("");
      $("#id_reg").val("");
      table.ajax.reload();  //just reload table
  });

});
</script>
