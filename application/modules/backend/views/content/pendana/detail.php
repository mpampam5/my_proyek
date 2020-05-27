<div class="wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-3 animated fadeInRight delay-2s">
          <div class="row">

            <div class="col-lg-12">
              <div class="card m-b-10 text-center">
                <div class="mb-2 card-body text-muted">
                    <h5 class="text-info">Rp.<?=format_rupiah(balance_user($dt->id_pendana))?></h5>
                    Total Saldo
                </div>
              </div>
            </div>

            <div class="col-lg-12">
              <div class="card m-b-30">
                <div class="card-body">
                  <ul class="list-group list-group-flush">
                    <!-- <li class="list-group-item"><a href="">Log Aktifitas Pendana</a></li> -->
                    <li class="list-group-item"><a href="">Lihat Pendanaan Aktif</a></li>
                    <li class="list-group-item"><a href="">Lihat Pendanaan Selesai</a></li>
                    <!-- <li class="list-group-item"><a href="">Lihat Mutasi Dompet</a></li> -->
                    <li class="list-group-item"><a href="">Reset Password</a></li>
                    <!-- <li class="list-group-item"><a href="">Reset PIN Transaksi</a></li> -->
                    <li class="list-group-item"><a href="">Nonaktifkan Pendana</a></li>
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
                    <h5 class="text-success">Rp.<?=format_rupiah($this->balance->get_deposito($dt->id_pendana))?></h5>
                    Total Deposit
                </div>
              </div>
            </div>

            <div class="col-md-12 col-xl-4 animated fadeInRight delay-4s">
              <div class="card m-b-10 text-center">
                <div class="mb-2 card-body text-muted">
                    <h5 class="text-danger">Rp.<?=format_rupiah($this->balance->get_withdraw($dt->id_pendana))?></h5>
                    Total Withdraw
                </div>
              </div>
            </div>

            <div class="col-md-12 col-xl-4 animated fadeInRight delay-5s">
              <div class="card m-b-10 text-center">
                <div class="mb-2 card-body text-muted">
                    <h5 class="text-primary">Rp.<?=format_rupiah($this->balance->get_pendanaan($dt->id_pendana))?></h5>
                    Total Omset
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
                        <td>: <?=$dt->tempat_lahir?>, <?=$dt->tgl_lahir?></td>
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
                        <th class="text-muted"> Status Kawin</th>
                        <td>: <?=$dt->status_perkawinan?></td>
                      </tr>


                      <tr>
                        <th class="text-muted"> Pendidikan Terakhir</th>
                        <td>: <?=$dt->pendidikan?></td>
                      </tr>

                      <tr>
                        <th class="text-muted"> Pekerjaan</th>
                        <td>: <?=$dt->pekerjaan?></td>
                      </tr>

                      <tr>
                        <th class="text-muted"> Pendapatan</th>
                        <td>: <?=$dt->pendapatan?></td>
                      </tr>

                      <tr>
                        <th class="text-muted"> Alamat</th>
                        <td>: <?=$dt->alamat?></td>
                      </tr>

                      <tr>
                        <th class="text-muted"> Provinsi</th>
                        <td>: Nama</td>
                      </tr>

                      <tr>
                        <th class="text-muted"> Kabupaten/kota</th>
                        <td>: Nama</td>
                      </tr>

                      <tr>
                        <th class="text-muted"> Kecamatan</th>
                        <td>: Nama</td>
                      </tr>

                      <tr>
                        <th class="text-muted"> Kelurahan/desa</th>
                        <td>: Nama</td>
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

            <!-- data berkas -->
            <style media="screen">
            .container-box {
              display: flex;
              flex-flow: row wrap;;
              }

              .container-box >div.box-file{
                background-color: #f1f1f1;
                background-position: center center!important;
                background-repeat: no-repeat!important;
                background-size: cover!important;
                width: 100px;
                height: 100px;
                margin: 10px;
                text-align: center;
              }

              .container-box >div.box-file:hover{
                cursor: zoom-in;
              }

              .container-box >div.box-file p{
                margin-top: 40px;
                font-weight: bold;
                color:#ff0026;
                line-height: 15px;
                font-size: 14px;
              }


            </style>
            <div class="col-md-12 col-xl-12 animated fadeInRight delay-8s">
              <div class="card m-b-30">
                <div class="mb-2 card-body text-muted">
                  <div class="container-box">
                    <div class="box-file" style="background:url('<?=base_url()?>_template/files/pendaftaran-calon-pengajar.jpg')">
                      <p>FOTO DIRI</p>
                    </div>

                    <div class="box-file" style="background:url('<?=base_url()?>_template/files/pendaftaran-calon-pengajar.jpg')">
                      <p>FOTO KTP</p>
                    </div>

                    <div class="box-file" style="background:url('<?=base_url()?>_template/files/pendaftaran-calon-pengajar.jpg')">
                      <p>FOTO DIRI & KTP</p>
                    </div>

                    <div class="box-file" style="background:url('<?=base_url()?>_template/files/donatur-menunggu-verifikasi1.png')">
                      <p>FOTO BUKU REKENING</p>
                    </div>

                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>


      </div>


    </div>
</div>
