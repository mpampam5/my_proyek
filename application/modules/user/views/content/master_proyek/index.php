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

.card-img-top{
  background-repeat: no-repeat!important;
  background-size: cover!important;
  background-position: center!important;
  position: relative;
}

.label-hari{
  position: absolute;
  bottom: 4px;
  left: 0;
  background-color: #dd4747;
  color:#fff;
  padding: 2px 10px 3px 6px;
  /* opacity: 0.8; */
  border-radius: 0 4px 4px 0;
}
</style>
<div class="page-content-wrapper">
  <div class="container-fluid">
    <div class="col-md-11 mx-auto mb-5">
      <div class="mb-3 animated fadeInRight delay-2s">
        <h3 class="pb-2">Penggalangan Dana Sedang Berlangsung</h3>
        <p style="color:#141414;font-size:18px">Berikan Pendanaan Terbaikmu, dan Nikmati Imbal Hasil Terbaik.</p>
      </div>
      <div id="content-paging" class="row"></div>
       <div align="right" id="pagination_link"></div>
    </div>
  </div>
</div> <!-- Page content Wrapper -->


<script>
$(document).ready(function(){

 function load_data(page)
 {

   var titles = $("#title").val();
  $.ajax({
   url:"<?php echo base_url(); ?>user/master_proyek/paging/"+page,
   method:"POST",
   dataType:"json",
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


 $(document).on("click", "#filter", function(event){
  event.preventDefault();
  load_data(1);
 });

});
</script>
