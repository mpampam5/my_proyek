<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Level_model extends MY_Model{

  public function filter($limit, $start, $order_field, $order_ascdesc){
    if (profile('id_level')!=1) {
      $this->db->where("id_level !=",1);
    }
    $this->db->where("is_delete","0");
    $this->db->order_by($order_field, $order_ascdesc);
    $this->db->limit($limit, $start);
    return $this->db->get('level')->result();
  }

  public function count_all(){
    $this->db->where("id_level !=","1");
    $this->db->where("is_delete","0");
    return $this->db->count_all('level');
  }

  public function count_filter(){
    if (profile('id_level')!=1) {
      $this->db->where("id_level !=",1);
    }
    $this->db->where("is_delete","0");
    return $this->db->get('level')->num_rows();
  }

}
