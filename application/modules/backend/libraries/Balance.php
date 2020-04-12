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
          $nominal = $deposito;
          return $nominal;
        }


        function get_deposito($id_pendana)
        {
          $qry = $this->CI->db->select("id_deposito,id_pendana,SUM(nominal) AS nominal,status")
                              ->from("deposito")
                              ->where("id_pendana",$id_pendana)
                              ->where("status","approved")
                              ->group_by('id_pendana')
                              ->get()
                              ->row();
          return $qry->nominal;
        }


}
