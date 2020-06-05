<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_proyek_model extends MY_Model{

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
        $cek_pendanaan = $this->balance_user->get_pendanaan(sess('id_user'),$pb->id_proyek);
        if ($pb->foto_1!="") {
          $image = base_url().'_template/files/proyek/'.$pb->kode.'/'.$pb->foto_1;
        }else {
          $image = base_url().'_template/files/no-image.png';
        }


        $output.='<div class="col-md-6 col-lg-6 col-xl-4 animated zoomIn delay-2s">
                    <div class="card m-b-30">
                  <div class="card-img-top" style="height:150px;background:url('.$image.')">';
                  if ($pb->status_penggalangan=="akan_datang") {
                    $output.='<span class="label-hari bg-danger">Akan Rilis '.date('d/m/Y',strtotime($pb->mulai_penggalangan)).'</span>';
                  }elseif ($pb->status_penggalangan=="mulai") {
                    $output.='<span class="label-hari bg-info">Tersisa '.selisih_hari($pb->akhir_penggalangan).' hari lagi</span>';
                  }elseif ($pb->status_penggalangan=="terpenuhi") {
                    $output.='<span class="label-hari bg-success">Terpenuhi</span>';
                  }elseif ($pb->status_penggalangan=="selesai") {
                    $output.='<span class="label-hari bg-success">Selesai</span>';
                  }

        $output.='</div>
                <div class="card-body" style="height:80px;max-height:80px!important;">
                    '.($cek_pendanaan > 0 ? '<span class="text-success"><i class="fa fa-check-circle"></i> TELAH ANDA DANAI</span>':'').'
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
                    <li class="list-group-item">Imbal Hasil /tahun <span class="float-right badge badge-primary"> Rp.'.format_rupiah($rupiah_imbal_hasil).' ('.$imbal_hasil.'%)</span></li>
                    <li class="list-group-item">Terima Imbal Hasil <span class="float-right badge badge-primary">Tiap Bulan</span></li>
                </ul>
                <div class="card-body">
                    <a href="'.site_url("user/master_proyek/detail/".$pb->id_proyek.'/'.$pb->kode).'" class="btn btn-sm btn-block btn-primary">Detail</a>
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
