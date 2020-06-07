<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aktivitas_pendanaan_model extends MY_Model{

  var $column_order = array('created_at',null);
  var $order = array('id'=>"DESC");
  var $select = " id,
                  keterangan,
                  created_at";

  private function _get_datatables_query()
    {
      $this->db->select($this->select);
      $this->db->from("aktivitas_pendanaan");
      if(isset($_POST['order'])) // here order processing
       {
           $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
       }
       else if(isset($this->order))
       {
           $order = $this->order;
           $this->db->order_by(key($order), $order[key($order)]);
       }

    }


    public function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->select($this->select);
        $this->db->from("aktivitas_pendanaan");
        return $this->db->count_all_results();
    }




}
