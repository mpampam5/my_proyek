<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Backend{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function index()
  {
    $this->template->set_title("dashboard");
    $this->template->view("content/dashboard/index");
  }

  function index2()
  {
    $this->template->set_title("dashboard");
    $this->template->view("content/dashboard/index2");
  }

  function test()
  {
    $this->load->library('controllerlist');

    print_r($this->controllerlist->getControllers());
  }





}
