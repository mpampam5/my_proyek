<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post extends Backend{

  public function __construct()
  {
    parent::__construct();
    $this->load->model("Post_model","model");
  }

  function index()
  {
    $this->template->set_title("post");
    $this->template->view("content/post/index");
  }


  function json()
  {
    if ($this->input->is_ajax_request()) {
      $list = $this->model->get_datatables();
      $data = array();
      // $no = $_POST['start'];
      foreach ($list as $rows) {
          $id = enc_url($rows->id_post);
          $row = array();
          $row[] = date("d/m/Y H:i",strtotime($rows->created));
          $row[] = ucfirst(substr($rows->title,0,100)).'...<p style="font-size:12px"><a class="text-primary" href="'.site_url("$rows->kategori_slug/$id/$rows->slug").'"><i class="fa fa-link"></i> '.base_url().substr($rows->slug,0,100).'...</a></p>';
          $row[] = ($rows->kategori=="") ? 'tidak ada' : '<span class="badge badge-primary">'.strtoupper($rows->kategori).'</span>';

          $row[] = '
                    <a href="'.site_url("backend/post/update/$id").'" class="bnt btn-sm btn-primary" id="update"><i class="fa fa-pencil"></i> Update</a>
                    <a href="'.site_url("backend/post/delete/$id").'" class="bnt btn-sm btn-danger" id="delete"><i class="fa fa-trash"></i> Delete</a>
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


  function add()
  {
    $this->template->set_title("Add Post");
    $data = array('action' => site_url("backend/post/add_action"),
                  'button' => "add",
                  'nama' => set_value("nama"),
                  'email' => set_value("email"),
                  'is_active' => set_value("is_active"),
                  'id_level' => set_value("id_level"),

                  );
    $this->template->view("content/post/form",$data);
  }








}
