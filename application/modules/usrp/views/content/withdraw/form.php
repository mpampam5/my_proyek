<div class="page-content-wrapper">
  <div class="container-fluid">
    <div class="col-md-8 mx-auto mb-5">
      <div class="card">
        <div class="card-body">
          <form id="form" action="<?=site_url("usrp/withdraw/add_action")?>" autocomplete="off">
            <div class="form-group">
              <label for="">Nominal</label>
              <input type="text" class="form-control" id="nominal" name="nominal" placeholder="Nominal">
            </div>

            <a href="<?=site_url("usrp/withdraw")?>" class="btn btn-danger btn-sm">Batal</a>
            <button type="submit" name="submit" id="submit" class="btn btn-sm btn-primary"> Withdraw</button>

          </form>


          <div class="alert alert-info mt-5">
            <strong><i class="fa fa-info"></i>Info.</strong>
            Saldo anda akan terpotong walaupun withdraw dalam status proses.
          </div>
        </div>
      </div>
    </div>
  </div>
</div> <!-- Page content Wrapper -->


<script type="text/javascript">
$("#form").submit(function(e){
e.preventDefault();
var me = $(this);
$("#submit").prop('disabled',true).html('Loading...');
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
            $.toast({
              text: json.alert,
              showHideTransition: 'slide',
              icon: 'success',
              loaderBg: '#f96868',
              position: 'bottom-right',
							hideAfter: 3000,
              afterHidden: function () {
                  location.href="<?=site_url("usrp/withdraw")?>";
              }
            });
        }else {
          $("#submit").prop('disabled',false)
                      .html('Withdraw');
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
