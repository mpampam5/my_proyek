<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_proyek extends Backend{

  public function __construct()
  {
    parent::__construct();
    $this->load->model("Master_proyek_model","model");
  }

  function index()
  {
    $this->template->set_title("Daftar Proyek");
    $this->template->view("content/master_proyek/index");
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
          $row[] = "<b><a href=''><i class='fa fa-link'></i> ".$dt->id_reg."</a></b> ".$dt->nama;
          $row[] = "Pendanaan <b class='text-info'>$dt->kode</b>. ".$dt->title."
                    <ul>
                      <li>Priode/Tenor : ".$dt->durasi_proyek." Bulan</li>
                      <li>Harga Paket : Rp.".format_rupiah($dt->harga_paket)."</li>
                      <li>Jumlah Paket : ".$dt->jumlah_paket."</li>
                      <li>Total Dana Dibutuhkan : Rp.".format_rupiah($dt->harga_paket*$dt->jumlah_paket)."</li>
                    </ul>
                    "


                    ;

          if ($dt->status=="process") {
            $row[] = "<i>Belum Di Tentukan</i>";
          }elseif ($dt->status=="publish") {
            if ($dt->status_penggalangan=="mulai") {
              $row[] = "<span class='badge badge-success'>Sedang Berlangsung</span>
                        <p class='font-12 mt-2'>
                          <i class='fa fa-calendar'></i> ".date('d-m-Y',strtotime($dt->mulai_penggalangan))." s/d ".date('d-m-Y',strtotime($dt->akhir_penggalangan)).
                        "</br>
                        <span class='font-12'>
                          Tersisa ".selisih_hari($dt->akhir_penggalangan)." Hari Lagi
                        </span>
                        </p>";
            }elseif ($dt->status_penggalangan=="selesai") {
              $row[] = "<span class='badge badge-danger text-white'>Telah Berakhir</span>";
            }
          }


          if ($dt->status=="process") {
            $row[] = "<span class='badge badge-warning text-white'>Menunggu Verifikasi</span>";
          }elseif ($dt->status=="publish") {
            $row[] = "<span class='badge badge-success'>Terverifikasi</span>";
          }


          $row[] = '
                      <a href="'.site_url("backend/pendana/detail/".enc_url($dt->id_proyek)).'" class="btn btn-info btn-sm" title="detail"><i class="fa fa-file"></i></a>
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


}
