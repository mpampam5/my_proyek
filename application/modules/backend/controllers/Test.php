<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function get($id=null)
  {
    $this->db->select("trans_penggalangan_dana.id_penggalangan_dana_proyek,
                              trans_penggalangan_dana.id_proyek,
                              trans_penggalangan_dana.id_pendana,
                              trans_penggalangan_dana.jumlah_paket,
                              trans_penggalangan_dana.total_rupiah,
                              trans_penggalangan_dana.join_hari_ke,
                              trans_penggalangan_dana.`status`,
                              trans_penggalangan_dana.date_join,
                              trans_penggalangan_dana.created_at,
                              master_proyek.kode,
                              master_proyek.title,
                              master_pendana.id_reg,
                              master_pendana.no_ktp,
                              master_pendana.nama");
              $this->db->from("trans_penggalangan_dana");
              $this->db->join("master_proyek","master_proyek.id_proyek = trans_penggalangan_dana.id_proyek");
              $this->db->join("master_pendana","master_pendana.id_pendana = trans_penggalangan_dana.id_pendana");
              if ($id!=null) {
                $this->db->where("trans_penggalangan_dana.id_pendana=$id");
              }
              $qry = $this->db->get();

    print_r($qry->result_array());
  }


  function cek_1($nisn)
  {
    if ($nisn=="11") {
      echo 'true';
    }else {
      echo 'false';
    }
  }


  function cek_2($nisn)
  {
    if ($nisn=="22") {
      echo 'true';
    }else {
      echo 'false';
    }
  }




}
