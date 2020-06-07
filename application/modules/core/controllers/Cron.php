<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cron extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->helper(array("public","proyek"));
    $this->load->library("proyek");
    $this->load->model("Cron_model","model");
  }

  //// QUOTES ////
  //// SELAMAT BERAKTIFITAS AYA' , SEMOGA HARINYA MENYENANGKAN !!!
  //// *** SEMANGAT ANAK MUDA!!! :) :)
  //// JANGAN RINDU, BERAT... WKWKKWKWKWKWKWKWKWKKWKWKWKKWKKWKWKWKWK



  // maintenance akun user jam 23.57 setiap hari
  function maintenance_on()
  {
    $this->model->get_update("config_system",['status'=>'1'], ['id'=>999]);
  }

  // matikan maintenance akun user jam 02.00 setiap hari
  function maintenance_off()
  {
    $this->model->get_update("config_system",['status'=>'1'], ['id'=>999]);
  }

  //set jam 12.00
  function execute()
  {
    //hapus master proyek yang complate 0
    $this->db->where("complate","0");
    $this->db->delete("master_proyek");

    $tgl = date("Y-m-d");

    $qry = $this->db->get_where("master_proyek",["complate" => "1", "tgl_mulai_proyek" => $tgl]);
    if ($qry->num_rows() > 0) {
      foreach ($qry->result() as $row) {
        $total_dana = $row->dana_dibutuhkan; //dana di butuhkan
        $dana_terkumpul = $this->proyek->total_dana_terkumpul($row->id_proyek);
        $persen = cari_persen($total_dana,$dana_terkumpul);
        if ($persen < master_config("FINANCIAL-PD")) {
          //update data master proyek
          $data = array('keterangan'  => $this->input->post("keterangan",true),
                        'status'      => "unapproved",
                        'acc_by_id'   => sess("id_user"),
                        'acc_at'      => date("Y-m-d H:i:s")
                        );
          $this->model->get_update("master_proyek",$data,['id_proyek' => $row->id_proyek]);

          // update data trans_penggalangan dana
          $data_2 = array('status' => "dikembalikan");
          $this->model->get_update("trans_penggalangan_dana",$data_2,['id_proyek' => $row->id_proyek]);

          // update data profit/dividen
          $data_3 = array('status' => null);
          $this->model->get_update("trans_profit",$data_3,['id_proyek' => $row->id_proyek]);
          //tambah aktivitas pendanaan
          $keterangan = 'Dana yang terkumpul pada proyek <i>#'.$row->kode.'</i> telah di kembalikan pada masing-masing pendana karena, dana yang terkumpul di bawah '.master_config("FINANCIAL-PD").'% <i>'.$data['keterangan'].'</i>. (Pengembalian otomatis oleh system)';
          aktivitas_pendanaan($keterangan);

        }else {
          //update status pembagian dividen mulai
          $this->model->get_update("master_proyek",['status_penggalangan'=>'selesai','status_pembagian_dividen'=>'mulai'], ["id_proyek" => $row->id_proyek]);
          //tambah aktivitas pendanaan
          $keterangan = "Pembagian Dividen ke pendana pada Proyek <i>#$row->kode</i> telah di mulai.";
          aktivitas_pendanaan($keterangan);
        }
      }
    }

  }

  //set jam 12:30
  //pembagian DIVIDEN
  function execute_2()
  {
    $tgl = date("Y-m-d");

    $qry = $this->db->query("SELECT
                            trans_profit.id_trans_profit,
                            trans_profit.id_trans_pendanaan_proyek,
                            trans_profit.waktu_pembagian,
                            trans_profit.status,
                            trans_penggalangan_dana.status
                            FROM
                            trans_profit
                            INNER JOIN trans_penggalangan_dana ON trans_penggalangan_dana.id_penggalangan_dana_proyek = trans_profit.id_trans_pendanaan_proyek
                            WHERE trans_penggalangan_dana.status = 'approved'
                            AND
                            waktu_pembagian = '$tgl'");
    if ($qry->num_rows() > 0) {
      foreach ($qry->result() as $row) {
        $this->model->get_update("trans_profit",["status" => 1], ["id_trans_profit" => $row->id_trans_profit]);
      }
    }
  }

  //set jam 12:30
  //pembagian set proyek selesai (pembagian dividen selesai)
  function execute_3()
  {
    $tgl = date("Y-m-d");

    $qry = $this->db->get_where("master_proyek",["complate" => "1", "tgl_selesai_proyek" => $tgl]);
    if ($qry->num_rows() > 0) {
      foreach ($qry->result() as $row) {
        $this->model->get_update("master_proyek",["status_pembagian_dividen" => "selesai"], ["id_proyek" => $row->id_proyek]);
        $keterangan = "Pembagian Dividen pada Proyek <i>#$row->kode</i> telah selesai.";
        aktivitas_pendanaan($keterangan);
      }
    }
  }

}
