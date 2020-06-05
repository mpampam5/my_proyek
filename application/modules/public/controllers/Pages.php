<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends Pbl{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function get_data($str)
  {
    $cek = array('cara-jadi-pendana','cara-jadi-penerima-dana','aturan-dan-ketentuan','tentang','pengaduan');
    if (in_array($str,$cek)) {
      if ($str == "cara-jadi-pendana") {
        $title = "Cara Jadi Pendana";
      }elseif ($str == "cara-jadi-penerima-dana") {
        $title = "Cara Jadi Penerima Dana";
      }elseif ($str == "aturan-dan-ketentuan") {
        $title = "Aturan Dan Ketentuan Yang Berlaku";
      }elseif ($str == "tentang") {
        $title = "Tentang Kami";
      }elseif ($str=="pengaduan") {
        $title = "Mekanisme Layanan & Pengaduan Pengguna";
      }

      $data['data'] = config_system($str,'deskripsi');

      $this->template->set_title("$title");


      if ($str=="pengaduan") {
        $this->template->view("content/pages/pengaduan");
      }else {
        $this->template->view("content/pages/index",$data);
      }
    }else {
      redirect(site_url("page-not-found"));
    }
  }


  function error404()
  {
    $this->template->set_title("Page Not Found");
    $this->template->view("content/pages/404");
  }

}
