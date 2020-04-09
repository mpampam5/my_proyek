<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Deposito extends Backend{

  public function __construct()
  {
    parent::__construct();
    $this->load->model("Deposito_model","model");
  }

  function index()
  {
    $this->template->set_title("Daftar Deposito");
    $this->template->view("content/deposito/index");
  }


  function json()
  {
    if ($this->input->is_ajax_request()) {
      $list = $this->model->get_datatables();
      $data = array();
      // $no = $_POST['start'];
      foreach ($list as $dt) {
          $row = array();
          $row[] = date("d/m/Y H:i:s", strtotime($dt->created_at));
          $row[] = "<b>$dt->code</b>";
          $row[] = '<a href=""><b>'.$dt->id_reg.'</b></a>&nbsp;'.$dt->nama;
          if ($dt->status=="process") {
            $row[] = '<span class="badge badge-warning text-white">Waithing</span>';
          }elseif ($dt->status=="approved") {
            $row[] = '<span class="badge badge-success">Approved</span>';
          }elseif ($dt->status=="cancel") {
            $row[] = '<span class="badge badge-danger">Cancel</span>';
          }else {
            $row[] = ' - ';
          }
          $row[] = "Rp.".format_rupiah($dt->nominal);
          $row[] = $dt->nominal_acc!="" ? "Rp.".format_rupiah($dt->nominal_acc) :" <i>Null</i> ";

          $row[] = '
                      <a href="'.site_url("backend/deposito/detail/".enc_url($dt->id_deposito)).'" class="btn btn-info btn-sm" title="detail"><i class="fa fa-file"></i></a>
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
      $this->template->set_title("Detail Deposito #$row->code");
      $data['dt'] = $row;
      $this->template->view("content/deposito/detail",$data);
    }
  }
}
