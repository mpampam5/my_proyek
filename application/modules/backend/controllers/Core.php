<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Core extends Backend{

  public function __construct()
  {
    parent::__construct();
    $this->load->model("Core_model","model");
  }

  function reset_password()
  {
    $this->template->view("content/core/form_reset_password",array(),false);
  }


  function reset_password_action()
  {
    if ($this->input->is_ajax_request()) {
          $json = array('success'=>false, 'alert'=>array());
          $this->form_validation->set_rules("password","*&nbsp;","trim|xss_clean|required|callback__cek_password");
          $this->form_validation->set_rules("password_baru","*&nbsp;","trim|xss_clean|required|min_length[6]");
          $this->form_validation->set_rules("konfirmasi_password","*&nbsp;","trim|xss_clean|matches[password_baru]",[
            "matches"=> "*&nbsp; tidak sesuai dengan password awal"
          ]);
          $this->form_validation->set_error_delimiters('<span class="error text-danger" style="font-size:11px">','</span>');
          if ($this->form_validation->run()) {
            $token = config_system("key_token").date('YmdHis');
            $update = array(
                            'token' => $token,
                            'password' => pass_encrypt($token,$this->input->post('konfirmasi_password')),
                          );

            $this->model->get_update("user",$update,["id_user" => sess("id_user")]);

            $json['alert'] = "reset password successfully";
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


  function icon()
  {
    $this->template->view("content/core/icon",array(),false);
  }

}
