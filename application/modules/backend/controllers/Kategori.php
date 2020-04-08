<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends Backend{

  public function __construct()
  {
    parent::__construct();
    $this->load->model("Kategori_model","model");
  }

  function index()
  {
    $this->template->set_title("kategori");
    $this->template->view("content/kategori/index");
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
          $row[] = $rows->kategori;


          $row[] = '
                    <a href="'.site_url("backend/kategori/update/".enc_url($rows->id_kategori)).'" class="bnt btn-sm btn-primary" id="update"><i class="fa fa-pencil"></i> Update</a>
                    <a href="'.site_url("backend/kategori/delete/".enc_url($rows->id_kategori)).'" class="bnt btn-sm btn-danger" id="delete"><i class="fa fa-trash"></i> Delete</a>
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
     $this->form_validation->set_rules("kategori","*&nbsp;","trim|xss_clean|htmlspecialchars|required|callback__cek_kategori");
     $this->form_validation->set_error_delimiters('<span class="error text-danger" style="font-size:11px">','</span>');
   }


  function add()
  {
    $this->template->set_title("Add Kategori");
    $data = array('action' => site_url("backend/kategori/add_action"),
                  'button' => "add",
                  'kategori' => set_value("kategori"),
                  );
    $this->template->view("content/kategori/form",$data);
  }

  function add_action()
  {
    if ($this->input->is_ajax_request()) {
          $json = array('success'=>false, 'alert'=>array());
          $this->_rules();
          if ($this->form_validation->run()) {
            $insert = array('kategori' => strtolower($this->input->post('kategori',true)),
                            'kategori_slug' => url_title($this->input->post('kategori',true),"-",true),
                            'created' => date('Y-m-d H:i:s'),
                          );

            $this->model->get_insert("kategori",$insert);
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
    if ($row = $this->model->get_where("kategori",["id_kategori" => dec_url($id)])) {
      $this->template->set_title("Add Kategori");
      $data = array('action' => site_url("backend/kategori/update_action/$id"),
                    'button' => "update",
                    'kategori' => set_value("kategori",$row->kategori),
                    );
      $this->template->view("content/kategori/form",$data);
    }
  }


  function update_action($id)
  {
    if ($this->input->is_ajax_request()) {
          $json = array('success'=>false, 'alert'=>array());
          $this->_rules();
          if ($this->form_validation->run()) {
            $insert = array('kategori' => strtolower($this->input->post('kategori',true)),
                            'kategori_slug' => url_title($this->input->post('kategori',true),"-",true),
                            'modified' => date('Y-m-d H:i:s'),
                          );

            $this->model->get_update("kategori",$insert,["id_kategori"=>dec_url($id)]);

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

  function delete($id)
  {
    if ($this->input->is_ajax_request()) {
      $this->db->delete("kategori",["id_kategori" => dec_url($id)]);
      $data = array("message" => "delete data success");
      echo json_encode($data);
    }
  }


  function _cek_kategori($str)
  {
    if (isset($_POST['kategori_lama'])) {
      $qry = $this->db->get_where("kategori",["kategori_slug" => url_title($str,"-",TRUE) ,"kategori_slug !=" => url_title($_POST['kategori_lama'],"-",TRUE)]);
    }else {
      $qry = $this->db->get_where("kategori",["kategori_slug"=> url_title($str,"-",TRUE)]);
    }

    if ($qry->num_rows() > 0) {
      $this->form_validation->set_message('_cek_kategori', '*&nbsp; sudah ada');
      return FALSE;
    }else {
      return true;
    }
  }

}
