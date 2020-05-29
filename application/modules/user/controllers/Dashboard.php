<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends User{

  public function __construct()
  {
    parent::__construct();
    $this->load->model("Dashboard_model","model");
    $this->load->library("proyek");
    $this->load->helper("proyek");
  }

  function index()
  {
    $this->template->set_title("Dashboard");
    $dt['proyek_publish'] =  $this->model->proyek_publish();
    $this->template->view("content/dashboard/index",$dt);
  }



}
