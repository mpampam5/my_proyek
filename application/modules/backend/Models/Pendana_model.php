<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendana_model extends MY_Model{

  var $column_order = array(null,'master_pendana.no_ktp','master_pendana.nama','master_pendana.email','master_pendana.telepon');
  var $order = array('master_pendana.id_pendana'=>"DESC");
  var $select = " master_pendana.id_pendana,
                  master_pendana.id_reg,
                  master_pendana.no_ktp,
                  master_pendana.nama,
                  master_pendana.telepon,
                  master_pendana.email";

  private function _get_datatables_query()
    {
      $this->db->select($this->select);
      $this->db->from("master_pendana");
      $this->db->where("master_pendana.is_active","1");
      if($this->input->post('id_reg'))
        {
            $this->db->like('master_pendana.id_reg', $this->input->post('id_reg'));
        }
      if($this->input->post('nik'))
        {
            $this->db->like('master_pendana.no_ktp', $this->input->post('nik'));
        }
      if($this->input->post('nama'))
        {
            $this->db->like('master_pendana.nama', $this->input->post('nama'));
        }
      if($this->input->post('email'))
        {
            $this->db->like('master_pendana.email', $this->input->post('email'));
        }
      if($this->input->post('telepon'))
        {
            $this->db->like('master_pendana.telepon', $this->input->post('telepon'));
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
        $this->db->from("master_pendana");
        $this->db->where("master_pendana.is_active","1");
        return $this->db->count_all_results();
    }


    function get_detail_model($id)
    {
      return $this->db->select("master_pendana.id_pendana,
                        master_pendana.id_reg,
                        master_pendana.no_ktp,
                        master_pendana.no_npwp,
                        master_pendana.nama,
                        master_pendana.tempat_lahir,
                        master_pendana.tgl_lahir,
                        master_pendana.jenis_kelamin,
                        master_pendana.status_perkawinan,
                        master_pendana.telepon,
                        master_pendana.email,
                        master_pendana.nama_ibu_kandung,
                        master_pendana.id_pendidikan,
                        master_pendana.id_pekerjaan,
                        master_pendana.id_pendapatan,
                        master_pendana.alamat,
                        master_pendana.provinsi,
                        master_pendana.kabupaten,
                        master_pendana.kecamatan,
                        master_pendana.kelurahan,
                        master_pendana.kode_pos,
                        master_pendana.no_rekening,
                        master_pendana.nama_rekening,
                        master_pendana.id_bank,
                        master_pendana.foto_diri,
                        master_pendana.foto_ktp,
                        master_pendana.foto_diri_ktp,
                        master_pendana.foto_buku_rekening,
                        master_pendana.password,
                        master_pendana.token_password,
                        master_pendana.pin,
                        master_pendana.token_pin,
                        master_pendana.is_verifikasi,
                        master_pendana.is_active,
                        master_pendana.created_at,
                        master_pendana.update_at,
                        master_pendana.verifikasi_at,
                        trans_pendidikan.pendidikan,
                        trans_pekerjaan.pekerjaan,
                        trans_pendapatan.pendapatan,
                        trans_bank.nama_bank")
                ->from("master_pendana")
                ->join("trans_pendidikan","trans_pendidikan.id_pendidikan = master_pendana.id_pendidikan","left")
                ->join("trans_pekerjaan","trans_pekerjaan.id_pekerjaan = master_pendana.id_pekerjaan","left")
                ->join("trans_pendapatan","trans_pendapatan.id_pendapatan = master_pendana.id_pendapatan","left")
                ->join("trans_bank","trans_bank.id_bank = master_pendana.id_bank","left")
                ->where("master_pendana.id_pendana",$id)
                ->get()
                ->row();
    }

}
