<?php defined('BASEPATH') OR exit('No direct script access allowed');



function config_system($kode = null , $field = "value")
{
  //$file = "value" or $file = "status" 0,1
  $ci=& get_instance();
  $kd = strtolower($kode);
  $qry = $ci->db->get_where("config_system",["slug"=>"$kd"]);
  if ($qry->num_rows() > 0) {
      return $qry->row()->$field;
  }else {
      return "System not available";;
  }
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

function profile($field)
{
  $ci=& get_instance();
  $qry = $ci->db->select("user_level.id_user_level AS id_user_level,
                          user_level.id_user AS id_user,
                          user_level.id_level AS id_level,
                          user.email AS email,
                          user.password AS password,
                          user.token AS token,
                          user.is_active AS is_active,
                          user.is_delete AS is_delete,
                          user.nama AS nama,
                          user.created AS created,
                          user.modified AS modified,
                          level.level AS level,
                          level.slug AS slug_level")
                  ->from("user_level")
                  ->join("user","user.id_user = user_level.id_user")
                  ->join("level","level.id_level = user_level.id_level")
                  ->where("user_level.id_user",sess("id_user"))
                  ->get()
                  ->row();
    return $qry->$field;
}


function profile_where_id($id,$field)
{
  $ci=& get_instance();
  $qry = $ci->db->select("user_level.id_user_level AS id_user_level,
                          user_level.id_user AS id_user,
                          user_level.id_level AS id_level,
                          user.email AS email,
                          user.password AS password,
                          user.token AS token,
                          user.is_active AS is_active,
                          user.is_delete AS is_delete,
                          user.nama AS nama,
                          user.created AS created,
                          user.modified AS modified,
                          level.level AS level,
                          level.slug AS slug_level")
                  ->from("user_level")
                  ->join("user","user.id_user = user_level.id_user")
                  ->join("level","level.id_level = user_level.id_level")
                  ->where("user_level.id_user",$id)
                  ->get()
                  ->row();
    return $qry->$field;
}


function rekening($id,$field)
{
  $ci=& get_instance();
  $qry = $ci->db->select("trans_rekening.id_rekening AS id_rekening,
                          trans_rekening.id_bank AS id_bank,
                          trans_rekening.nama_rekening AS nama_rekening,
                          trans_rekening.no_rekening AS no_rekening,
                          trans_bank.nama_bank AS nama_bank")
                  ->from("trans_rekening")
                  ->join("trans_bank","trans_bank.id_bank = trans_rekening.id_bank")
                  ->where("trans_rekening.id_rekening",$id)
                  ->get()
                  ->row();
    return $qry->$field;
}


//balance user
function balance_user($id_pendana)
{
  $ci=& get_instance();
  return $ci->balance->init($id_pendana);
}



//core form
//combobox
function is_combo($table,$id_name,$id_field,$name_field,$value)
{
  $ci=& get_instance();
  $qry = $ci->db->get_where("$table",["id_level !="=>"1"]);
  $str = '<select class="form-control" name="'.$id_name.'" id="'.$id_name.'">';
  if ($value=="") {
    $str .= '<option value="">--pilih--</option>';
  }
  foreach ($qry->result() as $row) {
    $str .='<option value="'.$row->$id_field.'" ';
    $str .=  $value==$row->$id_field ? "selected>":">";
    $str .= $row->$name_field;
    $str .='</option>';
  }
  $str .= '<select>';

  return $str;
}
