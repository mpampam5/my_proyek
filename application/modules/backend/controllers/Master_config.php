<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_config extends Backend{

  public function __construct()
  {
    parent::__construct();
    $this->load->model("Administrator_model","model");
  }

  function index()
  {
    $this->template->set_title("Master Config");
    $this->template->view("content/master_config/index");
  }


  function action_deposito()
  {
    if ($this->input->is_ajax_request()) {
        $json = array('success'=>false, 'alert'=>array());
        $this->form_validation->set_rules("dp-status","*&nbsp;","trim|xss_clean|numeric|required");
        $this->form_validation->set_rules("dp-min","*&nbsp;","trim|xss_clean|numeric|required");
        $this->form_validation->set_rules("dp-max","*&nbsp;","trim|xss_clean|numeric|required");
        $this->form_validation->set_error_delimiters('<span class="error mt-1 text-danger" style="font-size:11px">','</span>');

        if ($this->form_validation->run()) {
            foreach ($_POST as $key => $value) {
                if ($key == "dp-status") {
                  $data = ["status" => $this->input->post("$key")];
                }else {
                  $data = ["value" => $this->input->post("$key")];
                }
                $this->db->update("master_config",$data,["code"=>strtoupper($key)]);
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



  function action_withdraw()
  {
    if ($this->input->is_ajax_request()) {
        $json = array('success'=>false, 'alert'=>array());
        $this->form_validation->set_rules("wd-status","*&nbsp;","trim|xss_clean|numeric|required");
        $this->form_validation->set_rules("wd-min","*&nbsp;","trim|xss_clean|numeric|required");
        $this->form_validation->set_rules("wd-max","*&nbsp;","trim|xss_clean|numeric|required");
        $this->form_validation->set_error_delimiters('<span class="error mt-1 text-danger" style="font-size:11px">','</span>');

        if ($this->form_validation->run()) {
            foreach ($_POST as $key => $value) {
                if ($key == "wd-status") {
                  $data = ["status" => $this->input->post("$key")];
                }else {
                  $data = ["value" => $this->input->post("$key")];
                }
                $this->db->update("master_config",$data,["code"=>strtoupper($key)]);
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

}
