<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_proyek extends Usrp{

  public function __construct()
  {
    parent::__construct();
    $this->load->library("proyek");
    $this->load->helper("proyek");
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
            $row[] = "<p class='text-center'>-</p>";
            $row[] = "<span class='badge badge-danger'>Permohonan Di Tolak</span>";
          }elseif ($dt->status=="done") {
            $row[] = "<span class='badge badge-danger text-white'>Telah Berakhir</span>
            <p class='font-12 mt-2' style='font-size:10px'>
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
                      <a href="'.site_url("usrp/master_proyek/detail/".enc_url($dt->id_proyek)).'" class="btn btn-info btn-sm" title="detail"><i class="fa fa-file"></i></a>
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
    $where = array('complate' => "0",
                    'id_penerima_dana' => sess('id_user') );
    $this->db->where($where)
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


  function action($kode)
  {
    if ($this->input->is_ajax_request()) {
          $json = array('success'=>false, 'alert'=>array());
          $this->form_validation->set_rules("title","*&nbsp;","trim|xss_clean|htmlspecialchars|required");
          $this->form_validation->set_rules("harga_paket","*&nbsp;","trim|xss_clean|numeric|required");
          $this->form_validation->set_rules("paket","*&nbsp;","trim|xss_clean|numeric|required");
          $this->form_validation->set_rules("dana_dibutuhkan","*&nbsp;","trim|xss_clean|numeric|required");
          $this->form_validation->set_rules("priode","*&nbsp;","trim|xss_clean|numeric|required");
          $this->form_validation->set_rules("imbal_hasil_pendana","*&nbsp;","trim|xss_clean|numeric|required");
          $this->form_validation->set_rules("ujroh_penyelenggara","*&nbsp;","trim|xss_clean|numeric|required");
          $this->form_validation->set_rules("provinsi","*&nbsp;","trim|xss_clean|htmlspecialchars|required");
          $this->form_validation->set_rules("kabupaten","*&nbsp;","trim|xss_clean|htmlspecialchars|required");
          $this->form_validation->set_rules("alamat","*&nbsp;","trim|xss_clean|htmlspecialchars|required");
          $this->form_validation->set_rules("deskripsi","*&nbsp;","trim|xss_clean|htmlspecialchars|required");
          $this->form_validation->set_error_delimiters('<span class="error text-danger" style="font-size:11px">','</span>');
          if ($this->form_validation->run()) {
            $data = array('title' => $this->input->post("title",true),
                          'harga_paket' => $this->input->post("harga_paket",true),
                          'jumlah_paket' => $this->input->post("paket",true),
                          'durasi_proyek' => $this->input->post("priode",true),
                          'imbal_hasil_pendana' => $this->input->post("imbal_hasil_pendana",true),
                          'ujroh_penyelenggara' => $this->input->post("ujroh_penyelenggara",true),
                          'provinsi' => $this->input->post("provinsi",true),
                          'kabupaten' => $this->input->post("kabupaten",true),
                          'lokasi_proyek' => $this->input->post("alamat",true),
                          'deskripsi' => $this->input->post("deskripsi",true),
                          'status' => "process",
                          'created_at' => date("Y-m-d H:i:s"),
                          'complate' => "1",
                          );
            $this->model->get_update("master_proyek",$data,["kode"=>$kode]);
            $json['alert'] = "Proyek berhasil dibuat, Selanjutnya menunggu verifikasi";
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


      function detail($id="")
      {
        if ($row = $this->model->get_detail_model(dec_url($id))) {
          $this->template->set_title("Detail Proyek #$row->kode");
          $data['dt'] = $row;
          $this->template->view("content/proyek/detail",$data);
        }
      }

      function delete($id)
      {
        if ($this->input->is_ajax_request()) {
          $this->model->get_update("master_proyek",['status'=>"delete"],["id_proyek" => dec_url($id)]);
          $data = array("message" => "berhasil di hapus");
          echo json_encode($data);
        }
      }


      function get_progres_proyek($id_proyek=null)
      {
        if ($row = $this->model->get_detail_model(dec_url($id_proyek))) {
          $this->template->set_title("Progres Pengerjaan Pada Proyek #$row->kode");
          $data['dt'] = $row;
          $data['result'] = $this->db->get_where("trans_progres_proyek",["id_proyek"=>dec_url($id_proyek)]);
          $this->template->view("content/proyek/daftar_progres_proyek",$data);
        }
      }


      function add_progres($id)
      {
        if ($row = $this->model->get_detail_model(dec_url($id))) {
          $this->template->set_title("Tambah Progres Pengerjaan Proyek #$row->kode");
          $data = array(  'id_proyek' => $id,
                          'action' => site_url("usrp/master_proyek/action_progres/$id"),
                          'button' => "tambah",
                          'progres' => set_value("progres"),
                          'deskripsi' => set_value("deskripsi")
                        );
          $this->template->view("content/proyek/form_progres",$data);
        }
      }


      function action_progres($id)
      {
        if ($this->input->is_ajax_request()) {
              $json = array('success'=>false, 'alert'=>array());
              $this->form_validation->set_rules("progres","*&nbsp;","trim|xss_clean|numeric|required");
              $this->form_validation->set_rules("deskripsi","*&nbsp;","trim|xss_clean|htmlspecialchars|required");
              $this->form_validation->set_error_delimiters('<span class="error text-danger" style="font-size:11px">','</span>');
              if ($this->form_validation->run()) {
                $data = array('id_proyek' => dec_url($id),
                              'persentase' => $this->input->post("progres",true),
                              'deskripsi' => $this->input->post("deskripsi",true),
                              'created_at' => date("Y-m-d H:i:s"),
                              );
                $this->model->get_insert("trans_progres_proyek",$data);
                $json['alert'] = "Berhasil di simpan";
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


      function edit_progres($kode,$id,$id_proyek)
      {
        if ($row = $this->model->get_where("trans_progres_proyek",['id_progres_proyek'=>dec_url($id)])) {
          $this->template->set_title("Tambah Progres Pengerjaan Proyek #$kode");
          $data = array(  'id_proyek' => $id_proyek,
                          'action' => site_url("usrp/master_proyek/action_edit_progres/$id"),
                          'button' => "edit",
                          'progres' => set_value("progres",$row->persentase),
                          'deskripsi' => set_value("deskripsi",$row->deskripsi)
                        );
          $this->template->view("content/proyek/form_progres",$data);
        }
      }


      function action_edit_progres($id)
      {
        if ($this->input->is_ajax_request()) {
              $json = array('success'=>false, 'alert'=>array());
              $this->form_validation->set_rules("progres","*&nbsp;","trim|xss_clean|numeric|required");
              $this->form_validation->set_rules("deskripsi","*&nbsp;","trim|xss_clean|htmlspecialchars|required");
              $this->form_validation->set_error_delimiters('<span class="error text-danger" style="font-size:11px">','</span>');
              if ($this->form_validation->run()) {
                $data = array(
                              'persentase' => $this->input->post("progres",true),
                              'deskripsi' => $this->input->post("deskripsi",true),
                              );
                $this->model->get_update("trans_progres_proyek",$data,['id_progres_proyek'=>dec_url($id)]);
                $json['alert'] = "Berhasil di edit";
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


      function delete_progres_proyek($id)
      {
        if ($this->input->is_ajax_request()) {
          $this->db->delete("trans_progres_proyek",["id_progres_proyek" => dec_url($id)]);
          $data = array("message" => "berhasil di hapus");
          echo json_encode($data);
        }
      }



}
