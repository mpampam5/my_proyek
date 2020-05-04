<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wizard extends Usrp{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function index()
  {
    $this->template->set_title("Form Lengkapi Data");
    $this->template->view("content/wizard/index");
  }

}
