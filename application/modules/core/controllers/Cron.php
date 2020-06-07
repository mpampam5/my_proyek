<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cron extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->helper(array("public"));
    $this->load->model("Cron_model","model");
  }


  // maintenance akun user jam 23.57 setiap hari
  function maintenance_on()
  {
    $this->model->get_update("config_system",['status'=>'1'], ['id'=>999]);
  }

  // matikan maintenance akun user jam 02.00 setiap hari
  function maintenance_off()
  {
    $this->model->get_update("config_system",['status'=>'1'], ['id'=>999]);
  }

  //set jam 12.00
  function execute()
  {
    //hapus master proyek yang complate 0
    $this->db->where("complate","0");
    $this->db->delete("master_proyek");

    $tgl = "2020-09-06";


    
    //update status proyek mulai penggalangan
    $this->model->get_update("master_proyek",['status_penggalangan'=>'mulai'], ['complate'=>"1","status"=>"publish","mulai_penggalangan" => $tgl]);
    //update status pembagian dividen mulai
    $this->model->get_update("master_proyek",['status_penggalangan'=>'selesai','status_pembagian_dividen'=>'mulai'], ['complate'=>"1","status"=>"publish","tgl_mulai_proyek" => $tgl]);


    //update pembagian dividen pada table trans_profit
    $this->model->get_update("trans_profit",['status' => 1], ["status"=> null,"waktu_pembagian" => $tgl]);
    //update status pembagian dividen selesai
    $this->model->get_update("master_proyek",['status_pembagian_dividen'=>'selesai'], ['complate'=>"1","status"=>"publish","tgl_selesai_proyek" => $tgl]);

  }

}
