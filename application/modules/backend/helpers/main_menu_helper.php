<?php defined('BASEPATH') OR exit('No direct script access allowed');
function get_main_menu()
{
    $str = "";
    $ci=& get_instance();
    $get_menu = $ci->db->select("*")
                       ->from("main_menu")
                       ->where("is_parent",0)
                       ->order_by("sort","ASC")
                       ->get()->result();
    foreach ($get_menu as $menu) {
      $get_sub_menu = $ci->db->select("*")
                               ->from("main_menu")
                               ->where("is_parent",$menu->id_menu)
                               ->order_by("sort","ASC")
                               ->get();
      if ($get_sub_menu->num_rows() > 0) {
        if (_cek_role_access_menu("is_parent", $menu->id_menu)) {
          $str.= '<li class="has-submenu">
                    <a href="#"><i class="'.$menu->icon.'"></i>'.ucfirst($menu->menu).' <i class="mdi mdi-chevron-down mdi-drop"></i></a>
                    <ul class="submenu">';
          foreach ($get_sub_menu->result() as $sub_menu) {
            if ($sub_menu->controller!=null) {
              $url_sub_menu = site_url("backend/".$sub_menu->controller);
            }else {
              $url_sub_menu = "#";
            }
            if (_cek_role_access_menu("id_main_menu", $sub_menu->id_menu)) {
              $str .='<li><a href="'.$url_sub_menu.'">'.ucfirst($sub_menu->menu).'</a></li>';
            }
          }
          $str.='   </ul>
                  </li>';
        }
      }else {
        if ($menu->controller!=null) {
          $url_menu = site_url("backend/".$menu->controller);
        }else {
          $url_menu = "#";
        }
        if (_cek_role_access_menu("id_main_menu", $menu->id_menu)) {
          $str.= '<li class="has-submenu">
                      <a href="'.$url_menu.'"><i class="'.$menu->icon.'"></i>'.ucfirst($menu->menu).'</a>
                  </li>';
        }
      }
    }
return $str;
}

function _cek_role_access_menu($field, $id)
{
  $ci=& get_instance();
  $get  = $ci->db->select("rule_level.id_rule_level,
                           rule_level.id_level,
                           rule_level.id_main_menu,
                           main_menu.is_parent")
                     ->from("rule_level")
                     ->join("main_menu","main_menu.id_menu =  rule_level.id_main_menu")
                     ->where("$field",$id)
                     ->where("id_level",sess("id_level"))
                     ->get();
  if ($get->num_rows() > 0) {
      return true;
  }else {
     return false;
  }
}

function cek_role_access($str)
{
  $ci=& get_instance();
  $id_level = $ci->uri->segment(4);
  $qry = $ci->db->get_where("rule_level",["id_main_menu"=>$str, "id_level" => dec_url($id_level)]);
  if ($qry->num_rows() > 0) {
    return true;
  }else {
    return false;
  }
}
