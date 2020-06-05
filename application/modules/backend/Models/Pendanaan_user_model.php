<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendanaan_user_model extends MY_Model{

  var $column_order = array('trans_penggalangan_dana.date_join',null,null,null,null);
  var $order = array('trans_penggalangan_dana.id_penggalangan_dana_proyek'=>"DESC");
  var $select = " trans_penggalangan_dana.id_penggalangan_dana_proyek,
                  trans_penggalangan_dana.id_proyek,
                  trans_penggalangan_dana.id_pendana,
                  trans_penggalangan_dana.jumlah_paket,
                  trans_penggalangan_dana.total_rupiah,
                  trans_penggalangan_dana.date_join,
                  trans_penggalangan_dana.join_hari_ke,
                  trans_penggalangan_dana.status,
                  master_proyek.kode,
                  master_proyek.title";

  private function _get_datatables_query_pemberi_dana($id)
    {
      $this->db->select($this->select);
      $this->db->from("trans_penggalangan_dana");
      $this->db->join("master_proyek","trans_penggalangan_dana.id_proyek = master_proyek.id_proyek");
      $this->db->where("trans_penggalangan_dana.id_pendana",$id);

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


    public function get_datatables_pendanaan($id)
    {
        $this->_get_datatables_query_pemberi_dana($id);
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered_pemberi_dana($id)
    {
        $this->_get_datatables_query_pemberi_dana($id);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_pemberi_dana($id)
    {
        $this->db->select($this->select);
        $this->db->from("trans_penggalangan_dana");
        $this->db->join("master_proyek","trans_penggalangan_dana.id_proyek = master_proyek.id_proyek");
        $this->db->where("trans_penggalangan_dana.id_pendana",$id);
        return $this->db->count_all_results();
    }



}
