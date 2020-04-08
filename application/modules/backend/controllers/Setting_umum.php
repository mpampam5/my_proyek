<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting_umum extends backend{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function index()
  {
    $this->template->set_title("Pengaturan umum");
    $this->template->view("content/setting_umum/index");
  }


  function umum_action()
  {
    if ($this->input->is_ajax_request()) {
        $json = array('success'=>false, 'alert'=>array());
        $this->form_validation->set_rules("title","*&nbsp;","trim|xss_clean|htmlspecialchars|required");
        $this->form_validation->set_rules("telepon","*&nbsp;","trim|xss_clean|numeric|required");
        $this->form_validation->set_rules("email","*&nbsp;","trim|xss_clean|required|valid_email");
        $this->form_validation->set_rules("domain","*&nbsp;","trim|xss_clean|htmlspecialchars|required");
        $this->form_validation->set_rules("alamat","*&nbsp;","trim|xss_clean|htmlspecialchars|required");
        $this->form_validation->set_error_delimiters('<span class="error mt-1 text-danger" style="font-size:11px">','</span>');

        if ($this->form_validation->run()) {
            foreach ($_POST as $key => $value) {
                $data = ["value" => $this->input->post("$key")];
                $this->db->update("config_system",$data,["slug"=>$key]);
            }


          $json['alert'] = "update data successfully";
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


  function email_smtp_action()
  {
    if ($this->input->is_ajax_request()) {
        $json = array('success'=>false, 'alert'=>array());
        $this->form_validation->set_rules("email_smtp","*&nbsp;","trim|xss_clean|required|valid_email");
        $this->form_validation->set_rules("host_smtp","*&nbsp;","trim|xss_clean|htmlspecialchars|required");
        $this->form_validation->set_rules("port_smtp","*&nbsp;","trim|xss_clean|numeric|required");
        $this->form_validation->set_rules("password_smtp","*&nbsp;","trim|xss_clean|required");
        $this->form_validation->set_error_delimiters('<span class="error mt-1 text-danger" style="font-size:11px">','</span>');

        if ($this->form_validation->run()) {
            foreach ($_POST as $key => $value) {
                $data = ["value" => ($key == "password_smtp") ? $this->encrypt->encode($this->input->post("$key")) : $this->input->post("$key")];
                $this->db->update("config_system",$data,["slug"=>$key]);
            }


          $json['alert'] = "update data successfully";
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


  function system_action()
  {
    if ($this->input->is_ajax_request()) {
        $json = array('success'=>false, 'alert'=>array());
        $name = $this->input->post("name");
        $value = $this->input->post("value");

        if ($value == 1 || $value == 0) {
          $data = array("status" => $value);
          $this->db->update("config_system",$data,["slug"=>$name]);
          if ($this->db->affected_rows()) {
            $json['alert'] = "update data successfully";
            $json['success'] =  true;
          }else {
            $json['alert'] = "update data error";
          }
        }else {
          $json['alert'] = "update data error";
        }

        echo json_encode($json);
    }
  }

}
