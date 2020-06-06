<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendanaan_model extends CI_Model{

  function fetch_data($limit,$start)
  {
    $post = $this->input->post("filter");
    $output = "";
    $this->db->select(" master_proyek.id_proyek,
                        master_proyek.kode,
                        master_proyek.title,
                        master_proyek.harga_paket,
                        master_proyek.jumlah_paket,
                        master_proyek.durasi_proyek,
                        master_proyek.imbal_hasil_pendana,
                        master_proyek.ujroh_penyelenggara,
                        master_proyek.foto_1,
                        master_proyek.status,
                        master_proyek.status_penggalangan,
                        master_proyek.mulai_penggalangan,
                        master_proyek.akhir_penggalangan,
                        master_proyek.dana_dibutuhkan,
                        master_proyek.complate");
    $this->db->from("master_proyek");
    $this->db->where("master_proyek.status","publish");
    $this->db->where("master_proyek.complate","1");

    if ($post=="akan_datang") {
      $this->db->like("master_proyek.status_penggalangan", "akan_datang");
    }elseif ($post=="sedang_berlangsung") {
      $this->db->like("master_proyek.status_penggalangan", "mulai");
    }elseif ($post=="terpenuhi") {
      $this->db->like("master_proyek.status_penggalangan", "terpenuhi");
    }elseif ($post=="selesai") {
      $this->db->like("master_proyek.status_penggalangan", "selesai");
    }

    $this->db->order_by("master_proyek.id_proyek","DESC");
    $this->db->limit($limit,$start);
    $qry = $this->db->get();


      if ($qry->num_rows()>0) {
        foreach ($qry->result() AS $pb) {
          $total_dana = $pb->harga_paket * $pb->jumlah_paket; //dana di butuhkan
          $dana_terkumpul = $this->proyek->total_dana_terkumpul($pb->id_proyek);
          $persen = cari_persen($total_dana,$dana_terkumpul);
          $imbal_hasil = $pb->imbal_hasil_pendana;
          $rupiah_imbal_hasil = ($pb->imbal_hasil_pendana+$pb->ujroh_penyelenggara)/100*$total_dana;
          if ($pb->foto_1!="") {
            $image = base_url().'_template/files/proyek/'.$pb->kode.'/'.$pb->foto_1;
          }else {
            $image = base_url().'_template/files/no-image.png';
          }



          $output.='<div class="col-md-4 appear-animation animated fadeIn appear-animation-visible" data-appear-animation="fadeIn" data-appear-animation-delay="0" data-appear-animation-duration="1s" style="animation-duration: 1s; animation-delay: 0ms;">
                        <div class="card">
                              <img class="card-img-top" src="'.$image.'" alt="Card Image" height="200">

                            <div class="card-body">
                                <h4 class="card-title mb-1 text-3 font-weight-bold" style="min-height:70px;">Pendanaan '.$pb->kode.' '.$pb->title.'</h4>
                                <div class="row">
                                  <div class="col-sm-12">';
                                  if ($pb->status_penggalangan=="akan_datang") {
                                    $output.='<span class="badge badge-warning">AKAN DATANG</span>';
                                  }elseif ($pb->status_penggalangan=="mulai") {
                                    $output.='<span class="badge badge-info">SEDANG BERLANGSUNG</span>';
                                  }elseif ($pb->status_penggalangan=="terpenuhi") {
                                    $output.='<span class="badge badge-danger">TERPENUHI</span>';
                                  }elseif ($pb->status_penggalangan=="selesai") {
                                    $output.='<span class="badge badge-success">SELESAI</span>';
                                  }
              $output.='          </div>
                                    <div class="col-lg-7 text-left">
                                        <p style="margin-bottom: 3px;">Dana Terkumpul</p>
                                    </div>
                                    <div class="col-lg-5 text-right">
                                        <h5 style="margin-bottom: 0px;">'.$persen.'%</h5>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="progress progress-sm mb-2">
                                            <div class="progress-bar progress-bar-primary progress-bar-striped progress-bar-animated active" role="progressbar" aria-valuenow="'.$persen.'" aria-valuemin="0" aria-valuemax="100" style="width: '.$persen.'%">
                                                <span class="sr-only">'.$persen.'% Complete</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-lg-6">
                                        <h6 class="mb-0 text-2">Dana Dibutuhkan</h6>
                                        <h6 class="font-weight-bold">Rp. '.format_rupiah($pb->dana_dibutuhkan).'</h6>

                                        <h6 class="mb-0 text-2">Imbal Hasil/Tahun</h6>
                                        <h6 class="font-weight-bold">'.$pb->imbal_hasil_pendana.'%</h6>

                                        <h6 class="mb-0 text-2">Terima Imbal Hasil</h6>
                                        <h6 class="font-weight-bold">Tiap Bulan</h6>
                                    </div>
                                    <div class="col-lg-6">
                                        <h6 class="mb-0 text-2">Durasi/Tenor Proyek</h6>
                                        <h6 class="font-weight-bold">'.$pb->durasi_proyek.' bulan</h6>

                                        <h6 class="mb-0 text-2">Minimum Pendanaan</h6>
                                        <h6 class="font-weight-bold">Rp.'.format_rupiah($pb->harga_paket).'</h6>';

                                        if ($pb->status_penggalangan=="mulai") {
                                          $output.='<h6 class="mb-0 text-2">Penggalangan Berakhir</h6>
                                          <h6 class="font-weight-bold">'.selisih_hari($pb->akhir_penggalangan).' Hari lagi</h6>';
                                        }elseif ($pb->status_penggalangan=="akan_datang") {
                                          $output.='<h6 class="mb-0 text-2">Mulai Penggalangan</h6>
                                          <h6 class="font-weight-bold">'.date('d/m/Y',strtotime($pb->mulai_penggalangan)).'</h6>';
                                        }elseif ($pb->status_penggalangan=="terpenuhi" OR $pb->status_penggalangan=="selesai") {
                                          $output.='<h6 class="mb-0 text-2">Status Penggalangan</h6>
                                          <h6 class="font-weight-bold">Berakhir</h6>';
                                        }
                    $output.='</div>
                                </div>
                                <a href="'.site_url("penggalangan-dana/read/$pb->id_proyek/$pb->kode/pendanaan-".url_title($pb->title,"dash")).'" class="read-more text-color-primary font-weight-semibold text-2">Lihat Selengkapnya <i class="fas fa-angle-right position-relative top-1 ml-1"></i></a>
                            </div>
                        </div>
                    </div>';
        }
      }else {
        $output.='<div class="text-center"><img src="'.base_url().'_template/files/data-not-found.png" /></div>';
      }

    return $output;

  }


  function count_all()
  {
    $post = $this->input->post("filter");
    $this->db->select(" master_proyek.id_proyek");
    $this->db->from("master_proyek");
    $this->db->where("master_proyek.`status`","publish");
    $this->db->where("master_proyek.complate","1");
    if ($post=="akan_datang") {
      $this->db->like("master_proyek.status_penggalangan", "akan_datang");
    }elseif ($post=="sedang_berlangsung") {
      $this->db->like("master_proyek.status_penggalangan", "mulai");
    }elseif ($post=="terpenuhi") {
      $this->db->like("master_proyek.status_penggalangan", "terpenuhi");
    }elseif ($post=="selesai") {
      $this->db->like("master_proyek.status_penggalangan", "selesai");
    }
    $qry = $this->db->get();
    return $qry->num_rows();
  }



    function get_detail($id,$kode)
    {
      $this->db->select(" master_proyek.id_proyek,
                          master_proyek.id_penerima_dana,
                          master_proyek.kode,
                          master_proyek.title,
                          master_proyek.harga_paket,
                          master_proyek.jumlah_paket,
                          master_proyek.dana_dibutuhkan,
                          master_proyek.durasi_proyek,
                          master_proyek.imbal_hasil_pendana,
                          master_proyek.ujroh_penyelenggara,
                          master_proyek.foto_1,
                          master_proyek.foto_2,
                          master_proyek.foto_3,
                          master_proyek.status,
                          master_proyek.status_penggalangan,
                          master_proyek.mulai_penggalangan,
                          master_proyek.akhir_penggalangan,
                          master_proyek.imbal_hasil,
                          master_proyek.tgl_mulai_proyek,
                          master_proyek.deskripsi,
                          master_proyek.complate,
                          master_penerima_dana.nama,
                          master_penerima_dana.nama_perusahaan");
      $this->db->from("master_proyek");
      $this->db->join("master_penerima_dana","master_penerima_dana.id_penerima_dana=master_proyek.id_penerima_dana");
      $this->db->where("master_proyek.complate","1");
      $this->db->where("master_proyek.id_proyek",$id);
      $this->db->where("master_proyek.kode",$kode);
      $qry = $this->db->get();
      return $qry->row();
    }


}
