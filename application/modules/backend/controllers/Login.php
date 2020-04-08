<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->helper(array("backend/backend","sct"));
  }

  function index()
  {
    if ($this->session->userdata("login_status")) {
        redirect(site_url("backend/dashboard"),"refresh");
    }else {
      $this->load->view("login");
    }
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
              $token = $row->token;
              $password_account = $row->password;
              if (pass_decrypt($token,$password,$password_account)) {
                $session = array('id_user' => $row->id_user, "id_level" => $row->id_level , "login_status" => true );
                $this->session->set_userdata($session);
                //insert log
                $this->load->library(array("user_agent"));
                $user_log = array('id_user' => $row->id_user,
                                  'status' => "login",
                                  'ip_address' => $this->input->ip_address(),
                                  'user_agent' => $this->agent->platform()." - ".$this->agent->browser().' '.$this->agent->version(),
                                  'date_time' => date("Y-m-d H:i:s")
                                  );
                $this->db->insert("ci_user_login",$user_log);

                $json['valid'] = true;
                $json["url"] = site_url("backend/dashboard");
              }else {
                $json['alert'] = "Email atau Password tidak valid";
              }
            }else {
              $json['alert'] = "Email atau Password tidak valid";
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


function logout()
{
  $this->load->library(array("user_agent"));
  $user_log = array('id_user' => sess('id_user'),
                    'status' => "logout",
                    'ip_address' => $this->input->ip_address(),
                    'user_agent' => $this->agent->platform()." - ".$this->agent->browser().' '.$this->agent->version(),
                    'date_time' => date("Y-m-d H:i:s")
                    );
  $this->db->insert("ci_user_login",$user_log);
  $this->session->sess_destroy();
  redirect(site_url("backend/login"),"refresh");
}

}
