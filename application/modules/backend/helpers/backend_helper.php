<?php defined('BASEPATH') OR exit('No direct script access allowed');




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

function balance_penerima_dana($id_pendana)
{
  $ci=& get_instance();
  return $ci->balance_penerima_dana->inits($id_pendana);
}

//proyek penerima dana
function penggalangan_publish($id_penerima_dana)
{
  $ci=& get_instance();
  $qry = $ci->db->select("id_proyek,status,status_penggalangan")
                ->from("master_proyek")
                ->where("id_penerima_dana",$id_penerima_dana)
                ->where("status","publish")
                ->where("status_penggalangan","mulai")
                ->get();
    if ($qry->num_rows() > 0) {
      return $qry->num_rows();
    }else {
      return 0;
    }
}


function penggalangan_selesai($id_penerima_dana)
{
  $ci=& get_instance();
  $qry = $ci->db->select("id_proyek,status,status_penggalangan")
                ->from("master_proyek")
                ->where("id_penerima_dana",$id_penerima_dana)
                ->where("status","done")
                ->where("status_penggalangan","selesai")
                ->get();
    if ($qry->num_rows() > 0) {
      return $qry->num_rows();
    }else {
      return 0;
    }
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
