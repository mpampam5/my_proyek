<!--Summernote js-->
<link href="<?=base_url()?>_template/backend/plugins/summernote/summernote-bs4.css" rel="stylesheet" />
<script src="<?=base_url()?>_template/backend/plugins/summernote/summernote-bs4.min.js"></script>
<style media="screen">
.modal-backdrop, .modal-backdrop.in{
  display: none;
}
</style>
<link href="<?=base_url()?>_template/backend/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<script src="<?=base_url()?>_template/backend/plugins/select2/js/select2.min.js" type="text/javascript"></script>
<div class="wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 col-xl-12 mx-auto animated zoomIn delay-2s">
          <div class="card m-b-30">
            <div class="card-body">
              <div class="row">
                <div class="col-sm-8">
                  <div class="form-group">
                    <label for="">Title</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="">
                  </div>

                  <div class="form-group">
                    <textarea class="summernote" name="name" rows="8" cols="80"></textarea>
                  </div>
                </div>

                <div class="col-sm-4">
                  <div class="form-group">
                      <label>Gambar</label>
                      <input type="file" class="filestyle" data-buttonname="btn-secondary" id="filestyle-0" tabindex="-1" style="position: absolute; clip: rect(0px, 0px, 0px, 0px);">
                      <div class="bootstrap-filestyle input-group">
                        <input type="text" class="form-control " placeholder="" disabled="">
                         <span class="group-span-filestyle input-group-append" tabindex="0">
                           <label for="filestyle-0" class="btn btn-secondary ">
                             <span class="icon-span-filestyle fa fa-folder-open"></span>
                           <span class="buttonText">Choose file</span>
                           </label>
                           </span>

                      </div>
                  </div>

                  <div class="form-group">
                    <label for="">Kategori</label>
                    <select class="form-control" id="kategori" name="kategori">
                      <option value=""> -- pilih kategori--</option>
                    </select>
                  </div>

                  <div class="form-group">
                                        <label class="control-label">Tags</label>

                                        <select class="select2 form-control select2-multiple" multiple="multiple" multiple data-placeholder="Choose ...">
                                            <optgroup label="Alaskan/Hawaiian Time Zone">
                                                <option value="AK">Alaska</option>
                                                <option value="HI">Hawaii</option>
                                            </optgroup>
                                            <optgroup label="Pacific Time Zone">
                                                <option value="CA">California</option>
                                                <option value="NV">Nevada</option>
                                                <option value="OR">Oregon</option>
                                                <option value="WA">Washington</option>
                                            </optgroup>
                                            <optgroup label="Mountain Time Zone">
                                                <option value="AZ">Arizona</option>
                                                <option value="CO">Colorado</option>
                                                <option value="ID">Idaho</option>
                                                <option value="MT">Montana</option>
                                                <option value="NE">Nebraska</option>
                                                <option value="NM">New Mexico</option>
                                                <option value="ND">North Dakota</option>
                                                <option value="UT">Utah</option>
                                                <option value="WY">Wyoming</option>
                                            </optgroup>
                                            <optgroup label="Central Time Zone">
                                                <option value="AL">Alabama</option>
                                                <option value="AR">Arkansas</option>
                                                <option value="IL">Illinois</option>
                                                <option value="IA">Iowa</option>
                                                <option value="KS">Kansas</option>
                                                <option value="KY">Kentucky</option>
                                                <option value="LA">Louisiana</option>
                                                <option value="MN">Minnesota</option>
                                                <option value="MS">Mississippi</option>
                                                <option value="MO">Missouri</option>
                                                <option value="OK">Oklahoma</option>
                                                <option value="SD">South Dakota</option>
                                                <option value="TX">Texas</option>
                                                <option value="TN">Tennessee</option>
                                                <option value="WI">Wisconsin</option>
                                            </optgroup>
                                            <optgroup label="Eastern Time Zone">
                                                <option value="CT">Connecticut</option>
                                                <option value="DE">Delaware</option>
                                                <option value="FL">Florida</option>
                                                <option value="GA">Georgia</option>
                                                <option value="IN">Indiana</option>
                                                <option value="ME">Maine</option>
                                                <option value="MD">Maryland</option>
                                                <option value="MA">Massachusetts</option>
                                                <option value="MI">Michigan</option>
                                                <option value="NH">New Hampshire</option>
                                                <option value="NJ">New Jersey</option>
                                                <option value="NY">New York</option>
                                                <option value="NC">North Carolina</option>
                                                <option value="OH">Ohio</option>
                                                <option value="PA">Pennsylvania</option>
                                                <option value="RI">Rhode Island</option>
                                                <option value="SC">South Carolina</option>
                                                <option value="VT">Vermont</option>
                                                <option value="VA">Virginia</option>
                                                <option value="WV">West Virginia</option>
                                            </optgroup>
                                        </select>

                                    </div>

                </div>


              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>


<script type="text/javascript">
$(document).ready(function(){
  $(".select2").select2();
  
    $('.summernote').summernote({
        height: 450,                 // set editor height         // set maximum height of editor
        toolbar: [
                  ['style', ['style']],
                  ['font', ['bold', 'italic', 'underline', 'clear']],
                  ['fontname', ['fontname']],
                  ['color', ['color']],
                  ['para', ['ul', 'ol', 'paragraph']],
                  ['height', ['height']],
                  ['insert', ['hr']],
                  ['view', ['codeview']],
                ],
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
