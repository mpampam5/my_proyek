<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Withdraw_model extends MY_Model{


    var $column_order = array('withdraw__usrp.created_at','withdraw__usrp.code','withdraw__usrp.status','withdraw__usrp.nominal');
    var $order = array('withdraw_usrp.id_withdraw'=>"DESC");
    var $select = " withdraw_usrp.id_withdraw,
                    withdraw_usrp.code,
                    withdraw_usrp.id_penerima_dana,
                    withdraw_usrp.nominal,
                    withdraw_usrp.`status`,
                    withdraw_usrp.created_at";

    private function _get_datatables_query()
      {
        $this->db->select($this->select);
        $this->db->from("withdraw_usrp");
        $this->db->where("withdraw_usrp.id_penerima_dana",sess("id_user"));
        if($this->input->post('status'))
        {
          $this->db->where("withdraw_usrp.status",$this->input->post('status'));
        }
        if($this->input->post('code'))
          {
              $this->db->like('withdraw_usrp.code', $this->input->post('code'));
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
          $this->db->from("withdraw_usrp");
          $this->db->where("withdraw_usrp.id_penerima_dana",sess("id_user"));
          if($this->input->post('status'))
          {
            $this->db->where("withdraw_usrp.status",$this->input->post('status'));
          }
          return $this->db->count_all_results();
      }

}
