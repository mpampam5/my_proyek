<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aturan extends Backend{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function index()
  {
    $this->template->set_title("Aturan dan ketentuan");
    $this->template->view("content/config/aturan");
  }

  function action()
  {
    if ($this->input->is_ajax_request()) {
          $json = array('success'=>false, 'alert'=>array());
          $this->form_validation->set_rules("deskripsi","*&nbsp;","trim|xss_clean");
          $this->form_validation->set_error_delimiters('<span class="error text-danger" style="font-size:11px">','</span>');
          if ($this->form_validation->run()) {

            $this->db->where("slug","aturan-dan-ketentuan");
            $this->db->update("config_system",array("deskripsi"=> $this->input->post("deskripsi",true)));

            $json['alert']   = "Berhasil menyimpan perubahan";
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

}
