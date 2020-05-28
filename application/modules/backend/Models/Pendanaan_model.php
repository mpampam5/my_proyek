<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendanaan_model extends MY_Model{

  var $column_order = array('trans_penggalangan_dana.date_join','master_pendana.id_reg','trans_penggalangan_dana.total_rupiah','master_proyek.kode','trans_penggalangan_dana.`status`');
  var $order = array('trans_penggalangan_dana.id_penggalangan_dana_proyek'=>"DESC");
  var $select = "trans_penggalangan_dana.id_penggalangan_dana_proyek,
                trans_penggalangan_dana.id_proyek,
                trans_penggalangan_dana.id_pendana,
                trans_penggalangan_dana.jumlah_paket,
                trans_penggalangan_dana.total_rupiah,
                trans_penggalangan_dana.join_hari_ke,
                trans_penggalangan_dana.`status`,
                trans_penggalangan_dana.date_join,
                trans_penggalangan_dana.created_at,
                master_proyek.kode,
                master_proyek.title,
                master_proyek.dana_dibutuhkan,
                master_pendana.id_reg,
                master_pendana.nama";

  private function _get_datatables_query()
    {
      $this->db->select($this->select);
      $this->db->from("trans_penggalangan_dana");
      $this->db->join("master_proyek","master_proyek.id_proyek = trans_penggalangan_dana.id_proyek");
      $this->db->join("master_pendana","master_pendana.id_pendana = trans_penggalangan_dana.id_pendana");
      if($this->input->post('status'))
        {
            $this->db->where('trans_penggalangan_dana.`status`', $this->input->post('status'));
        }
        if($this->input->post('code'))
          {
              $this->db->like('master_proyek.kode', $this->input->post('code'));
          }
        if($this->input->post('title'))
          {
              $this->db->like('master_proyek.title', $this->input->post('title'));
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
        $this->db->from("trans_penggalangan_dana");
        $this->db->join("master_proyek","master_proyek.id_proyek = trans_penggalangan_dana.id_proyek");
        $this->db->join("master_pendana","master_pendana.id_pendana = trans_penggalangan_dana.id_pendana");
        if($this->input->post('status'))
          {
              $this->db->where('trans_penggalangan_dana.`status`', $this->input->post('status'));
          }
        return $this->db->count_all_results();
    }

}
