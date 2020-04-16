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
          $pendanaan_proyek = $this->pendanaan_proyek($id_pendana);
          $nominal = $deposito-$withdraw-$pendanaan_proyek;
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


        function pendanaan_proyek($id_pendana)
        {
          $qry = $this->CI->db->select("trans_penggalangan_dana.id_penggalangan_dana_proyek,
                                        trans_penggalangan_dana.id_proyek,
                                        trans_penggalangan_dana.id_pendana,
                                        trans_penggalangan_dana.jumlah_paket,
                                        master_proyek.harga_paket")
                              ->from("trans_penggalangan_dana")
                              ->join("master_proyek","master_proyek.id_proyek = trans_penggalangan_dana.id_proyek")
                              ->where("trans_penggalangan_dana.id_pendana",$id_pendana)
                              ->get();
            $row = array();
            foreach ($qry->result() as $dt) {
              $row[] = $dt->harga_paket*$dt->jumlah_paket;
            }

            return array_sum($row);
        }


}
