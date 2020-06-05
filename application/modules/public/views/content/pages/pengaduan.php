<style media="screen">
  .img-s{
    width: 100%;
    height: 300px;
    max-height: 300px;
    min-height: 100px;
    background-repeat: no-repeat;
    background-size: 100%;
    background-position: center;
    background-image: url("<?=base_url()?>_template/files/call.png");
  }

  .text-title{
    line-height: 30px;
    font-weight: bold;
  }
</style>
<div class="main" role="main">
  <section class="page-header page-header-modern page-header-background page-header-background-sm overlay overlay-color-primary overlay-show overlay-op-8 mb-5" style="background-image: url(img/page-header/page-header-elements.jpg);">
		<div class="container">
			<div class="row">
				<div class="col-md-12 align-self-center p-static order-2 text-center">
					<h1><?=$title?></h1>
				</div>
			</div>
		</div>
	</section>

  <div class="container mb-5">
    <div class="row">
      <div class="col-lg-10 mx-auto">
        <div class="row">
          <div class="col-md-6">
            <div class="img-s"></div>
          </div>

          <div class="col-md-6 pt-5">
            <h5 class="text-primary text-5 text-title"> Tata Cara Mekanisme & Layanan Pengaduan Pengguna</h5>
            <p class="text-5">
              Untuk menangani keluhan atau pengaduan silahkan hubungi kontak di bawah.
            </p>

            <ul style="list-style:none" class="text-primary text-4">
              <li class="pb-2"><i class="fa fa-comments"></i> <?=config_system("telepon_wa")?> (Whatsapp)</li>
              <li class="pb-2"><i class="fa fa-phone"></i> <?=config_system("telepon")?> (Tlp. Kantor)</li>
              <li class="pb-2"><i class="fa fa-envelope"></i> <?=config_system('email')?></li>
            </ul>

            <p class="text-5">
              Atau Kunjungi Kantor kami
            </p>

            <ul style="list-style:none" class="text-primary text-4">
              <li><i class="fa fa-map"></i> <?=config_system("alamat")?></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>


</div>
