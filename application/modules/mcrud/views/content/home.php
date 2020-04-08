
<div class="wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 col-xl-4 animated zoomIn delay-2s">
          <div class="card m-b-10">
            <div class="card-body">
                <div class="form-group">
                  <?php if (count($list_table) > 0): ?>
                    <label for="">Table</label>
                    <select class="form-control" name="list-table" id="list-table">
                        <option value="">-- pilih table --</option>
                        <?php foreach ($list_table as $tb): ?>
                          <option value="<?=$tb?>"><?=$tb?></option>
                        <?php endforeach; ?>
                    </select>
                    <?php else: ?>
                      <div class="alert alert-danger">Silahkan buat table dulu</div>
                  <?php endif; ?>

                </div>
                <div class="float-right">
                <a href="<?=base_url("mcrud")?>" class="btn btn-warning btn-md"><i class="fa fa-refresh"></i> Reload</a>
                <button type="button" name="button" id="generate-table" class="btn btn-primary btn-md"><i class="fa fa-cogs"></i> Generate</button>
              </div>
            </div>
          </div>


          <div class="clearfix"></div>

          <div class="card m-b-30">
            <div class="card-body">
              <h6><span class="text-danger font-12">Directory : ../modules/backend/controllers/ </span></h6>
              <h6><span class="text-danger font-12">Total Files : <?=count($list_controller)?> Files</span></h6>
              <table class="table table-bordered">
                <tr>
                  <th>File</th>
                  <th>Class</th>
                  <th>Menu</th>
                </tr>

                <?php foreach ($list_controller as $controllers): ?>
                <tr>
                  <td><?=ucfirst($controllers)?>.php</td>
                  <td><?=ucfirst($controllers)?></td>
                  <td class="text-center"><?=cek_controller_is_menu($controllers)?></td>
                </tr>
                <?php endforeach; ?>
              </table>
            </div>
          </div>
        </div>


        <div class="col-md-12 col-xl-8 animated zoomIn delay-2s">
          <div class="card m-b-30">
            <div class="card-body" id="content">
              <div class="alert alert-info">
                <p>CRUD Generator adalah istilah untuk sebuah tools yang membantu developer dalam membuat script untuk proses Create Read Update Dan Delete secara otomatis dengan bantuan tools tersebut, jika anda adalah pengguna framework Codeigniter maka CMS M-CRUDIGNITER adalah salah satu tools CRUD Generator yang wajib anda coba.</p>
                <ul>
                  <li>Terintegrasi dengan template premium</li>
                  <li>HMVC</li>
                  <li>Manajemen Admin</li>
                  <li>Manajemen Level</li>
                  <li>Manajemen Menu</li>
                  <li>Form Validation</li>
                  <li>Library Template</li>
                  <li>Ajax (Created, Update, delete)</li>
                  <li>Datatable Serverside</li>
                </ul>

                <ul class="social-links text-center list-inline mb-0 mt-3">
                    <li class="list-inline-item">
                        <a target="_blank" href="https://web.facebook.com/mpampam" data-placement="top" data-toggle="tooltip" class="tooltips" href="" data-original-title="Facebook"><i class="fa fa-facebook"></i></a>
                    </li>
                    <li class="list-inline-item">
                        <a target="_blank" href="https://api.whatsapp.com/send?phone=+6285288882994" data-placement="top" data-toggle="tooltip" class="tooltips" href="" data-original-title="Whatsapp"><i class="fa fa-whatsapp"></i></a>
                    </li>
                    <li class="list-inline-item">
                        <a target="_blank" href="tel:085288882994" data-placement="top" data-toggle="tooltip" class="tooltips" href="" data-original-title="085288882994"><i class="fa fa-phone"></i></a>
                    </li>
                    <li class="list-inline-item">
                        <a target="_blank" href="https://www.instagram.com/m_pampam/" data-placement="top" data-toggle="tooltip" class="tooltips" href="" data-original-title="Instagram"><i class="fa fa-instagram"></i></a>
                    </li>
                    <li class="list-inline-item">
                        <a target="_blank" href="https://www.youtube.com/channel/UC1TlTaxRNdwrCqjBJ5zh6TA" data-placement="top" data-toggle="tooltip" class="tooltips" href="" data-original-title="Youtube"><i class="fa fa-youtube"></i></a>
                    </li>
                </ul>
              </div>

            </div>
          </div>
        </div>
      </div>

    </div>
</div>



<script type="text/javascript">
  $(document).on("click","#generate-table",function(e){
    e.preventDefault();
    var value = $("#list-table option:selected").val();
    $("#list-table").closest(".form-group").find(".text-danger").remove();
      $.ajax({
              url             : "<?=base_url()?>/mcrud/get",
              type            : 'POST',
              data            : "values="+value,
              dataType        : 'JSON',
              success:function(json){
                if (json.success==true) {
                  $("#content").hide().fadeIn(300).html(json.content);
                }else {
                  $("#list-table").after('<span style="font-size:12px" class="m-t-2 text-danger">*'+json.alert+'</span>');
                }
              }
            });

  });
</script>
