<?php if (!defined("BASEPATH")) exit("No direct script access allowed");


function cari_persen($total_dana,$dana_terkumpul)
{
  $persen = ($dana_terkumpul / $total_dana) * 100;
  return number_format($persen,2);
}
