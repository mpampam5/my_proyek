<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Deposito_usrp extends Backend{

  public function __construct()
  {
    parent::__construct();
    $this->load->model("Deposito_usrp_model","model");
  }

  function index()
  {
    $this->template->set_title("Daftar Deposit Penerima Dana");
    $this->template->view("content/deposito_usrp/index");
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
          $row[] = "<b>$dt->code</b>";
          $row[] = '<a href="'.site_url("backend/pendana/detail/".enc_url($dt->id_penerima_dana)).'" target="_blank"><b><i class="fa fa-link"></i> '.$dt->id_reg.'</b></a>&nbsp;'.$dt->nama;
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
          $row[] = $dt->kode_unik;

          $row[] = '
                      <a href="'.site_url("backend/deposito_usrp/detail/".enc_url($dt->id_deposito)).'" class="btn btn-info btn-sm" title="detail"><i class="fa fa-file"></i></a>
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
      $this->template->set_title("Detail Deposit Penerima Dana #$row->code");
      $data['dt'] = $row;
      $this->template->view("content/deposito_usrp/detail",$data);
    }
  }

function action()
{
  if ($this->input->is_ajax_request()) {
        $json = array('success'=>false, 'alert'=>array());
        $this->form_validation->set_rules("id_act","*&nbsp;","trim|xss_clean|required");
        $this->form_validation->set_rules("status_approved","*&nbsp;","trim|xss_clean|required|callback__cek_status");
        $this->form_validation->set_rules("keterangan","*&nbsp;","trim|xss_clean");
        $this->form_validation->set_rules("password_admin","*&nbsp;","trim|xss_clean|required|callback__cek_password");
        $this->form_validation->set_error_delimiters('<span class="error text-danger" style="font-size:11px">','</span>');
        if ($this->form_validation->run()) {
          $id_act = dec_url($this->input->post("id_act"));
          if ($row = $this->model->get_detail_model($id_act)) {
            //update
            $update = array('status' => $this->input->post('status_approved',true),
                            'keterangan' => $this->input->post('keterangan',true),
                            'acc_by' => "admin",
                            'acc_by_id' => sess("id_user"),
                            'acc_at' => date('Y-m-d H:i:s'),
                          );

            $this->model->get_update("deposito_usrp",$update,["id_deposito"=>$id_act]);


            // set report mutasi
            // if ($this->input->post('status_approved',true)=="approved") {
            //   $report = array('id_pendana' => $row->id_pendana,
            //                   'type' => "deposito",
            //                   'id_transaksi' => $row->id_deposito,
            //                   'kd_transaksi' => $row->code ,
            //                   'kredit' => $row->nominal,
            //                   'saldo' => $this->balance->init($row->id_pendana),
            //                   'deskripsi' => "DEPOSITO [".$row->code."] ke BANK ".rekening($row->id_rekening,"nama_bank")." - ".rekening($row->id_rekening,"no_rekening"),
            //                   'created_at' => date('Y-m-d H:i:s'),
            //                   );
            //   $this->model->get_insert("report_mutasi",$report);
            // }

            $json['alert'] = "process successfully";
          }else {
            $json['alert'] = "process error";
          }

          $json['success'] =  true;
        }else {
          foreach ($_POST as $key => $value)
            {
              $json['alert'][$key] = form_error($key);
            }
        }

        echo json_encode($json);
    }
}



function _cek_status($str)
{
  $status = array("approved","cancel");
  if (in_array($str,$status)) {
    return true;
  }else {
    $this->form_validation->set_message('_cek_status', '*&nbsp; status tidak valid');
    return FALSE;
  }
}








}
