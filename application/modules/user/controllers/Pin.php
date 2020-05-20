<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pin extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->helper(array("public","user"));
  }

  function index()
  {
    if (profile('pin_transaksi') != null) {
        redirect(site_url("user/dashboard"),"refresh");
    }else {
      $this->load->view("pin");
    }
  }

  function action()
  {
    if ($this->input->is_ajax_request()) {
          $this->load->model("Login_model","model");
          $this->load->library("form_validation");
          $json = array('success'=>false, 'alert'=>array(), "valid" => false, "url" => null);
          $this->form_validation->set_rules("pin","*&nbsp;","trim|xss_clean|required|min_length[3]");
          $this->form_validation->set_rules("pin_2","*&nbsp;","trim|xss_clean|required|matches[pin]",[
            "matches" => " *&nbsp; Tidak cocok dengan PIN awal"
          ]);
          $this->form_validation->set_error_delimiters('<span class="error text-danger" style="font-size:11px">','</span>');
          if ($this->form_validation->run()) {
            $pin = $this->input->post('pin_2');
            $token = date('YmdHis');

            $data = array('token_pin' => $token,
                          'pin' => pass_encrypt($token,$pin),
                          'pin_transaksi' => 1
                        );
            $this->db->where('id_pendana', sess('id_user'));
            $this->db->update('master_pendana', $data);
            $json['alert'] = "PIN Transaksi berhasil di tambahkan";
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



}
