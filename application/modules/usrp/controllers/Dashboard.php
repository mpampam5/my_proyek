<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Usrp{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function index()
  {
    $this->template->set_title("Dashboard");
    $this->template->view("content/dashboard/index");
  }

}
