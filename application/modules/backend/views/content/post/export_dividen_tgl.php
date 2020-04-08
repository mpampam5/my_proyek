<!DOCTYPE html>
<?php

 header("Content-type: application/vnd-ms-excel");
 header("Content-Disposition: attachment; filename= data-comission-".date('d-m-y H-i-s').".xls");

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

      <h2 ><?=strtoupper(setting_system("title"))?></h2>

      <p>DATA COMISSION (export tanggal <?=date('d/m/Y')?> jam <?=date('H:i:s')?>)<br>

      <?=strtoupper(setting_system("alamat"))?></p>

    </center>

    <div class="row">
        <table border="1" style="margin: 20px auto;border-collapse: collapse;">
            <tr style="background:#a70f0f;color:#ffffff">
              <th rowspan="2">No</th>
              <th rowspan="2">Tanggal Terima</th>
              <th colspan="4">Data Penerima</th>
              <th colspan="3">Data Investasi</th>
              <th colspan="2">Comission</th>
            </tr>
            <tr style="background:#a70f0f;color:#ffffff">

              <th>Data Member</th>
              <th>Nama Rekening</th>
              <th>No. Rekening</th>
              <th>Bank</th>
              <th>kode_invest</th>
              <th>Masa Kontrak</th>
              <th>Jumlah Investasi</th>
              <th>%</th>
              <th>Jumlah</th>
            </tr>
            <?php $no = 1;?>

            <?php foreach ($data->result() as $row): ?>
              <tr>
                <td><?=$no++?></td>
                <td><?=date("d-m-Y",strtotime($row->time_dividen))?></td>
                <td><?=$row->kode_person?> | <span style="mso-number-format:\@;"><?="$row->nik"?></span> | <?=$row->nama?> | <?=$row->username?> | <?=$row->level?></td>
                <td><?=$row->nama_rekening?></td>
                <td style="mso-number-format:\@;"><?=$row->no_rekening?></td>
                <td><?=strtoupper($row->bank)?></td>
                <td><?=$row->kode_invest?></td>
                <td><?=date("d-m-Y",strtotime($row->kontrak_start))?> s/d <?=date("d-m-Y",strtotime($row->kontrak_end))?></td>
                <td><?=$row->amount_invest?></td>
                <td><?=$row->persentase?></td>
                <td><?=$row->amount?></td>
              </tr>
          <?php endforeach; ?>


        </table>
    </div>

  </body>
</html>
