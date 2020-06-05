

        <!-- Footer -->
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        © <?=date("Y")?> <i class="mdi mdi-heart text-danger"></i> <span class="logo-tilte" style="text-transform:uppercase"><?=strtoupper(config_system("title"))?></span>
                    </div>
                </div>
            </div>
        </footer>
        <!-- End Footer -->
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

        <!-- <script src="<?=base_url()?>_template/backend/pages/dashboard.js"></script> -->
        <!-- Bootstrap inputmask js -->
        <script src="<?=base_url()?>_template/backend/plugins/bootstrap-inputmask/jquery.mask.min.js" type="text/javascript"></script>
        <!-- App js -->
        <script src="<?=base_url()?>_template/backend/js/app.js"></script>
        <script type="text/javascript">
        $(document).ready(function(){
          $(".fancy").fancybox();
          $('.rupiah').mask('00.000.000.000', {reverse: true});
        });


          $('#modalGue').on('hide.bs.modal', function () {
              setTimeout(function(){
                  $('#modalTitle, #modalContent , #modalFooter').html('');
                }, 500);
             });
        </script>


    </body>
</html>
