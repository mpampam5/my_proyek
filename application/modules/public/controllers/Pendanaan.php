<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendanaan extends Pbl{

  public function __construct()
  {
    parent::__construct();
    $this->load->library("proyek");
    $this->load->helper("proyek");
    $this->load->model("Pendanaan_model","model");
  }

  function get_pendanaan()
  {
    $this->template->set_title("Penggalangan Dana");
    $this->template->view("content/pendanaan/index");
  }

  function paging()
  {
        $this->load->library("pagination");
        $config = array();
        $config["base_url"] = "#";
        $config["total_rows"] = $this->model->count_all();
        $config["per_page"] = 6;
        $config["uri_segment"] = 3;
        $config["use_page_numbers"] = TRUE;

        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item">';
        $config['num_tag_close']    = '</li>';
        $config['cur_tag_open']     = '<li class="page-item active">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</li>';
        $config['next_tag_open']    = '<li class="page-item">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</li>';
        $config['prev_tag_open']    = '<li class="page-item">';
        $config['prev_tagl_close']  = 'Next</li>';
        $config['first_tag_open']   = '<li class="page-item">';
        $config['first_tagl_close'] = '</li>';
        $config['last_tag_open']    = '<li class="page-item">';
        $config['last_tagl_close']  = '</li>';

        $config["num_links"] = 1;
        $this->pagination->initialize($config);
        $page = $this->uri->segment(3);
        $start = ($page - 1) * $config["per_page"];

      $output = array(
       'pagination_link'  => $this->pagination->create_links(),
       'data'   => $this->model->fetch_data($config["per_page"], $start)
      );
      echo json_encode($output);
  }

}
