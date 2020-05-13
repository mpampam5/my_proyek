<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wizard extends User{

  public function __construct()
  {
    parent::__construct();
    if (complate_data()) {
      redirect(site_url("user/dashboard"),'refresh');
    }
    $this->load->model("Wizard_model","model");
  }

  function index()
  {
    $this->template->set_title("Form Lengkapi Data");
    $this->template->view("content/wizard/index");
  }


  function form_wizard($form = null)
  {
    if ($form == 1 ) {
      $forms = "form_data_pribadi";
    }elseif ($form == 2) {
      $forms = "form_rekening";
    }elseif ($form == 3) {
      $forms = "form_foto";
    }
    $data['dt'] = $this->db->get_where("master_pendana",['id_pendana'=>sess('id_user')])->row();
    $this->template->view("content/wizard/$forms",$data,false);
  }

  function form_data_pribadi_action()
  {
    if ($this->input->is_ajax_request()) {
          $json = array('success'=>false, 'alert'=>array(), 'url'=>"");
          $this->form_validation->set_rules("nama","*&nbsp;","trim|xss_clean|htmlspecialchars|required");
          $this->form_validation->set_rules("telepon","*&nbsp;","trim|xss_clean|numeric|required");
          $this->form_validation->set_rules("provinsi","*&nbsp;","trim|xss_clean|htmlspecialchars|required");
          $this->form_validation->set_rules("kabupaten","*&nbsp;","trim|xss_clean|htmlspecialchars|required");
          $this->form_validation->set_rules("alamat","*&nbsp;","trim|xss_clean|htmlspecialchars|required");
          $this->form_validation->set_rules("kode_pos","*&nbsp;","trim|xss_clean|numeric|required");
          $this->form_validation->set_rules("tempat_lahir","*&nbsp;","trim|xss_clean|htmlspecialchars|required");
          $this->form_validation->set_rules("tgl_lahir","*&nbsp;","trim|xss_clean|htmlspecialchars|required");
          $this->form_validation->set_rules("jenis_kelamin","*&nbsp;","trim|xss_clean|htmlspecialchars|required");
          $this->form_validation->set_rules("pendidikan","*&nbsp;","trim|xss_clean|htmlspecialchars|required");
          $this->form_validation->set_rules("pekerjaan","*&nbsp;","trim|xss_clean|htmlspecialchars|required");
          $this->form_validation->set_error_delimiters('<span class="error text-danger" style="font-size:11px">','</span>');
          if ($this->form_validation->run()) {
            $data = array('nama' => $this->input->post('nama',true),
                          'telepon' => $this->input->post('telepon',true),
                          'provinsi' => $this->input->post('provinsi',true),
                          'kabupaten' => $this->input->post('kabupaten',true),
                          'alamat' => $this->input->post('alamat',true),
                          'kode_pos' => $this->input->post('kode_pos',true),
                          'tempat_lahir' => $this->input->post('tempat_lahir',true),
                          'tgl_lahir' => date("Y-m-d",strtotime($this->input->post('tgl_lahir',true))),
                          'jenis_kelamin' => $this->input->post('jenis_kelamin',true),
                          'id_pendidikan' => $this->input->post('pendidikan',true),
                          'id_pekerjaan' => $this->input->post('pekerjaan',true),
                        );
            $this->db->where("id_pendana", sess('id_user'))
                     ->update("master_pendana",$data);

            $json['url'] = site_url("user/wizard/form_wizard/2");
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

  //
  // function form_rekening()
  // {
  //   $this->template->view("content/wizard/form_rekening",[],false);
  // }

  function form_rekening_action()
  {
    if ($this->input->is_ajax_request()) {
          $json = array('success'=>false, 'alert'=>array(), 'url'=>"");
          $this->form_validation->set_rules("nama_rekening","*&nbsp;","trim|xss_clean|htmlspecialchars|required");
          $this->form_validation->set_rules("no_rekening","*&nbsp;","trim|xss_clean|numeric|required");
          $this->form_validation->set_rules("bank","*&nbsp;","trim|xss_clean|htmlspecialchars|required");
          $this->form_validation->set_error_delimiters('<span class="error text-danger" style="font-size:11px">','</span>');
          if ($this->form_validation->run()) {

            $data = array('nama_rekening' => $this->input->post('nama_rekening',true),
                          'no_rekening' => $this->input->post('no_rekening',true),
                          'id_bank' => $this->input->post('bank',true),
                          // 'complate'  => "1"
                        );
            $this->db->where("id_pendana", sess('id_user'))
                     ->update("master_pendana",$data);


            // $this->session->set_flashdata('info_data',
            // '<div class="col-md-6 mx-auto text-center alert alert-success" id="alert-data-success" style="font-size:18px">
            // <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            //                                             <span aria-hidden="true">×</span>
            //                                         </button>
            //   <p >
            //      Data Berhasil Di Lengkapi.
            //   </p>
            // </div>');
            // $json['url'] = site_url("user/dashboard");
            $json['url'] = site_url("user/wizard/form_wizard/3");
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


  function form_foto_action()
  {
    if ($this->input->is_ajax_request()) {
          $json = array('success'=>false, 'alert'=>array(), 'url'=>"");
          $this->form_validation->set_rules("foto_diri","*&nbsp;","trim|xss_clean|required");
          $this->form_validation->set_rules("foto_ktp","*&nbsp;","trim|xss_clean|required");
          $this->form_validation->set_rules("foto_buku_rek","*&nbsp;","trim|xss_clean|required");
          $this->form_validation->set_error_delimiters('<span class="error text-danger" style="font-size:11px">','</span>');
          if ($this->form_validation->run()) {

            $data = array('complate'  => "1");
            $this->db->where("id_pendana", sess('id_user'))
                     ->update("master_pendana",$data);


            $this->session->set_flashdata('info_data',
            '<div class="col-md-6 mx-auto text-center alert alert-success" id="alert-data-success" style="font-size:18px">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
              <p >
                 Data Berhasil Di Lengkapi.
              </p>
            </div>');
            $json['url'] = site_url("user/dashboard");
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


  function jsonkabupaten(){
        $propinsiID = $_GET['id'];
        $kabupaten   = $this->db->get_where('wil_kabupaten',array('province_id'=>$propinsiID));
        echo '<option value="">-- Pilih Kabupaten/Kota --</option>';
        foreach ($kabupaten->result() as $k)
        {
            echo "<option value='$k->id'>$k->name</option>";
        }
    }


    function do_upload()
        {
          if ($this->input->is_ajax_request()) {
            $kode = profile("id_reg");
              $json = array('success' =>false , "alert"=> array(), "file_name"=>array());
              if (isset($_FILES['upload-file']['name'])) {
                $file = "foto_diri.".pathinfo($_FILES['upload-file']['name'], PATHINFO_EXTENSION);
                $file_name = "upload-file";
                $field= "foto_diri";
              }elseif (isset($_FILES['upload-file1']['name'])) {
                $file = "foto_ktp.".pathinfo($_FILES['upload-file1']['name'], PATHINFO_EXTENSION);
                $file_name = "upload-file1";
                $field= "foto_ktp";
              }elseif (isset($_FILES['upload-file2']['name'])) {
                $file = "foto_buku_rek.".pathinfo($_FILES['upload-file2']['name'], PATHINFO_EXTENSION);
                $file_name = "upload-file2";
                $field= "foto_buku_rekening";
              }

               if (!file_exists('./_template/files/user/'.$kode)) {
                  mkdir('./_template/files/user/'.$kode, 0777, true);
              }

              $config['upload_path'] = "./_template/files/user/".$kode."/";
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
                  $this->model->get_update("master_pendana",["$field"=>$config['file_name']],['id_pendana'=>sess('id_user')]);
                  $json['file_name'] = $config['file_name'];
                  $json['header_alert'] = "success";
                  $json['alert'] = "File upload successfully.";
                  $json['success'] = true;
              }

              echo json_encode($json);

        }
      }

}
