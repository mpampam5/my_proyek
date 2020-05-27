<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

    class Balance {

        /**
         * Codeigniter reference
         */
        private $CI;


        // Construct
        function __construct() {
            // Get Codeigniter instance
            $this->CI = get_instance();
        }

        //heleper methode "balance_user($id_pendana)"
        function init($id_pendana){
          $deposito = $this->get_deposito($id_pendana);
          $withdraw = $this->get_withdraw($id_pendana);
          $pendanaan_proyek = $this->get_pendanaan($id_pendana);
          $dividen = $this->get_dividen($id_pendana);
          $nominal = $deposito-$withdraw-$pendanaan_proyek+$dividen;
          return $nominal;
        }


        function get_deposito($id_pendana)
        {
          $qry = $this->CI->db->select("id_deposito,id_pendana,SUM(nominal) AS nominal,status")
                              ->from("deposito")
                              ->where("id_pendana",$id_pendana)
                              ->where("status","approved")
                              ->group_by('id_pendana')
                              ->get();
          if ($qry->num_rows() > 0 ) {
            return $qry->row()->nominal;
          }else {
            return 0;
          }
        }


        function get_withdraw($id_pendana)
        {
          $qry = $this->CI->db->select("id_withdraw,id_pendana,SUM(nominal) AS nominal,status")
                              ->from("withdraw")
                              ->where("id_pendana",$id_pendana)
                              ->where("status","approved")
                              ->group_by('id_pendana')
                              ->get();
          if ($qry->num_rows() > 0 ) {
            return $qry->row()->nominal;
          }else {
            return 0;
          }
        }


        function get_pendanaan($id_pendana, $id_proyek = null)
        {
          $this->CI->db->select("id_penggalangan_dana_proyek, SUM(total_rupiah) AS total_rupiah");
          $this->CI->db->from("trans_penggalangan_dana");
          $this->CI->db->where("id_pendana",$id_pendana);
          $this->CI->db->where("status","approved");
          if ($id_proyek!=null) {
            $this->CI->db->where("id_proyek",$id_proyek);
          }
          $this->CI->db->group_by('id_pendana');
            $qry = $this->CI->db->get();
          if ($qry->num_rows() > 0 ) {
            return $qry->row()->total_rupiah;
          }else {
            return 0;
          }
        }


        function get_dividen($id_pendana)
        {
          $this->CI->db->select(" trans_profit.id_trans_profit,
                                  trans_profit.id_proyek,
                                  trans_profit.id_trans_pendanaan_proyek,
                                  trans_profit.id_pendana AS id_pendana_proyek,
                                  trans_profit.waktu_pembagian,
                                  SUM(trans_profit.total) AS total,
                                  trans_profit.`status`,
                                  trans_penggalangan_dana.`status`");
          $this->CI->db->from("trans_profit");
          $this->CI->db->join("trans_penggalangan_dana","trans_penggalangan_dana.id_penggalangan_dana_proyek = trans_profit.id_trans_pendanaan_proyek");
          $this->CI->db->where("trans_profit.id_pendana",$id_pendana);
          $this->CI->db->where("trans_penggalangan_dana.`status`","approved");
          $this->CI->db->where("trans_profit.status",1);
          $this->CI->db->group_by("trans_profit.id_pendana");
          $qry = $this->CI->db->get();
          if ($qry->num_rows() > 0 ) {
            return $qry->row()->total;
          }else {
            return 0;
          }
        }


}
