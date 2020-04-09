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
