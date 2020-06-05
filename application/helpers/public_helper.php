<?php if (!defined("BASEPATH")) exit("No direct script access allowed");

function sess($str)
{
  $ci=& get_instance();
  return $ci->session->userdata($str);
}


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


function get_proyek($id, $field)
{
  $ci=& get_instance();
  $qry = $ci->db->select("*")
                ->from("master_proyek")
                ->where("id_proyek",$id)
                ->get();
  if ($qry->num_rows() > 0) {
      return $qry->row()->$field;
  }else {
    return "Dont exist";
  }

}


function get_user($id,$field)
{
  $ci=& get_instance();
  $qry = $ci->db->query("SELECT
                          master_pendana.id_pendana,
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
                          master_pendana.complate,
                          master_pendana.pin_transaksi,
                          trans_bank.nama_bank,
                          trans_pekerjaan.pekerjaan,
                          trans_pendidikan.pendidikan
                          FROM
                          master_pendana
                          LEFT JOIN trans_bank ON trans_bank.id_bank = master_pendana.id_bank
                          LEFT JOIN trans_pekerjaan ON trans_pekerjaan.id_pekerjaan = master_pendana.id_pekerjaan
                          LEFT JOIN trans_pendidikan ON trans_pendidikan.id_pendidikan = master_pendana.id_pendidikan
                          WHERE
                          master_pendana.id_pendana = $id;
                          ");
if ($qry->num_rows() > 0) {
  return $qry->row()->$field;
}else {
  return "not exist";
}

}


function aktivitas_pendanaan($str)
{
  $ci=& get_instance();
  $data = array('keterangan' => $str, 'created_at' => date("Y-m-d H:i:s"));
  $ci->db->insert("aktivitas_pendanaan",$data);
}
