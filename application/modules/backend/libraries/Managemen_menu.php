<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */
class Managemen_menu
{
  private $ci;

  private $menu;

  private $sub_menu;

  function __construct()
  {
    $this->ci =& get_instance();
  }

  function menu()
  {
    $menu = $this->ci->db->select('id_menu,is_parent,menu,slug,url,is_active,sort')
                    ->from("menu")
                    ->where("is_active",1)
                    ->where("is_parent",0)
                    ->order_by("sort","asc")
                    ->get();
    $this->menu;
  }

  function sub_menu($id_parent)
  {
    $menu = $this->ci->db->select('id_menu,is_parent,menu,slug,url,is_active,sort')
                          ->from("menu")
                          ->where("is_active",1)
                          ->where("is_parent",$id_parent)
                          ->order_by("sort","asc")
                          ->get();
    $this->menu;
  }

  function get_menu()
  {
    $str = '';
    $qry_menu = $this->ci->db->select('id_menu,is_parent,menu,slug,url,is_active,sort')
                    ->from("menu")
                    ->where("is_active",1)
                    ->where("is_parent",0)
                    ->order_by("sort","asc")
                    ->get();
    foreach ($qry_menu->result() as $menu) {
      $qry_sub_menu = $this->ci->db->select('id_menu,is_parent,menu,slug,url,is_active,sort')
                            ->from("menu")
                            ->where("is_active",1)
                            ->where("is_parent",$menu->id_menu)
                            ->order_by("sort","asc")
                            ->get();
      if ($qry_sub_menu->num_rows() > 0) {
        $str .='<li class="has-submenu">
                  <a href="#"><i class="fa fa-user"></i>'.$menu->menu.' <i class="mdi mdi-chevron-down mdi-drop"></i></a>
                  <ul class="submenu">';

        foreach ($qry_sub_menu->result() AS $sub_menu) {
          $str .='<li><a href="<?=site_url("backend/administrator")?>">'.$sub_menu->menu.'</a></li>';
        }

        $str .='  </ul>
                </li>';

      }else {
        $str .='<li class="has-submenu">
                  <a href="#"><i class="dripicons-device-desktop"></i>'.$menu->menu.'</a>
                </li>';
      }

    }

    echo $str;
  }



}
