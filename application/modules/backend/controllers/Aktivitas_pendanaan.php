<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aktivitas_pendanaan extends Backend{

  public function __construct()
  {
    parent::__construct();
    $this->load->model("Aktivitas_pendanaan_model","model");
  }

  function index()
  {
    $this->template->set_title("Aktivitas Pendanaan");
    $this->template->view("content/aktivitas_pendanaan/index");
  }

  function json()
  {
    if ($this->input->is_ajax_request()) {
      $list = $this->model->get_datatables();
      $data = array();
      // $no = $_POST['start'];
      foreach ($list as $dt) {
          $row = array();
          $row[] = date("d/m/Y H:i", strtotime($dt->created_at));
          $row[] = $dt->keterangan;
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

}
