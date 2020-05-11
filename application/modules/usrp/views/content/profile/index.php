<style media="screen">
  table tr th,td{
    padding:5px!important;
  }

  table tr th{
    color:#464646;
    width:200px;
  }

  table tr td{
    color:#949494;
  }
</style>

<div class="page-content-wrapper">
  <div class="container-fluid">
    <div class="col-md-10 mx-auto mb-5">
      <div class="card">
        <div class="card-body">
          <h4 class="header-title">Data Perusahaan</h4>
          <hr>
          <table class="table table-borderless mb-5">
            <tr>
              <th>ID-REG</th>
              <td>: <?=$dt->id_reg?></td>
            </tr>

            <tr>
              <th>Nama Perusahaan</th>
              <td>: <?=$dt->nama_perusahaan?></td>
            </tr>

            <tr>
              <th>Bidang Usaha</th>
              <td>: <?=$dt->bidang_usaha?></td>
            </tr>

            <tr>
              <th>Bentuk Badan Usaha</th>
              <td>: <?=$dt->bentuk_badan_usaha?></td>
            </tr>


            <tr>
              <th>Telepon Perusahaan</th>
              <td>: <?=$dt->telepon_perusahaan?></td>
            </tr>

            <tr>
              <th>Provinsi</th>
              <td>: <?=ucwords(provinsi($dt->provinsi))?></td>
            </tr>

            <tr>
              <th>Kabupaten</th>
              <td>: <?=ucwords(kabupaten($dt->kabupaten))?></td>
            </tr>

            <tr>
              <th>Alamat Lengkap Perusahaan</th>
              <td>: <?=$dt->alamat_perusahaan?></td>
            </tr>

            <tr>
              <td colspan="2">
                <a href="#" class="btn btn-sm btn-warning" style="margin-top:10px;">Edit Data Perusahaan</a>
              </td>
            </tr>

          </table>


          <h4 class="header-title">Data Penanggung Jawab</h4>
          <hr>
          <table class="table table-borderless mb-5">
            <tr>
              <th>No.KTP</th>
              <td>: <?=$dt->no_ktp?></td>
            </tr>

            <tr>
              <th>Nama Penanggung Jawab</th>
              <td>: <?=$dt->nama?></td>
            </tr>

            <tr>
              <th>Tempat, Tgl Lahir</th>
              <td>: <?=$dt->tempat_lahir?>, <?=date("d-m-Y",strtotime($dt->tgl_lahir))?></td>
            </tr>

            <tr>
              <th>Email</th>
              <td>: <?=$dt->email?></td>
            </tr>

            <tr>
              <th>Telepon</th>
              <td>: <?=$dt->telepon?></td>
            </tr>

            <tr>
              <th>Alamat</th>
              <td>: <?=$dt->alamat?></td>
            </tr>

            <tr>
              <td colspan="2">
                <a href="#" class="btn btn-sm btn-warning" style="margin-top:10px;">Edit Data Penanggung Jawab</a>
              </td>
            </tr>

          </table>

          <h4 class="header-title">Data Rekening</h4>
          <hr>
          <table class="table table-borderless mb-5">
            <tr>
              <th>No.Rekening</th>
              <td>: <?=$dt->no_rekening?></td>
            </tr>

            <tr>
              <th>Nama Rekening</th>
              <td>: <?=$dt->nama_rekening?></td>
            </tr>

            <tr>
              <th>BANK</th>
              <td>: <?=bank($dt->bank)?></td>
            </tr>

            <tr>
              <td colspan="2">
                <a href="#" class="btn btn-sm btn-warning" style="margin-top:10px;">Edit Data Rekening</a>
              </td>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </div>
</div> <!-- Page content Wrapper -->
