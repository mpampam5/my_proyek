<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Deposit extends Usrp{

  public function __construct()
  {
    parent::__construct();
    $this->load->model("Deposit_model","model");
  }

  function index()
  {
    $this->template->set_title("Deposit");
    $this->template->view("content/deposit/index");
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
          $row[] = $dt->kode_unik;

          if ($dt->status=="process") {
            $row[] = '
                        <a href="'.site_url("usrp/deposit/detail/".enc_url($dt->id_deposito)).'" class="btn btn-info btn-sm" title="detail"><i class="fa fa-file"></i></a>
                        <a id="hapus" href="'.site_url("usrp/deposit/delete/".enc_url($dt->id_deposito)).'" class="btn btn-danger btn-sm" title="detail"><i class="fa fa-trash"></i></a>
                     ';
          }else {
            $row[] = '
                        <a href="'.site_url("usrp/deposit/detail/".enc_url($dt->id_deposito)).'" class="btn btn-info btn-sm" title="detail"><i class="fa fa-file"></i></a>
                     ';
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


  function detail($id)
  {
    if ($row =  $this->model->get_where("deposito_usrp",['id_deposito'=>dec_url($id)])) {
      $dt['dt'] = $row;
      $this->template->set_title("Detail Deposit #$row->code");
      $this->template->view("content/deposit/detail",$dt);
    }
  }


  function add()
  {
    $this->template->set_title("Add Deposit");
    $this->template->view("content/deposit/form");
  }


  function add_action()
  {
    if ($this->input->is_ajax_request()) {
      $json = array('success'=>false, 'alert'=>array());
      $this->form_validation->set_rules("nominal","*&nbsp;","trim|xss_clean|numeric|required|callback__cek_deposit");
      $this->form_validation->set_rules("bank","*&nbsp;","trim|xss_clean|numeric|required");
      $this->form_validation->set_error_delimiters('<span class="error text-danger" style="font-size:11px">','</span>');
      if ($this->form_validation->run()) {
        $data = array('code' => $this->_code(),
                      'id_penerima_dana' => sess("id_user"),
                      'kode_unik' => $this->_kode_unik(),
                      'nominal' => $this->input->post("nominal"),
                      'id_rekening' => $this->input->post("bank"),
                      'status' => "process",
                      'created_at' => date("Y-m-d H:i:s")
                      );
        $this->db->insert("deposito_usrp",$data);

        $json['alert'] = "Deposit Berhasil ditambahkan, selanjutnya menunggu verifikasi";
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


  function _code()
  {
    $q = $this->db->query("SELECT MAX(RIGHT(code,7)) AS kd_trans FROM deposito_usrp ORDER BY id_deposito DESC LIMIT 1");
          $kd = "";
          if($q->num_rows()>0){
              foreach($q->result() as $k){
                  $tmp = ((int)$k->kd_trans)+1;
                  $kd = sprintf("%07s", $tmp);
              }
          }else{
              $kd = "0000001";
          }
          return "DP-".$kd;
  }



  function _kode_unik()
  {
    $q = $this->db->query("SELECT kode_unik AS kd_trans FROM deposito_usrp ORDER BY id_deposito DESC LIMIT 1");
          $kd = "";
          if($q->num_rows()>0){
              foreach($q->result() as $k){
                $tmp = ((int)$k->kd_trans)+1;
                $kd = sprintf("%05s", $tmp);
              }
          }else{
              $kd = "00001";
          }
          return $kd;
  }


  function _cek_deposit($str)
  {
    if ($str < master_config("DP-MIN")) {
      $this->form_validation->set_message("_cek_deposit","*&nbsp; Minmal Deposit Rp.".format_rupiah(master_config("DP-MIN")));
      return false;
    }elseif ($str > master_config("DP-MAX")) {
      $this->form_validation->set_message("_cek_deposit","*&nbsp; Maksimal Deposit Rp.".format_rupiah(master_config("DP-MAX")));
      return false;
    }else {
      return true;
    }
  }


  function delete($id)
  {
    if ($this->input->is_ajax_request()) {
      $this->db->delete("deposito_usrp",["id_deposito" => dec_url($id), "id_penerima_dana"=>sess("id_user")]);
      $data = array("message" => "berhasil di hapus");
      echo json_encode($data);
    }
  }

}
