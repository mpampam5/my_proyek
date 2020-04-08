<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mcrud extends CI_Controller{

  private $tilte;

  public function __construct()
  {
    parent::__construct();
    $this->title = "CMS M-CRUDIGNITER V 0.1";
    $this->load->library(array("template","core"));
    $this->load->helper(array("backend/backend","mcrud"));
  }

  function index()
  {
    $menu = array('ci_sessions','ci_user_login','config_system','level','main_menu','rule_level','user','user_level');
    $table = $this->db->list_tables();
    $table_list = array_diff($table,$menu);
    $this->template->set_title($this->title);
    $data['list_table'] = $table_list;
    $data['list_controller'] = $this->core->controllerList();
    $this->template->view("content/home",$data);
  }


  function get()
  {
    if ($this->input->is_ajax_request()) {
        $json = array('success'=>false, 'alert'=>array(), 'content'=>"");
        $tables_name = $this->input->post("values");
        if (!empty($tables_name)) {
          if (in_array($tables_name,$this->db->list_tables())) {
            // code...
            $data['table']    = $tables_name;
            $data['fields']   = $this->db->field_data($tables_name);
            $json['content']  = $this->load->view("content/generate",$data,true);
            $json["success"]  = true;
          }else {
            $json["alert"] = "** Silahkan pilih table";
          }
        }else {
          $json["alert"] = "** Silahkan pilih table";
        }
        echo json_encode($json);
    }
  }



}
