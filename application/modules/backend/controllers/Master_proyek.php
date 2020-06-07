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
          $row[] = "* <b><a href='".site_url("backend/master_penerima_dana/detail/".enc_url($dt->id_penerima_dana))."'><i class='fa fa-link'></i> ".$dt->id_reg."</a></b> <br> * ".$dt->nama." </br> * ".$dt->nama_perusahaan;
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
            }elseif ($dt->status_penggalangan=="akan_datang") {
                $row[] = "<span class='badge badge-success text-white'>Akan Rilis</span>
                            <p class='font-12 mt-2'>
                              <i class='fa fa-calendar'></i> ".date('d-m-Y',strtotime($dt->mulai_penggalangan))."
                            </p>";
            }elseif ($dt->status_penggalangan=="terpenuhi") {
                $row[] = "<span class='badge badge-success text-white'>Terpenuhi</span>";
            }
          }elseif ($dt->status=="cancel") {
            $row[] = "-";
            $row[] = "<span class='badge badge-danger'>Cancel</span>";
          }elseif ($dt->status=="unapproved") {
            $row[] = "<span class='badge badge-danger text-white'>Telah Berakhir</span>";
            $row[] = "<span class='badge badge-danger'>Dana Di Kembalikan</span>";
          }


          if ($dt->status=="process") {
            $row[] = "<span class='badge badge-warning text-white'>Menunggu Verifikasi</span>";
          }elseif ($dt->status=="publish") {
            $row[] = "<span class='badge badge-success'>Publish</span>";
          }

          if ($dt->status_pembagian_dividen == "belum") {
            $row[] = "<span class='badge badge-danger'>Belum Di Bagikan</span>";
          }elseif ($dt->status_pembagian_dividen == "mulai") {
            $row[] = "<span class='badge badge-primary'>Mulai Pembagian</span>";
          }elseif ($dt->status_pembagian_dividen == "selesai") {
            $row[] = "<span class='badge badge-primary'>Selesai</span>";
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
       $priode  = $this->input->post("priode",true);
       $tgl_mulai_proyek = date("Y-m-d",strtotime("+1 days",strtotime($akhir_penggalangan)));
       $tgl_selesai_proyek = date("Y-m-d",strtotime("+$priode month",strtotime($tgl_mulai_proyek)));

       $this->form_validation->set_rules("status_publish","*&nbsp;","trim|xss_clean|required|callback__cek_status");
       if ($status=="publish") {
         $this->form_validation->set_rules("start_proyek","*&nbsp;","trim|xss_clean|required");
         $this->form_validation->set_rules("end_proyek","*&nbsp;","trim|xss_clean|required");
         $this->form_validation->set_rules("priode","*&nbsp;","trim|xss_clean|numeric|required");
         $this->form_validation->set_rules("pembagian","*&nbsp;","trim|xss_clean|required|callback__cek_desimal");
         $this->form_validation->set_rules("pembagian_penyelenggara","*&nbsp;","trim|xss_clean|required|callback__cek_desimal");
         $this->form_validation->set_rules("imbal_hasil","*&nbsp;","trim|xss_clean|required|callback__cek_desimal");
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
                $update['durasi_proyek']        = $priode;
                $update['imbal_hasil']          = $this->input->post("pembagian",true);
                $update['ujroh_penyelenggara']  = $this->input->post("pembagian_penyelenggara",true);
                $update['imbal_hasil_pendana']  = $this->input->post("imbal_hasil",true);
                $update['tgl_mulai_proyek']     = $tgl_mulai_proyek;
                $update['tgl_selesai_proyek']     = $tgl_selesai_proyek;
                if ($mulai_penggalangan == date('Y-m-d')) {
                  $update['status_penggalangan']  = "mulai";
                }else {
                  $update['status_penggalangan']  = "akan_datang";
                }
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

   function _cek_desimal($str)
   {
     if (is_numeric($str)) {
       return true;
     }else {
       $this->form_validation->set_message("_cek_desimal","* Hanya berupa angka desimal");
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
           $row[] = '<a  target="_blank" href="'.site_url("backend/master_proyek/get_dividen/".enc_url($dt->id_penggalangan_dana_proyek)."/".enc_url($dt->id_pendana)."/".enc_url($dt->id_proyek)."/".$dt->kode).'" class="btn btn-sm btn-primary">Lihat Dividen</a>';
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

   function export_pemberi_dana($id_proyek=null)
   {
     if ($row = $this->model->get_detail_model(dec_url($id_proyek))) {
       $data['dt'] = $row;
       $this->template->view("content/master_proyek/export_pemberi_dana",$data,false);
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



   function add()
   {
     $data = array('kode' => $this->_kode(),
                   'created_at' => date('Y-m-d H:i:s')
                 );
     $this->db->insert("master_proyek",$data);

     $dt['kode'] = $data['kode'];
     $dt['id_proyek'] = $this->db->insert_id();
     $this->template->set_title("Tambah Penggalangan Dana");
     $this->template->view("content/master_proyek/form",$dt);
   }


   function action_add($kode)
   {
     if ($this->input->is_ajax_request()) {
           $json = array('success'=>false, 'alert'=>array());
           $this->form_validation->set_rules("penerima_dana","*&nbsp;","trim|xss_clean|htmlspecialchars|required");
           $this->form_validation->set_rules("title","*&nbsp;","trim|xss_clean|htmlspecialchars|required");
           $this->form_validation->set_rules("harga_paket","*&nbsp;","trim|xss_clean|numeric|required");
           $this->form_validation->set_rules("paket","*&nbsp;","trim|xss_clean|numeric|required");
           $this->form_validation->set_rules("dana_dibutuhkan","*&nbsp;","trim|xss_clean|numeric|required");
           $this->form_validation->set_rules("provinsi","*&nbsp;","trim|xss_clean|htmlspecialchars|required");
           $this->form_validation->set_rules("kabupaten","*&nbsp;","trim|xss_clean|htmlspecialchars|required");
           $this->form_validation->set_rules("alamat","*&nbsp;","trim|xss_clean|htmlspecialchars|required");
           $this->form_validation->set_rules("deskripsi","*&nbsp;","trim|xss_clean|required");
           $this->form_validation->set_error_delimiters('<span class="error text-danger" style="font-size:11px">','</span>');
           if ($this->form_validation->run()) {
             $data = array('id_penerima_dana' => $this->input->post("id_penerima_dana"),
                           'title' => $this->input->post("title",true),
                           'dana_dibutuhkan' => $this->input->post("harga_paket",true) * $this->input->post("paket",true),
                           'harga_paket' => $this->input->post("harga_paket",true),
                           'jumlah_paket' => $this->input->post("paket",true),
                           'provinsi' => $this->input->post("provinsi",true),
                           'kabupaten' => $this->input->post("kabupaten",true),
                           'lokasi_proyek' => $this->input->post("alamat",true),
                           'deskripsi' => $this->input->post("deskripsi",true),
                           'status' => "process",
                           'created_at' => date("Y-m-d H:i:s"),
                           'complate' => "1",
                           );
             $this->model->get_update("master_proyek",$data,["kode"=>$kode]);
             $json['alert'] = "Proyek berhasil dibuat, Selanjutnya proses verifikasi";
             $json['success'] =  true;
           }else {
             foreach ($_POST as $key => $value)
               {
                 $json['alert'][$key] = form_error($key);
               }
           }

           echo json_encode($json);
       }
   }

   function _kode(){
     $tahun = date("Y");
     $bulan = date("m");
     $q = $this->db->query("SELECT MAX(RIGHT(kode,6)) AS kd_trans FROM master_proyek WHERE year(created_at)=$tahun AND month(created_at)=$bulan");
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


   function jsonkabupaten(){
         $propinsiID = $_GET['id'];
         $kabupaten   = $this->db->get_where('wil_kabupaten',array('province_id'=>$propinsiID));
         echo '<option value="">-- Pilih Kabupaten/Kota --</option>';
         foreach ($kabupaten->result() as $k)
         {
             echo "<option value='$k->id'>$k->name</option>";
         }
     }

     function do_upload($kode)
         {
           if ($this->input->is_ajax_request()) {
               $json = array('success' =>false , "alert"=> array(), "file_name"=>array());
               if (isset($_FILES['upload-file']['name'])) {
                 $file = "foto_1.".pathinfo($_FILES['upload-file']['name'], PATHINFO_EXTENSION);
                 $file_name = "upload-file";
                 $field= "foto_1";
               }elseif (isset($_FILES['upload-file1']['name'])) {
                 $file = "foto_2.".pathinfo($_FILES['upload-file1']['name'], PATHINFO_EXTENSION);
                 $file_name = "upload-file1";
                 $field= "foto_2";
               }elseif (isset($_FILES['upload-file2']['name'])) {
                 $file = "foto_3.".pathinfo($_FILES['upload-file2']['name'], PATHINFO_EXTENSION);
                 $file_name = "upload-file2";
                 $field= "foto_3";
               }

                if (!file_exists('./_template/files/proyek/'.$kode)) {
                   mkdir('./_template/files/proyek/'.$kode, 0777, true);
               }

               $config['upload_path'] = "./_template/files/proyek/".$kode."/";
               $config['allowed_types'] = 'jpeg|jpg';
               $config['overwrite'] = true;
               $config['max_size']  = '1024';
               $config['file_name']  = "$file";


               $this->load->library('upload', $config);
               $this->upload->initialize($config);

               if (!$this->upload->do_upload("$file_name")){
                   $json['header_alert'] = "error";
                   $json['alert'] = "File tidak valid, format file harus JPG,JPEG & ukuran maksimal 1 mb";
               }else {
                   $this->model->get_update("master_proyek",["$field"=>$config['file_name']],['kode'=>$kode]);
                   $json['file_name'] = $config['file_name'];
                   $json['header_alert'] = "success";
                   $json['alert'] = "File upload successfully.";
                   $json['success'] = true;
               }

               echo json_encode($json);

         }
       }


function penerima_modal()
{
  $this->template->view("content/master_proyek/modal_penerima_dana",[],false);
}


function kembalikan_dana($id="")
{
  if ($row = $this->model->get_detail_model(dec_url($id))) {
    $this->template->set_title("Kembalikan Dana Proyek #$row->kode");
    $data['dt'] = $row;
    $this->template->view("content/master_proyek/form_kembalikan_dana",$data);
  }
}

function action_kembalikan_dana($id="")
{
  if ($this->input->is_ajax_request()) {
        $json = array('success'=>false, 'alert'=>array());
        $this->form_validation->set_rules("keterangan","*&nbsp;","trim|xss_clean|htmlspecialchars|required");
        $this->form_validation->set_rules("password","*&nbsp;","trim|xss_clean|htmlspecialchars|required|callback__cek_password");
        $this->form_validation->set_error_delimiters('<span class="error text-danger" style="font-size:11px">','</span>');
        if ($this->form_validation->run()) {
          $where = array('id_proyek' => dec_url($id));
          //update data master proyek
          $data = array('keterangan'  => $this->input->post("keterangan",true),
                        'status'      => "unapproved",
                        'acc_by_id'   => sess("id_user"),
                        'acc_at'      => date("Y-m-d H:i:s")
                        );
          $this->model->get_update("master_proyek",$data,$where);

          // update data trans_penggalangan dana
          $data_2 = array('status' => "dikembalikan");
          $this->model->get_update("trans_penggalangan_dana",$data_2,$where);

          // update data profit/dividen
          $data_3 = array('status' => null);
          $this->model->get_update("trans_profit",$data_3,$where);

          $keterangan = 'Dana yang terkumpul pada proyek <i>#'.get_proyek(dec_url($id),'kode').'</i> telah di kembalikan pada masing-masing pendana karena, <i>'.$data['keterangan'].'</i>. (Pengembalian manual oleh admin)';
          aktivitas_pendanaan($keterangan);

          $json['alert'] = "Dana Berhasil Di Kembalikan";
          $json['success'] =  true;
        }else {
          foreach ($_POST as $key => $value)
            {
              $json['alert'][$key] = form_error($key);
            }
        }

        echo json_encode($json);
    }
}


function get_dividen($id_penggalangan_dana_proyek = null, $id_pendana = null , $id_proyek = null, $kode = null)
{
  if ($row = $this->model->get_dividen($id_penggalangan_dana_proyek, $id_pendana, $id_proyek)) {
      $dt['prs'] = $row;
      $dt['id_penggalangan_dana_proyek']  = $id_penggalangan_dana_proyek;
      $dt['id_proyek']  = $id_proyek;
      $dt['id_pendana'] = $id_pendana;
      $dt['kode'] = $kode;
      $this->template->set_title("Detail Dividen Pada Proyek #$kode");
      $this->template->view("content/master_proyek/detail_dividen",$dt);
  }
}

function export_dividen($id_penggalangan_dana_proyek = null, $id_pendana = null , $id_proyek = null, $kode = null)
{
  if ($row = $this->model->get_dividen($id_penggalangan_dana_proyek, $id_pendana, $id_proyek)) {
      $dt['prs'] = $row;
      $dt['id_penggalangan_dana_proyek']  = $id_penggalangan_dana_proyek;
      $dt['id_proyek']  = $id_proyek;
      $dt['id_pendana'] = $id_pendana;
      $dt['kode'] = $kode;
      $this->template->view("content/master_proyek/export_dividen",$dt,false);
  }
}

function simulasi_act($id, $kode)
{
  if ($this->input->is_ajax_request()) {
    $json = array('success'=>false, 'alert'=>array(), 'data' => null);
    $this->form_validation->set_rules("nominal","*&nbsp;","trim|xss_clean|numeric|required");
    $this->form_validation->set_rules("tanggal","*&nbsp;","trim|xss_clean|required");
    $this->form_validation->set_rules("akhir_penggalangan","*&nbsp;","trim|xss_clean|required");
    $this->form_validation->set_rules("durasi_proyek","*&nbsp;","trim|xss_clean|required");
    $this->form_validation->set_rules("imbal_hasil","*&nbsp;","trim|xss_clean|required");
    $this->form_validation->set_error_delimiters('<span class="error text-danger" style="font-size:11px">','</span>');
    if ($this->form_validation->run()) {
      $tanggal = date('Y-m-d',strtotime($this->input->post('tanggal')));
      $nominal = $this->input->post("nominal");
      $akhir_penggalangan = $this->input->post("akhir_penggalangan");
      $priode = $this->input->post("durasi_proyek");
      $imbal_hasil_post = $this->input->post("imbal_hasil");
      $selisih_hari = selisih_hari($akhir_penggalangan,$tanggal);

      $penggalangan = (master_config("FINANCIAL-PED") / 100) * $nominal ;
      $hsl_penggalangan =  $penggalangan * $selisih_hari;

      $profit_bulan = (master_config("FINANCIAL-DB") / 100) * $nominal;
      $profit_bulan_pertama = $profit_bulan + $hsl_penggalangan;
      $imbal_hasil = ($imbal_hasil_post / 100) * $nominal;

      $hasil_durasi = $profit_bulan * $priode;

      $dana_pokok_imbal_hasil = $nominal + $imbal_hasil + $hasil_durasi + $hsl_penggalangan;

      $output = '';
      $output .='<p>Simulasi Imbal Hasil</p>
                <table class="table table-bordered">
                  <tr>
                    <th>Tgl Pendanaan</th>
                    <th>Jumlah Dana</th>
                    <th>Jumlah Hari</th>
                    <th>Penggalangan</th>
                    <th>Bulan 1</th>
                    <th>Pembayaran Bulan 1</th>
                    <th>Bulan 2 - akhir</th>
                    <th>Sisa Imbal Hasil</th>
                  </tr>

                  <tr>
                    <td>'.date('d/m/Y',strtotime($tanggal)).'</td>
                    <td>'.format_rupiah($nominal).'</td>
                    <td class="text-center">'.$selisih_hari.'</td>
                    <td>'.format_rupiah($hsl_penggalangan).'</td>
                    <td>'.format_rupiah($profit_bulan).'</td>
                    <td>'.format_rupiah($profit_bulan_pertama).'</td>';

              if ($priode > 1) {
                $output .='<td>'.format_rupiah($profit_bulan).'</td>';
              }else {
                $output .='<td class="text-center"> - </td>';
              }
              $output .='<td>'.format_rupiah($imbal_hasil).'</td>
                  </tr>
                </table>
                <p class="text-right" style="font-weight:bold">Total Imbal Hasil dan Dana Pokok : Rp.'.format_rupiah($dana_pokok_imbal_hasil).'</p>';

      $json['data'] = $output;
      $json['success'] =  true;
    }else {
      foreach ($_POST as $key => $value)
        {
          $json['alert'][$key] = form_error($key);
        }
    }


    echo json_encode($json);
  }
}


function export()
{
  $data['dt'] = $this->model->get_export();
  $this->load->view("content/master_proyek/export",$data);
}


}
