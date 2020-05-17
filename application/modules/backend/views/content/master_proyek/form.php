<div class="wrapper">
  <div class="container-fluid">
    <div class="col-md-10 mx-auto mb-5">
      <div class="card">
        <div class="card-body">
          <form class="" action="<?=site_url("backend/master_proyek/action_add/$kode")?>" id="form" autocomplete="off">
            <input type="hidden" name="id_penerima_dana" id="id_penerima_dana">

            <div class="form-group">
              <label for="">Penerima Dana</label>
              <div class="bootstrap-filestyle input-group">
                <input type="text" class="form-control bg-white" id="penerima-dana" name="penerima_dana" placeholder="Penerima Dana" readonly>
                <span class="group-span-filestyle input-group-append" tabindex="0">
                  <button for="filestyle-0" type="button" id="btn-pilih-penerima" class="btn btn-primary">
                    <span class="buttonText">Pilih Penerima Dana</span>
                  </button>
                </span>
              </div>
              <div id="penerima_dana"></div>
            </div>


            <div class="form-group">
              <label for="">Title Proyek</label>
              <input type="text" class="form-control" id="title" name="title" placeholder="Title Proyek">
            </div>

            <div class="form-group">
              <label for="">Harga Per Paket (Rp)</label>
              <input id="harga_paket" type="text" readonly value="<?=master_config('HP-MIN')?>" name="harga_paket" class=" form-control bg-white">
            </div>

            <div class="form-group">
              <label for="">Jumlah Paket (Satuan)</label>
              <input id="paket" type="text" value="1" readonly name="paket" class=" form-control bg-white">
            </div>

            <div class="form-group">
              <label for="">Dana Yang Di Butuhkan (Rp)</label>
              <input type="text" class="form-control bg-white" id="dana_dibutuhkan" name="dana_dibutuhkan" readonly>
            </div>



            <div class="form-group">
              <label for="">Lokasi Proyek</label>
              <select class="form-control" name="provinsi" id="provinsi" onchange="loadKabupaten()">
                <option value="">-- Pilih Provinsi --</option>
                  <?php $provinsi = $this->db->get("wil_provinsi")?>
                  <?php foreach ($provinsi->result() as $prov): ?>
                    <option value="<?=$prov->id?>"><?=$prov->name?></option>
                  <?php endforeach; ?>
              </select>
            </div>

            <div class="form-group">
              <label for="">Kabupaten</label>
              <select class="form-control" name="kabupaten" id="kabupaten">
                <option value="">-- Pilih Kabupaten/Kota --</option>
              </select>
            </div>

            <div class="form-group">
              <label for="">Alamat Lengkap</label>
              <textarea class="form-control" name="alamat" id="alamat" rows="3" cols="80" placeholder="Jl. exmple, Nomor. kecamatan , Kelurahan."></textarea>
            </div>

            <div class="form-group">
              <label for="">Foto Proyek</label>
              <div class="row">
                <div class="col-sm-4">
                  <input type="file" name="upload-file" id="upload-file" style="display:none"   accept="image/*">
                    <div class="bootstrap-filestyle input-group">
                      <input type="text" class="form-control bg-white" id="value-file" placeholder="Upload Foto" readonly>
                      <span class="group-span-filestyle input-group-append" tabindex="0">
                        <button for="filestyle-0" type="button" id="btn-upload-file" class="btn btn-success">
                          <span class="buttonText">Upload</span>
                        </button>
                      </span>
                    </div>
                </div>

                <div class="col-sm-4">
                  <input type="file" name="upload-file1" id="upload-file1" style="display:none"   accept="image/*">
                    <div class="bootstrap-filestyle input-group">
                      <input type="text" class="form-control bg-white" id="value-file1" placeholder="Upload Foto" readonly>
                      <span class="group-span-filestyle input-group-append" tabindex="0">
                        <button for="filestyle-0" type="button" id="btn-upload-file1" class="btn btn-success">
                          <span class="buttonText">Upload</span>
                        </button>
                      </span>
                    </div>
                </div>


                <div class="col-sm-4">
                  <input type="file" name="upload-file2" id="upload-file2" style="display:none"   accept="image/*">
                    <div class="bootstrap-filestyle input-group">
                      <input type="text" class="form-control bg-white" id="value-file2" placeholder="Upload Foto" readonly>
                      <span class="group-span-filestyle input-group-append" tabindex="0">
                        <button for="filestyle-0" type="button" id="btn-upload-file2" class="btn btn-success">
                          <span class="buttonText">Upload</span>
                        </button>
                      </span>
                    </div>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="">Deskripsi Proyek</label>
              <textarea class="form-control" id="elm1" rows="5" cols="80" placeholder="Deskripsi"></textarea>
              <input type="hidden" id="deskripsi" name="deskripsi">
            </div>

            <div class="text-right">
              <a href="<?=site_url("backend/master_proyek")?>" class="btn btn-sm btn-danger">Batal</a>
              <button type="submit" id="submit" name="submit" class="btn btn-sm btn-primary">Buat</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div> <!-- Page content Wrapper -->

