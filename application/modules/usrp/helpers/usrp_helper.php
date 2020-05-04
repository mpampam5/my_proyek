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


function complate_data()
{
  if (profile("complate")!="1") {
    return false;
  }
  return true;
}
