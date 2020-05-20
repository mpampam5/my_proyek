<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Withdraw extends User{

  public function __construct()
  {
    parent::__construct();
    $this->load->model("Withdraw_model","model");
  }

  function index()
  {
    $this->template->set_title("Withdraw");
    $this->template->view("content/withdraw/index");
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
          if ($dt->status=="process") {
            $row[] = '<span class="badge badge-warning text-white">Proses</span>';
          }elseif ($dt->status=="approved") {
            $row[] = '<span class="badge badge-success">Approved</span>';
          }elseif ($dt->status=="cancel") {
            $row[] = '<span class="badge badge-danger">Cancel</span>';
          }else {
            $row[] = ' - ';
          }
          $row[] = "Rp.".format_rupiah($dt->nominal);
          if ($dt->status=="process" OR $dt->status=="cancel") {
            $row[] = '
                        <a href="'.site_url("user/withdraw/delete/".enc_url($dt->id_withdraw)).'" class="btn btn-danger btn-sm" title="delete" id="hapus"><i class="fa fa-trash"></i></a>
                     ';
          }else {
            $row[] = "";
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


  function add()
  {
    $this->template->set_title("Add Withdraw");
    $this->template->view("content/withdraw/form");
  }


  function add_action()
  {
    if ($this->input->is_ajax_request()) {
      $json = array('success'=>false, 'alert'=>array());
      $this->form_validation->set_rules("nominal","*&nbsp;","trim|xss_clean|required|callback__cek_wd");
      $this->form_validation->set_rules("pin","*&nbsp;","trim|xss_clean|numeric|required|callback__cek_pin");
      $this->form_validation->set_error_delimiters('<span class="error text-danger" style="font-size:11px">','</span>');
      if ($this->form_validation->run()) {
        $data = array('code' => $this->_code(),
                      'id_pendana' => sess("id_user"),
                      'nominal' => replace_rupiah($this->input->post("nominal")),
                      'status' => "process",
                      'created_at' => date("Y-m-d H:i:s")
                      );
        $this->db->insert("withdraw",$data);

        $json['alert'] = "Withdraw Berhasil ditambahkan, selanjutnya menunggu verifikasi";
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

  function _cek_wd($str)
  {
    $strs = replace_rupiah($str);
    if ($strs > $this->balance_user->init()) {
      $this->form_validation->set_message("_cek_wd","*&nbsp; Saldo tidak mencukupi. Sisa Saldo Rp.".format_rupiah($this->balance_user->init()));
      return false;
    }else {
      if ($strs < master_config("WD-MIN")) {
        $this->form_validation->set_message("_cek_wd","*&nbsp; Minmal Withdraw Rp.".format_rupiah(master_config("DP-MIN")));
        return false;
      }elseif ($strs > master_config("WD-MAX")) {
        $this->form_validation->set_message("_cek_wd","*&nbsp; Maksimal Withdraw Rp.".format_rupiah(master_config("DP-MAX")));
        return false;
      }else {
        return true;
      }
    }
  }

  function _code()
  {
    $q = $this->db->query("SELECT MAX(RIGHT(code,7)) AS kd_trans FROM withdraw ORDER BY id_withdraw DESC LIMIT 1");
          $kd = "";
          if($q->num_rows()>0){
              foreach($q->result() as $k){
                  $tmp = ((int)$k->kd_trans)+1;
                  $kd = sprintf("%07s", $tmp);
              }
          }else{
              $kd = "0000001";
          }
          return "WD-".$kd;
  }


  function delete($id)
  {
    if ($this->input->is_ajax_request()) {
      $this->db->delete("withdraw",["id_withdraw" => dec_url($id), "id_pendana"=>sess("id_user")]);
      $data = array("message" => "berhasil di hapus");
      echo json_encode($data);
    }
  }


}
