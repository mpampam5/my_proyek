<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

    class Balance_user {

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
        function init(){
          $deposito = $this->get_deposito(sess('id_user'));
          $withdraw = $this->get_withdraw(sess('id_user'));
          $pendanaan = $this->get_pendanaan(sess('id_user'));
          $nominal = $deposito-$withdraw-$pendanaan;
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



}
