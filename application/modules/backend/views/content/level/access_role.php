<div class="wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 col-xl-7 mx-auto animated zoomIn delay-2s">

          <div class="card m-b-30">
            <div class="card-body">
              <table class="table table-bordered table-striped">
                <tr>
                  <th style="padding-top:25px;padding-bottom:25px;">
                    Dashboard
                    <div class="float-right">Null</div>
                  </th>
                </tr>
                <?php $get_menu = $this->db->query("SELECT * FROM main_menu WHERE is_parent=0  ORDER BY sort ASC" ) ?>
                <?php foreach ($get_menu->result() as $menu): ?>
                  <?php $get_sub_menu = $this->db->query("SELECT * FROM main_menu WHERE is_parent = $menu->id_menu ORDER BY sort ASC") ?>
                  <?php if ($get_sub_menu->num_rows() > 0): ?>
                    <tr>
                      <th>
                        <?=ucfirst($menu->menu)?>
                        <ul>
                        <?php foreach ($get_sub_menu->result() as $sub_menu): ?>
                            <li style="padding:10px;border-bottom:1px solid #e3e3e3">
                              <?=ucfirst($sub_menu->menu)?>
                              <i style="font-size:11px;margin-left:10px;" class="text-primary"> <?= $sub_menu->controller == "" ? "Null" : site_url("backend/".$sub_menu->controller)?></i>
                              <div class="float-right">
                                <input type="checkbox" id="switch<?=$sub_menu->id_menu?>"  class="checkbox1" name="<?=$sub_menu->id_menu?>" switch="success" <?=cek_role_access($sub_menu->id_menu) ? "checked" : ""?>/>
                                <label for="switch<?=$sub_menu->id_menu?>" data-on-label="Yes" data-off-label="No"></label>
                              </div>
                            </li>
                        <?php endforeach; ?>
                      </ul>
                      </th>
                    </tr>
                    <?php else: ?>
                      <tr>
                        <th style="padding-top:25px;">
                          <?=ucfirst($menu->menu)?>
                          <i style="font-size:11px;margin-left:10px;" class="text-primary"> <?= $menu->id_menu == "" ? "Url Null" : site_url("backend/".$menu->controller)?></i>
                          <div class="float-right" style="padding-right:13px;">
                            <input type="checkbox" id="switch<?=$menu->id_menu?>"  class="checkbox1" name="<?=$menu->id_menu?>" switch="success" <?=cek_role_access($menu->id_menu) ? "checked" : ""?>/>
                            <label for="switch<?=$menu->id_menu?>" data-on-label="Yes" data-off-label="No"></label>
                          </div>
                        </th>
                      </tr>
                  <?php endif; ?>
                <?php endforeach; ?>
              </table>


              <div class="float-right">
                <a href="<?=site_url("backend/level")?>" class="btn btn-success btn-sm"> Finish</a>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
</div>


<script type="text/javascript">
$("input[type='checkbox']").change(function() {
  if (this.checked) {
    var dataVal = 1;
  }else {
    var dataVal = 0;
  }

  dataName = $(this).attr("name");

  $.ajax({
        url             : "<?=site_url("backend/level/set_role/".$this->uri->segment(4))?>",
        type            : 'POST',
        data            : {name : dataName, value : dataVal},
        dataType        : 'JSON',
        success:function(json){
          if (json.success==true) {
            $.toast({
                text: json.alert,
                showHideTransition: 'slide',
                icon: "success",
                loaderBg: '#f96868',
                position: 'bottom-left',
              });
          }else {
            $.toast({
                text: json.alert,
                showHideTransition: 'slide',
                icon: "danger",
                loaderBg: '#f96868',
                position: 'bottom-left',
              });
          }
        }
  });

});
</script>
