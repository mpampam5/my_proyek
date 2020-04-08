<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Filemanager extends Backend{

  public function __construct()
  {
    parent::__construct();
    $this->load->model("Filemanager_model","model");
  }

  function index()
  {
    $this->template->set_title("File Manager");
    $this->template->view("content/filemanager/index");
  }


  function json()
  {
    if ($this->input->is_ajax_request()) {
      $list = $this->model->get_datatables();
      $data = array();
      foreach ($list as $rows) {
          $row = array();
          $row[] = '<a data-fancybox="gallery" data-title="'.$rows->file.'" href="'.base_url().'_template/files/'.$rows->file.'"><div style="background:url('.base_url().'_template/files/'.$rows->file.');background-repeat: no-repeat;background-position: center center;background-size: cover;" class="filemanager-image"></div></a>';
          $row[] = '<p class="text-muted font-14"><a href="'.base_url().'_template/files/'.$rows->file.'" data-fancybox="gallery">'.$rows->file.'</a>
                    <br><span class="font-12">'.date("d/m/Y H:i",strtotime($rows->created)).'</span></p>';

          $row[] = '<a href="'.site_url("backend/kategori/delete/".enc_url($rows->id)).'" class="bnt btn-sm btn-danger" id="delete"><i class="fa fa-trash"></i></a>';

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


  function add()
  {
    $this->template->set_title("Add");
    $data = array('action' => site_url("backend/filemanager/add_action"),
                  'button' => "add",
                  'title' => set_value("title"),
                  );
    $this->template->view("content/filemanager/form",$data,false);
  }


  function add_action()
  {
    if ($this->input->is_ajax_request()) {
          $json = array('success'=>0, 'alert'=>array());
          $this->load->helper('file');
          $this->form_validation->set_rules("title","*&nbsp;","trim|xss_clean|htmlspecialchars|required");
          $this->form_validation->set_rules("files","*&nbsp;","callback__file_check");
          $this->form_validation->set_error_delimiters('<span class="error text-danger" style="font-size:11px">','</span>');
          if ($this->form_validation->run()) {
             $file_name = url_title($this->input->post('title',true),"-",true);
             $ext = pathinfo($_FILES['files']['name'], PATHINFO_EXTENSION);
             $full_file_name = strtolower($file_name).'.'.$ext;
             $config['upload_path']   = './_template/files/';
             $config['allowed_types']  = 'jpg|png';
             $config['file_name']      = $full_file_name;
             $config['overwrite']			 = false;
             $config['max_size']       = 1024; // 1MB

             $this->load->library('upload', $config);

          		if ( ! $this->upload->do_upload('files')){
                $json['success'] = 2;
          			$json['alert'] = $this->upload->display_errors();
          		}else{
          			$result = $this->upload->data();
                $insert = array('title' => strtolower($this->input->post('title',true)),
                                'file'  => $result['file_name'] ,
                                'created' => date('Y-m-d H:i:s'),
                              );
                $this->model->get_insert("filemanager",$insert);
                $json['success'] =  1;
                $json['alert'] = "upload successfully";
          		}



          }else {
            foreach ($_POST as $key => $value)
              {
                $json['alert'][$key] = form_error($key);
              }
          }

          echo json_encode($json);
      }
  }


  function _file_check($str){
        $allowed_mime_type_arr = array('image/jpeg','image/pjpeg','image/png','image/x-png');
        $mime = get_mime_by_extension($_FILES['files']['name']);
        if(isset($_FILES['files']['name']) && $_FILES['files']['name']!=""){
            if(in_array($mime, $allowed_mime_type_arr)){
                return true;
            }else{
                $this->form_validation->set_message('_file_check', '* Please select only jpg/png file.');
                return false;
            }
        }else{
            $this->form_validation->set_message('_file_check', '* Please choose a file to upload.');
            return false;
        }
    }

}
