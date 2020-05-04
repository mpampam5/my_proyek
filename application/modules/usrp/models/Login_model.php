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
    $qry = $this->db->select("id_penerima_dana,email,token_password,password")
                    ->from("master_penerima_dana")
                    ->where("email","$email")
                    ->where("is_active","1")
                    ->where("is_delete","0")
                    ->get();
    return $qry;
  }

}
