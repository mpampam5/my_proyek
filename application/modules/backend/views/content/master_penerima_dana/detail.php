<div class="wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-3 animated fadeInRight delay-2s">
          <div class="row">

            <div class="col-lg-12">
              <div class="card m-b-10 text-center">
                <div class="mb-2 card-body text-muted">
                    <h3 class="text-info">Rp.<?=format_rupiah(balance_penerima_dana($dt->id_penerima_dana))?></h3>
                    Total Saldo
                </div>
              </div>
            </div>

            <div class="col-lg-12">
              <div class="card m-b-30">
                <div class="card-body">
                  <ul class="list-group list-group-flush">
                    <!-- <li class="list-group-item"><a href="">Log Aktifitas Pendana</a></li> -->
                    <!-- <li class="list-group-item"><a href="">Lihat Pendanaan Aktif</a></li>
                    <li class="list-group-item"><a href="">Lihat Pendanaan Selesai</a></li> -->
                    <!-- <li class="list-group-item"><a href="">Lihat Mutasi Dompet</a></li> -->
                    <li class="list-group-item"><a href="">Reset Password</a></li>
                    <!-- <li class="list-group-item"><a href="">Reset PIN Transaksi</a></li> -->
                    <!-- <li class="list-group-item"><a href="">Nonaktifkan Pendana</a></li> -->
                  </ul>
                </div>
              </div>
            </div>


          </div>
        </div>

        <div class="col-md-9">
          <div class="row">
            <div class="col-md-12 col-xl-4 animated fadeInRight delay-3s">
              <div class="card m-b-10 text-center">
                <div class="mb-2 card-body text-muted">
                    <h3 class="text-success"><?=penggalangan_publish($dt->id_penerima_dana)?></h3>
                    Penggalangan Publish
                </div>
              </div>
            </div>

            <div class="col-md-12 col-xl-4 animated fadeInRight delay-4s">
              <div class="card m-b-10 text-center">
                <div class="mb-2 card-body text-muted">
                    <h3 class="text-danger"><?=penggalangan_selesai($dt->id_penerima_dana)?></h3>
                    Penggalangan Selesai
                </div>
              </div>
            </div>

            <div class="col-md-12 col-xl-4 animated fadeInRight delay-5s">
              <div class="card m-b-10 text-center">
                <div class="mb-2 card-body text-muted">
                    <h3 class="text-primary"><?=penggalangan_publish($dt->id_penerima_dana)+penggalangan_selesai($dt->id_penerima_dana)?></h3>
                    Total Penggalangan Dana
                </div>
              </div>
            </div>




            <style media="screen">
            .tabless tr th{
              color:#222222;
              width: 250px;
              padding: 3px 3px 3px 3px;
              font-size: 14px;
            }
              .tabless tr td{
                color:#8a8a8a;
                padding: 3px 3px 3px 3px!important;
                font-size: 14px;
              }
            </style>
            <!-- DATA PERSON -->
            <div class="col-md-12 col-xl-12 animated fadeInRight delay-6s">
              <div class="card m-b-10">
                <div class="mb-2 card-body text-muted">
                    <table class="table table-borderless tabless">
                      <tr>
                        <th class="text-muted"> ID-REG</th>
                        <td>: <?=$dt->id_reg?></td>
                      </tr>

                      <tr>
                        <th class="text-muted"> No.KTP</th>
                        <td>: <?=$dt->no_ktp?></td>
                      </tr>

                      <tr>
                        <th class="text-muted"> Nama</th>
                        <td>: <?=$dt->nama?></td>
                      </tr>

                      <tr>
                        <th class="text-muted"> Tempat, Tgl lahir</th>
                        <td>: <?=$dt->tempat_lahir?>, <?=date('d-m-Y',strtotime($dt->tgl_lahir))?></td>
                      </tr>

                      <tr>
                        <th class="text-muted"> Email</th>
                        <td>: <?=$dt->email?></td>
                      </tr>

                      <tr>
                        <th class="text-muted"> Telepon</th>
                        <td>: <?=$dt->telepon?></td>
                      </tr>

                      <tr>
                        <th class="text-muted"> Provinsi</th>
                        <td>: <?=provinsi($dt->provinsi)?></td>
                      </tr>

                      <tr>
                        <th class="text-muted"> Kabupaten/kota</th>
                        <td>: <?=kabupaten($dt->kabupaten)?></td>
                      </tr>

                      <tr>
                        <th class="text-muted"> Alamat</th>
                        <td>: <?=$dt->alamat?></td>
                      </tr>

                    </table>
                </div>
              </div>
            </div>

            <div class="col-md-12 col-xl-12 animated fadeInRight delay-6s">
              <div class="card m-b-10">
                <div class="mb-2 card-body text-muted">
                    <table class="table table-borderless tabless">

                      <tr>
                        <th class="text-muted"> Nama Perusahaan</th>
                        <td>: <?=$dt->nama_perusahaan?></td>
                      </tr>

                      <tr>
                        <th class="text-muted">Bentuk Badan Usaha</th>
                        <td>: <?=$dt->bentuk_badan_usaha?></td>
                      </tr>



                      <tr>
                        <th class="text-muted"> Telepon Perusahaan</th>
                        <td>: <?=$dt->telepon_perusahaan?></td>
                      </tr>

                      <tr>
                        <th class="text-muted"> Alamat</th>
                        <td>: <?=$dt->alamat_perusahaan?></td>
                      </tr>


                      <tr>
                        <th class="text-muted"> File Badan Usaha</th>
                        <td>: <?=$dt->file_badan_usaha?></td>
                      </tr>

                      <tr>
                        <th class="text-muted"> File Perizinan</th>
                        <td>: <?=$dt->file_dokument_perizinan?></td>
                      </tr>

                    </table>
                </div>
              </div>
            </div>




            <!-- data rekening -->
            <div class="col-md-12 col-xl-12 animated fadeInRight delay-7s">
              <div class="card m-b-10">
                <div class="mb-2 card-body text-muted">
                    <table class="table table-borderless tabless">
                      <tr>
                        <th class="text-muted"> Nama Rekening</th>
                        <td>: <?=$dt->nama_rekening?></td>
                      </tr>

                      <tr>
                        <th class="text-muted"> No. Rekening</th>
                        <td>: <?=$dt->no_rekening?></td>
                      </tr>

                      <tr>
                        <th class="text-muted"> Bank</th>
                        <td>: <?=$dt->nama_bank?></td>
                      </tr>

                    </table>
                </div>
              </div>
            </div>



          </div>
        </div>


      </div>


    </div>
</div>
