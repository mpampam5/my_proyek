<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_proyek_model extends MY_Model{

  var $column_order = array('master_proyek.created_at','master_proyek.kode',null,null,null);
  var $order = array('master_proyek.id_proyek'=>"DESC");
  var $select = " master_proyek.id_proyek,
                  master_proyek.id_penerima_dana,
                  master_proyek.kode,
                  master_proyek.title,
                  master_proyek.harga_paket,
                  master_proyek.jumlah_paket,
                  master_proyek.lama_penggalangan,
                  master_proyek.mulai_penggalangan,
                  master_proyek.akhir_penggalangan,
                  master_proyek.tgl_mulai_proyek,
                  master_proyek.durasi_proyek,
                  master_proyek.imbal_hasil_pendana,
                  master_proyek.ujroh_penyelenggara,
                  master_proyek.lokasi_proyek,
                  master_proyek.provinsi,
                  master_proyek.kabupaten,
                  master_proyek.kecamatan,
                  master_proyek.`status`,
                  master_proyek.status_penggalangan,
                  master_proyek.status_pembagian_dividen,
                  master_proyek.created_at,
                  master_penerima_dana.id_reg,
                  master_penerima_dana.nama_perusahaan,
                  master_penerima_dana.nama";

  private function _get_datatables_query()
    {
      $this->db->select($this->select);
      $this->db->from("master_proyek");
      $this->db->join("master_penerima_dana","master_penerima_dana.id_penerima_dana = master_proyek.id_penerima_dana");
      $this->db->where("master_proyek.complate","1");
      $this->db->where("master_proyek.status !=","delete");
      if($this->input->post('status_publish'))
        {
            $this->db->like('master_proyek.`status`', $this->input->post('status_publish'));
        }
      if($this->input->post('status_penggalangan'))
        {
            $this->db->like('master_proyek.status_penggalangan', $this->input->post('status_penggalangan'));
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
        $this->db->from("master_proyek");
        $this->db->where("master_proyek.complate","1");
        $this->db->where("master_proyek.status !=","delete");
        return $this->db->count_all_results();
    }

    function get_detail_model($id)
    {
      return $this->db->select("master_proyek.id_proyek,
                                master_proyek.id_penerima_dana,
                                master_proyek.kode,
                                master_proyek.title,
                                master_proyek.harga_paket,
                                master_proyek.jumlah_paket,
                                master_proyek.lama_penggalangan,
                                master_proyek.mulai_penggalangan,
                                master_proyek.akhir_penggalangan,
                                master_proyek.tgl_mulai_proyek,
                                master_proyek.durasi_proyek,
                                master_proyek.jenis_akad,
                                master_proyek.imbal_hasil_pendana,
                                master_proyek.imbal_hasil,
                                master_proyek.ujroh_penyelenggara,
                                master_proyek.dana_dibutuhkan,
                                master_proyek.deskripsi,
                                master_proyek.foto_1,
                                master_proyek.foto_2,
                                master_proyek.foto_3,
                                master_proyek.lokasi_proyek,
                                master_proyek.provinsi,
                                master_proyek.kabupaten,
                                master_proyek.kecamatan,
                                master_proyek.kelurahan,
                                master_proyek.legalitas,
                                master_proyek.`status`,
                                master_proyek.status_pembagian_dividen,
                                master_proyek.created_at,
                                master_proyek.acc_at,
                                master_proyek.acc_by,
                                master_proyek.acc_by_id,
                                master_proyek.keterangan,
                                master_proyek.status_penggalangan,
                                master_penerima_dana.id_reg,
                                master_penerima_dana.nama_perusahaan,
                                master_penerima_dana.nama,
                                master_penerima_dana.email")
                      ->from("master_proyek")
                      ->join("master_penerima_dana","master_penerima_dana.id_penerima_dana = master_proyek.id_penerima_dana")
                      ->where("master_proyek.id_proyek",$id)
                      ->get()
                      ->row();
    }


    function get_dividen($id_penggalangan_dana_proyek , $id_pendana, $id_proyek)
    {
      return $this->db->select("trans_profit.id_trans_profit,
                                        trans_profit.id_proyek,
                                        trans_profit.id_pendana,
                                        trans_profit.id_trans_pendanaan_proyek,
                                        trans_profit.waktu_pembagian,
                                        trans_profit.nominal_rupiah,
                                        trans_profit.penggalangan,
                                        trans_profit.sisa_imbal_hasil,
                                        trans_profit.pendanaan,
                                        trans_profit.total,
                                        trans_profit.status AS status_profit,
                                        trans_penggalangan_dana.status")
                                ->from("trans_profit")
                                ->join("trans_penggalangan_dana","trans_penggalangan_dana.id_penggalangan_dana_proyek = trans_profit.id_trans_pendanaan_proyek")
                                ->where("trans_profit.id_proyek",dec_url($id_proyek))
                                ->where("trans_profit.id_pendana",dec_url($id_pendana))
                                ->where("trans_profit.id_trans_pendanaan_proyek",dec_url($id_penggalangan_dana_proyek))
                                ->get();
    }

    function get_export()
    {
      return $this->db->select("master_proyek.id_proyek,
                                master_proyek.id_penerima_dana,
                                master_proyek.kode,
                                master_proyek.title,
                                master_proyek.harga_paket,
                                master_proyek.jumlah_paket,
                                master_proyek.lama_penggalangan,
                                master_proyek.mulai_penggalangan,
                                master_proyek.akhir_penggalangan,
                                master_proyek.tgl_mulai_proyek,
                                master_proyek.tgl_selesai_proyek,
                                master_proyek.durasi_proyek,
                                master_proyek.jenis_akad,
                                master_proyek.imbal_hasil_pendana,
                                master_proyek.imbal_hasil,
                                master_proyek.ujroh_penyelenggara,
                                master_proyek.deskripsi,
                                master_proyek.foto_1,
                                master_proyek.foto_2,
                                master_proyek.foto_3,
                                master_proyek.lokasi_proyek,
                                master_proyek.dana_dibutuhkan,
                                master_proyek.provinsi,
                                master_proyek.kabupaten,
                                master_proyek.kecamatan,
                                master_proyek.kelurahan,
                                master_proyek.legalitas,
                                master_proyek.`status`,
                                master_proyek.status_pembagian_dividen,
                                master_proyek.created_at,
                                master_proyek.acc_at,
                                master_proyek.acc_by,
                                master_proyek.acc_by_id,
                                master_proyek.keterangan,
                                master_proyek.status_penggalangan,
                                master_penerima_dana.id_reg,
                                master_penerima_dana.nama_perusahaan,
                                master_penerima_dana.nama,
                                master_penerima_dana.email")
                      ->from("master_proyek")
                      ->join("master_penerima_dana","master_penerima_dana.id_penerima_dana = master_proyek.id_penerima_dana")
                      ->where("master_proyek.complate","1")
                      ->get();
    }

}
