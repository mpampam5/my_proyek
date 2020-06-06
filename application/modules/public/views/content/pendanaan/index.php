<style media="screen">
  .img-s{
    width: 100%;
    height: 100px;
    min-height: 100px;
    background-repeat: no-repeat;
    background-size: 100%;
    background-position: center;
    background-image: url("<?=base_url()?>_template/files/pendanaan.svg");
  }

</style>

<div class="main" role="main">
  <section class="page-header page-header-modern page-header-background page-header-background-sm overlay overlay-color-primary overlay-show overlay-op-8 mb-5" style="background-image: url(img/page-header/page-header-elements.jpg);">
		<div class="container">
			<div class="row">
				<div class="col-md-12 p-static order-2 row">
          <div class="col-lg-4">
            <img src="<?=base_url()?>_template/files/pendanaan.svg" width="100%" alt="">
          </div>

          <div class="col-lg-8 text-center mt-5">
            <h1>Penggalangan Dana</h1>
            <p class="text-white text-4">Berikan Pendanaan Terbaikmu, dan Nikmati Imbal Hasil Terbaik.</p>
          </div>

				</div>
			</div>
		</div>
	</section>

  <div class="container mb-5">
    <div class="row">
      <div class="col-md-12 mx-auto">
          <h3 class="text-primary">Semua Penggalangan Dana</h3>
          <div  style="overflow-x:auto!important">
            <div class="btn-group" id="filters" role="group" aria-label="Basic example">
                <button type="button" data-value="all" class="filter btn btn-primary active">Semua</button>
                <button type="button" data-value="sedang_berlangsung" class="filter btn btn-primary">Sedang Berlangsung</button>
                <button type="button" data-value="akan_datang" class="filter btn btn-primary">Akan Rilis</button>
                <button type="button" data-value="terpenuhi" class="filter btn btn-primary">Terpenuhi</button>
                <button type="button" data-value="selesai" class="filter btn btn-primary">Selesai</button>
            </div>
          </div>

          <div id="content-paging" class="row mt-5"></div>
          <div id="pagination_link"></div>

      </div>

    </div>
  </div>


</div>


<script type="text/javascript">
$(document).ready(function(){

 function load_data(page)
 {
   const data_filter = $('.filter.active').attr('data-value');

   if (data_filter=="all") {
     $("#title-proyek").text("Semua Penggalangan Dana ");
   }else if (data_filter=="sedang_berlangsung") {
    $("#title-proyek").text("Penggalangan Dana Sedang Berlangsung");
  }else if (data_filter=="terpenuhi") {
    $("#title-proyek").text("Penggalangan Dana Terpenuhi");
  }else if (data_filter=="akan_datang") {
    $("#title-proyek").text("Penggalangan Dana Akan Rilis");
  }else if (data_filter=="selesai") {
    $("#title-proyek").text("Penggalangan Dana Selesai");
  }

  $.ajax({
   url:"<?php echo base_url(); ?>penggalangan-dana/page/"+page,
   method:"POST",
   dataType:"json",
   data:{
     filter:data_filter
   },
   success:function(json)
   {
    $('#content-paging').hide().fadeIn(300).html(json.data);
    $('#pagination_link').html(json.pagination_link);
   }
  });
 }

 load_data(1);

 $(document).on("click", ".pagination li a", function(event){
  event.preventDefault();
  var page = $(this).data("ci-pagination-page");
  load_data(page);
 });



 const elements = document.querySelectorAll(".filter");
 for (var i = 0; i < elements.length; i++) {
   elements[i].addEventListener('click',function(){
     $('.filter').removeClass('active');
     $(this).addClass('active');
     load_data(1);
   });
 }


});
</script>
