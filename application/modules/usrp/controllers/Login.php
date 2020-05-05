<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->helper(array("public"));
  }

  function index()
  {
    $this->load->view("login");
  }



  function action()
  {
    if ($this->input->is_ajax_request()) {
          $this->load->model("Login_model","model");
          $this->load->library("form_validation");
          $json = array('success'=>false, 'alert'=>array(), "valid" => false, "url" => null);
          $this->form_validation->set_rules("email","*&nbsp;","trim|xss_clean|valid_email|required");
          $this->form_validation->set_rules("password","*&nbsp;","trim|xss_clean|required");
          $this->form_validation->set_error_delimiters('<span class="error text-danger" style="font-size:11px">','</span>');
          if ($this->form_validation->run()) {
            $json['success'] =  true;
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $account = $this->model->get_data($email);

            if ($account->num_rows() > 0) {
              $row = $account->row();
              $token = $row->token_password;
              $password_account = $row->password;
              if (pass_decrypt($token,$password,$password_account)) {
                $session = array('id_user' => $row->id_penerima_dana , "login_usrp_status" => true );
                $this->session->set_userdata($session);

                $json['valid'] = true;
                $json["url"] = site_url("usrp/dashboard");
              }else {
                $json['alert'] = "Email atau Password tidak salah";
              }
            }else {
              $json['alert'] = "Email atau Password tidak salah";
            }

            // $json['alert'] = "add data successfully";


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
