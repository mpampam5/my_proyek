<div class="page-content-wrapper">
  <div class="container-fluid">
    <div class="col-md-10 mx-auto mb-5">
      <div class="card">
        <div class="card-body">
          <div id="content-wizard"></div>
        </div>
      </div>
    </div>
  </div>
</div> <!-- Page content Wrapper -->



<script type="text/javascript">
  $(document).ready(function(){
    $("#content-wizard").load('<?=site_url("user/wizard/form_wizard/1")?>');
  })

</script>
