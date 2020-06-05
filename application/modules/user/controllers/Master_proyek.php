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
        $config["per_page"] = 6;
        $config["uri_segment"] = 4;
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
        $page = $this->uri->segment(4);
        $start = ($page - 1) * $config["per_page"];

      $output = array(
       'pagination_link'  => $this->pagination->create_links(),
       'data'   => $this->model->fetch_data($config["per_page"], $start)
      );
      echo json_encode($output);
  }


  function detail($id=null, $kode=null)
  {
    if ($row = $this->model->get_detail($id,$kode)) {
      $this->template->set_title("Detail Proyek #$kode");
      $data['dt'] = $row;
      $this->template->view("content/master_proyek/detail",$data);
    }
  }

  function simulasi_act($id, $kode)
  {
    if ($this->input->is_ajax_request()) {
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


  function add($id = null,$kode = null){
    if ($this->input->is_ajax_request()) {
      if ($row = $this->model->get_detail($id,$kode)) {
        if ($row->status_penggalangan == "mulai" AND $row->status == "publish") {
          $dt['dt'] =$row;
          $dt['action'] = site_url("user/master_proyek/add_action/".$row->id_proyek."/".$row->kode);
          $this->template->view("content/master_proyek/form",$dt,false);
        }
      }
    }
  }


  function add_action($id = null,$kode = null){
    if ($this->input->is_ajax_request()) {
      $json = array('success'=>false, 'alert'=>array());
      $row = $this->model->get_detail($id,$kode);
      $paket =  $this->input->post("paket");
      $nominal =  $row->harga_paket;
      $total = $nominal * $paket;
      $this->form_validation->set_rules("paket","*&nbsp;","trim|xss_clean|numeric|required");
      $this->form_validation->set_rules("total","*&nbsp;","trim|xss_clean|required|callback__cek_saldo[".$total."]");
      $this->form_validation->set_rules("pin","*&nbsp;","trim|xss_clean|required|callback__cek_pin");
      $this->form_validation->set_error_delimiters('<span class="error text-danger" style="font-size:11px">','</span>');
      if ($this->form_validation->run()) {
        if ($row) {
            if ($row->status_penggalangan == "mulai" AND $row->status == "publish") {
              $insert = array('id_proyek' => $row->id_proyek,
                              'id_pendana' => sess('id_user'),
                              'jumlah_paket' => $paket,
                              'join_hari_ke' => selisih_hari($row->akhir_penggalangan),
                              'date_join' => date("Y-m-d"),
                              'total_rupiah' => $total,
                              'status'  => "approved",
                              'created_at' => date("Y-m-d H:i:s"),
                              );
              $this->model->get_insert("trans_penggalangan_dana",$insert);
              //profit
              $last_id = $this->db->insert_id();
              //hitung profit
              $tanggal = date('Y-m-d');
              $nominal = $total;
              $akhir_penggalangan = $row->akhir_penggalangan;
              $priode = $row->durasi_proyek;
              $selisih_hari = selisih_hari($akhir_penggalangan,$tanggal);

              $penggalangan = (0.03 / 100) * $nominal ;
              $hsl_penggalangan =  $penggalangan * $selisih_hari;

              $profit_bulan = (1 / 100) * $nominal;
              $profit_bulan_pertama = $profit_bulan + $hsl_penggalangan;
              $imbal_hasil = ($row->imbal_hasil / 100) * $nominal;

              if ($row->durasi_proyek == 1) {
                $insert_profit['id_proyek']                 =  $row->id_proyek;
                $insert_profit['id_pendana']                =  sess('id_user');
                $insert_profit['id_trans_pendanaan_proyek'] =  $last_id;
                $insert_profit['waktu_pembagian']           = date('Y-m-d', strtotime("+1 month", strtotime($row->tgl_mulai_proyek)));
                $insert_profit['nominal_rupiah']            =  $profit_bulan;
                $insert_profit['penggalangan']              =  $hsl_penggalangan;
                $insert_profit['sisa_imbal_hasil']          =  $imbal_hasil;
                $insert_profit['pendanaan']                 =  $nominal;
                $insert_profit['total']                     =  $profit_bulan+$nominal+$hsl_penggalangan+$imbal_hasil;
                $this->model->get_insert("trans_profit",$insert_profit);
              }else {
                for ($i=1; $i <= $row->durasi_proyek; $i++) {
                  if ($i == 1) {
                    $insert_profit['id_proyek']                 =  $row->id_proyek;
                    $insert_profit['id_pendana']                =  sess('id_user');
                    $insert_profit['id_trans_pendanaan_proyek'] =  $last_id;
                    $insert_profit['waktu_pembagian']           = date('Y-m-d', strtotime("+$i month", strtotime($row->tgl_mulai_proyek)));
                    $insert_profit['nominal_rupiah']            =  $profit_bulan;
                    $insert_profit['penggalangan']              =  $hsl_penggalangan;
                    $insert_profit['sisa_imbal_hasil']          =  0;
                    $insert_profit['pendanaan']                 =  0;
                    $insert_profit['total']                     =  $profit_bulan+$hsl_penggalangan;
                  }elseif ($i == $row->durasi_proyek) {
                    $insert_profit['id_proyek']                 =  $row->id_proyek;
                    $insert_profit['id_pendana']                =  sess('id_user');
                    $insert_profit['id_trans_pendanaan_proyek'] =  $last_id;
                    $insert_profit['waktu_pembagian']           = date('Y-m-d', strtotime("+$i month", strtotime($row->tgl_mulai_proyek)));
                    $insert_profit['nominal_rupiah']            =  $profit_bulan;
                    $insert_profit['penggalangan']              =  0;
                    $insert_profit['sisa_imbal_hasil']          =  $imbal_hasil;
                    $insert_profit['pendanaan']                 =  $nominal;
                    $insert_profit['total']                     =  $profit_bulan+$nominal+$imbal_hasil;
                  }else {
                    $insert_profit['id_proyek']                 =  $row->id_proyek;
                    $insert_profit['id_pendana']                =  sess('id_user');
                    $insert_profit['id_trans_pendanaan_proyek'] =  $last_id;
                    $insert_profit['waktu_pembagian']           = date('Y-m-d', strtotime("+$i month", strtotime($row->tgl_mulai_proyek)));
                    $insert_profit['nominal_rupiah']            =  $profit_bulan;
                    $insert_profit['penggalangan']              =  0;
                    $insert_profit['sisa_imbal_hasil']          =  0;
                    $insert_profit['pendanaan']                 =  0;
                    $insert_profit['total']                     =  $profit_bulan;
                  }

                  $this->model->get_insert("trans_profit",$insert_profit);
                }
              }

              //insert akstivitas pendanaan
              $dana_terkumpul = $this->proyek->total_dana_terkumpul($row->id_proyek);
              $persen = cari_persen($row->dana_dibutuhkan,$dana_terkumpul);
              $persen_replace = substr($persen,0,-3);
              $keterangan = '<i>#'.profile('id_reg').'&nbsp;'.strtoupper(profile('nama')).'</i> telah mendanai proyek <i>#'.$row->kode.'</i> sebesar Rp.'.format_rupiah($total);
              aktivitas_pendanaan($keterangan);

              if ($persen_replace >= 100) {
                //update status penggalangan
                  $this->model->get_update("master_proyek", ['status_penggalangan'=> "terpenuhi"], ['id_proyek'=>$row->id_proyek]);
                  $keterangan2 = 'Status penggalangan Proyek <i>#'.$row->kode.'</i> sudah mencapai '.$persen_replace.'% (terpenuhi)';
                  aktivitas_pendanaan($keterangan2);
              }


              $json['success'] = true;
              $json['alert'] ="Berhasil mendanai";
            }else {
              $json['alert'] ="Gagal mendanai";
            }
          }else {
            $json['alert'] ="Gagal mendanai";
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

}
