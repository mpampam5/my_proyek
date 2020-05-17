<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends MY_Model{

  function proyek_publish()
  {
    $qry =  $this->db->select(" master_proyek.id_proyek,
                                master_proyek.kode,
                                master_proyek.title,
                                master_proyek.harga_paket,
                                master_proyek.jumlah_paket,
                                master_proyek.durasi_proyek,
                                master_proyek.imbal_hasil_pendana,
                                master_proyek.ujroh_penyelenggara,
                                master_proyek.foto_1,
                                master_proyek.`status`,
                                master_proyek.status_penggalangan,
                                master_proyek.akhir_penggalangan,
                                master_proyek.complate")
                      ->from("master_proyek")
                      ->where("master_proyek.`status`","publish")
                      ->where("master_proyek.status_penggalangan","mulai")
                      ->where("master_proyek.complate","1")
                      ->order_by("master_proyek.created_at","DESC")
                      ->limit(3)
                      ->get();
    return $qry->result();

  }

}
