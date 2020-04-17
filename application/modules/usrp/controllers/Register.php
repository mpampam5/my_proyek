<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->helper(array("usrp"));
  }

  function index()
  {
    $this->load->view("register");
  }


  function action()
  {
    if ($this->input->is_ajax_request()) {
      $this->load->library("form_validation");
      $json = array('success'=>false, 'alert'=>array());
      $this->form_validation->set_rules("nama","*&nbsp;","trim|xss_clean|htmlspecialchars|required");
      $this->form_validation->set_rules("telepon","*&nbsp;","trim|xss_clean|numeric|required");
      $this->form_validation->set_rules("email","*&nbsp;","trim|xss_clean|valid_email|required|callback__cek_email");
      $this->form_validation->set_rules("password","*&nbsp;","trim|xss_clean|required|min_length[8]");
      $this->form_validation->set_error_delimiters('<span class="error text-danger" style="font-size:11px">','</span>');
      if ($this->form_validation->run()) {
          $token = date('YmdHis');
          $nama =  $this->input->post("nama",true);
          $email = $this->input->post("email",true);
          $telepon = $this->input->post("telepon",true);
          $password = $this->input->post("password",true);

          $insert = array('id_reg'          => $this->_kode(),
                          'nama'            => $nama,
                          'email'           => $email,
                          'telepon'         => $telepon,
                          'token_password'  => $token,
                          'password'        => pass_encrypt($token,$password),
                          'is_active'       => "1",
                          'created_at'      => date("Y-m-d H:i:s"),
                          );

        $this->db->insert('master_penerima_dana',$insert);


        $json['alert'] = "<strong>Pendaftaran sukses!</strong> Silahkan cek email untuk melakukan verifikasi.";
        $json['success'] = true;
      }else {
        foreach ($_POST as $key => $value) {
          $json['alert'][$key] = form_error($key);
        }
      }

      echo json_encode($json);
    }
  }



  function _cek_email($str)
  {
    $qry = $this->db->get_where("master_penerima_dana",["email"=>$str]);
    if ($qry->num_rows() > 0) {
      $this->form_validation->set_message("_cek_email","*&nbsp; Email sudah terdaftar.");
        return false;
    }else {
      return true;
    }
  }


  function _kode()
  {
    $q = $this->db->query("SELECT MAX(RIGHT(id_reg,7)) AS kd_trans FROM master_penerima_dana ORDER BY id_penerima_dana DESC LIMIT 1");
    if($q->num_rows()>0){
        foreach($q->result() as $k){
          $tmp = ((int)$k->kd_trans)+1;
          $kd = sprintf("%07s", $tmp);
        }
    }else{
        $kd = "0000001";
    }
    return "PM-".$kd;
  }

}
