<link href="<?=base_url()?>_template/usrp/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<script src="<?=base_url()?>_template/usrp/plugins/select2/js/select2.min.js"></script>

<div class="page-content-wrapper">
  <div class="container-fluid">
    <div class="col-md-10 mx-auto">
      <div class="card">
        <div class="card-body">
          <form class="" action="index.html" method="post">
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Nama Perusahaan</label>
                <div class="col-sm-9">
                    <input class="form-control" type="text" value="" id="example-text-input">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Bidang Usaha</label>
                <div class="col-sm-9">
                  <select class="form-control" value="" id="example-text-input">
                    <option value="">-- Pilih --</option>
                    <option value=""> Peternakan</option>
                  </select>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Provinsi</label>
                <div class="col-sm-9">
                    <input class="form-control" type="text" value="" id="example-text-input">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Kabupaten/Kota</label>
                <div class="col-sm-9">
                    <input class="form-control" type="text" value="" id="example-text-input">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Alamat Lengkap</label>
                <div class="col-sm-9">
                    <textarea name="name" class="form-control" rows="3" cols="80"></textarea>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Bentuk Badan Usaha</label>
                <div class="col-sm-9">
                  <select class="form-control" value="" id="example-text-input">
                    <option value="">-- Pilih --</option>
                    <option value=""> Belum Ada</option>
                    <option value=""> PT</option>
                    <option value=""> CV</option>
                    <option value=""> UD</option>
                    <option value=""> FIRMA</option>
                    <option value=""> Yang lainnya</option>
                  </select>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">File Badan Usaha</label>
                <div class="col-sm-9">
                    <div class="bootstrap-filestyle input-group">
                      <input type="text" class="form-control " placeholder="" readonly>
                      <span class="group-span-filestyle input-group-append" tabindex="0">
                        <label for="filestyle-0" class="btn btn-info">
                          <span class="icon-span-filestyle fa fa-folder-open"></span>
                          <span class="buttonText">Choose file</span>
                        </label>
                      </span>
                    </div>
                </div>
                <div class="col-sm-12 mt-3">
                  <ul style="list-style:none;font-size:11px;margin-left:170px">
                    <li><i class="fa fa-info-circle"></i> Tulisan harus berbahasa Indonesia dan terbaca dengan jelas</li>
                    <li><i class="fa fa-info-circle"></i> Pastikan file dalam bentuk PDF</li>
                    <li><i class="fa fa-info-circle"></i> Ukuran file maksimal 5 Mb</li>
                  </ul>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Dokumen Perizinan</label>
                <div class="col-sm-9">
                  <select class="select2 form-control select2-multiple" multiple="multiple" multiple data-placeholder="  -- pilih --">
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
                  </select>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">File Dokumen Perizinan</label>
                <div class="col-sm-9">
                    <div class="bootstrap-filestyle input-group">
                      <input type="text" class="form-control " placeholder="" readonly>
                      <span class="group-span-filestyle input-group-append" tabindex="0">
                        <label for="filestyle-0" class="btn btn-info">
                          <span class="icon-span-filestyle fa fa-folder-open"></span>
                          <span class="buttonText">Choose file</span>
                        </label>
                      </span>
                    </div>
                </div>
                <div class="col-sm-12 mt-3">
                  <ul style="list-style:none;font-size:11px;margin-left:170px">
                    <li><i class="fa fa-info-circle"></i> File Perizinan digabung jadi satu file</li>
                    <li><i class="fa fa-info-circle"></i> Tulisan harus berbahasa Indonesia dan terbaca dengan jelas</li>
                    <li><i class="fa fa-info-circle"></i> Pastikan file dalam bentuk PDF</li>
                    <li><i class="fa fa-info-circle"></i> Ukuran file maksimal 5 Mb</li>
                  </ul>
                </div>
            </div>


            <div class="text-right mt-5">
              <button type="submit" name="submit" class="btn btn-sm btn-primary">Simpan & Lanjutkan</button>
            </div>

          </form>
        </div>
      </div>
    </div>

  </div>
</div> <!-- Page content Wrapper -->



<script type="text/javascript">
  $(".select2").select2();
</script>
