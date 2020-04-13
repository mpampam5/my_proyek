<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Withdraw_model extends MY_Model{

  var $column_order = array('withdraw.created_at','withdraw.code','master_pendana.nama','withdraw.status','withdraw.nominal');
  var $order = array('withdraw.id_withdraw'=>"DESC");
  var $select = " withdraw.id_withdraw,
                  withdraw.code,
                  withdraw.id_pendana,
                  withdraw.nominal,
                  withdraw.`status`,
                  withdraw.created_at,
                  master_pendana.id_reg,
                  master_pendana.nama,
                  master_pendana.email";

  private function _get_datatables_query()
    {
      $this->db->select($this->select);
      $this->db->from("withdraw");
      $this->db->join("master_pendana","master_pendana.id_pendana = withdraw.id_pendana");
      if($this->input->post('status'))
      {
        $this->db->where("withdraw.status",$this->input->post('status'));
      }
      if($this->input->post('code'))
        {
            $this->db->like('withdraw.code', $this->input->post('code'));
        }
      if($this->input->post('id_reg'))
        {
            $this->db->like('master_pendana.id_reg', $this->input->post('id_reg'));
        }
      if($this->input->post('nama'))
        {
            $this->db->like('master_pendana.nama', $this->input->post('nama'));
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
        $this->db->from("withdraw");
        $this->db->join("master_pendana","master_pendana.id_pendana = withdraw.id_pendana");
        if($this->input->post('status'))
        {
          $this->db->where("withdraw.status",$this->input->post('status'));
        }
        return $this->db->count_all_results();
    }


    function get_detail_model($id)
    {
      return $this->db->select("withdraw.id_withdraw,
                                withdraw.`code`,
                                withdraw.id_pendana,
                                withdraw.nominal,
                                withdraw.`status`,
                                withdraw.created_at,
                                withdraw.update_at,
                                withdraw.keterangan,
                                withdraw.acc_at,
                                withdraw.acc_by,
                                withdraw.acc_by_id,
                                master_pendana.id_reg,
                                master_pendana.nama,
                                master_pendana.email")
                      ->from("withdraw")
                      ->join("master_pendana","master_pendana.id_pendana = withdraw.id_pendana")
                      ->where("withdraw.id_withdraw",$id)
                      ->get()
                      ->row();
    }


}
