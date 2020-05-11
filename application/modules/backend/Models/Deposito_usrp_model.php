<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Deposito_usrp_model extends MY_Model{

  var $column_order = array('deposito_usrp.created_at','deposito_usrp.code','master_pendana.nama','deposito_usrp.status','deposito_usrp.nominal','deposito_usrp.kode_unik');
  var $order = array('deposito_usrp.id_deposito'=>"DESC");
  var $select = " deposito_usrp.id_deposito,
                  deposito_usrp.code,
                  deposito_usrp.id_penerima_dana,
                  deposito_usrp.nominal,
                  deposito_usrp.kode_unik,
                  deposito_usrp.status,
                  deposito_usrp.created_at,
                  deposito_usrp.acc_at,
                  master_penerima_dana.id_reg,
                  master_penerima_dana.nama,
                  master_penerima_dana.email";

  private function _get_datatables_query()
    {
      $this->db->select($this->select);
      $this->db->from("deposito_usrp");
      $this->db->join("master_penerima_dana","master_penerima_dana.id_penerima_dana = deposito_usrp.id_penerima_dana");
      if($this->input->post('status'))
      {
        $this->db->where("deposito_usrp.status",$this->input->post('status'));
      }
      if($this->input->post('code'))
        {
            $this->db->like('deposito_usrp.code', $this->input->post('code'));
        }
      if($this->input->post('id_reg'))
        {
            $this->db->like('master_penerima_dana.id_reg', $this->input->post('id_reg'));
        }
      if($this->input->post('nama'))
        {
            $this->db->like('master_penerima_dana.nama', $this->input->post('nama'));
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
        $this->db->from("deposito_usrp");
        $this->db->join("master_penerima_dana","master_penerima_dana.id_penerima_dana = deposito_usrp.id_penerima_dana");
        if($this->input->post('status'))
        {
          $this->db->where("deposito_usrp.status",$this->input->post('status'));
        }
        return $this->db->count_all_results();
    }


    function get_detail_model($id)
    {
      return $this->db->select("deposito_usrp.id_deposito,
                                deposito_usrp.code,
                                deposito_usrp.id_penerima_dana,
                                deposito_usrp.nominal,
                                deposito_usrp.kode_unik,
                                deposito_usrp.nominal_acc,
                                deposito_usrp.status,
                                deposito_usrp.created_at,
                                deposito_usrp.keterangan,
                                deposito_usrp.id_rekening,
                                deposito_usrp.acc_at,
                                deposito_usrp.acc_by,
                                deposito_usrp.acc_by_id,
                                master_penerima_dana.id_reg,
                                master_penerima_dana.nama,
                                master_penerima_dana.email")
                      ->from("deposito_usrp")
                      ->join("master_penerima_dana","master_penerima_dana.id_penerima_dana = deposito_usrp.id_penerima_dana")
                      ->where("deposito_usrp.id_deposito",$id)
                      ->get()
                      ->row();
    }


}
