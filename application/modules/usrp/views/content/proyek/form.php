<div class="page-content-wrapper">
  <div class="container-fluid">
    <div class="col-md-10 mx-auto mb-5">
      <div class="card">
        <div class="card-body">
          <form class="" action="index.html" method="post">
            <div class="form-group">
              <label for="">Kode Proyek</label>
              <input type="text" class="form-control" readonly value="<?=$kode?>">
            </div>

            <div class="form-group">
              <label for="">Nama Proyek</label>
              <input type="text" class="form-control" id="" placeholder="">
            </div>

            <div class="form-group">
              <label for="">Harga Per Paket (Rp)</label>
              <input id="harga_paket" type="text" value="1000000" name="harga_paket" class=" form-control">
            </div>

            <div class="form-group">
              <label for="">Jumlah Paket (Satuan)</label>
              <input id="paket" type="text" value="1" name="paket" class=" form-control">
            </div>

            <div class="form-group">
              <label for="">Dana Yang Di Butuhkan (Rp)</label>
              <input type="text" class="form-control" id="" placeholder="">
            </div>

            <div class="form-group">
              <label for="">Priode/Tenor (Bulan)</label>
              <input id="priode" type="text" value="1" name="priode" class=" form-control">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div> <!-- Page content Wrapper -->


<script src="<?=base_url()?>_template/usrp//plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js"></script>
<script type="text/javascript">
$("input[name='paket']").TouchSpin({
          min: 1,
          max: 1000,
          step: 1,
          postfix: 'PAKET',
          buttondown_class: 'btn btn-primary',
          buttonup_class: 'btn btn-primary'
      });

$("input[name='priode']").TouchSpin({
          min: 1,
          max: 36,
          step: 1,
          postfix: 'Bulan',
          buttondown_class: 'btn btn-primary',
          buttonup_class: 'btn btn-primary'
      });

$("input[name='harga_paket']").TouchSpin({
            min: 1000000,
            max: 100000000,
            step: 1000000,
            prefix: 'Rp',
            buttondown_class: 'btn btn-primary',
            buttonup_class: 'btn btn-primary'
        });
</script>
