<div role="main" class="main">
    <div class="slider-container light rev_slider_wrapper" style="height: 700px">
        <div id="revolutionSlider" class="slider rev_slider" data-version="5.4.8" data-plugin-revolution-slider data-plugin-options="{'delay': 9000, 'gridwidth': 1170, 'gridheight': 700, 'responsiveLevels': [4096,1200,992,500], 'navigation': {'arrows': {'enable': true, 'style': 'arrows-style-1 arrows-big arrows-dark'}}}">

            <ul>
                <li data-transition="fade">
                    <img src="<?= base_url() ?>_template/public/img/slides/slide-corporate-9-1.jpg" alt="" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg">

                    <div class="tp-caption" data-x="center" data-hoffset="['-150','-150','-150','-240']" data-y="center" data-voffset="['-50','-50','-50','-75']" data-start="1000" data-transform_in="x:[-300%];opacity:0;s:500;" data-transform_idle="opacity:0.8;s:500;">
                        <img src="<?= base_url() ?>_template/public/img/slides/slide-title-border-light.png" alt=""></div>

                    <div class="tp-caption text-color-dark font-weight-semibold" data-x="center" data-y="center" data-voffset="['-50','-50','-50','-75']" data-start="700" data-fontsize="['22','22','22','40']" data-lineheight="['25','25','25','45']" data-transform_in="y:[-50%];opacity:0;s:500;">MAKE BETTER THINGS</div>

                    <div class="tp-caption d-none d-md-block" data-frames='[{"delay":3800,"speed":500,"frame":"0","from":"opacity:0;x:10%;","to":"opacity:1;x:0;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]' data-x="center" data-hoffset="['90','90','90','135']" data-y="center" data-voffset="['-33','-33','-33','-55']"><img src="<?= base_url() ?>_template/public/img/slides/slide-dark-line.png" alt=""></div>

                    <div class="tp-caption" data-x="center" data-hoffset="['150','150','150','240']" data-y="center" data-voffset="['-50','-50','-50','-75']" data-start="1000" data-transform_in="x:[300%];opacity:0;s:500;" data-transform_idle="opacity:0.8;s:500;">
                        <img src="<?= base_url() ?>_template/public/img/slides/slide-title-border-light.png" alt=""></div>

                    <h1 class="tp-caption font-weight-extra-bold text-color-dark negative-ls-2" data-frames='[{"delay":1000,"speed":2000,"frame":"0","from":"sX:1.5;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]' data-x="center" data-y="center" data-fontsize="['50','50','50','90']" data-lineheight="['55','55','55','95']">PORTO TEMPLATE</h1>

                    <div class="tp-caption font-weight-light text-color-dark opacity-8" data-frames='[{"from":"opacity:0;","speed":300,"to":"o:1;","delay":2000,"split":"chars","splitdelay":0.05,"ease":"Power2.easeInOut"},{"delay":"wait","speed":1000,"to":"y:[100%];","mask":"x:inherit;y:inherit;s:inherit;e:inherit;","ease":"Power2.easeInOut"}]' data-x="center" data-y="center" data-voffset="['40','40','40','80']" data-fontsize="['18','18','18','50']" data-lineheight="['20','20','20','55']" style="color: #b5b5b5;">Check out our options and features</div>

                </li>
                <li data-transition="fade">
                    <img src="<?= base_url() ?>_template/public/img/slides/slide-corporate-9-2.jpg" alt="" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg">

                    <div class="tp-caption font-weight-extra-bold text-color-dark negative-ls-2" data-frames='[{"delay":1000,"speed":2000,"frame":"0","from":"sX:1.5;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]' data-x="center" data-y="center" data-fontsize="['50','50','50','90']" data-lineheight="['55','55','55','95']">AMAZING DESIGN</div>

                    <div class="tp-caption font-weight-light text-color-dark opacity-8" data-frames='[{"from":"opacity:0;","speed":300,"to":"o:1;","delay":2000,"split":"chars","splitdelay":0.05,"ease":"Power2.easeInOut"},{"delay":"wait","speed":1000,"to":"y:[100%];","mask":"x:inherit;y:inherit;s:inherit;e:inherit;","ease":"Power2.easeInOut"}]' data-x="center" data-y="center" data-voffset="['40','40','40','80']" data-fontsize="['18','18','18','50']" data-lineheight="['20','20','20','55']" style="color: #b5b5b5;">The best choice for your new website</div>

                </li>
            </ul>
        </div>
    </div>

    <div class="container">
        <div class="row counters counters-sm with-borders py-4 mt-5">
            <div class="col-sm-6 col-lg-3 mb-5 mb-lg-0">
                <div class="counter counter-primary">
                    <i class="icons icon-wallet text-color-dark"></i>
                    <strong class="font-weight-extra-bold text-5">Rp.<?=format_rupiah($total_pendanaan)?></strong>
                    <label class="text-3 mt-1">Total Semua Pendanaan</label>
                </div>
            </div>

            <div class="col-sm-6 col-lg-3 mb-5 mb-lg-0">
                <div class="counter counter-primary">
                    <i class="icons icon-graph text-color-dark"></i>
                    <strong class="font-weight-extra-bold text-5">Rp.<?=format_rupiah($total_pendanaan_tahun_berjalan)?></strong>
                    <label class="text-3 mt-1">Pendanaan Tahun Berjalan</label>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3 mb-5 mb-sm-0">
                <div class="counter counter-primary">
                    <i class="icons icon-book-open text-color-dark"></i>
                    <strong class="font-weight-extra-bold text-5"><?=$total_proyek?></strong>
                    <label class="text-3 mt-1">Penggalangan Terdaftar</label>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="counter counter-primary">
                    <i class="icons icon-user text-color-dark"></i>
                    <strong class="font-weight-extra-bold text-5"><?=$total_pendana?></strong>
                    <label class="text-3 mt-1">Total Pendana</label>
                </div>
            </div>
        </div>

        <!-- <hr class="solid my-5"> -->
    </div>


    <div class="container mt-4 mb-5">

        <div class="row">
            <h3>Penggalangan Dana</h3>
            <!-- <p>Berikan Pembiayaan Terbaikmu, dan Nikmati Imbal Hasil Terbaik</p> -->
            <div class="owl-carousel owl-theme dots-morphing" data-plugin-options="{'responsive': {'0': {'items': 1}, '479': {'items': 1}, '768': {'items': 2}, '979': {'items': 3}, '1199': {'items': 3}}, 'loop': false, 'autoHeight': true, 'margin': 10}">
              <?php foreach ($proyek_publish as $pr): ?>
                <?php
                $total_dana = $pr->harga_paket * $pr->jumlah_paket; //dana di butuhkan
                $dana_terkumpul = $this->proyek->total_dana_terkumpul($pr->id_proyek);
                $persen = cari_persen($total_dana,$dana_terkumpul);
                $imbal_hasil = $pr->imbal_hasil_pendana;
                $rupiah_imbal_hasil = ($pr->imbal_hasil_pendana+$pr->ujroh_penyelenggara)/100*$total_dana;
                 ?>
                <div>
                    <div class="card">
                        <?php if ($pr->foto_1 == ""): ?>
                          <img class="card-img-top" src="<?= base_url() ?>_template/files/no-image.png" alt="Card Image" height="200">
                          <?php else: ?>
                            <img class="card-img-top" src="<?= base_url() ?>_template/files/proyek/<?=$pr->kode?>/<?=$pr->foto_1?>" alt="Card Image" height="200">
                        <?php endif; ?>
                        <div class="card-body">
                            <h4 class="card-title mb-1 text-3 font-weight-bold" style="min-height:70px;">Pendanaan <?=$pr->kode?>. <?=$pr->title?></h4>
                            <div class="row">
                              <div class="col-sm-12">
                                <?php if ($pr->status_penggalangan=="akan_datang"): ?>
                                  <span class="badge badge-warning">AKAN DATANG</span>
                                <?php elseif($pr->status_penggalangan=="mulai"):?>
                                  <span class="badge badge-info">SEDANG BERLANGSUNG</span>
                                <?php elseif($pr->status_penggalangan=="terpenuhi"):?>
                                  <span class="badge badge-danger">TERPENUHI</span>
                                <?php elseif($pr->status_penggalangan=="selesai"):?>
                                  <span class="badge badge-success">SELESAI</span>
                                <?php endif; ?>

                              </div>
                                <div class="col-lg-9">
                                    <p style="margin-bottom: 3px;">Dana Terkumpul</p>
                                </div>
                                <div class="col-lg-3 text-right">
                                    <h5 style="margin-bottom: 0px;"><?=$persen?>%</h5>
                                </div>
                                <div class="col-lg-12">
                                    <div class="progress progress-sm mb-2">
                                        <div class="progress-bar progress-bar-primary progress-bar-striped progress-bar-animated active" role="progressbar" aria-valuenow="<?=$persen?>" aria-valuemin="0" aria-valuemax="100" style="width: <?=$persen?>%">
                                            <span class="sr-only"><?=$persen?>% Complete</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-lg-6">
                                    <h6 class="mb-0">Dana Dibutuhkan</h6>
                                    <h6 class="font-weight-bold">Rp. <?=format_rupiah($pr->dana_dibutuhkan)?></h6>

                                    <h6 class="mb-0">Imbal Hasil/Tahun</h6>
                                    <h6 class="font-weight-bold"><?=$pr->imbal_hasil_pendana?>%</h6>

                                    <h6 class="mb-0">Terima Imbal Hasil</h6>
                                    <h6 class="font-weight-bold">Tiap Bulan</h6>
                                </div>
                                <div class="col-lg-6">
                                    <h6 class="mb-0">Durasi/Tenor Proyek</h6>
                                    <h6 class="font-weight-bold"><?=$pr->durasi_proyek?> bulan</h6>

                                    <h6 class="mb-0">Minimum Pendanaan</h6>
                                    <h6 class="font-weight-bold">Rp. <?=format_rupiah($pr->harga_paket)?></h6>

                                    <?php if ($pr->status_penggalangan=="mulai"): ?>
                                      <h6 class="mb-0">Penggalangan Berakhir</h6>
                                      <h6 class="font-weight-bold"><?=selisih_hari($pr->akhir_penggalangan)?> Hari lagi</h6>
                                    <?php elseif($pr->status_penggalangan=="akan_datang"):?>
                                      <h6 class="mb-0">Mulai Penggalangan</h6>
                                      <h6 class="font-weight-bold"><?=date('d/m/Y',strtotime($pr->mulai_penggalangan))?></h6>
                                    <?php elseif($pr->status_penggalangan=="terpenuhi" OR $pr->status_penggalangan=="selesai"):?>
                                      <h6 class="mb-0">Status Penggalangan</h6>
                                      <h6 class="font-weight-bold">Berakhir</h6>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <a href="<?=site_url("penggalangan-dana/read/".$pr->id_proyek."/".$pr->kode."/pendanaan-".url_title($pr->title,"dash"))?>" class="read-more text-color-primary font-weight-semibold text-2">Lihat Selengkapnya <i class="fas fa-angle-right position-relative top-1 ml-1"></i></a>
                        </div>
                    </div>
                </div>
              <?php endforeach; ?>






            </div>
        </div>
        <div class="text-center">
            <a href="<?= site_url("penggalangan-dana") ?>" class="btn btn-outline btn-primary">Lihat Semua Penggalangan <i class="fas fa-angle-right position-relative top-1 ml-1"></i></a>
        </div>
    </div>

    <section class="section section-primary">
        <div class="container">
            <div class="row">
                <div class="col-md-9 col-lg-9 p-0">
                    <h4 class="mb-0">Cara Investasi</h4>
                    <p class="mb-0">Ikuti panduan singkat cara investasi dari kami dan dapatkan penghasilan rutin dari bagihasil bisnis yang kamu pilih.</p>
                </div>
                <div class="col-md-3 col-lg-3 p-0 my-auto text-center">
                    <a href="<?=site_url("pages/cara-jadi-pendana")?>" class="btn btn-modern btn-light btn-lg">Lihat cara investasi<i class="fas fa-angle-right position-relative top-1 ml-1"></i></a>
                </div>
            </div>
        </div>
    </section>

    <div class="container py-2">
        <div class="text-center">
            <h3 class="mb-2">Bagaimana caranya berinvestasi di Idea Syariah ?</h3>
            <h5>Berinvestasi semudah satu klik di smartphone Anda</h5>
        </div>

        <div class="row mb-5 pt-5 pb-3">

            <div class="col-md-4 col-lg-4 mb-5 mb-lg-0 appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="400">

                <div class="card border-radius-0 bg-color-light border-0 box-shadow-1">
                    <div class="card-body text-center">
                        <strong class=" font-weight-extra-bold text-color-dark line-height-1 text-13 mb-3 d-inline-block">01</strong>
                        <h4 class="font-weight-bold text-color-primary text-4">Proses Seleksi Bisnis</h4>
                        <p>Sebelum terlisting, calon bisnis yang membutuhkan pendanaan akan melewati alur seleksi yang diproses oleh team Business Analyst <?=config_system("title")?>.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-lg-4 mb-5 mb-lg-0 appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="400">

                <div class="card border-radius-0 bg-color-light border-0 box-shadow-1">
                    <div class="card-body text-center">
                        <strong class=" font-weight-extra-bold text-color-dark line-height-1 text-13 mb-3 d-inline-block">02</strong>
                        <h4 class="font-weight-bold text-color-primary text-4">Penawaran Saham</h4>
                        <p>Bisnis yang lolos seleksi akan ditampilkan profil dan penawarannya di website dan aplikasi <?=config_system("title")?>. Anda bisa membeli saham bisnis pilihan.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-lg-4 mb-5 mb-lg-0 appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="400">

                <div class="card border-radius-0 bg-color-light border-0 box-shadow-1">
                    <div class="card-body text-center">
                        <strong class=" font-weight-extra-bold text-color-dark line-height-1 text-13 mb-3 d-inline-block">03</strong>
                        <h4 class="font-weight-bold text-color-primary text-4">Pengelolaan Dana & Pembagian Dividen</h4>
                        <p>Pemilik bisnis akan mengelola dana dari Anda untuk membesarkan usahanya. Anda akan mendapat bagi hasil usaha dalam jangka waktu yang ditentukan.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>



</div>
