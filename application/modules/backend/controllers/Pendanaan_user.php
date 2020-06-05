<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendanaan_user extends Backend{

  public function __construct()
  {
    parent::__construct();
    $this->load->model("Pendanaan_user_model","model");
  }

  function get_pendanaan($id, $id_reg)
  {
    $this->template->set_title("Pendanaan user #$id_reg");
    $data['id_pendana'] = $id;
    $data['id_reg'] = $id_reg;
    $this->template->view("content/pendanaan_user/index",$data);
  }

  function json($id_pendana)
  {
    if ($this->input->is_ajax_request()) {
      $list = $this->model->get_datatables_pendanaan(dec_url($id_pendana));
      $data = array();
      // $no = $_POST['start'];
      foreach ($list as $dt) {
          $row = array();
          $row[] = date("d/m/Y",strtotime($dt->date_join));
          $row[] = 'Pendanaan <a target="_blank" href="'.site_url("backend/master_proyek/detail/".enc_url("$dt->id_proyek")).'" class="text-bold"><i class="fa fa-link"></i>'.$dt->kode.'</a>. '.$dt->title;
          $row[] = "Hari Ke - ".$dt->join_hari_ke;
          $row[] = $dt->jumlah_paket." Paket";
          $row[] = "Rp.".format_rupiah($dt->total_rupiah);
          if ($dt->status=="approved") {
            $row[] = '<span class="badge badge-success">Approved</span>';
          }elseif($dt->status=="dikembalikan") {
            $row[] = '<span class="badge badge-danger">Dana Di Kembalikan</span>';
          }

          $row[] = '<a  target="_blank" href="'.site_url("backend/master_proyek/get_dividen/".enc_url($dt->id_penggalangan_dana_proyek)."/".enc_url($dt->id_pendana)."/".enc_url($dt->id_proyek)."/".$dt->kode).'" class="btn btn-sm btn-primary">Lihat Dividen</a>
                    <a  target="_blank" href="'.site_url("backend/master_proyek/detail/".enc_url("$dt->id_proyek")).'" class="btn btn-sm btn-primary mt-1">Detail Proyek</a>
                    ';
          $data[] = $row;
      }

      $output = array(
                      "draw" => $_POST['draw'],
                      "recordsTotal" => $this->model->count_all_pemberi_dana(dec_url($id_pendana)),
                      "recordsFiltered" => $this->model->count_filtered_pemberi_dana(dec_url($id_pendana)),
                      "data" => $data,
              );
      //output to json format
      echo json_encode($output);
    }
  }



}
