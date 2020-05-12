<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function get_data($email)
  {
    $qry = $this->db->select("id_pendana,email,token_password,password,is_verifikasi")
                    ->from("master_pendana")
                    ->where("email","$email")
                    ->where("is_active","1")
                    ->get();
    return $qry;
  }

}
