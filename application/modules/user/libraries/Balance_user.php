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
          $nominal = $deposito-$withdraw;
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
                              ->where("status !=","cancel")
                              ->group_by('id_pendana')
                              ->get();
          if ($qry->num_rows() > 0 ) {
            return $qry->row()->nominal;
          }else {
            return 0;
          }
        }



}