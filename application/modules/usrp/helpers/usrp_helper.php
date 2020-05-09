<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function profile($field)
{
  $ci=& get_instance();
  $qry = $ci->db->select("id_reg,
                          no_ktp,
                          nama,
                          telepon,
                          email,
                          complate")
                  ->from("master_penerima_dana")
                  ->where("id_penerima_dana",sess("id_user"))
                  ->get()
                  ->row();
    return $qry->$field;
}


function master_config($code = null , $field = "value")
{
  //$file = "value" or $file = "status" 0,1
  $ci=& get_instance();
  $kd = strtoupper($code);
  $qry = $ci->db->get_where("master_config",["code"=>"$kd"]);
  if ($qry->num_rows() > 0) {
      return $qry->row()->$field;
  }else {
      return "System not available";;
  }
}


function complate_data()
{
  if (profile("complate")!="1") {
    return false;
  }
  return true;
}
