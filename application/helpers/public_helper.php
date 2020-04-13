<?php if (!defined("BASEPATH")) exit("No direct script access allowed");

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


function selisih_hari($tanggal)
{

  // $tanggal = new DateTime($tanggal);
  //
  // $sekarang = new DateTime();
  //
  // $perbedaan = $tanggal->diff($sekarang);
  //
  // return $perbedaan->d;

  $tanggall  = strtotime($tanggal);
  $sekarang    = time(); // Waktu sekarang
  $diff   = $sekarang - $tanggall;
  $hsl = floor($diff / (60 * 60 * 24));
  return abs($hsl)+1;
}
