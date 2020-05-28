<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendanaan_model extends MY_Model{


      var $column_order = array('trans_penggalangan_dana.created_at','trans_penggalangan_dana.total_rupiah','trans_penggalangan_dana.id_proyek');
      var $order = array('trans_penggalangan_dana.id_penggalangan_dana_proyek'=>"DESC");
      var $select = " trans_penggalangan_dana.id_penggalangan_dana_proyek,
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
                      master_proyek.dana_dibutuhkan";

      private function _get_datatables_query()
        {
          $this->db->select($this->select);
          $this->db->from("trans_penggalangan_dana");
          $this->db->join('master_proyek',"master_proyek.id_proyek = trans_penggalangan_dana.id_proyek");
          $this->db->where("trans_penggalangan_dana.id_pendana",sess("id_user"));
          // if($this->input->post('status'))
          // {
          //   $this->db->where("withdraw.status",$this->input->post('status'));
          // }


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
            $this->db->join('master_proyek',"master_proyek.id_proyek = trans_penggalangan_dana.id_proyek");
            $this->db->where("trans_penggalangan_dana.id_pendana",sess("id_user"));
            return $this->db->count_all_results();
        }


  function get_detail($id_penggalangan_dana_proyek, $kode){
    $qry = $this->db->select("trans_penggalangan_dana.id_penggalangan_dana_proyek,
                              trans_penggalangan_dana.id_proyek,
                              trans_penggalangan_dana.id_pendana,
                              trans_penggalangan_dana.jumlah_paket,
                              trans_penggalangan_dana.total_rupiah,
                              trans_penggalangan_dana.join_hari_ke,
                              trans_penggalangan_dana.status,
                              trans_penggalangan_dana.date_join,
                              trans_penggalangan_dana.created_at,
                              master_proyek.kode,
                              master_proyek.title,
                              master_proyek.harga_paket,
                              master_proyek.jumlah_paket,
                              master_proyek.dana_dibutuhkan,
                              master_proyek.lama_penggalangan,
                              master_proyek.mulai_penggalangan,
                              master_proyek.akhir_penggalangan,
                              master_proyek.tgl_mulai_proyek,
                              master_proyek.tgl_selesai_proyek,
                              master_proyek.durasi_proyek,
                              master_proyek.keterangan,
                              master_proyek.status_penggalangan")
                ->from("trans_penggalangan_dana")
                ->join("master_proyek","master_proyek.id_proyek = trans_penggalangan_dana.id_proyek")
                ->where("trans_penggalangan_dana.id_penggalangan_dana_proyek",dec_url($id_penggalangan_dana_proyek))
                ->where("master_proyek.kode","$kode")
                ->where("trans_penggalangan_dana.id_pendana",sess("id_user"))
                ->get();
    return $qry->row();
  }

}
