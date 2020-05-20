<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendanaan extends User{

  public function __construct()
  {
    parent::__construct();
    $this->load->model("Pendanaan_model","model");
    $this->load->library("proyek");
    $this->load->helper("proyek");
  }

  function index()
  {
    $this->template->set_title("Pendanaan Anda");
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
          $row[] = date("d/m/Y H:i", strtotime($dt->created_at));
          $row[] = format_rupiah($dt->total_rupiah);
          $row[] = "Pendanaan <b>".$dt->kode."</b>. ".ucfirst($dt->title);
          if ($dt->status=="approved") {
            $row[] = '<span class="badge badge-success"> Approved</span>';
          }else {
            $row[] = '<span class="badge badge-warning text-white"> Dana Di Kembalikan</span>';
          }
          $row[] = '<a href="'.site_url("user/pendanaan/detail/".enc_url($dt->id_penggalangan_dana_proyek)."/".$dt->kode).'" class="btn btn-sm btn-primary"><i class="fa fa-file"></i></a>';
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



  function detail($id_penggalangan_dana_proyek = null , $kode = null)
  {
    if ($row = $this->model->get_detail($id_penggalangan_dana_proyek,$kode)) {
      $this->template->set_title("Detail Pendanaan Proyek #$kode");
      $dt['dt'] = $row;
      $this->template->view("content/pendanaan/detail",$dt);
    }
  }

}
