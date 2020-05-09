<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_proyek extends Backend{

  public function __construct()
  {
    parent::__construct();
    $this->load->library("proyek");
    $this->load->helper("proyek");
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
          $row[] = "<b><a href=''><i class='fa fa-link'></i> ".$dt->id_reg."</a></b> </br>".$dt->nama_perusahaan;
          $row[] = "Pendanaan <b class='text-info'>$dt->kode</b>. ".$dt->title."
                    <ul>
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
          }elseif ($dt->status=="cancel") {
            $row[] = "-";
            $row[] = "<span class='badge badge-danger'>Cancel</span>";
          }elseif ($dt->status=="done") {
            $row[] = "<span class='badge badge-danger text-white'>Telah Berakhir</span>
            <p class='font-12 mt-2'>
              <i class='fa fa-calendar'></i> ".date('d-m-Y',strtotime($dt->mulai_penggalangan))." s/d ".date('d-m-Y',strtotime($dt->akhir_penggalangan)).
            "</br>";
          }elseif ($dt->status=="pengerjaan") {
            $row[] = "<span class='badge badge-danger text-white'>Telah Berakhir</span>
            <p class='font-12 mt-2' style='font-size:10px'>
              <i class='fa fa-calendar'></i> ".date('d-m-Y',strtotime($dt->mulai_penggalangan))." s/d ".date('d-m-Y',strtotime($dt->akhir_penggalangan)).
            "</br>";
            $row[] = "<span class='badge badge-success'>Proyek Di Kerjakan</span><p style='font-size:10px' class='text-center'>Proyek mulai di kerjakan ".$dt->durasi_proyek." bulan kedepan terhitung mulai tgl <span>".date('d-m-Y',strtotime($dt->tgl_mulai_proyek))."</span></p>";
          }elseif ($dt->status=="dana_dikembalikan") {
            $row[] = "<span class='badge badge-danger text-white'>Telah Berakhir</span>
            <p class='font-12 mt-2' style='font-size:10px'>
              <i class='fa fa-calendar'></i> ".date('d-m-Y',strtotime($dt->mulai_penggalangan))." s/d ".date('d-m-Y',strtotime($dt->akhir_penggalangan)).
            "</br>";
            $row[] = "<span class='badge badge-danger'>Dana Di Kembalikan</span>";
          }


          if ($dt->status=="process") {
            $row[] = "<span class='badge badge-warning text-white'>Menunggu Verifikasi</span>";
          }elseif ($dt->status=="publish") {
            $row[] = "<span class='badge badge-success'>Publish</span>";
          }elseif ($dt->status=="done") {
            $row[] = "<span class='badge badge-success'>Proyek Selesai</span>";
          }


          $row[] = '
                      <a href="'.site_url("backend/master_proyek/detail/".enc_url($dt->id_proyek)).'" class="btn btn-info btn-sm" title="detail"><i class="fa fa-file"></i></a>
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



  function detail($id="")
  {
    if ($row = $this->model->get_detail_model(dec_url($id))) {
      $this->template->set_title("Detail Proyek #$row->kode");
      $data['dt'] = $row;
      $this->template->view("content/master_proyek/detail",$data);
    }
  }


   function action($id="")
   {
     if ($this->input->is_ajax_request()) {
       $json = array('success'=>false, 'alert'=>array());
       $status = $this->input->post("status_publish",true);
       $mulai_penggalangan = date("Y-m-d",strtotime($this->input->post("start_proyek")));
       $akhir_penggalangan = date("Y-m-d",strtotime($this->input->post("end_proyek")));

       $this->form_validation->set_rules("status_publish","*&nbsp;","trim|xss_clean|required|callback__cek_status");
       if ($status=="publish") {
         $this->form_validation->set_rules("start_proyek","*&nbsp;","trim|xss_clean|required");
         $this->form_validation->set_rules("end_proyek","*&nbsp;","trim|xss_clean|required");
       }
       $this->form_validation->set_rules("keterangan","*&nbsp;","trim|xss_clean");
       $this->form_validation->set_rules("password","*&nbsp;","trim|xss_clean|required|callback__cek_password");
       $this->form_validation->set_error_delimiters('<span class="error text-danger" style="font-size:11px">','</span>');
       if ($this->form_validation->run()) {
         if ($id!="") {
           if ($row = $this->model->get_detail_model(dec_url($id))) {



              if ($status=="publish") {
                $update['mulai_penggalangan']   = $mulai_penggalangan;
                $update['akhir_penggalangan']   = $akhir_penggalangan;
                $update['tgl_mulai_proyek']     = date("Y-m-d",strtotime("+1 days",strtotime($akhir_penggalangan)));
                $update['status_penggalangan']  = "mulai";
                $update['lama_penggalangan']    = selisih_hari($akhir_penggalangan,$mulai_penggalangan);
              }
              $update['status']                 = $status;
              $update['acc_by']                 = "admin";
              $update['acc_by_id']              = sess("id_user");
              $update['acc_at']                 = date("Y-m-d H:i:s");
              $update['keterangan']             = $this->input->post("keterangan");

              $this->model->get_update("master_proyek",$update,["id_proyek"=>dec_url($id)]);
             $json['alert'] = "success";
           }else {
             $json['alert'] = "process error";
           }
         }else {
           $json['alert'] = "process error";
         }
         $json["success"] = true;
       }else {
         foreach ($_POST as $key => $value)
           {
             $json['alert'][$key] = form_error($key);
           }
       }

        echo json_encode($json);
     }
   }

   function _cek_status($str)
   {
     $status = ["publish","cancel"];
     if (in_array($str,$status)) {
         return true;
     }else {
       $this->form_validation->set_message("_cek_status","* status tidak valid");
        return false;
     }
   }

   function get_pemberi_dana($id_proyek=null)
   {
     if ($row = $this->model->get_detail_model(dec_url($id_proyek))) {
       $this->template->set_title("Daftar Pemberi Dana Pada Proyek #$row->kode");
       $data['dt'] = $row;
       $this->template->view("content/master_proyek/daftar_pemberi_dana",$data);
     }
   }


   function json_pemberi_dana($id_proyek)
   {
     if ($this->input->is_ajax_request()) {
       $this->load->model("Trans_pemberi_dana_proyek","model_pemberi_dana");
       $list = $this->model_pemberi_dana->get_datatables_pemberi_dana(dec_url($id_proyek));
       $data = array();
       // $no = $_POST['start'];
       foreach ($list as $dt) {
           $row = array();
           $row[] = date("d/m/Y H:s",strtotime($dt->date_join));
           $row[] = "Hari Ke - ".$dt->join_hari_ke;
           $row[] = "<a href='".site_url("backend/pendana/detail/".enc_url("$dt->id_pendana"))."' target='_blank'><i class='fa fa-link'></i> ".$dt->id_reg."</a> ".$dt->nama;
           $row[] = $dt->jumlah_paket." Paket";
           $row[] = "Rp.".format_rupiah($dt->harga_paket*$dt->jumlah_paket);

           $data[] = $row;
       }

       $output = array(
                       "draw" => $_POST['draw'],
                       "recordsTotal" => $this->model_pemberi_dana->count_all_pemberi_dana(dec_url($id_proyek)),
                       "recordsFiltered" => $this->model_pemberi_dana->count_filtered_pemberi_dana(dec_url($id_proyek)),
                       "data" => $data,
               );
       //output to json format
       echo json_encode($output);
     }
   }


   function get_progres_proyek($id_proyek=null)
   {
     if ($row = $this->model->get_detail_model(dec_url($id_proyek))) {
       $this->template->set_title("Progres Pengerjaan Pada Proyek #$row->kode");
       $data['dt'] = $row;
       $data['result'] = $this->db->get_where("trans_progres_proyek",["id_proyek"=>dec_url($id_proyek)]);
       $this->template->view("content/master_proyek/daftar_progres_proyek",$data);
     }
   }


}
