<!-- DataTables -->
<link href="<?=base_url()?>_template/backend/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<!-- Required datatable js -->
<script src="<?=base_url()?>_template/backend/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=base_url()?>_template/backend/plugins/datatables/dataTables.bootstrap4.min.js"></script>

<div class="page-content-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 col-xl-12 mx-auto animated fadeInRight delay-2s">

          <div class="card m-b-30">
            <div class="card-body">

              <div class="alert alert-info">
                <strong><i class="fa fa-info-circle"></i> Perhatian</strong><br/>
                Pastikan Data Rekening anda sudah benar. Kami akan mentransfer nominal sesuai Data Rekening yang tertera di Profile anda.  <a href="<?=site_url("user/profile")?>" class="font-bold">lihat Profile</a>
              </div>


              <table class="table table-borderless" >
                <tr>
                  <td>
                    <select class="form-control" id="status_view" name="status">
                      <option value="">All</option>
                      <option value="process">Proses</option>
                      <option value="approved">Approved</option>
                      <option value="cancel">Cancel</option>
                    </select>
                  </td>
                  <td><input type="text" class="form-control" autocomplete="off" placeholder="CODE-TRANSAKSI" id="code"></td>
                  <td>
                    <button class="btn btn-primary" id="btn-search" type="button"><i class="fa fa-search"></i></button>
                    <button type="button" id="reload"  name="button" class="btn btn-warning"><i class="fa fa-refresh"></i></button>
                    <a href="<?=site_url("user/withdraw/add")?>" class="btn btn-success">Tambah Withdraw</a>
                  </td>
                </tr>
              </table>


              <table class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="table">
                <thead>
                  <tr>
                    <th>DATE REQUEST</th>
                    <th>CODE-TRANSAKSI</th>
                    <th>STATUS</th>
                    <th>NOMINAL REQUEST</th>
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
          "url": "<?php echo site_url("user/withdraw/json")?>",
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
      $("#status_view").removeAttr('selected').val("").attr('selected', 'selected');
      $("#id_reg").val("");
      $("#code").val("");
      table.ajax.reload();  //just reload table
  });

});



$(document).on("click","#hapus",function(e){
  e.preventDefault();
  $('.modal-dialog').removeClass('modal-lg')
                    .removeClass('modal-md')
                    .addClass('modal-sm');
  $("#modalTitle").text('Please Confirm');
  $('#modalContent').html(`<p>Are you sure you want to delete?</p>
                            <button type='button' class='btn btn-default btn-sm' data-dismiss='modal'>Cancel</button>
                            <button type='button' class='btn btn-primary btn-sm' id='ya-hapus' data-id=`+$(this).attr('alt')+`  data-url=`+$(this).attr('href')+`>Yes, i'm sure</button>
                            `);
  $("#modalGue").modal('show');
});


$(document).on('click','#ya-hapus',function(e){
  $(this).prop('disabled',true)
          .text('Processing...');
  $.ajax({
          url:$(this).data('url'),
          type:'POST',
          cache:false,
          dataType:'json',
          success:function(json){
            $('#modalGue').modal('hide');
            $("#table").DataTable().ajax.reload();
            $.toast({
              text: json.message,
              showHideTransition: 'slide',
              icon: 'success',
              loaderBg: '#f96868',
              position: 'bottom-right',
              hideAfter: 3000
            });
          }
        });
});
</script>
