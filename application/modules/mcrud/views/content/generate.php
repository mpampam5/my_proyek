<div class="alert alert-danger">
  <b>Peringatan!</b> Perhatikan pemberian nama CONTROLLER** & MODEL**. Jika nama CONTROLLER** & MODEL** sama dengan nama file yang terdapat pada diretory CONTROLLER & MODEL, file akan otomatis di replace dengan yang baru.
</div>

<form class="" action="index.html" method="post" autocomplete="off">
  <div class="row">
      <div class="form-group col-md-6">
        <label for="">Table Name</label>
        <input type="text" class="form-control" id="" name="table" value="<?=$table?>" readonly>
      </div>

    <div class="form-group col-md-6">
      <label for="">Title **</label>
      <input type="text" class="form-control" id="title" name="title" placeholder="Title" value="<?=ucfirst($table)?>">
    </div>

    <div class="form-group col-md-6">
      <label for="">Controller **</label>
      <input type="text" class="form-control" id="controller" name="controller" placeholder="Controller" value="<?=ucfirst($table)?>">
    </div>

    <div class="form-group col-md-6">
      <label for="">Model **</label>
      <input type="text" class="form-control" id="model" name="model" placeholder="Model" value="<?=ucfirst($table)?>_model">
    </div>
  </div>


  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th width="200">Field</th>
        <th>Rules</th>
      </tr>
    </thead>

    <tbody>
      <?php foreach ($fields as $field): ?>
        <tr>
          <td><span class="text-primary" style="font-weight:bold"><?=$field->name?></span> <?=$field->type?>  <?=$field->max_length==null ? "":"($field->max_length)"?> <?=$field->primary_key == 1 ? '<i class="fa fa-key text-warning"></i>':''?></td>
          <?php if ($field->primary_key == 1): ?>
            <td>No Rules</td>
            <?php else: ?>
          <td>
            <div class="row">
              <div class="form-group col-sm-6">
                <label for="">Type</label>
                <select class="form-control form-control-sm" name="type" id="type">
                  <option value="0">Text</option>
                  <option value="1">Text area</option>
                  <option value="1">Text editor</option>
                  <option value="">File Manager</option>
                </select>
              </div>

              <div class="form-group col-sm-6">
                <label for="">Required</label>
                <select class="form-control form-control-sm" name="required" id="required">
                  <option value="0">No</option>
                  <option value="1">Yes</option>
                </select>
              </div>

              <div class="form-group col-sm-6">
                <label for="">Min length</label>
                <input type="text" class="form-control form-control-sm" id="" placeholder="Null">
              </div>

              <div class="form-group col-sm-6">
                <label for="">Max length</label>
                <input type="text" class="form-control form-control-sm" id="" value="<?=$field->max_length==null ? '':$field->max_length?>" placeholder="255">
              </div>

            </div>
          </td>
          <?php endif; ?>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <div class="float-right">
    <button type="submit" id="submit" name="submit" class="btn btn-md btn-primary"><i class="ion-wand"></i> Build</button>
  </div>
</form>
