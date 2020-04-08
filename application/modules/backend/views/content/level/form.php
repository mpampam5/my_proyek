<div class="wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 col-xl-7 mx-auto animated zoomIn delay-2s">

          <div class="card m-b-30">
            <div class="card-body">
                <?php echo form_open($action, array( 'id' => 'form', 'autocomplete' => 'off' ));?>
                <div class="form-group row">
                    <label for="example-search-input" class="col-sm-3 col-form-label">Level</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="text" name="level" id="level" value="<?=$level?>">
                    </div>
                </div>

                <?php if ($button == "update"): ?>
                  <input type="hidden" name="last_level" value="<?=$level?>">
                <?php endif; ?>


                <input type="hidden" name="submit" value="<?=$button?>">

                <div class="text-right">
                  <a href="<?=site_url("backend/".$this->uri->segment(2))?>" class="btn btn-sm btn-danger">Cancel</a>
                  <button type="submit" id="submit" name="submit" class="btn btn-sm btn-primary"><?=ucfirst($button)?> & Next Access Role</button>
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
                  location.href="<?=base_url('backend/'.$this->uri->segment(2).'/role_access/')?>"+json.id+'.html';
              }
            });
        }else {
          $("#submit").prop('disabled',false)
                      .html('<?=ucfirst($button)?> & Next Access Role');
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
