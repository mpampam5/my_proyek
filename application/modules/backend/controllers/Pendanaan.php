<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendanaan extends Backend{

  public function __construct()
  {
    parent::__construct();
    $this->load->model("Pendanaan_model","model");
  }

  function index()
  {
    $this->template->set_title("Penggalangan Dana");
    $this->template->view("content/pendanaan/index");
  }


  function json()
  {
    if ($this->input->is_ajax_request()) {
      $list = $this->model->get_datatables();
      $data = array();
      // $no = $_POST['start'];
      foreach ($list as $dt) {
          $row = array();
          $row[] = date("d/m/Y H:i",strtotime($dt->created_at));
          $row[] = '<b class="text-primary"><a href="'.site_url("backend/pendana/detail/".enc_url($dt->id_pendana)).'" target="_blank"><i class="fa fa-link"></i>'.$dt->id_reg.'</a></b> '.$dt->nama ;
          $row[] = format_rupiah($dt->total_rupiah);
          $row[] = 'PENDANAAN <b class="text-primary"><a href="'.site_url("backend/master_proyek/detail/".enc_url($dt->id_proyek)).'" target="_blank"><i class="fa fa-link"></i>'.$dt->kode.'</a></b>. '.strtoupper($dt->title).
                    '<p>Dana Yang Di Butuhkan : '.format_rupiah($dt->dana_dibutuhkan).'</p>'
                  ;
          if ($dt->status=="approved") {
            $row[]  = '<span class="badge badge-success">Approved</span>';
          }else {
            $row[]  = '<span class="badge badge-danger">Dana Dikembalikan</span>';
          }



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