<!--Wysiwig js-->
<script src="<?=base_url()?>_template/backend/plugins/tinymce/tinymce.min.js"></script>
<script src="<?=base_url()?>_template/backend//plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
  let paket = $("#paket").val();
  let harga_paket = $("#harga_paket").val();
  jumlah = harga_paket * paket;
  $("#dana_dibutuhkan").val(jumlah)

      tinymce.init({
          selector: "textarea#elm1",
          theme: "modern",
          setup : function(ed) {
            ed.on('change', function(e) {
            // This will print out all your content in the tinyMce box
            console.log(ed.getContent());
            // Your text from the tinyMce box will now be passed to your text area …
            $("#deskripsi").val(ed.getContent());
            });
          }
        });



});

$(document).on("change","#paket",function(e){
  e.preventDefault();
  let paket = $(this).val();
  let harga_paket = $("#harga_paket").val();
  jumlah = harga_paket * paket;
  $("#dana_dibutuhkan").val(jumlah)
});

$(document).on("change","#harga_paket",function(e){
  e.preventDefault();
  let paket = $("#paket").val();
  let harga_paket = $(this).val();
  jumlah = harga_paket * paket;
  $("#dana_dibutuhkan").val(jumlah)
});

function loadKabupaten()
{
    var provinsi = $("#provinsi").val();
    if (provinsi!="") {
      $.ajax({
          type:'GET',
          url:"<?php echo base_url(); ?>backend/master_proyek/jsonkabupaten",
          data:"id=" + provinsi,
          success: function(html)
          {
             $("#kabupaten").html(html);
          }
      });
    }else {
      $("#kabupaten").html('<option value="">-- Pilih Kabupaten/Kota --</option>');
    }
}

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
            min: <?=master_config('HP-MIN')?>,
            max: <?=master_config('HP-MAX')?>,
            step: 1000000,
            prefix: 'Rp',
            buttondown_class: 'btn btn-primary',
            buttonup_class: 'btn btn-primary'
        });



      $(function () {
            var fileupload = $("#upload-file");
            var button = $("#btn-upload-file");
            button.click(function () {
                fileupload.click();
            });
            fileupload.change(function () {
                var fileName = $(this).val().split('\\')[$(this).val().split('\\').length - 1];
                var file_data = $('#upload-file').prop('files')[0];
                var form_data = new FormData();
                $("#value-file").val(fileName);
                $("#btn-upload-file").html('Loading');

                form_data.append('upload-file', file_data);
                $.ajax({
                   url: '<?=site_url("backend/master_proyek/do_upload/$kode")?>',
                   dataType: 'json',
                   cache: false,
                   contentType: false,
                   processData: false,
                   data: form_data,
                   type: 'post',
                   success: function(json){
                     if (json.success==true) {
                       button.html('Upload File');
                       $("#value-file").val(json.file_name);
                       $.toast({
                         text: json.alert,
                         showHideTransition: 'slide',
                         icon: json.header_alert,
                         loaderBg: '#f96868',
                         position: 'top-center',
                       });
                     }else {
                       button.html('Upload File');
                       fileupload.val("");
                       $("#value-file").val("");
                       $.toast({
                         text: json.alert,
                         showHideTransition: 'slide',
                         icon: json.header_alert,
                         loaderBg: '#f96868',
                         position: 'top-center',
                       });
                     }
                   }
               });
          });
        });



              $(function () {
                    var fileupload = $("#upload-file1");
                    var button = $("#btn-upload-file1");
                    button.click(function () {
                        fileupload.click();
                    });
                    fileupload.change(function () {
                        var fileName = $(this).val().split('\\')[$(this).val().split('\\').length - 1];
                        var file_data = $('#upload-file1').prop('files')[0];
                        var form_data = new FormData();
                        $("#value-file1").val(fileName);
                        $("#btn-upload-file1").html('Loading');

                        form_data.append('upload-file1', file_data);
                        $.ajax({
                           url: '<?=site_url("backend/master_proyek/do_upload/$kode")?>',
                           dataType: 'json',
                           cache: false,
                           contentType: false,
                           processData: false,
                           data: form_data,
                           type: 'post',
                           success: function(json){
                             if (json.success==true) {
                               button.html('Upload');
                               $("#value-file1").val(json.file_name);
                               $.toast({
                                 text: json.alert,
                                 showHideTransition: 'slide',
                                 icon: json.header_alert,
                                 loaderBg: '#f96868',
                                 position: 'top-center',
                               });
                             }else {
                               button.html('Upload');
                               fileupload.val("");
                               $("#value-file1").val("");
                               $.toast({
                                 text: json.alert,
                                 showHideTransition: 'slide',
                                 icon: json.header_alert,
                                 loaderBg: '#f96868',
                                 position: 'top-center',
                               });
                             }
                           }
                       });
                  });
                });

                $(function () {
                      var fileupload = $("#upload-file2");
                      var button = $("#btn-upload-file2");
                      button.click(function () {
                          fileupload.click();
                      });
                      fileupload.change(function () {
                          var fileName = $(this).val().split('\\')[$(this).val().split('\\').length - 1];
                          var file_data = $('#upload-file2').prop('files')[0];
                          var form_data = new FormData();
                          $("#value-file2").val(fileName);
                          $("#btn-upload-file2").html('Loading');

                          form_data.append('upload-file2', file_data);
                          $.ajax({
                             url: '<?=site_url("backend/master_proyek/do_upload/$kode")?>',
                             dataType: 'json',
                             cache: false,
                             contentType: false,
                             processData: false,
                             data: form_data,
                             type: 'post',
                             success: function(json){
                               if (json.success==true) {
                                 button.html('Upload');
                                 $("#value-file2").val(json.file_name);
                                 $.toast({
                                   text: json.alert,
                                   showHideTransition: 'slide',
                                   icon: json.header_alert,
                                   loaderBg: '#f96868',
                                   position: 'top-center',
                                 });
                               }else {
                                 button.html('Upload');
                                 fileupload.val("");
                                 $("#value-file2").val("");
                                 $.toast({
                                   text: json.alert,
                                   showHideTransition: 'slide',
                                   icon: json.header_alert,
                                   loaderBg: '#f96868',
                                   position: 'top-center',
                                 });
                               }
                             }
                         });
                    });
                  });


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
                                  window.location.href = '<?=site_url('backend/master_proyek')?>'
                              }
                            });

                          }else {
                            $("#submit").prop('disabled',false)
                                        .html('Buat');
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


                  $(document).on("click","#btn-pilih-penerima",function(e){
                    e.preventDefault();
                    $('.modal-dialog').removeClass('modal-sm')
                                      .removeClass('modal-md')
                                      .addClass('modal-lg');
                    $("#modalTitle").text('Pilih Penerima Dana');
                    $('#modalContent').load('<?=site_url("backend/master_proyek/penerima_modal")?>');
                    $("#modalGue").modal('show');
                  });
</script>
