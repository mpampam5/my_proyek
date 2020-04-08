<!-- DataTables -->
<link href="<?=base_url()?>_template/backend/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<!-- Required datatable js -->
<script src="<?=base_url()?>_template/backend/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=base_url()?>_template/backend/plugins/datatables/dataTables.bootstrap4.min.js"></script>

<div class="wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 col-xl-12 mx-auto animated zoomIn delay-2s">

          <div class="card m-b-30">
            <div class="card-body">
              <div class="m-b-10 text-left m-l-15 m-r-15">
                <div class="row">
                  <div class="col-sm-3">
                    <a href="<?=site_url("backend/post/add")?>" class="btn btn-sm btn-success"><i class="fa fa-file"></i> Add</a>
                    <button type="button" id="reload"  name="button" class="btn btn-sm btn-warning"><i class="fa fa-refresh"></i> Reload</button>
                  </div>

                  <div class="col-sm-9">
                    <div class="row  float-right">
                      <div class="col-xs-5 mr-2">
                        <input type="text" class="form-control" autocomplete="off" placeholder="title" id="title">
                      </div>

                      <div class="col-xs-5 mr-2">
                        <input type="text" class="form-control" autocomplete="off" placeholder="kategori" id="kategori">
                      </div>

                      <div class="col-xs-2 mr-2">
                        <button class="btn btn-primary" id="btn-search" type="button"><i class="fa fa-search"></i></button>
                      </div>
                    </div>

                  </div>
                </div>


              </div>
              <!-- <h4 class="mt-0 header-title"><?=ucfirst($title)?></h4> -->
              <table class="table table-bordered" id="table" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                  <tr>
                    <th>Created</th>
                    <th>Title</th>
                    <th>Kategori</th>
                    <th>Action</th>
                  </tr>
                </thead>

              </table>

            </div>
          </div>
        </div>
      </div>

    </div>
</div>
