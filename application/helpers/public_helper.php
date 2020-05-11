<?php if (!defined("BASEPATH")) exit("No direct script access allowed");

function sess($str)
{
  $ci=& get_instance();
  return $ci->session->userdata($str);
}



if ( ! function_exists('format_rupiah'))
{
  function format_rupiah($int)
  {
    return number_format($int, 0, ',', '.');
  }
}

if ( ! function_exists('replace_rupiah'))
{
  function replace_rupiah($int)
  {
    return str_replace(".","","$int");
  }
}


function selisih_hari($tanggal,$tanggal_ditentukan = null)
{

  if ($tanggal_ditentukan==null) {
    $datetime1 = date_create(date("Y-m-d"));
  }else {
    $datetime1 = date_create("$tanggal_ditentukan");
  }
  $datetime2 = date_create("$tanggal");
  $interval = date_diff($datetime1, $datetime2);
  $hsls = $interval->format('%R');
  $hsl = $interval->format('%d');
  if ($hsls=="+") {
    return $hsl+1;
  }else {
    return 0;
  }
}


//pass hash
function pass_encrypt($token,$str)
{
    $ecrypt = password_hash($str."".$token,PASSWORD_DEFAULT);
    return $ecrypt;
}


function pass_decrypt($token,$str,$hash)
{
    if (password_verify($str."".$token, $hash)) {
        return true;
    }else {
        return false;
    }
}


function bank($id)
{
  $ci=& get_instance();
  $qry = $ci->db->get_where("trans_bank",["id_bank"=>$id]);
  return $qry->row()->nama_bank;
}


function provinsi($id)
{
  $ci=& get_instance();
  $qry = $ci->db->get_where("wil_provinsi",['id'=>$id])->row();
  return $qry->name;
}

function kabupaten($id)
{
  $ci=& get_instance();
  $qry = $ci->db->get_where("wil_kabupaten",['id'=>$id])->row();
  return $qry->name;
}



function where_bank($id,$field)
{
  $ci=& get_instance();
  $bank = $ci->db->query("SELECT
                            trans_rekening.id_rekening,
                            trans_rekening.id_bank,
                            trans_rekening.nama_rekening,
                            trans_rekening.no_rekening,
                            trans_bank.nama_bank
                            FROM
                            trans_rekening
                            INNER JOIN trans_bank ON trans_bank.id_bank = trans_rekening.id_bank
                            WHERE trans_rekening.id_rekening = $id")->row();
  return $bank->$field;
}



function combo_bank()
{
  $ci=& get_instance();
  $bank = $ci->db->query("SELECT
                            trans_rekening.id_rekening,
                            trans_rekening.id_bank,
                            trans_rekening.nama_rekening,
                            trans_rekening.no_rekening,
                            trans_bank.nama_bank
                            FROM
                            trans_rekening
                            INNER JOIN trans_bank ON trans_bank.id_bank = trans_rekening.id_bank");

  $str = "";
  foreach ($bank->result() as $bk) {
    $str.='<option value="'.$bk->id_rekening.'">'.strtoupper($bk->nama_bank).' / '.$bk->nama_rekening.' / '.$bk->no_rekening.'</option>';
  }
  return $str;
}
