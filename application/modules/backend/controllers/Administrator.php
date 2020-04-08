<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrator extends Backend{

  public function __construct()
  {
    parent::__construct();
    $this->load->model("Administrator_model","model");
  }

  function index()
  {
    $this->template->set_title("administrator");
    $this->template->view("content/administrator/index");
  }


  function json()
  {
    if ($this->input->is_ajax_request()) {
      $list = $this->model->get_datatables();
      $data = array();
      $no = $_POST['start'];
      foreach ($list as $rows) {
          $no++;
          $row = array();
          $row[] = $no;
          $row[] = $rows->nama;
          $row[] = $rows->email;
          $row[] = $rows->level == "" ? '<span class="badge badge-default">tidak ada</span>':'<span class="badge badge-primary">'.$rows->level.'</span>';
          $row[] = $rows->is_active == 1 ? '<i class="mdi mdi-checkbox-blank-circle text-success"></i> Ya' : '<i class="mdi mdi-checkbox-blank-circle text-danger"></i> Tidak';


          $row[] = '
                    <a href="'.site_url("backend/administrator/update/".enc_url($rows->id_user)).'" class="bnt btn-sm btn-primary" id="update"><i class="fa fa-pencil"></i> Update</a>
                    <a href="'.site_url("backend/administrator/delete/".enc_url($rows->id_user)).'" class="bnt btn-sm btn-danger" id="delete"><i class="fa fa-trash"></i> Delete</a>
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

  function _rules()
   {
     $this->form_validation->set_rules("nama","*&nbsp;","trim|xss_clean|htmlspecialchars|required");
     $this->form_validation->set_rules("id_level","*&nbsp;","trim|xss_clean|numeric|required");
     $this->form_validation->set_rules("email","*&nbsp;","trim|xss_clean|valid_email|required|callback__cek_email");
     $this->form_validation->set_rules("is_active","*&nbsp;","trim|xss_clean|numeric|required");
     if ($_POST['submit']=="add") {
       $this->form_validation->set_rules("password","*&nbsp;","trim|xss_clean|required|min_length[6]");
       $this->form_validation->set_rules("konfirmasi_password","*&nbsp;","trim|xss_clean|matches[password]|required",[
         "matches"=> "*&nbsp; tidak sesuai dengan password awal"
       ]);
     }

     if ($_POST['submit']=="update") {
       $this->form_validation->set_rules("password","*&nbsp;","trim|xss_clean|min_length[6]");
       $this->form_validation->set_rules("konfirmasi_password","*&nbsp;","trim|xss_clean|matches[password]",[
         "matches"=> "*&nbsp; tidak sesuai dengan password awal"
       ]);
     }

     $this->form_validation->set_error_delimiters('<span class="error text-danger" style="font-size:11px">','</span>');
   }


function add()
{
  $this->template->set_title("Add Administrator");
  $data = array('action' => site_url("backend/administrator/add_action"),
                'button' => "add",
                'nama' => set_value("nama"),
                'email' => set_value("email"),
                'is_active' => set_value("is_active"),
                'id_level' => set_value("id_level"),
                );
  $this->template->view("content/administrator/form",$data);
}

function add_action()
{
  if ($this->input->is_ajax_request()) {
        $json = array('success'=>false, 'alert'=>array());
        $this->_rules();
        if ($this->form_validation->run()) {
          $token = config_system("key_token").date('YmdHis');
          $insert = array('nama' => $this->input->post('nama',true),
                          'email' => $this->input->post('email'),
                          'is_active' => $this->input->post('is_active'),
                          'token' => $token,
                          'password' => pass_encrypt($token,$this->input->post('konfirmasi_password')),
                          'is_delete' => "0",
                          'created' => date('Y-m-d H:i:s'),
                        );

          $this->model->get_insert("user",$insert);

          $last_id_user = $this->db->insert_id();

          $insert_trans = array('id_user' => $last_id_user,
                                'id_level' => $this->input->post('id_level')
                              );

          $this->model->get_insert("user_level",$insert_trans);

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
  if ($row = $this->model->get_where_data(dec_url($id))) {
    $this->template->set_title("Update Administrator");
    $data = array('action' => site_url("backend/administrator/update_action/$id"),
                  'button' => "update",
                  'nama' => set_value("nama",$row->nama),
                  'email' => set_value("email",$row->email),
                  'is_active' => set_value("is_active",$row->is_active),
                  'id_level' => set_value("id_level",$row->level),
                  );
    $this->template->view("content/administrator/form",$data);
  }else {
    echo "error 404";
  }
}

function update_action($id)
{
  if ($this->input->is_ajax_request()) {
        $json = array('success'=>false, 'alert'=>array());
        $this->_rules();
        if ($this->form_validation->run()) {

          if ($_POST['konfirmasi_password']!="") {
            $token = config_system("key_token").date('YmdHis');
            $update['token'] = $token;
            $update['password'] = pass_encrypt($token,$this->input->post('konfirmasi_password'));
          }

          $update['nama'] = $this->input->post('nama',true);
          $update['email'] = $this->input->post('email');
          $update['is_active'] = $this->input->post('is_active');
          $update['modified'] = date('Y-m-d H:i:s');

          $this->model->get_update("user",$update,["id_user"=>dec_url($id)]);

          $update_trans = array(
                                'id_level' => $this->input->post('id_level')
                              );

          $this->model->get_update("user_level",$update_trans,["id_user"=>dec_url($id)]);

          $json['alert'] = "update data successfully";
          $json['success'] =  true;
        }else {
          foreach ($_POST as $key => $value)
            {
              $json['alert'][$key] = form_error($key);
            }
        }


        $json['token'] = $this->security->get_csrf_hash();
        echo json_encode($json);
    }
}


function delete($id)
{
  if ($this->input->is_ajax_request()) {
    $this->model->get_update("user",["is_delete" => "1"],["id_user" => dec_url($id)]);
    $data = array("message" => "delete data success");
    echo json_encode($data);
  }
}


function _cek_email($str)
{
  if (isset($_POST['last_email'])) {
    $qry = $this->db->get_where("user",["email" => $str ,"email !=" => $_POST['last_email'] , "is_delete !=" => "1"]);
  }else {
    $qry = $this->db->get_where("user",["email"=> $str , "is_delete !=" => "1"]);
  }
  if ($qry->num_rows() > 0) {
    $this->form_validation->set_message('_cek_email', '*&nbsp; sudah terdaftar');
    return FALSE;
  }else {
    return TRUE;
  }
}


}
