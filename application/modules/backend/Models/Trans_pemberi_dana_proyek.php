<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Trans_pemberi_dana_proyek extends MY_Model{

  var $column_order = array('trans_penggalangan_dana.date_join',null,null,null,null);
  var $order = array('trans_penggalangan_dana.id_penggalangan_dana_proyek'=>"DESC");
  var $select = " trans_penggalangan_dana.id_penggalangan_dana_proyek,
                  trans_penggalangan_dana.id_proyek,
                  trans_penggalangan_dana.id_pendana,
                  trans_penggalangan_dana.jumlah_paket,
                  trans_penggalangan_dana.date_join,
                  trans_penggalangan_dana.join_hari_ke,
                  master_pendana.id_reg,
                  master_pendana.nama,
                  master_pendana.email,
                  master_proyek.kode,
                  master_proyek.harga_paket";

  private function _get_datatables_query_pemberi_dana($id)
    {
      $this->db->select($this->select);
      $this->db->from("trans_penggalangan_dana");
      $this->db->join("master_pendana","master_pendana.id_pendana = trans_penggalangan_dana.id_pendana");
      $this->db->join("master_proyek","trans_penggalangan_dana.id_proyek = master_proyek.id_proyek");
      $this->db->where("trans_penggalangan_dana.id_proyek",$id);

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


    public function get_datatables_pemberi_dana($id)
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
        $this->db->join("master_pendana","master_pendana.id_pendana = trans_penggalangan_dana.id_pendana");
        $this->db->join("master_proyek","trans_penggalangan_dana.id_proyek = master_proyek.id_proyek");
        $this->db->where("trans_penggalangan_dana.id_proyek",$id);
        return $this->db->count_all_results();
    }



}
