<div class="page-content-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 col-xl-10 mx-auto animated zoomIn delay-3s">
          <div class="card m-b-10">
            <div class="mb-2 card-body text-muted">
              <h4 class="header-title">Pendanaan <b class="text-info"> <?=$dt->kode?></b>. <?=$dt->title?></h4>

              <a href="<?=site_url("usrp/master_proyek/detail/".enc_url($dt->id_proyek))?>" class="btn btn-light btn-sm"> Lihat Detail Proyek</a>
              <a href="<?=site_url("usrp/master_proyek/add_progres/".enc_url($dt->id_proyek))?>" class="btn btn-primary btn-sm"> Tambah Progress</a>
              <hr>

              <?php if ($result->num_rows() > 0): ?>
                <ol class="activity-feed mb-0">
                  <?php foreach ($result->result() as $row): ?>
                    <li class="feed-item">
                        <span class="date"><i class="fa fa-calendar"></i> <?=date("d/m/Y",strtotime($row->created_at))?></span>
                        <span class="activity-text">
                          <a href="<?=site_url("usrp/master_proyek/edit_progres/".$dt->kode."/".enc_url($row->id_progres_proyek)."/".enc_url($dt->id_proyek))?>" id="edit" class="badge badge-warning text-white">edit</a>
                          <a href="<?=site_url("usrp/master_proyek/delete_progres_proyek/".enc_url($row->id_progres_proyek))?>" id="hapus" class="badge badge-danger">hapus</a>
                          <b class="text-success">Progres pengerjaan <?=$row->persentase?>%</b> -
                          <?=$row->deskripsi?>
                        </span>
                    </li>
                  <?php endforeach; ?>
                </ol>

                <?php else: ?>
                  <i>Belum ada progres</i>
              <?php endif; ?>



            </div>
          </div>
        </div>
      </div>
    </div>
</div>

<script type="text/javascript">
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
            $.toast({
              text: json.message,
              showHideTransition: 'slide',
              icon: 'success',
              loaderBg: '#f96868',
              position: 'bottom-right',
              hideAfter: 3000,
              afterHidden: function () {
                  window.location.href = '<?=site_url('usrp/master_proyek/get_progres_proyek/'.enc_url($dt->id_proyek))?>';
              }
            });
          }
        });
});
</script>
