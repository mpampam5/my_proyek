<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

    class Balance_penerima_dana {

        /**
         * Codeigniter reference
         */
        private $CI;


        // Construct
        function __construct() {
            // Get Codeigniter instance
            $this->CI = get_instance();
        }

        //heleper methode "balance_user($id_penerima_dana)"
        function inits($id_penerima_dana){
          $deposito = $this->get_depositos($id_penerima_dana);
          $withdraw = $this->get_withdraws($id_penerima_dana);
          // $pendanaan_proyek = $this->pendanaan_proyek($id_penerima_dana);
          $nominal = $deposito-$withdraw;
          return $nominal;
        }


        function get_depositos($id_penerima_dana)
        {
          $qry = $this->CI->db->select("id_deposito,id_penerima_dana,SUM(nominal) AS nominal,status")
                              ->from("deposito_usrp")
                              ->where("id_penerima_dana",$id_penerima_dana)
                              ->where("status","approved")
                              ->group_by('id_penerima_dana')
                              ->get();
          if ($qry->num_rows() > 0 ) {
            return $qry->row()->nominal;
          }else {
            return 0;
          }
        }


        function get_withdraws($id_penerima_dana)
        {
          $qry = $this->CI->db->select("id_withdraw,id_penerima_dana,SUM(nominal) AS nominal,status")
                              ->from("withdraw_usrp")
                              ->where("id_penerima_dana",$id_penerima_dana)
                              ->where("status","approved")
                              ->group_by('id_penerima_dana')
                              ->get();
          if ($qry->num_rows() > 0 ) {
            return $qry->row()->nominal;
          }else {
            return 0;
          }
        }




}
