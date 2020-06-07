<!DOCTYPE html>
<?php
 //
 header("Content-type: application/vnd-ms-excel");
 header("Content-Disposition: attachment; filename=data-deposit-".date('d-m-y H-i-s').".xls");


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
      <h3>DATA DEPOSIT</h3>
      <p>(export tanggal <?=date('d/m/Y')?> jam <?=date('H:i:s')?>)<br>


    </center>

    <div class="row">
        <table border="1" style="margin: 20px auto;border-collapse: collapse;">
            <tr>
              <th>No</th>
              <th>DATE REQUEST</th>
              <th>CODE-TRANSAKSI</th>
              <th>PENDANA</th>
              <th>STATUS</th>
              <th>AMOUNT REQUEST</th>
              <th>KODE-UNIK</th>
            </tr>

            <?php $no = 1; ?>
            <?php foreach ($dt->result() as $dt): ?>
              <tr>
                <td><?=$no++?></td>
                <td><?=date("d/m/Y H:i",strtotime($dt->created_at))?></td>
                <td><?=$dt->code?></td>
                <td>**<?=$dt->id_reg?><br>
                    **<?=$dt->nama?><br>
                    **<?=$dt->no_ktp?><br>
                    **<?=$dt->email?>
                </td>
                <td><?=$dt->status?></td>
                <td><?=$dt->nominal?></td>
                <td><?=$dt->kode_unik?></td>
              </tr>
            <?php endforeach; ?>


        </table>
    </div>

  </body>
</html>
