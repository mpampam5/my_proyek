<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_proyek extends User{

  public function __construct()
  {
    parent::__construct();
    $this->load->model("Master_proyek_model","model");
    $this->load->library("proyek");
    $this->load->helper("proyek");
  }

  function index()
  {
    $this->template->set_title("Daftar Proyek");
    $this->template->view("content/master_proyek/index");
  }


  function paging()
  {
        $this->load->library("pagination");
        $config = array();
        $config["base_url"] = "#";
        $config["total_rows"] = $this->model->count_all();
        $config["per_page"] = 10;
        $config["uri_segment"] = 4;
        $config["use_page_numbers"] = TRUE;

        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';

        $config["num_links"] = 1;
        $this->pagination->initialize($config);
        $page = $this->uri->segment(4);
        $start = ($page - 1) * $config["per_page"];

      $output = array(
       'pagination_link'  => $this->pagination->create_links(),
       'data'   => $this->model->fetch_data($config["per_page"], $start)
      );
      echo json_encode($output);
  }

}
