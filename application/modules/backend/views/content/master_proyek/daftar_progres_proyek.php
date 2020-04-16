<div class="wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 col-xl-10 mx-auto animated zoomIn delay-3s">
          <div class="card m-b-10">
            <div class="mb-2 card-body text-muted">
              <h4 class="header-title">Pendanaan <b class="text-info"> <?=$dt->kode?></b>. <?=$dt->title?></h4>

              <?php if ($result->num_rows() > 0): ?>
                <ol class="activity-feed mb-0">
                  <?php foreach ($result->result() as $row): ?>
                    <li class="feed-item">
                        <span class="date"><i class="fa fa-calendar"></i> <?=date("d/m/Y",strtotime($row->created_at))?></span>
                        <span class="activity-text">
                          <b class="text-success">Progres pengerjaan <?=$row->persentase?>%</b> -
                          <?=$row->deskripsi?>
                        </span>
                    </li>
                  <?php endforeach; ?>
                </ol>

                <?php else: ?>
                  <i>Belum ada progres</i>
              <?php endif; ?>



            </div>
          </div>
        </div>
      </div>
    </div>
</div>
