<?php if (!defined("BASEPATH")) exit("No direct script access allowed");

/**
 *libray proyek custom
 */
class Proyek
{

  private $CI;

  private $select;

  private $table;


  // Construct
  function __construct() {
      // Get Codeigniter instance
      $this->CI = get_instance();

      $this->table = "trans_penggalangan_dana";

      $this->select = "trans_penggalangan_dana.id_penggalangan_dana_proyek,
                        trans_penggalangan_dana.id_proyek,
                        trans_penggalangan_dana.id_pendana,
                        trans_penggalangan_dana.jumlah_paket AS jumlah_paket_pendana,
                        master_proyek.harga_paket,
                        master_proyek.jumlah_paket AS jumlah_paket_proyek";
  }


  function _get_query($id_proyek)
  {
    $this->CI->db->select($this->select);
    $this->CI->db->from($this->table);
    $this->CI->db->join("master_proyek","master_proyek.id_proyek = trans_penggalangan_dana.id_proyek");
    $this->CI->db->where("trans_penggalangan_dana.id_proyek",$id_proyek);
  }

  function _get_field($id_proyek,$field)
  {
    $this->_get_query($id_proyek);
    $query = $this->CI->db->get();
    if ($query->num_rows() > 0) {
      return $query->row()->$field;
    }
  }


  function total_paket($id_proyek)
  {
    $this->_get_query($id_proyek);
    $query = $this->CI->db->get();
    if ($query->num_rows() > 0) {
      foreach ($query->result() as $key) {
        $row[] = $key->jumlah_paket_pendana;
      }
      return array_sum($row);
    }else {
      return 0;
    }

  }

  function total_dana_terkumpul($id_proyek)
  {
    $harga = $this->_get_field($id_proyek,"harga_paket");
    $total_paket = $this->total_paket($id_proyek);
    $jumlah = $total_paket*$harga;
    return $jumlah;
  }

  function count_pendana($id_proyek)
  {
    $this->_get_query($id_proyek);
    $query = $this->CI->db->count_all_results();
    return $query;
  }





}
