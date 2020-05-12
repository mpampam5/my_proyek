<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function profile($field)
{
  $ci=& get_instance();
  $qry = $ci->db->select("master_pendana.id_pendana,
                        master_pendana.id_reg,
                        master_pendana.no_ktp,
                        master_pendana.no_npwp,
                        master_pendana.nama,
                        master_pendana.tempat_lahir,
                        master_pendana.tgl_lahir,
                        master_pendana.jenis_kelamin,
                        master_pendana.status_perkawinan,
                        master_pendana.telepon,
                        master_pendana.email,
                        master_pendana.nama_ibu_kandung,
                        master_pendana.id_pendidikan,
                        master_pendana.id_pekerjaan,
                        master_pendana.id_pendapatan,
                        master_pendana.alamat,
                        master_pendana.provinsi,
                        master_pendana.kabupaten,
                        master_pendana.kecamatan,
                        master_pendana.kelurahan,
                        master_pendana.kode_pos,
                        master_pendana.no_rekening,
                        master_pendana.nama_rekening,
                        master_pendana.id_bank,
                        master_pendana.foto_diri,
                        master_pendana.foto_ktp,
                        master_pendana.foto_diri_ktp,
                        master_pendana.foto_buku_rekening,
                        master_pendana.`password`,
                        master_pendana.token_password,
                        master_pendana.pin,
                        master_pendana.token_pin,
                        master_pendana.is_verifikasi,
                        master_pendana.is_active,
                        master_pendana.created_at,
                        master_pendana.update_at,
                        master_pendana.verifikasi_at,
                        master_pendana.complate")
                  ->from("master_pendana")
                  ->where("master_pendana.id_pendana",sess("id_user"))
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



//combobox
function custom_select($table,$id_name,$id_field,$name_field,$value)
{
  $ci=& get_instance();
  $qry = $ci->db->get_where("$table");
  $str = '<select class="form-control" name="'.$id_name.'" id="'.$id_name.'">';
  if ($value=="") {
    $str .= '<option value="" style="color:#a4a4a4">-- Pilih --</option>';
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
