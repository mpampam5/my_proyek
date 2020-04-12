<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Deposito_model extends MY_Model{

  var $column_order = array('deposito.created_at','deposito.code','master_pendana.nama','deposito.status','deposito.nominal','deposito.kode_unik');
  var $order = array('deposito.id_deposito'=>"DESC");
  var $select = " deposito.id_deposito,
                  deposito.code,
                  deposito.id_pendana,
                  deposito.nominal,
                  deposito.kode_unik,
                  deposito.status,
                  deposito.created_at,
                  deposito.acc_at,
                  master_pendana.id_reg,
                  master_pendana.nama,
                  master_pendana.email";

  private function _get_datatables_query()
    {
      $this->db->select($this->select);
      $this->db->from("deposito");
      $this->db->join("master_pendana","master_pendana.id_pendana = deposito.id_pendana");
      if($this->input->post('status'))
      {
        $this->db->where("deposito.status",$this->input->post('status'));
      }
      if($this->input->post('code'))
        {
            $this->db->like('deposito.code', $this->input->post('code'));
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
        $this->db->from("deposito");
        $this->db->join("master_pendana","master_pendana.id_pendana = deposito.id_pendana");
        if($this->input->post('status'))
        {
          $this->db->where("deposito.status",$this->input->post('status'));
        }
        return $this->db->count_all_results();
    }


    function get_detail_model($id)
    {
      return $this->db->select("deposito.id_deposito,
                                deposito.code,
                                deposito.id_pendana,
                                deposito.nominal,
                                deposito.kode_unik,
                                deposito.nominal_acc,
                                deposito.status,
                                deposito.created_at,
                                deposito.keterangan,
                                deposito.id_rekening,
                                deposito.acc_at,
                                deposito.acc_by,
                                deposito.acc_by_id,
                                master_pendana.id_reg,
                                master_pendana.nama,
                                master_pendana.email")
                      ->from("deposito")
                      ->join("master_pendana","master_pendana.id_pendana = deposito.id_pendana")
                      ->where("deposito.id_deposito",$id)
                      ->get()
                      ->row();
    }


}
