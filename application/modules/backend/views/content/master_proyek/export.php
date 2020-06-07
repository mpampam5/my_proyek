<!DOCTYPE html>
<?php
 //
 header("Content-type: application/vnd-ms-excel");
 header("Content-Disposition: attachment; filename=data-proyek-".date('d-m-y H-i-s').".xls");


  ?>

<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <style media="screen">
      table tr th{
        padding:5px;
      }
    </style>
  </head>
  <body style="background-color:none!important;">
    <center>

      <h1 ><?=strtoupper(config_system("title"))?></h1>
      <h3>DATA PROYEK </h3>
      <p>(export tanggal <?=date('d/m/Y')?> jam <?=date('H:i:s')?>)<br>


    </center>

    <div class="row">
        <table border="1" style="margin: 20px auto;border-collapse: collapse;">
            <tr>
              <th>No</th>
              <th>Tanggal Bergabung</th>
              <th>Kode</th>
              <th>title</th>
              <th>Pemilik Proyek</th>
              <th>Dana Dibutuhkan</th>
              <th>Mulai Penggalangan</th>
              <th>akhir Penggalangan</th>
              <th>tgl mulai proyek</th>
              <th>tgl akhir proyek</th>
              <th>Durasi Proyek</th>
              <th>Imbal hasil Pendana</th>
              <th>Ujroh penyelenggara</th>
              <th>Imbal Hasil</th>
              <th>status</th>
              <th>status_penggalangan</th>
              <th>status_pembagian_dividen</th>
              <th>Dana Terkumpul</th>
            </tr>

            <?php $no = 1; ?>
            <?php foreach ($dt->result() as $dt): ?>
              <?php
              $dana_terkumpul = $this->proyek->total_dana_terkumpul($dt->id_proyek);
              $persen = cari_persen($dt->dana_dibutuhkan,$dana_terkumpul);
               ?>
              <tr>
                <td><?=$no++?></td>
                <td><?=$dt->created_at?></td>
                <td><?=$dt->kode?></td>
                <td><?=$dt->title?></td>
                <td>** <?=$dt->nama?> <br>**<?=$dt->nama_perusahaan?> <br>** <?=$dt->email?></td>
                <td><?=$dt->dana_dibutuhkan?></td>
                <td><?=$dt->mulai_penggalangan?></td>
                <td><?=$dt->akhir_penggalangan?></td>
                <td><?=$dt->tgl_mulai_proyek?></td>
                <td><?=$dt->tgl_selesai_proyek?></td>
                <td><?=$dt->durasi_proyek?></td>
                <td><?=$dt->imbal_hasil_pendana?>%</td>
                <td><?=$dt->ujroh_penyelenggara?>%</td>
                <td><?=$dt->imbal_hasil?>%</td>
                <td><?=$dt->status?></td>
                <td><?=$dt->status_penggalangan?></td>
                <td><?=$dt->status_pembagian_dividen?></td>
                <td><?=$dana_terkumpul?> (<?=$persen?>%)</td>
              </tr>
            <?php endforeach; ?>
        </table>
    </div>

  </body>
</html>
