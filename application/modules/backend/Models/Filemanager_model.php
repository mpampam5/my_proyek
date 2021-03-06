<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Filemanager_model extends MY_Model{

  var $column_order = array(null,'title');
  var $order = array('id'=>"DESC");
  var $select = "id,title,file,created";

  private function _get_datatables_query()
    {
      $this->db->select($this->select);
      $this->db->from("filemanager");
      if($this->input->post('search'))
        {
            $this->db->like('file', $this->input->post('search'));
        }

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
        $this->db->from("filemanager");
        return $this->db->count_all_results();
    }

}
