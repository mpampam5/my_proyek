<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wizard extends Usrp{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function index()
  {
    $this->template->set_title("Form Lengkapi Data");
    $this->template->view("content/wizard/index");
  }


  function form_wizard($form = null)
  {
    if ($form == 1 ) {
      $forms = "form_perusahaan";
    }elseif ($form == 2) {
      $forms = "form_rekening";
    }
    $data['dt'] = $this->db->get_where("master_penerima_dana",['id_penerima_dana'=>sess('id_user')])->row();
    $this->template->view("content/wizard/$forms",$data,false);
  }

  function form_perusahaan_action()
  {
    if ($this->input->is_ajax_request()) {
          $json = array('success'=>false, 'alert'=>array(), 'url'=>"");
          $this->form_validation->set_rules("nama_perusahaan","*&nbsp;","trim|xss_clean|htmlspecialchars|required");
          $this->form_validation->set_rules("bidang_usaha","*&nbsp;","trim|xss_clean|htmlspecialchars|required");
          $this->form_validation->set_rules("provinsi","*&nbsp;","trim|xss_clean|htmlspecialchars|required");
          $this->form_validation->set_rules("kabupaten","*&nbsp;","trim|xss_clean|htmlspecialchars|required");
          $this->form_validation->set_rules("alamat_perusahaan","*&nbsp;","trim|xss_clean|htmlspecialchars|required");
          $this->form_validation->set_rules("bentuk_badan_usaha","*&nbsp;","trim|xss_clean|htmlspecialchars|required");
          $this->form_validation->set_error_delimiters('<span class="error text-danger" style="font-size:11px">','</span>');
          if ($this->form_validation->run()) {
            $data = array('nama_perusahaan' => $this->input->post('nama_perusahaan',true),
                          'bidang_usaha' => $this->input->post('bidang_usaha',true),
                          'provinsi' => $this->input->post('provinsi',true),
                          'kabupaten' => $this->input->post('kabupaten',true),
                          'alamat_perusahaan' => $this->input->post('alamat_perusahaan',true),
                          'bentuk_badan_usaha' => $this->input->post('bentuk_badan_usaha',true)
                        );
            $this->db->where("id_penerima_dana", sess('id_user'))
                     ->update("master_penerima_dana",$data);

            $json['url'] = site_url("usrp/wizard/form_wizard/2");
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
                          'bank' => $this->input->post('bank',true)
                        );
            $this->db->where("id_penerima_dana", sess('id_user'))
                     ->update("master_penerima_dana",$data);

            $json['url'] = site_url("usrp/wizard/form_rekening");
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

}
