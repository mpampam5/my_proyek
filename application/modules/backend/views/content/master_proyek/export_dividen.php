<!DOCTYPE html>
<?php

 header("Content-type: application/vnd-ms-excel");
 header("Content-Disposition: attachment; filename=DATA-DIVIDEN-PADA-PROYEK-proyek-".$dt->kode."-".date('d-m-y H-i-s').".xls");


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

  <?php
    $no = 1;
   ?>
  <body style="background-color:none!important;">
    <center>

      <h1 ><?=strtoupper(config_system("title"))?></h1>
      <h3>DATA DIVIDEN PADA PROYEK <?=$kode?> <?=strtoupper(get_proyek(dec_url($id_proyek),"title"))?></h3>
      <p>(export tanggal <?=date('d/m/Y')?> jam <?=date('H:i:s')?>)<br>


    </center>

<h3>Data Proyek</h3>
    <table>
      <tr>
        <th>Kode</th>
        <td>: <?=$kode?></td>
      </tr>

      <tr>
        <th>Title</th>
        <td>: <?=get_proyek(dec_url($id_proyek),"title")?></td>
      </tr>

      <tr>
        <th>Dana Dibutuhkan</th>
        <td>: Rp.<?=format_rupiah(get_proyek(dec_url($id_proyek),"dana_dibutuhkan"))?></td>
      </tr>
    </table>
    <hr>

    <h3>Data Pendana</h3>
    <table>
      <tr>
        <th>ID.REG</th>
        <td>:<?=get_user(dec_url($id_pendana),"id_reg")?></td>
      </tr>

      <tr>
        <th>Nama</th>
        <td>: <?=get_user(dec_url($id_pendana),"nama")?></td>
      </tr>

      <tr>
        <th>No.KTP</th>
        <td>: <?=get_user(dec_url($id_pendana),"no_ktp")?></td>
      </tr>

      <tr>
        <th>Email</th>
        <td>: <?=get_user(dec_url($id_pendana),"email")?></td>
      </tr>
    </table>

    <div class="row">
        <table border="1" style="margin: 20px auto;border-collapse: collapse;">
            <tr>
              <th>No</th>
              <th>Waktu Pembagian</th>
              <th>Profit Ke</th>
              <th>Modal Pendanaan</th>
              <th>Dividen Bulanan</th>
              <th>Bonus Penggalangan</th>
              <th>Sisa Imbal Hasil</th>
              <th>Status</th>
              <th>Total</th>
            </tr>

            <?php foreach ($prs->result() as $pr): ?>
              <tr>
                <td><?=$no++?></td>
                <td><?=date("d/m/Y",strtotime($pr->waktu_pembagian))?></td>
                <td class="text-center">Profit ke-<?=$no++?></td>
                <td><?=$pr->pendanaan?></td>
                <td><?=$pr->nominal_rupiah?></td>
                <td><?=$pr->penggalangan?></td>
                <td><?=$pr->sisa_imbal_hasil?></td>
                <td class="text-center">
                  <?php if ($pr->status_profit == 1): ?>
                    <span class="badge badge-success"> Telah Di Bagikan</span>
                    <?php else: ?>
                      <span class="badge badge-danger"> Belum Di Bagikan</span>
                  <?php endif; ?>
                </td>
                <td><?=$pr->total?></td>
              </tr>

              <?php $total[] = $pr->total; ?>
            <?php endforeach; ?>
            <tr>
              <td colspan="8" class="text-right"><b>Total Dividen :</b></td>
              <td><b><?=array_sum($total)?></b></td>
            </tr>






        </table>
    </div>

  </body>
</html>
