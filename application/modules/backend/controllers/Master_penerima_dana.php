<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_penerima_dana extends Backend{

  public function __construct()
  {
    parent::__construct();
    $this->load->model("Master_penerima_dana_model","model");
  }

  function index()
  {
    $this->template->set_title("Daftar Penerima Dana");
    $this->template->view("content/master_penerima_dana/index");
  }

  function json()
  {
    if ($this->input->is_ajax_request()) {
      $list = $this->model->get_datatables();
      $data = array();
      // $no = $_POST['start'];
      foreach ($list as $dt) {
          $row = array();
          $row[] = "<b>$dt->id_reg</b>";
          $row[] = $dt->no_ktp;
          $row[] = $dt->nama;
          $row[] = $dt->email;
          $row[] = $dt->nama_perusahaan;
          $row[] = '
                      <a href="'.site_url("backend/master_penerima_dana/detail/".enc_url($dt->id_penerima_dana)).'" class="btn btn-info btn-sm" title="detail"><i class="fa fa-file"></i></a>
                   ';

          $data[] = $row;
      }

      $output = array(
                      "draw" => $_POST['draw'],
                      "recordsTotal" => $this->model->count_all(),
                      "recordsFiltered" => $this->model->count_filtered(),
                      "data" => $data,
              );
      //output to json format
      echo json_encode($output);
    }
  }


  function detail($id="")
  {
    if ($row = $this->model->get_detail_model(dec_url($id))) {
      $this->template->set_title("Detail Penerima Dana #$row->id_reg");
      $data['dt'] = $row;
      $this->template->view("content/master_penerima_dana/detail",$data);
    }
  }

}
