<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
 * mpampam
 */


class Backend extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    if (!$this->session->userdata("login_status")) {
        redirect(site_url("backend/login"),"refresh");
    }else {
      $this->load->library(array("backend/Template","backend/Userize","form_validation","security","user_agent"));
      $this->load->helper(array("backend/backend","sct","main_menu"));
    }
  }


  //CEK PASSWORD FORM VALIDATION
function _cek_password($str)
{
  if ($str!="") {
    if (pass_decrypt(profile("token"),$str,profile("password"))) {
      return true;
    }else {
      $this->form_validation->set_message('_cek_password', '* Password Salah');
      return false;
    }
  }else {
    return true;
  }
}


}
