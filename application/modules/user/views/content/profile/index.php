<style media="screen">
  table tr th,td{
    padding:5px!important;
    text-transform: uppercase;
  }

  table tr td{
    color:#8c8c8c;
  }
</style>

<div class="page-content-wrapper">
  <div class="container-fluid">
    <div class="col-md-10 mx-auto mb-2">
      <div class="card">
        <div class="card-body">
          <div class="">
            <h4 class="header-title float-left">Data Pribadi</h4>
            <a class="btn btn-sm btn-warning float-right" href="<?=site_url("user/profile/edit_data_pribadi")?>"><i class="fa fa-pencil"></i></a>
          </div>

          <div class="clearfix"></div>
          <hr>
          <table class="table table-borderless">
            <tr>
              <th>ID.REG</th>
              <td>: <?=profile("id_reg")?></td>
            </tr>

            <tr>
              <th>No.KTP</th>
              <td>: <?=profile("no_ktp")?></td>
            </tr>

            <tr>
              <th>Nama</th>
              <td>: <?=profile("nama")?></td>
            </tr>

            <tr>
              <th>Tempat, Tanggal Lahir</th>
              <td>: <?=ucfirst(profile("tempat_lahir"))?>, <?=date("d-m-Y",strtotime(profile("tgl_lahir")))?></td>
            </tr>

            <tr>
              <th>Jenis Kelamin</th>
              <td>: <?=profile("jenis_kelamin")?></td>
            </tr>

            <tr>
              <th>Email</th>
              <td>: <?=profile("email")?></td>
            </tr>

            <tr>
              <th>Telepon</th>
              <td>: <?=profile("telepon")?></td>
            </tr>



            <tr>
              <th>Pekerjaan</th>
              <td>: <?=profile("pekerjaan")?></td>
            </tr>

            <tr>
              <th>Pendidikan Terakhir</th>
              <td>: <?=profile("pendidikan")?></td>
            </tr>

            <tr>
              <th>Provinsi</th>
              <td>: <?=provinsi(profile("provinsi"))?></td>
            </tr>

            <tr>
              <th>Kabupaten/Kota</th>
              <td>: <?=kabupaten(profile("kabupaten"))?></td>
            </tr>

            <tr>
              <th>Alamat Lengkap</th>
              <td>: <?=profile("alamat")?></td>
            </tr>

            <tr>
              <th>Kode Pos</th>
              <td>: <?=profile("kode_pos")?></td>
            </tr>
          </table>
        </div>
      </div>
    </div>


    <div class="col-md-10 mx-auto mb-2">
      <div class="card">
        <div class="card-body">
          <div class="">
            <h4 class="header-title float-left">Data Rekening</h4>
            <a class="btn btn-sm btn-warning float-right" href="<?=site_url("user/profile/edit_data_rekening")?>"><i class="fa fa-pencil"></i></a>
          </div>
          <div class="clearfix"></div>
          <hr>
          <table class="table table-borderless">
            <tr>
              <th>No.Rekening</th>
              <td>: <?=profile("no_rekening")?></td>
            </tr>

            <tr>
              <th>Nama Rekening</th>
              <td>: <?=profile("nama_rekening")?></td>
            </tr>

            <tr>
              <th>BANK</th>
              <td>: <?=bank(profile("id_bank"))?></td>
            </tr>

          </table>
        </div>
      </div>
    </div>


    <div class="col-md-10 mx-auto mb-2">
      <div class="card">
        <div class="card-body">
          <div class="">
            <h4 class="header-title float-left">Data Rekening</h4>
            <a class="btn btn-sm btn-warning float-right" href="<?=site_url("user/profile/edit_berkas")?>"><i class="fa fa-pencil"></i></a>
          </div>
          <div class="clearfix"></div>
          <hr>
          <table class="table table-borderless">
            <tr>
              <th>Foto Diri</th>
              <td>:
                <a class="fancy" href="<?=base_url("_template/files/user/")?>/<?=profile("id_reg")?>/<?=profile("foto_diri")?>"><i class="fa fa-image"></i> Lihat File</a>
              </td>
            </tr>

            <tr>
              <th>Foto KTP</th>
              <td>:
                <a class="fancy" href="<?=base_url("_template/files/user/")?>/<?=profile("id_reg")?>/<?=profile("foto_ktp")?>"><i class="fa fa-image"></i> Lihat File</a>
              </td>
            </tr>

            <tr>
              <th>FOTO Rekening</th>
              <td>:
                <a class="fancy" href="<?=base_url("_template/files/user/")?>/<?=profile("id_reg")?>/<?=profile("foto_buku_rekening")?>"><i class="fa fa-image"></i> Lihat File</a>
              </td>
            </tr>

          </table>
        </div>
      </div>
    </div>

    <div class="col-md-10 mx-auto mb-5">
      <a class="btn btn-sm btn-primary modal-reset" data-title="Reset Password" href="<?=site_url("user/config/reset_password")?>">Ganti PIN Transaksi</a>
      <a class="btn btn-sm btn-primary modal-reset" data-title="Reset PIN Transaksi" href="<?=site_url("user/config/reset_pin")?>">Ganti Password</a>
    </div>


  </div>
</div> <!-- Page content Wrapper -->
