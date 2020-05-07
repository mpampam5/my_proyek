<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proyek extends Usrp{

  public function __construct()
  {
    parent::__construct();
    $this->load->model("Proyek_model","model");
  }

  function index()
  {
    $this->template->set_title("Master Proyek");
    $this->template->view("content/proyek/index");
  }

  function json()
  {
    if ($this->input->is_ajax_request()) {
      $list = $this->model->get_datatables();
      $data = array();
      // $no = $_POST['start'];
      foreach ($list as $dt) {
          $row = array();
          $row[] = date("d/m/Y H:i",strtotime($dt->created_at));
          $row[] = "<b><a href=''><i class='fa fa-link'></i> ".$dt->id_reg."</a></b> </br>".$dt->nama_perusahaan;
          $row[] = "Pendanaan <b class='text-info'>$dt->kode</b>. \"".$dt->title."\"
                    <ul style='font-size:12px'>
                      <li>Priode/Tenor : ".$dt->durasi_proyek." Bulan</li>
                      <li>Harga Paket : Rp.".format_rupiah($dt->harga_paket)."</li>
                      <li>Jumlah Paket : ".$dt->jumlah_paket."</li>
                      <li>Total Dana Dibutuhkan : Rp.".format_rupiah($dt->harga_paket*$dt->jumlah_paket)."</li>
                    </ul>";

          if ($dt->status=="process") {
            $row[] = "<i>Belum Di Tentukan</i>";
          }elseif ($dt->status=="publish") {
            if ($dt->status_penggalangan=="mulai") {
              $row[] = "<span class='badge badge-success'>Penggalangan Berlangsung</span>
                        <p class='font-12 mt-2' style='font-size:10px'>
                          <i class='fa fa-calendar'></i> ".date('d-m-Y',strtotime($dt->mulai_penggalangan))." s/d ".date('d-m-Y',strtotime($dt->akhir_penggalangan)).
                        "</br>
                        <span class='font-12'>
                          Tersisa ".selisih_hari($dt->akhir_penggalangan)." Hari Lagi
                        </span>
                        </p>";
            }elseif ($dt->status_penggalangan=="selesai") {
              $row[] = "<span class='badge badge-danger text-white'>Telah Berakhir</span>";
            }
          }elseif ($dt->status=="cancel") {
            $row[] = "-";
            $row[] = "<span class='badge badge-danger'>Cancel</span>";
          }elseif ($dt->status=="done") {
            $row[] = "<span class='badge badge-danger text-white'>Telah Berakhir</span>
            <p class='font-12 mt-2' style='font-size:10px'>
              <i class='fa fa-calendar'></i> ".date('d-m-Y',strtotime($dt->mulai_penggalangan))." s/d ".date('d-m-Y',strtotime($dt->akhir_penggalangan)).
            "</br>";
          }


          if ($dt->status=="process") {
            $row[] = "<span class='badge badge-warning text-white'>Menunggu Verifikasi</span>";
          }elseif ($dt->status=="publish") {
            $row[] = "<span class='badge badge-success'>Publish</span>";
          }elseif ($dt->status=="done") {
            $row[] = "<span class='badge badge-success'>Proyek Selesai</span>";
          }


          $row[] = '
                      <a href="'.site_url("usrp/proyek/detail/".enc_url($dt->id_proyek)).'" class="btn btn-info btn-sm" title="detail"><i class="fa fa-file"></i></a>
                  ';

          $data[] = $row;
      }

      $output = array(
                      "draw" => $_POST['draw'],
                      "recordsTotal" => $this->model->count_all(),
                      "recordsFiltered" => $this->model->count_filtered(),
                      "data" => $data,
              );
      //output to json format
      echo json_encode($output);
    }
  }


  function add()
  {
    $this->db->where('complate', "0")
             ->delete('master_proyek');

    $data = array('kode' => $this->_kode(),
                  'id_penerima_dana' => sess("id_user"),
                  'created_at' => date('Y-m-d H:i:s')
                );
    $this->db->insert("master_proyek",$data);

    $dt['kode'] = $data['kode'];
    $dt['id_proyek'] = $this->db->insert_id();
    $this->template->set_title("Tambah Penggalangan Dana");
    $this->template->view("content/proyek/form",$dt);
  }

  function _kode(){
    $q = $this->db->query("SELECT MAX(RIGHT(kode,6)) AS kd_trans FROM master_proyek WHERE DATE(created_at)=CURDATE()");
          $kd = "";
          if($q->num_rows()>0){
              foreach($q->result() as $k){
                  $tmp = ((int)$k->kd_trans)+1;
                  $kd = sprintf("%06s", $tmp);
              }
          }else{
              $kd = "0000001";
          }
          return "PR-".date('m.y')."-".$kd;
  }

}
