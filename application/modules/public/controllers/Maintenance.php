<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Maintenance extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function index()
  {
    echo "System Maintenance, Silahkan kembali di lain waktu. <br><a href='".site_url()."'> Halaman Utama</a>";
  }

}
