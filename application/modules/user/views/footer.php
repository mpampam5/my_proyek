</div> <!-- content -->

<footer class="footer">
    © <?=date("Y")?>
</footer>

</div>
<!-- End Right content here -->

</div>
<!-- END wrapper -->

<div class="modal animated fadeInUp delay-30s" id="modalGue" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
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

<script type="text/javascript">
  $('#modalGue').on('hide.bs.modal', function () {
      setTimeout(function(){
          $('#modalTitle, #modalContent , #modalFooter').html('');
        }, 500);
     });


</script>

</body>
</html>
