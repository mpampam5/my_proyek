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
