<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_proyek_model extends MY_Model{

function fetch_data($limit,$start)
{
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
                      master_proyek.akhir_penggalangan,
                      master_proyek.complate");
  $this->db->from("master_proyek");
  $this->db->where("master_proyek.status","publish");
  $this->db->where("master_proyek.status_penggalangan","mulai");
  $this->db->where("master_proyek.complate","1");
  // if ($this->input->post("title")) {
  //   $this->db->like("master_proyek.title", $this->input->post("title"));
  // }
  $this->db->order_by("master_proyek.id_proyek","DESC");
  $this->db->limit($limit,$start);
  $qry = $this->db->get();


    foreach ($qry->result() AS $pb) {
      $total_dana = $pb->harga_paket * $pb->jumlah_paket; //dana di butuhkan
      $dana_terkumpul = $this->proyek->total_dana_terkumpul($pb->id_proyek);
      $persen = cari_persen($total_dana,$dana_terkumpul);
      $imbal_hasil = $pb->imbal_hasil_pendana+$pb->ujroh_penyelenggara;
      $rupiah_imbal_hasil = ($pb->imbal_hasil_pendana+$pb->ujroh_penyelenggara)/100*$total_dana;

      if ($pb->foto_1!="") {
        $image = base_url().'_template/files/proyek/'.$pb->kode.'/'.$pb->foto_1;
      }else {
        $image = base_url().'_template/files/no-image.png';
      }


      $output.='<div class="col-md-6 col-lg-6 col-xl-4 animated zoomIn delay-2s">
          <div class="card m-b-30">
              <div class="card-img-top" style="height:150px;background:url('.$image.')">
                <span class="label-hari">Tersisa '.selisih_hari($pb->akhir_penggalangan).' hari lagi</span>
              </div>

              <div class="card-body" style="height:80px;max-height:80px!important;">
                  <p class="card-text" style="color:#6b6b6b;font-size:15px">Pendanaan <b>'.$pb->kode.'</b>. '.$pb->title.'</p>
              </div>
              <div class="card-body">
                <span>Dana terkumpul ('.$persen.'%)</span>
                <div class="mt-1">
                  <div class="progress" style="background-color:#ebebeb;height:0.5rem;">
                      <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" role="progressbar" aria-valuenow="'.$persen.'" aria-valuemin="0" aria-valuemax="100" style="width: '.$persen.'%; color:#fff;"></div>
                  </div>
                </div>
              </div>
              <ul class="list-group list-group-flush list-custom">
                  <li class="list-group-item">Dana Dibutuhkan <span class="float-right badge badge-primary">Rp.'.format_rupiah($total_dana).'</span></li>
                  <li class="list-group-item">Minimum Pendanaan <span class="float-right badge badge-primary">Rp.'.format_rupiah($pb->harga_paket).'</span></li>
                  <li class="list-group-item">Durasi Proyek <span class="float-right badge badge-primary">'.$pb->durasi_proyek.' bulan</span></li>
                  <li class="list-group-item">Imbal Hasil /tahun <span class="float-right badge badge-primary">('.$imbal_hasil.'%) Rp.'.format_rupiah($rupiah_imbal_hasil).'</span></li>
                  <li class="list-group-item">Terima Imbal Hasil <span class="float-right badge badge-primary">Tiap Bulan</span></li>
              </ul>
              <div class="card-body">
                  <a href="'.site_url("user/master_proyek/detail/".$pb->id_proyek.'/'.$pb->kode).'" class="btn btn-sm btn-block btn-primary">Danai Sekarang</a>
              </div>
          </div>
      </div>';
    }

  return $output;

}


function count_all()
{
  $this->db->select(" master_proyek.id_proyek");
  $this->db->from("master_proyek");
  $this->db->where("master_proyek.`status`","publish");
  $this->db->where("master_proyek.status_penggalangan","mulai");
  $this->db->where("master_proyek.complate","1");
  $qry = $this->db->get();
  return $qry->num_rows();
}


function get_detail($id,$kode)
{
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
                      master_proyek.complate");
  $this->db->from("master_proyek");
  $this->db->where("master_proyek.status","publish");
  $this->db->where("master_proyek.status_penggalangan","mulai");
  $this->db->where("master_proyek.complate","1");
  $this->db->where("master_proyek.id_proyek",$id);
  $this->db->where("master_proyek.kode",$kode);
  $qry = $this->db->get();
  return $qry->row();
}

}
