<div class="content-wrapper">
  <!-- Main content -->
  <div class="col-md-6">
    <section class="content">
      <div class="box add_area">
        <div class="box-header with-border">
          <h3 class="box-title">Upload file </h3>
        </div>

        <div class="box-body">
          <form method="post" class="validate-form" action="<?php echo base_url('upload-file')?>" role="form" enctype="multipart/form-data">
              <?php if (!empty($user->cv)): ?> 
                  <?php preg_match("/[^\/]+$/", $user->cv, $matches);
                  $last_word = $matches[0]; ?>
                  <h3>Current cv - <span class="label label-default"><?php echo $last_word; ?></span></h3>
                  <h5>For sharing your cv copy this link:  
                    <div class="label label-info" role="alert">
                      <?php echo base_url($user->cv) ?>
                    </div>
                  </h5><br>
              <?php endif ?>          
              <div class="form-group">
                  <label>Upload file (Pdf file)</label><br>
                  <input type="file" name="file" required>
              </div>

              <!-- csrf token -->
              <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
              <?php if (!empty($user->cv)): ?>
                <button type="submit" class="btn btn-info">Update file</button>   
              <?php else: ?>
                <button type="submit" class="btn btn-info">Upload</button>
              <?php endif ?>
          </form>

        </div>

        <div class="box-footer">

        </div>
      </div>
    </section>
  </div>
</div>
