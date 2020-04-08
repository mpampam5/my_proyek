<div class="wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 col-xl-7 mx-auto animated zoomIn delay-2s">

          <div class="card m-b-30">
            <div class="card-body">
                <?php echo form_open($action, array( 'id' => 'form', 'autocomplete' => 'off' ));?>
                <div class="form-group row">
                    <label for="example-search-input" class="col-sm-3 col-form-label">Nama</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="text" name="nama" id="nama" value="<?=$nama?>">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="example-search-input" class="col-sm-3 col-form-label">Level</label>
                    <div class="col-sm-9">
                      <!-- is_combo($table,$id_name,$id_field,$name_field,$value) -->
                      <?=is_combo("level","id_level","id_level","level",$id_level)?>
                    </div>
                </div>


                <div class="form-group row">
                    <label for="example-search-input" class="col-sm-3 col-form-label">Is Active</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="is_active" id="is_active">
                          <?php if ($button == "tambah"): ?>
                            <option value="">--Pilih--</option>
                          <?php endif; ?>
                          <option <?=($is_active=="1") ? 'selected':''?> value="1">Ya</option>
                          <option <?=($is_active=="0") ? 'selected':''?> value="0">Tidak</option>
                        </select>
                    </div>
                </div>


                <div class="form-group row">
                    <label for="example-search-input" class="col-sm-3 col-form-label">Email</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="text" name="email" id="email" value="<?=$email?>">
                    </div>
                </div>

                <?php if ($button=="update"): ?>
                  <input class="form-control" type="hidden" name="last_email" id="last_email" value="<?=$email?>">
                  <p class="text-primary">* Silahkan isi password jika ingin mengganti</p>
                <?php endif; ?>

                <div class="form-group row">
                    <label for="example-search-input" class="col-sm-3 col-form-label">Password</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="password" name="password" id="password">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="example-search-input" class="col-sm-3 col-form-label">Konfirmasi Password</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="password" name="konfirmasi_password" id="konfirmasi_password">
                    </div>
                </div>

                <input type="hidden" name="submit" value="<?=$button?>">

                <div class="text-right">
                  <a href="<?=site_url("backend/".$this->uri->segment(2))?>" class="btn btn-sm btn-danger">Cancel</a>
                  <button type="submit" id="submit" name="submit" class="btn btn-sm btn-primary"><?=ucfirst($button)?></button>
                </div>
              </form>


            </div>
          </div>
        </div>
      </div>

    </div>
</div>


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
                  location.href="<?=site_url('backend/'.$this->uri->segment(2))?>";
              }
            });
        }else {
          $("#submit").prop('disabled',false)
                      .html('<?=ucfirst($button)?>');
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
