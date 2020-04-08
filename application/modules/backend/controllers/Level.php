<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Level extends Backend{

  public function __construct()
  {
    parent::__construct();
    $this->load->model("Level_model","model");
  }

  function index()
  {
    $this->template->set_title("Level");
    $this->template->view("content/level/index");
  }

  function json(){
    //$search = $_POST['search']['value']; // Ambil data yang di ketik user pada textbox pencarian
    $limit = $_POST['length']; // Ambil data limit per page
    $start = $_POST['start']; // Ambil data start
    $order_index = $_POST['order'][0]['column'];
    $order_field = $_POST['columns'][$order_index]['data'];
    $order_ascdesc = $_POST['order'][0]['dir'];
    $sql_total = $this->model->count_all();
    $sql_data = $this->model->filter($limit, $start, $order_field, $order_ascdesc);
    $sql_filter = $this->model->count_filter();

    $data = array();
    $no = $start;
    foreach ($sql_data as $rows) {
      $no++;
      $row = array();
      $row[] = $no;
      $row[] = $rows->level;
      $row[] = '<a href="'.site_url("backend/level/role_access/".enc_url($rows->id_level)).'" class="bnt btn-sm btn-warning" id="akses"><i class="ion-ios7-paper-outline"></i> Access Role</a>
                <a href="'.site_url("backend/level/update/".enc_url($rows->id_level)).'" class="bnt btn-sm btn-primary" id="update"><i class="fa fa-pencil"></i> update</a>
                <a href="'.site_url("backend/level/delete/".enc_url($rows->id_level)).'" class="bnt btn-sm btn-danger" id="delete"><i class="fa fa-trash"></i> delete</a>
                ';

      $data[] = $row;
    }


    $callback = array(
        'draw'=>$_POST['draw'], // Ini dari datatablenya
        'recordsTotal'=>$sql_total,
        'recordsFiltered'=>$sql_filter,
        'data'=>$data
    );
    header('Content-Type: application/json');
    echo json_encode($callback); // Convert array $callback ke json
  }


  function add()
  {
    $this->template->set_title("Add Level");
    $data = array('action' => site_url("backend/level/add_action"),
                  'button' => "add",
                  'level' => set_value("level"),
                  );
    $this->template->view("content/level/form",$data);
  }


  function add_action()
  {
    if ($this->input->is_ajax_request()) {
          $json = array('success'=>false, 'alert'=>array(), 'id'=> null);
          $this->form_validation->set_rules("level","*&nbsp;","trim|xss_clean|alpha_numeric|required|callback__cek_level",[
            "alpha_numeric" => "*&nbsp; Hanya berisi huruf dan angka. (tanpa spasi)."
          ]);
          $this->form_validation->set_error_delimiters('<span class="error text-danger" style="font-size:11px">','</span>');
          if ($this->form_validation->run()) {
            $insert = array('level' => strtolower($this->input->post('level',true)),
                            'slug'  => url_title($this->input->post('level',true),"-",true),
                            'created' => date('Y-m-d H:i:s'),
                          );

            $this->model->get_insert("level",$insert);

            $last_id = $this->db->insert_id();

            $json['id'] = enc_url($last_id);
            $json['alert'] = "add data successfully";
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


  function update($id)
  {
    if ($row = $this->model->get_where("level",["id_level" => dec_url($id)])) {
      $this->template->set_title("Update Level");
      $data = array('action' => site_url("backend/level/update_action/$id"),
                    'button' => "update",
                    'level' => set_value("level",$row->level),
                    );
      $this->template->view("content/level/form",$data);
    }
  }


  function update_action($id)
  {
    if ($this->input->is_ajax_request()) {
          $json = array('success'=>false, 'alert'=>array(), 'id'=> null);
          $this->form_validation->set_rules("level","*&nbsp;","trim|xss_clean|alpha_numeric|required|callback__cek_level",[
            "alpha_numeric" => "*&nbsp; Hanya berisi huruf dan angka. (tanpa spasi)."
          ]);
          $this->form_validation->set_error_delimiters('<span class="error text-danger" style="font-size:11px">','</span>');
          if ($this->form_validation->run()) {
            $update = array('level' => strtolower($this->input->post('level',true)),
                            'slug'  => url_title($this->input->post('level',true),"-",true),
                            'modified' => date('Y-m-d H:i:s'),
                          );

            $this->model->get_update("level",$update, ["id_level" => dec_url($id)]);

            $last_id = $id;

            $json['id'] = $last_id;
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


  function role_access($id)
  {
    $this->template->set_title("Set Access Role For Level");
    $this->template->view("content/level/access_role");
  }



  function set_role($id)
  {
    if ($this->input->is_ajax_request()) {
        $json = array('success'=>false, 'alert'=>array());
        $name = $this->input->post("name");
        $value = $this->input->post("value");
        $data = ["id_level" => dec_url($id), "id_main_menu" => $name];
        if ($name != "") {
          if ($value == 1 || $value == 0) {
            if ($value == 1) {
              $this->db->insert("rule_level",$data);
              $json['alert'] = "Set role successfully";
            }elseif ($value == 0) {
              $this->db->where($data)
                       ->delete("rule_level");
              $json['alert'] = "Remove role successfully";
            }

            if ($this->db->affected_rows()) {

              $json['success'] =  true;
            }else {
              $json['alert'] = "update data error";
            }
          }else {
            $json['alert'] = "update data error";
          }
        }else {
          $json['alert'] = "update data error";
        }

        echo json_encode($json);
    }
  }




  function _cek_level($str)
  {
    if (isset($_POST['last_level'])) {
      $qry = $this->db->get_where("level",["slug" => $str ,"slug !=" => $_POST['last_level']]);
    }else {
      $qry = $this->db->get_where("level",["slug"=> $str]);
    }
    if ($qry->num_rows() > 0) {
      $this->form_validation->set_message('_cek_level', '*&nbsp; '.$str.' sudah ada');
      return FALSE;
    }else {
      return TRUE;
    }
  }


  function delete($id)
  {
    if ($this->input->is_ajax_request()) {
      $this->db->delete("level",["id_level" => dec_url($id)]);
      $data = array("message" => "delete data success");
      echo json_encode($data);
    }
  }



}
