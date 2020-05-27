<style media="screen">
ul.pagination li.page-item{
  margin:10px;
}

ul.pagination li.page-item.active{
  color: #9e9e9e;
  font-size: 22px;
  text-align: center;
  font-weight: 500;
}



ul.pagination li.page-item a{
  color: #14b8f5;
  font-size: 18px;
  text-align: center;
  font-weight: 500;
}

.btn.btn-info.active{
  background-color: #a0d4dd!important;
}

</style>
<div class="page-content-wrapper">
  <div class="container-fluid">
    <div class="col-md-11 mx-auto mb-5">
      <div class="row">
        <div class="col-sm-12 mb-3 animated fadeInRight delay-2s font-style">
          <h3 class="pb-2 text-primary" id="title-proyek">Semua Penggalangan Dana</h3>
          <p style="color:#141414;font-size:18px">Berikan Pendanaan Terbaikmu, dan Nikmati Imbal Hasil Terbaik.</p>
        </div>

        <div class="col-sm-12 fadeInRight delay-2s mb-5">
          <b>Filter :&nbsp;&nbsp;</b>
          <div class="btn-group" id="filters" role="group" aria-label="Basic example">
              <button type="button" data-value="all" class="filter btn btn-info active">Semua</button>
              <button type="button" data-value="sedang_berlangsung" class="filter btn btn-info">Sedang Berlangsung</button>
              <button type="button" data-value="akan_datang" class="filter btn btn-info">Akan Rilis</button>
              <button type="button" data-value="terpenuhi" class="filter btn btn-info">Terpenuhi</button>
              <button type="button" data-value="selesai" class="filter btn btn-info">Selesai</button>
          </div>
        </div>
      </div>

      <div id="content-paging" class="row"></div>
       <div id="pagination_link"></div>
    </div>
  </div>
</div> <!-- Page content Wrapper -->


<script>
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
   url:"<?php echo base_url(); ?>user/master_proyek/paging/"+page,
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
