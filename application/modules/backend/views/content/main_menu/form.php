<div class="wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 col-xl-6 mx-auto animated zoomIn delay-2s">

          <div class="card m-b-30">
            <div class="card-body">
                <?php echo form_open($action, array( 'id' => 'form', 'autocomplete' => 'off' ));?>
                <div class="form-group row">
                    <label for="example-search-input" class="col-sm-3 col-form-label">Menu</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="text" name="menu" id="menu" value="<?=$menu?>">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="example-search-input" class="col-sm-3 col-form-label">Icon</label>
                    <div class="col-sm-7">
                        <input class="form-control" type="text" name="icon" id="icon" value="<?=$icon?>">
                    </div>
                    <div class="col-sm-2">
                      <a class="btn btn-info btn-md" href="<?=site_url("backend/core/icon")?>" id="icons">Icon</a>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="example-search-input" class="col-sm-3 col-form-label">Controller</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="controller" id="controller">
                          <option <?=$controller==""?"selected":""?> value="">*** kosong</option>
                          <optgroup label="-- Controller --">
                          <?php $get_controller = $this->userize->combo_controllerlist(); ?>
                          <?php foreach ($get_controller as $controllers): ?>
                            <option <?=$controller==$controllers?"selected":""?> value="<?=$controllers?>"><?=ucfirst($controllers)?></option>
                          <?php endforeach; ?>
                        </optgroup>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="example-search-input" class="col-sm-3 col-form-label">Is Parent</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="is_parent" id="is_parent">
                          <option <?=$is_parent==0?"selected":""?> value="0">Ya</option>
                          <?php $get_menu = $this->db->get_where("main_menu",["id_menu !="=>$id_menu, "is_parent"=> "0"]); ?>
                          <optgroup label="-- Main Menu --">
                          <?php foreach ($get_menu->result() as $menu): ?>
                            <option <?=$is_parent==$menu->id_menu?"selected":""?> value="<?=$menu->id_menu?>"><?=ucfirst($menu->menu)?></option>
                          <?php endforeach; ?>
                        </optgroup>
                        </select>
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


$(document).on("click","#icons",function(e){
  e.preventDefault();
  $('.modal-dialog').removeClass('modal-md')
                    .removeClass('modal-sm')
                    .addClass('modal-lg');
  $("#modalTitle").text('Icon');
  $('#modalContent').load($(this).attr("href"));
  $("#modalGue").modal('show');
});

</script>
