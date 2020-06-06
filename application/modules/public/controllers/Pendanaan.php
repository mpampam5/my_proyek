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
        $config["per_page"] = 9;
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

  function get_detail($id,$kode,$title = "")
  {
    if ($row = $this->model->get_detail($id,$kode)) {
      $this->template->set_title("Pendanaan #$kode. $row->title");
      $data['dt'] = $row;
      $this->template->view("content/pendanaan/detail",$data);
    }
  }

  function simulasi_act($id, $kode)
  {
    if ($this->input->is_ajax_request()) {
      $this->load->library('form_validation');
      $json = array('success'=>false, 'alert'=>array(), 'data' => null);
      $this->form_validation->set_rules("nominal","*&nbsp;","trim|xss_clean|numeric|required");
      $this->form_validation->set_rules("tanggal","*&nbsp;","trim|xss_clean|required");
      $this->form_validation->set_rules("akhir_penggalangan","*&nbsp;","trim|xss_clean|required");
      $this->form_validation->set_rules("durasi_proyek","*&nbsp;","trim|xss_clean|required");
      $this->form_validation->set_rules("imbal_hasil","*&nbsp;","trim|xss_clean|required");
      $this->form_validation->set_error_delimiters('<span class="error text-danger" style="font-size:11px">','</span>');
      if ($this->form_validation->run()) {
        $tanggal = date('Y-m-d',strtotime($this->input->post('tanggal')));
        $nominal = $this->input->post("nominal");
        $akhir_penggalangan = $this->input->post("akhir_penggalangan");
        $priode = $this->input->post("durasi_proyek");
        $imbal_hasil_post = $this->input->post("imbal_hasil");
        $selisih_hari = selisih_hari($akhir_penggalangan,$tanggal);

        $penggalangan = (master_config("FINANCIAL-PED") / 100) * $nominal ;
        $hsl_penggalangan =  $penggalangan * $selisih_hari;

        $profit_bulan = (master_config("FINANCIAL-DB") / 100) * $nominal;
        $profit_bulan_pertama = $profit_bulan + $hsl_penggalangan;
        $imbal_hasil = ($imbal_hasil_post / 100) * $nominal;

        $hasil_durasi = $profit_bulan * $priode;

        $dana_pokok_imbal_hasil = $nominal + $imbal_hasil + $hasil_durasi + $hsl_penggalangan;

        $output = '';
        $output .='<p>Simulasi Imbal Hasil</p>
                  <table class="table table-bordered">
                    <tr>
                      <th>Tgl Pendanaan</th>
                      <th>Jumlah Dana</th>
                      <th>Jumlah Hari</th>
                      <th>Penggalangan</th>
                      <th>Bulan 1</th>
                      <th>Pembayaran Bulan 1</th>
                      <th>Bulan 2 - akhir</th>
                      <th>Sisa Imbal Hasil</th>
                    </tr>

                    <tr>
                      <td>'.date('d/m/Y',strtotime($tanggal)).'</td>
                      <td>'.format_rupiah($nominal).'</td>
                      <td class="text-center">'.$selisih_hari.'</td>
                      <td>'.format_rupiah($hsl_penggalangan).'</td>
                      <td>'.format_rupiah($profit_bulan).'</td>
                      <td>'.format_rupiah($profit_bulan_pertama).'</td>';

                if ($priode > 1) {
                  $output .='<td>'.format_rupiah($profit_bulan).'</td>';
                }else {
                  $output .='<td class="text-center"> - </td>';
                }
                $output .='<td>'.format_rupiah($imbal_hasil).'</td>
                    </tr>
                  </table>
                  <p class="text-right" style="font-weight:bold">Total Imbal Hasil dan Dana Pokok : Rp.'.format_rupiah($dana_pokok_imbal_hasil).'</p>';

        $json['data'] = $output;
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

}
