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
    $qry = $this->db->select("user_level.id_user_level,
                              user_level.id_user,
                              user_level.id_level,
                              user.email,
                              user.password,
                              user.token,
                              user.is_active,
                              user.is_delete,
                              level.id_level")
                    ->from("user_level")
                    ->join("user","user.id_user = user_level.id_user")
                    ->join("level","level.id_level = user_level.id_level")
                    ->where("user.email","$email")
                    ->where("user.is_active","1")
                    ->where("user.is_delete","0")
                    ->get();
    return $qry;
  }

}
