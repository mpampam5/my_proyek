</div> <!-- content -->

<footer class="footer">
    © <?=date("Y")?> <i class="mdi mdi-heart text-danger"></i> <span class="logo-tilte" style="text-transform:uppercase"><?=strtoupper(config_system("title"))?>
</footer>

</div>
<!-- End Right content here -->

</div>
<!-- END wrapper -->


<div class="modal animated fadeInUp delay-30s" id="modalGue" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTitle"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="modalContent"></div>
    </div>
  </div>
</div>




<!-- App js -->
<script src="<?=base_url()?>_template/usrp/js/app.js"></script>
  <script src="<?=base_url()?>_template/backend/plugins/bootstrap-inputmask/jquery.mask.min.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){
  $("#modalGue").on("show.bs.modal", function () {
  $('body').css('overflow', 'hidden');
}).on("hide.bs.modal", function () {
  $('body').css('overflow', 'auto');
});
  $(".fancy").fancybox();
  $('.rupiah').mask('00.000.000.000', {reverse: true});
});

  $('#modalGue').on('hide.bs.modal', function () {
      setTimeout(function(){
          $('#modalTitle, #modalContent , #modalFooter').html('');
        }, 500);
     });


     $(document).on("click",".modal-reset",function(e){
       e.preventDefault();
       $('.modal-dialog').removeClass('modal-lg')
                         .removeClass('modal-md')
                         .addClass('modal-sm');
       $("#modalTitle").text($(this).attr('data-title'));
       $('#modalContent').load($(this).attr('href'));
       $("#modalGue").modal('show');
     });

</script>

</body>
</html>
