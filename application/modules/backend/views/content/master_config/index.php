<div class="wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-9 mx-auto">
          <div class="row">
            <!-- deposito -->
            <div class="col-md-12 col-xl-6 animated fadeInRight delay-3s">
              <div class="card m-b-10">
                <div class="mb-2 card-body text-muted">
                  <h4 class="mt-0 header-title">Deposito</h4>
                  <hr>
                  <form autocomplete="off" action="<?=site_url("backend/master_config/action_deposito")?>" id="form_deposito">
                    <div class="form-group">
                      <label for="">STATUS</label>
                      <select class="form-control" name="dp-status" id="dp-status">
                        <option <?=master_config("dp-status","status") == "0" ? "selected":""?> value="0">OFF</option>
                        <option <?=master_config("dp-status","status") == "1" ? "selected":""?> value="1">ON</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="">MIN DEPOSITO</label>
                      <input type="text" class="form-control" id="dp-min" name="dp-min" value="<?=master_config("dp-min")?>" placeholder="">
                    </div>


                    <div class="form-group">
                      <label for="">MAX DEPOSITO</label>
                      <span class="text-info help-block">* isikan '0' jika MAX Deposito tidak ada batasan.</span>
                      <input type="text" class="form-control" id="dp-max" name="dp-max" value="<?=master_config("dp-max")?>" placeholder="">
                    </div>

                    <button type="submit" class="btn btn-sm btn-warning" id="submit_deposito" name="submit_deposito">Simpan Perubahan</button>
                  </form>
                </div>
              </div>
            </div>
            <!-- end deposito -->

            <!-- withdraw -->
            <div class="col-md-12 col-xl-6 animated fadeInRight delay-3s">
              <div class="card m-b-10">
                <div class="mb-2 card-body text-muted">
                  <h4 class="mt-0 header-title">Withdraw</h4>
                  <hr>
                  <form autocomplete="off" action="<?=site_url("backend/master_config/action_withdraw")?>" id="form_withdraw">
                    <div class="form-group">
                      <label for="">STATUS</label>
                      <select class="form-control" name="wd-status" id="wd-status">
                        <option <?=master_config("wd-status","status") == "0" ? "selected":""?> value="0">OFF</option>
                        <option <?=master_config("wd-status","status") == "1" ? "selected":""?> value="1">ON</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="">MIN WITHDRAW</label>
                      <input type="text" class="form-control" id="wd-min" name="wd-min" value="<?=master_config("wd-min")?>">
                    </div>


                    <div class="form-group">
                      <label for="">MAX WITHDRAW</label>
                      <span class="text-info help-block">* isikan '0' jika MAX Withdraw tidak ada batasan.</span>
                      <input type="text" class="form-control" id="wd-max" name="wd-max" value="<?=master_config("wd-max")?>">
                    </div>

                    <button type="submit" class="btn btn-sm btn-warning" id="submit_withdraw" name="submit_withdraw">Simpan Perubahan</button>
                  </form>
                </div>
              </div>
            </div>
            <!-- end withdraw -->
          </div>
        </div>
      </div>
    </div>
</div>


<script type="text/javascript">
$("#form_deposito").submit(function(e){
e.preventDefault();
var me = $(this);
$("#submit_deposito").prop('disabled',true).html('<div class="spinner-border spinner-border-sm text-white"></div> Loading...');
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
              icon: "success",
              loaderBg: '#f96868',
              position: 'bottom-left',
            });
        $("#submit_deposito").prop('disabled',false)
                    .html('Simpan Perubahan');
        $('.form-group').find('.text-danger').remove();
        }else {
          $("#submit_deposito").prop('disabled',false)
                      .html('Simpan Perubahan');
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


$("#form_withdraw").submit(function(e){
e.preventDefault();
var me = $(this);
$("#submit_withdraw").prop('disabled',true).html('<div class="spinner-border spinner-border-sm text-white"></div> Loading...');
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
              icon: "success",
              loaderBg: '#f96868',
              position: 'bottom-left',
            });
        $("#submit_withdraw").prop('disabled',false)
                    .html('Simpan Perubahan');
        $('.form-group').find('.text-danger').remove();
        }else {
          $("#submit_withdraw").prop('disabled',false)
                      .html('Simpan Perubahan');
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
