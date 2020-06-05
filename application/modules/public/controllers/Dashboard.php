<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Pbl{

  public function __construct()
  {
    parent::__construct();
    $this->load->model("Dashboard_model","model");
    $this->load->library("proyek");
    $this->load->helper("proyek");
  }

  function index()
  {
    $data['total_pendana']                  = $this->_rows_pendana();
    $data['total_proyek']                   = $this->_rows_proyek();
    $data['total_pendanaan_tahun_berjalan'] = $this->_rows_pendanaan_tahun_berjalan();
    $data['total_pendanaan']                = $this->_rows_pendanaan();
    $data['proyek_publish']                 = $this->model->proyek_publish();
    $this->template->set_title("Dashboard");
    $this->template->view("content/dashboard/index",$data);
  }

  function _rows_pendana()
  {
    $qry = $this->db->get_where("master_pendana",["is_verifikasi"=>"1", "complate" => "1"]);
    return $qry->num_rows();
  }


  function _rows_proyek()
  {
    $qry = $this->db->get_where("master_proyek",["status"=>"publish","complate" => "1"]);
    return $qry->num_rows();
  }

  function _rows_pendanaan()
  {
    $this->db->select("trans_penggalangan_dana.id_proyek,
                        SUM(trans_penggalangan_dana.total_rupiah) AS total,
                        trans_penggalangan_dana.`status`,
                        master_proyek.`status`");
    $this->db->from("trans_penggalangan_dana");
    $this->db->join("master_proyek","master_proyek.id_proyek = trans_penggalangan_dana.id_proyek");
    $this->db->where("master_proyek.`status`","publish");
    $this->db->where("trans_penggalangan_dana.`status`","approved");
    $qry = $this->db->get();
    return $qry->row()->total;
  }

  function _rows_pendanaan_tahun_berjalan()
  {
    $this->db->select("trans_penggalangan_dana.id_proyek,
                        SUM(trans_penggalangan_dana.total_rupiah) AS total,
                        trans_penggalangan_dana.`status`,
                        master_proyek.`status`");
    $this->db->from("trans_penggalangan_dana");
    $this->db->join("master_proyek","master_proyek.id_proyek = trans_penggalangan_dana.id_proyek");
    $this->db->where("master_proyek.`status`","publish");
    $this->db->where("trans_penggalangan_dana.`status`","approved");
    $this->db->where("year(trans_penggalangan_dana.date_join)",date("Y"));
    $qry = $this->db->get();
    return $qry->row()->total;
  }

}
