<link href="<?=base_url()?>_template/backend/plugins/nestable/jquery.nestable.css" rel="stylesheet" />
<!--script for this page only-->
<script src="<?=base_url()?>_template/backend/plugins/nestable/jquery.nestable.js"></script>

<style media="screen">
  .dd{
    max-width:100%!important;
  }

  .float-right a{
    display: inline-block!important;
  }
</style>
<div class="wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 col-xl-7 mx-auto animated zoomIn delay-2s">

          <div class="card m-b-30">
            <div class="card-body">
              <div class="m-b-10 text-center">
                <a href="<?=site_url('backend/main_menu/add')?>" class="btn btn-sm btn-success"><i class="fa fa-file"></i> add</a>
                <a href="<?=site_url("backend/main_menu")?>" class="btn btn-sm btn-info"><i class="fa fa-refresh"></i> Reload</a>
              </div>


              <?php
                $get_menu = $this->db->select("*")
                                     ->from("main_menu")
                                     ->where("is_parent",0)
                                     ->order_by("sort","ASC")
                                     ->get()->result();

               ?>
              <div class="custom-dd dd" id="main_menu">
                  <ol class="dd-list">
                    <?php foreach ($get_menu as $menu): ?>
                      <?php
                        $get_sub_menu = $this->db->select("*")
                                                 ->from("main_menu")
                                                 ->where("is_parent",$menu->id_menu)
                                                 ->order_by("sort","ASC")
                                                 ->get();
                      ?>
                      <?php if ($get_sub_menu->num_rows() > 0): ?>
                        <li class="dd-item" data-id="<?=$menu->id_menu?>">
                            <div class="dd-handle">
                                <?=strtoupper($menu->menu)?>
                                <div class="float-right dd-nodrag">
                                  <span class="text-success">[ # ]</span>
                                  <a href="<?=site_url("backend/main_menu/update/".enc_url($menu->id_menu))?>" class="badge badge-primary"><i class="fa fa-pencil"></i> UPDATE</a>
                                  <a id="delete" href="<?=site_url("backend/main_menu/delete/".enc_url($menu->id_menu))?>" class="badge badge-danger"><i class="fa fa-trash"></i> DELETE</a>
                                </div>
                            </div>
                            <ol class="dd-list">
                                <?php foreach ($get_sub_menu->result() as $sub_menu): ?>
                                  <li class="dd-item" data-id="<?=$sub_menu->id_menu?>">
                                      <div class="dd-handle">
                                          <?=strtoupper($sub_menu->menu)?>
                                          <div class="float-right dd-nodrag">
                                            <span class="text-success">[ <?=$sub_menu->controller?> ]</span>
                                            <a href="<?=site_url("backend/main_menu/update/".enc_url($sub_menu->id_menu))?>" class="badge badge-primary"><i class="fa fa-pencil"></i> UPDATE</a>
                                            <a id="delete" href="<?=site_url("backend/main_menu/delete/".enc_url($sub_menu->id_menu))?>" class="badge badge-danger"><i class="fa fa-trash"></i> DELETE</a>
                                          </div>
                                      </div>
                                  </li>
                                <?php endforeach; ?>
                            </ol>
                        </li>
                        <?php else: ?>
                          <li class="dd-item" data-id="<?=$menu->id_menu?>">
                              <div class="dd-handle">
                                  <?=strtoupper($menu->menu)?>
                                  <div class="float-right dd-nodrag">
                                    <span class="text-success">[ <?=$menu->controller?> ]</span>
                                    <a href="<?=site_url("backend/main_menu/update/".enc_url($menu->id_menu))?>" class="badge badge-primary"><i class="fa fa-pencil"></i> UPDATE</a>
                                    <a id="delete" href="<?=site_url("backend/main_menu/delete/".enc_url($menu->id_menu))?>" class="badge badge-danger"><i class="fa fa-trash"></i> DELETE</a>
                                  </div>
                              </div>
                          </li>
                      <?php endif; ?>

                      <?php endforeach; ?>


                  </ol>


              </div>

            </div>
          </div>
        </div>
      </div>

    </div>
</div>

<input type="hidden" id="main_menu_output">

<script type="text/javascript">
$(document).on("click","#delete",function(e){
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
              position: 'bottom-right'
            });
            window.location.href = "<?=site_url("backend/main_menu")?>";
          }
        });
});


!function($) {
  "use strict";

  var Nestable = function() {};

  Nestable.prototype.updateOutput = function (e) {
      var list = e.length ? e : $(e.target),
          output = list.data('output');
      if (window.JSON) {
          output.val(window.JSON.stringify(list.nestable('serialize'))); //, null, 2));
      } else {
          alert('JSON browser support required for this demo.');
      }
  },
  //init
  Nestable.prototype.init = function() {

      // activate Nestable for list 2
      $('#main_menu').nestable({
          group: 1,
          maxDepth:2
      }).on('change', this.updateOutput);

      this.updateOutput($('#main_menu').data('output', $('#main_menu_output')));




      $('#nestable_list_menu').on('click', function (e) {
          var target = $(e.target),
              action = target.data('action');
          if (action === 'expand-all') {
              $('.dd').nestable('expandAll');
          }
          if (action === 'collapse-all') {
              $('.dd').nestable('collapseAll');
          }
      });


      $('.dd').on('change', function() {
        var dataString = {
             data : $("#main_menu_output").val(),
           };

       $.ajax({
           type: "POST",
           url: "<?=base_url()?>backend/main_menu/save",
           data: dataString,
           cache : false,
           success: function(data){
             $.toast({
               text: "Menyimpan perubahan",
               showHideTransition: 'slide',
               icon: 'success',
               loaderBg: '#f96868',
               position: 'bottom-right',
 							hideAfter: 3000
             });
           } ,error: function(xhr, status, error) {
             alert(error);
           },
       });
    });

  },
  //init
  $.Nestable = new Nestable, $.Nestable.Constructor = Nestable
}(window.jQuery),

//initializing
function($) {
  "use strict";
  $.Nestable.init()
}(window.jQuery);
</script>
