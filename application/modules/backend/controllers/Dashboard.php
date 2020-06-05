<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Backend{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function index()
  {
    $data['total_pendana']              = $this->_rows_pendana();
    $data['total_penerima_dana']        = $this->_rows_penerima_dana();
    $data['total_proyek']               = $this->_rows_proyek();
    $data['total_pendaan_aktif']        = $this->_rows_pendanaan('approved');
    $data['total_pendaan_dikembalikan'] = $this->_rows_pendanaan('dikembalikan');
    $data['total_pendaan']              = $this->_rows_pendanaan();
    $data['total_deposit_pendana']      = $this->_rows_deposit_pendana();
    $data['total_withdraw_pendana']     = $this->_rows_withdraw_pendana();
    $data['aktivitas_pendanaan']        = $this->_aktivitas_pendanaan();
    $this->template->set_title("dashboard");
    $this->template->view("content/dashboard/index",$data);
  }

  function _rows_pendana()
  {
    $qry = $this->db->get_where("master_pendana",["is_verifikasi"=>"1", "complate" => "1"]);
    return $qry->num_rows();
  }

  function _rows_penerima_dana()
  {
    $qry = $this->db->get_where("master_penerima_dana",["is_active"=>"1","is_delete"=> "0", "complate" => "1"]);
    return $qry->num_rows();
  }

  function _rows_proyek()
  {
    $qry = $this->db->get_where("master_proyek",["status"=>"publish","complate" => "1"]);
    return $qry->num_rows();
  }

  function _rows_pendanaan($status="")
  {
    $this->db->select("trans_penggalangan_dana.id_proyek,
                        SUM(trans_penggalangan_dana.total_rupiah) AS total,
                        trans_penggalangan_dana.`status`,
                        master_proyek.`status`");
    $this->db->from("trans_penggalangan_dana");
    $this->db->join("master_proyek","master_proyek.id_proyek = trans_penggalangan_dana.id_proyek");
    $this->db->where("master_proyek.`status`","publish");
    if ($status!="") {
      $this->db->where("trans_penggalangan_dana.`status`","$status");
    }
    $qry = $this->db->get();
    return $qry->row()->total;
  }

  function _rows_deposit_pendana()
  {
    $qry = $this->db->query("SELECT SUM(nominal) AS nominal FROM deposito WHERE status='approved'");
    return $qry->row()->nominal;
  }

  function _rows_withdraw_pendana()
  {
    $qry = $this->db->query("SELECT SUM(nominal) AS nominal FROM withdraw WHERE status='approved'");
    return $qry->row()->nominal;
  }

  function _aktivitas_pendanaan()
  {
    $qry = $this->db->select("*")
                    ->from("aktivitas_pendanaan")
                    ->limit(20)
                    ->order_by("id","DESC")
                    ->get();
    return $qry;
  }


}
