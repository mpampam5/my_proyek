<?php
function cek_controller_is_menu($str)
{
  $ci=& get_instance();
  $qry = $ci->db->get_where("main_menu",["controller" => strtolower($str)]);
  if ($qry->num_rows() > 0) {
    return '<i class="fa fa-check text-success"></i>';
  }else {
    return '<i class="fa fa-close text-danger"></i>';
  }
}
