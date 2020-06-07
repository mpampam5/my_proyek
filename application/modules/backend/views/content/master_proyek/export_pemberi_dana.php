<!DOCTYPE html>
<?php
 
 header("Content-type: application/vnd-ms-excel");
 header("Content-Disposition: attachment; filename=data-pemberi-dana-proyek-".$dt->kode."-".date('d-m-y H-i-s').".xls");


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
    $total_dana = $dt->dana_dibutuhkan; //dana di butuhkan
    $dana_terkumpul = $this->proyek->total_dana_terkumpul($dt->id_proyek);
    $persen = cari_persen($total_dana,$dana_terkumpul);
    $no = 1;
   ?>
  <body style="background-color:none!important;">
    <center>

      <h1 ><?=strtoupper(config_system("title"))?></h1>
      <h3>DATA PEMBERI DANA PADA PROYEK <?=$dt->kode?> <?=strtoupper($dt->title)?></h3>
      <p>(export tanggal <?=date('d/m/Y')?> jam <?=date('H:i:s')?>)<br>


    </center>

    <table>
      <tr>
        <th>Kode</th>
        <td>: <?=$dt->kode?></td>
      </tr>

      <tr>
        <th>Title</th>
        <td>: <?=$dt->title?></td>
      </tr>

      <tr>
        <th>Dana Dibutuhkan</th>
        <td>: Rp.<?=format_rupiah($dt->dana_dibutuhkan)?></td>
      </tr>

      <tr>
        <th>Total Dana Terkumpul</th>
        <td>: Rp.<?=format_rupiah($dana_terkumpul)?> (<?=$persen?>%)</td>
      </tr>
    </table>

    <div class="row">
        <table border="1" style="margin: 20px auto;border-collapse: collapse;">
            <tr>
              <th>No</th>
              <th>Waktu Pendanaan</th>
              <th>Penggalangan</th>
              <th>Data Pendana</th>
              <th>Jumlah Pendanaan (Rp)</th>
            </tr>

            <?php
              $qry = $this->db->query("SELECT
                                        trans_penggalangan_dana.id_penggalangan_dana_proyek,
                                        trans_penggalangan_dana.id_proyek,
                                        trans_penggalangan_dana.id_pendana,
                                        trans_penggalangan_dana.jumlah_paket,
                                        trans_penggalangan_dana.total_rupiah,
                                        trans_penggalangan_dana.join_hari_ke,
                                        trans_penggalangan_dana.`status`,
                                        trans_penggalangan_dana.date_join,
                                        trans_penggalangan_dana.created_at,
                                        master_pendana.id_reg,
                                        master_pendana.no_ktp,
                                        master_pendana.nama,
                                        master_pendana.email
                                        FROM
                                        trans_penggalangan_dana
                                        INNER JOIN master_pendana ON master_pendana.id_pendana = trans_penggalangan_dana.id_pendana
                                        WHERE
                                        trans_penggalangan_dana.id_proyek = $dt->id_proyek");
            ?>

            <?php foreach ($qry->result() as $rw): ?>
              <tr>
                <td><?=$no++?></td>
                <td><?=date("d/m/Y",strtotime($rw->date_join))?></td>
                <td>Hari Ke - <?=$rw->join_hari_ke?></td>
                <td>** <?=$rw->id_reg?><br>
                    ** <?=$rw->nama?><br>
                    ** <?=$rw->no_ktp?><br>
                    ** <?=$rw->email?>
                </td>
                <td><?=$rw->total_rupiah?></td>
              </tr>
            <?php endforeach; ?>


        </table>
    </div>

  </body>
</html>
