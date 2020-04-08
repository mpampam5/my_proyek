<!-- DataTables -->
<link href="<?=base_url()?>_template/backend/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<!-- Required datatable js -->
<script src="<?=base_url()?>_template/backend/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=base_url()?>_template/backend/plugins/datatables/dataTables.bootstrap4.min.js"></script>

<div class="wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 col-xl-7 mx-auto animated fadeInRight delay-2s">

          <div class="card m-b-30">
            <div class="card-body">
              <div class="m-b-10 text-center">
                <a href="<?=site_url("backend/level/add")?>" class="btn btn-sm btn-success"><i class="fa fa-file"></i> Add</a>
              </div>
              <!-- <h4 class="mt-0 header-title"><?=ucfirst($title)?></h4> -->
              <table class="table table-bordered nowrap" id="table" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Level</th>
                    <th>Action</th>
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
      "order": [[ 1, 'desc' ]], //Initial no order.
      "searching": false,
      "info": false,
      "bLengthChange": false,
      oLanguage: {
          sProcessing: '<i class="fa fa-spinner fa-spin fa-fw"></i> Loading...'
      },

      // Load data for the table's content from an Ajax source
      "ajax": {
          "url": "<?php echo site_url("backend/level/json")?>",
          "type": "POST"
      },

      //Set column definition initialisation properties.
        "columnDefs": [
        {
            "className": "text-center",
            "targets": 0, //first column / numbering column
            "orderable": false
        },
        {
            "className": "text-center",
            "orderable": false,
            "targets": 2
        }
      ],
    });

    $(document).on("click","#delete",function(e){
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
                $.toast({
                  text: json.message,
                  showHideTransition: 'slide',
                  icon: 'success',
                  loaderBg: '#f96868',
                  position: 'bottom-right'
                });
                $('#table').DataTable().ajax.reload();
              }
            });
    });

});
</script>
