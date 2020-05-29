<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aturan extends User{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function index()
  {
    $this->template->set_title("Aturan Dan ketentuan Yang Berlaku");
    $this->template->view("content/config/aturan");
  }

}
