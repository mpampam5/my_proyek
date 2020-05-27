<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class config extends User{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function reset_password()
  {
    $this->template->view("content/config/form_reset_password",[],false);
  }


  function action_password()
  {
    if ($this->input->is_ajax_request()) {
        $json = array("success" => false, "alert" => array());
        $this->form_validation->set_rules("password","&nbsp;*","required|callback__cek_password");
        $this->form_validation->set_rules("password_baru","&nbsp;*","required|min_length[8]");
        $this->form_validation->set_rules("konfirmasi_password","&nbsp;*","matches[password_baru]",[
          "matches" => "&nbsp;* Konfirmasi Password tidak valid."
        ]);
        $this->form_validation->set_error_delimiters('<span class="error text-danger" style="font-size:11px">','</span>');
        if ($this->form_validation->run()) {
          $token = date('YmdHis');
          $password =  $this->input->post("konfirmasi_password");
          $data = array('password' => pass_encrypt($token,$password),
                        'token_password'  => $token
                        );
          $this->db->where("id_pendana",sess("id_user"));
          $this->db->update("master_pendana",$data);
          $json['alert'] = "Password Berhasil Diganti";
          $json['success'] = true;

        }else {
          foreach ($_POST as $key => $value)
            {
              $json['alert'][$key] = form_error($key);
            }
        }

        echo json_encode($json);
    }
  }



    function reset_pin()
    {
      $this->template->view("content/config/form_reset_pin",[],false);
    }


    function action_pin()
    {
      if ($this->input->is_ajax_request()) {
          $json = array("success" => false, "alert" => array());
          $this->form_validation->set_rules("password","&nbsp;*","required|callback__cek_password");
          $this->form_validation->set_rules("pin_baru","&nbsp;*","required|min_length[3]");
          $this->form_validation->set_rules("konfirmasi_pin","&nbsp;*","matches[pin_baru]",[
            "matches" => "&nbsp;* Konfirmasi PIN tidak valid."
          ]);
          $this->form_validation->set_error_delimiters('<span class="error text-danger" style="font-size:11px">','</span>');
          if ($this->form_validation->run()) {
            $token = date('YmdHis');
            $pin =  $this->input->post("konfirmasi_pin");
            $data = array('pin' => pass_encrypt($token,$pin),
                          'token_pin'  => $token
                          );
            $this->db->where("id_pendana",sess("id_user"));
            $this->db->update("master_pendana",$data);
            $json['alert'] = "PIN Transaksi Berhasil Diganti";
            $json['success'] = true;

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
