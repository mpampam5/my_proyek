<footer id="footer" class="mt-0">
    <div class="container">
        <div class="row py-5">
            <div class="col text-center">
                <ul class="footer-social-icons social-icons social-icons-clean social-icons-big social-icons-opacity-light social-icons-icon-light mt-1">
                    <li class="social-icons-facebook"><a href="http://www.facebook.com/" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                    <li class="social-icons-twitter"><a href="http://www.twitter.com/" target="_blank" title="Twitter"><i class="fab fa-twitter"></i></a></li>
                    <li class="social-icons-linkedin"><a href="http://www.linkedin.com/" target="_blank" title="Linkedin"><i class="fab fa-linkedin-in"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer-copyright footer-copyright-style-2">
        <div class="container py-2">
            <div class="row py-4">
                <div class="col-lg-8 text-center text-lg-left mb-2 mb-lg-0">
                    <p>
                        <span class="pr-0 pr-md-3 d-block d-md-inline-block"><i class="far fa-dot-circle text-color-primary top-1 p-relative"></i><span class="text-color-light opacity-7 pl-1">
                          <?=config_system("alamat")?>
                        </span></span>
                        <span class="pr-0 pr-md-3 d-block d-md-inline-block"><i class="fab fa-whatsapp text-color-primary top-1 p-relative"></i><a href="tel:<?=config_system("telepon")?>" class="text-color-light opacity-7 pl-1">
                                <?=config_system("telepon")?></a></span>
                        <span class="pr-0 pr-md-3 d-block d-md-inline-block"><i class="far fa-envelope text-color-primary top-1 p-relative"></i><a href="mailto:<?=config_system("email")?>" class="text-color-light opacity-7 pl-1"><?=config_system("email")?></a></span>
                    </p>
                </div>
                <div class="col-lg-4 d-flex align-items-center justify-content-center justify-content-lg-end mb-4 mb-lg-0 pt-4 pt-lg-0">
                    <p>© Copyright 2019. All Rights Reserved.</p>
                </div>
            </div>
        </div>
    </div>
</footer>
</div>

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

<!-- Vendor -->

<script src="<?= base_url() ?>_template/public/vendor/jquery.appear/jquery.appear.min.js"></script>
<script src="<?= base_url() ?>_template/public/vendor/jquery.easing/jquery.easing.min.js"></script>
<script src="<?= base_url() ?>_template/public/vendor/jquery.cookie/jquery.cookie.min.js"></script>
<!-- <script src="<?= base_url() ?>_template/public/vendor/popper/umd/popper.min.js"></script> -->
<script src="<?= base_url() ?>_template/public/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="<?= base_url() ?>_template/public/vendor/common/common.min.js"></script>

<!-- <script src="<?= base_url() ?>_template/public/vendor/jquery.validation/jquery.validate.min.js"></script> -->
<!-- <script src="<?= base_url() ?>_template/public/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script> -->
<!-- <script src="<?= base_url() ?>_template/public/vendor/jquery.gmap/jquery.gmap.min.js"></script> -->
<script src="<?= base_url() ?>_template/public/vendor/jquery.lazyload/jquery.lazyload.min.js"></script>
<!-- <script src="<?= base_url() ?>_template/public/vendor/isotope/jquery.isotope.min.js"></script> -->
<script src="<?= base_url() ?>_template/public/vendor/owl.carousel/owl.carousel.min.js"></script>
<script src="<?= base_url() ?>_template/public/vendor/magnific-popup/jquery.magnific-popup.min.js"></script>
<!-- <script src="<?= base_url() ?>_template/public/vendor/vide/jquery.vide.min.js"></script> -->
<!-- <script src="<?= base_url() ?>_template/public/vendor/vivus/vivus.min.js"></script> -->

<!-- Theme Base, Components and Settings -->
<script src="<?= base_url() ?>_template/public/js/theme.js"></script>

<!-- Current Page Vendor and Views -->
<script src="<?= base_url() ?>_template/public/vendor/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
<script src="<?= base_url() ?>_template/public/vendor/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>

<!-- Theme Custom -->
<script src="<?= base_url() ?>_template/public/js/custom.js"></script>

<!-- Theme Initialization Files -->
<script src="<?= base_url() ?>_template/public/js/theme.init.js"></script>

<!-- Google Analytics: Change UA-XXXXX-X to be your site's ID. Go to http://www.google.com/analytics/ for more information.
	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		ga('create', 'UA-12345678-1', 'auto');
		ga('send', 'pageview');
	</script>
	 -->

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
   </script>

</body>

</html>
