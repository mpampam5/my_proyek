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
      $this->load->library(array("backend/Template","backend/Userize","form_validation","backend/Balance","security","user_agent"));
      $this->load->helper(array("backend/backend","sct","main_menu","public"));
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


//usrp class
class Usrp extends CI_Controller{
  public function __construct()
  {
    parent::__construct();
    if (!$this->session->userdata("login_usrp_status")) {
        redirect(site_url("usrp/login"),"refresh");
    }else {
      $this->load->helper(array("public","usrp/usrp","sct"));
      $this->load->library(array("usrp/Template","usrp/Balance_usrp","form_validation","security","user_agent"));
    }
  }

}


  //usrp class
  class User extends CI_Controller{
    public function __construct()
    {
      parent::__construct();
      if (!$this->session->userdata("login_user_status")) {
          redirect(site_url("user/login"),"refresh");
      }else {
        $this->load->helper(array("public","user","sct"));
        $this->load->library(array("user/Template","user/balance_user","form_validation","security","user_agent"));
      }
    }

}
