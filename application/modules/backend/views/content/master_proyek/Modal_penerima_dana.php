<!-- DataTables -->
<link href="<?=base_url()?>_template/backend/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<!-- Required datatable js -->
<script src="<?=base_url()?>_template/backend/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=base_url()?>_template/backend/plugins/datatables/dataTables.bootstrap4.min.js"></script>

<div class="row">
  <div class="col-sm-12">
    <table class="table table-bordered" id="table">
      <thead>
        <tr>
          <th>Penerima</th>
          <th>#</th>
        </tr>
      </thead>


      <?php
        $penerima_where = array("is_active" => "1",
                                "is_delete" => "0",
                                "complate"  => "1"
                              );
        $penerima = $this->db->get_where("master_penerima_dana",$penerima_where);
       ?>
      <tbody>
        <?php foreach ($penerima->result() as $pn): ?>
        <tr>
          <td>
            <b class="text-info"><?=$pn->id_reg?></b>&nbsp;|&nbsp;
            <?=$pn->nama?>&nbsp;|&nbsp;
            <?=$pn->nama_perusahaan?>
          </td>
          <td>
              <button type="button" name="button" id="pilih" data-id="<?=$pn->id_penerima_dana?>" data-name="<?=$pn->id_reg?>&nbsp;|&nbsp;<?=$pn->nama?>&nbsp;|&nbsp;<?=$pn->nama_perusahaan?>" class="btn btn-sm btn-success btn-block">Pilih</button>
          </td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>

  </div>
</div>


<script type="text/javascript">
  $("#table").DataTable({
    // "searching": false,
    "info": false,
    "bLengthChange": false,
    "ordering":false
  });


  $(document).on("click","#pilih",function(e){
    e.preventDefault();
    $("#modalGue").modal('hide');
    $("#penerima-dana").val($(this).attr('data-name'));
    $("#id_penerima_dana").val($(this).attr('data-id'));
  });
</script>
