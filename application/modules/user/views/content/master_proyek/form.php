<h6 class="header-title">Saldo : Rp.<?=format_rupiah($this->balance_user->init())?></h6>
<hr>
<div class="alert alert-info">
  <strong><i class="fa fa-info-circle"></i> PERINGATAN</strong>
  <p style="font-size:12px;">Anda tidak dapat membatalkan pendanaan setelah anda menekan tombol DANAI SEKARANG.
    dana anda akan di kembalikan jika dana yang terkumpul di bawah <?=master_config("FINANCIAL-PD")?>%.
    patikan anda telah membaca aturan, peryaratan & ketentuan yang berlaku.</p>
  </div>
<form id="form_act" action="<?=$action?>" autocomplete="off">
  <div class="form-group">
    <label for="">Jumlah Paket</label>
    <input type="text" class="form-control" name="paket" id="pkt" placeholder="jumlah paket">
    <div id="paket"></div>
  </div>

  <div class="form-group">
    <label for="">Total</label>
    <input type="text" class="form-control" id="total" name="total" placeholder="Jumlah" readonly>
  </div>

  <div class="form-group">
    <label for="">PIN Transaksi</label>
    <input type="password" class="form-control" id="pin" name="pin" placeholder="Masukkan PIN Transaksi Anda">
  </div>

  <div class="form-group">
    <input type="checkbox" id="terms_and_conditions"> <span style="font-size:12px;">Pastikan anda telah membaca dan menyetujui aturan dan ketentuan yang berlaku.</span>
  </div>

  <div class="mt-5 float-right">
    <button type='button' class='btn btn-default' data-dismiss='modal'>Batal</button>
    <button type="submit" id="submit_atc" name="submit_atc" class="btn btn-primary" disabled> Danai Sekarang</button>
  </div>

</form>


<script type="text/javascript">

$('#terms_and_conditions').click(function(){
    if($(this).is(':checked')){
        $('#submit_atc').attr("disabled", false);
    } else{
        $('#submit_atc').attr("disabled", true);
    }
});

$("input[name='paket']").TouchSpin({
            min: 1,
            max: <?=$dt->jumlah_paket?>,
            step: 1,
            prefix: 'paket',
            buttondown_class: 'btn btn-primary',
            buttonup_class: 'btn btn-primary'
        });

$(document).on("change","#pkt",function(e)
{
  e.preventDefault();
  let paket = $(this).val();
  let jumlah =  <?=$dt->harga_paket?> * paket;
  let convert = parseInt(jumlah).toLocaleString();
  $("#total").val(convert);
})


$("#form_act").submit(function(e){
e.preventDefault();
var me = $(this);
$("#submit_atc").prop('disabled',true).html('Loading...');
$(".form-group").find('.text-danger').remove();
$.ajax({
      url             : me.attr('action'),
      type            : 'post',
      data            :  new FormData(this),
      contentType     : false,
      cache           : false,
      dataType        : 'JSON',
      processData     :false,
      success:function(json){
        if (json.success==true) {
          $('#modalGue').modal('hide');
          $.toast({
            text: json.alert,
            showHideTransition: 'slide',
            icon: 'success',
            loaderBg: '#f96868',
            position: 'bottom-right',
            hideAfter: 3000,
            afterHidden: function () {
              location.reload(true);
            }
          });
        }else {
          $("#submit_atc").prop('disabled',false)
                      .html('Danai Sekarang');
          $.each(json.alert, function(key, value) {
            var element = $('#' + key);
            $(element)
            .closest('.form-group')
            .find('.text-danger').remove();
            $(element).after(value);
          });
        }
      }
    });
});
</script>
