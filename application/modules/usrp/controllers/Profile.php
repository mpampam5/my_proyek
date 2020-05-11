<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends Usrp{

  public function __construct()
  {
    parent::__construct();
    $this->load->model("Profile_model","model");
  }

  function index()
  {
    $this->template->set_title("Profile");
    $data['dt'] = $this->model->get_where("master_penerima_dana",['id_penerima_dana'=>sess("id_user")]);
    $this->template->view("content/profile/index",$data);
  }

}
