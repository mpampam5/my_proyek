<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_penerima_dana_model extends MY_Model{

  var $column_order = array(null,'master_penerima_dana.no_ktp','master_penerima_dana.nama','master_penerima_dana.email','master_penerima_dana.nama_perusahaan');
  var $order = array('master_penerima_dana.id_penerima_dana'=>"DESC");
  var $select = " master_penerima_dana.id_penerima_dana,
                  master_penerima_dana.id_reg,
                  master_penerima_dana.no_ktp,
                  master_penerima_dana.nama,
                  master_penerima_dana.nama_perusahaan,
                  master_penerima_dana.email";

  private function _get_datatables_query()
    {
      $this->db->select($this->select);
      $this->db->from("master_penerima_dana");
      $this->db->where("master_penerima_dana.is_active","1");
      $this->db->where("master_penerima_dana.complate","1");
      $this->db->where("master_penerima_dana.is_delete !=","1");
      if($this->input->post('id_reg'))
        {
            $this->db->like('master_penerima_dana.id_reg', $this->input->post('id_reg'));
        }
      if($this->input->post('nik'))
        {
            $this->db->like('master_penerima_dana.no_ktp', $this->input->post('nik'));
        }
      if($this->input->post('nama'))
        {
            $this->db->like('master_penerima_dana.nama', $this->input->post('nama'));
        }
      if($this->input->post('email'))
        {
            $this->db->like('master_penerima_dana.email', $this->input->post('email'));
        }
      if($this->input->post('telepon'))
        {
            $this->db->like('master_penerima_dana.nama_perusahaan', $this->input->post('nama_perusahaan'));
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
        $this->db->from("master_penerima_dana");
        $this->db->where("master_penerima_dana.is_active","1");
        $this->db->where("master_penerima_dana.complate","1");
        $this->db->where("master_penerima_dana.is_delete !=","1");
        return $this->db->count_all_results();
    }


    function get_detail_model($id)
    {
      return $this->db->select("master_penerima_dana.id_penerima_dana,
                        master_penerima_dana.id_reg,
                        master_penerima_dana.no_ktp,
                        master_penerima_dana.nama,
                        master_penerima_dana.alamat,
                        master_penerima_dana.email,
                        master_penerima_dana.telepon,
                        master_penerima_dana.tempat_lahir,
                        master_penerima_dana.tgl_lahir,
                        master_penerima_dana.token_password,
                        master_penerima_dana.`password`,
                        master_penerima_dana.pin_token,
                        master_penerima_dana.pin,
                        master_penerima_dana.nama_perusahaan,
                        master_penerima_dana.bidang_usaha,
                        master_penerima_dana.provinsi,
                        master_penerima_dana.kabupaten,
                        master_penerima_dana.alamat_perusahaan,
                        master_penerima_dana.telepon_perusahaan,
                        master_penerima_dana.bentuk_badan_usaha,
                        master_penerima_dana.file_badan_usaha,
                        master_penerima_dana.dokument_perizinan,
                        master_penerima_dana.file_dokument_perizinan,
                        master_penerima_dana.nama_rekening,
                        master_penerima_dana.no_rekening,
                        master_penerima_dana.bank,
                        master_penerima_dana.is_active,
                        master_penerima_dana.is_delete,
                        master_penerima_dana.complate,
                        trans_bank.nama_bank")
                ->from("master_penerima_dana")
                ->join("trans_bank","trans_bank.id_bank = master_penerima_dana.bank","left")
                ->where("master_penerima_dana.id_penerima_dana",$id)
                ->get()
                ->row();
    }


}
