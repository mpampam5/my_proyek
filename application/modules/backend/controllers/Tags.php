<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class tags extends Backend{

  public function __construct()
  {
    parent::__construct();
    $this->load->model("Tags_model","model");
  }

  function index()
  {
    $this->template->set_title("tags");
    $this->template->view("content/tags/index");
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
          $row[] = $rows->tags;


          $row[] = '
                    <a href="'.site_url("backend/tags/update/".enc_url($rows->id_tags)).'" class="bnt btn-sm btn-primary" id="update"><i class="fa fa-pencil"></i> Update</a>
                    <a href="'.site_url("backend/tags/delete/".enc_url($rows->id_tags)).'" class="bnt btn-sm btn-danger" id="delete"><i class="fa fa-trash"></i> Delete</a>
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
     $this->form_validation->set_rules("tags","*&nbsp;","trim|xss_clean|htmlspecialchars|required|callback__cek_tags");
     $this->form_validation->set_error_delimiters('<span class="error text-danger" style="font-size:11px">','</span>');
   }


  function add()
  {
    $this->template->set_title("Add tags");
    $data = array('action' => site_url("backend/tags/add_action"),
                  'button' => "add",
                  'tags' => set_value("tags"),
                  );
    $this->template->view("content/tags/form",$data);
  }

  function add_action()
  {
    if ($this->input->is_ajax_request()) {
          $json = array('success'=>false, 'alert'=>array());
          $this->_rules();
          if ($this->form_validation->run()) {
            $insert = array('tags' => strtolower($this->input->post('tags',true)),
                            'tags_slug' => url_title($this->input->post('tags',true),"-",true),
                            'created' => date('Y-m-d H:i:s'),
                          );

            $this->model->get_insert("tags",$insert);
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
    if ($row = $this->model->get_where("tags",["id_tags" => dec_url($id)])) {
      $this->template->set_title("Add tags");
      $data = array('action' => site_url("backend/tags/update_action/$id"),
                    'button' => "update",
                    'tags' => set_value("tags",$row->tags),
                    );
      $this->template->view("content/tags/form",$data);
    }
  }


  function update_action($id)
  {
    if ($this->input->is_ajax_request()) {
          $json = array('success'=>false, 'alert'=>array());
          $this->_rules();
          if ($this->form_validation->run()) {
            $insert = array('tags' => strtolower($this->input->post('tags',true)),
                            'tags_slug' => url_title($this->input->post('tags',true),"-",true),
                            'modified' => date('Y-m-d H:i:s'),
                          );

            $this->model->get_update("tags",$insert,["id_tags"=>dec_url($id)]);

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
      $this->db->delete("tags",["id_tags" => dec_url($id)]);
      $data = array("message" => "delete data success");
      echo json_encode($data);
    }
  }


  function _cek_tags($str)
  {
    if (isset($_POST['tags_lama'])) {
      $qry = $this->db->get_where("tags",["tags_slug" => url_title($str,"-",TRUE) ,"tags_slug !=" => url_title($_POST['tags_lama'],"-",TRUE)]);
    }else {
      $qry = $this->db->get_where("tags",["tags_slug"=> url_title($str,"-",TRUE)]);
    }

    if ($qry->num_rows() > 0) {
      $this->form_validation->set_message('_cek_tags', '*&nbsp; sudah ada');
      return FALSE;
    }else {
      return true;
    }
  }

}
