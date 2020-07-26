<div class="content-wrapper">

  <!-- Main content -->
  <section class="content">

    <div class="row">

      <div class="col-md-6">
        <div class="box">

          <div class="box-header with-border">
            <h3 class="box-title">Change Password</h3>
          </div>

          <form method="post" id="cahage_pass_form" action="<?php echo base_url('admin/profile/change') ?>">

            <div class="col-md-12 mt-20">
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label>Old Password</label>
                    <input type="password" class="form-control" name="old_pass" />
                  </div>
                </div>

                <div class="col-sm-12">
                  <div class="form-group">
                    <label>New Password</label>
                    <input type="password" class="form-control" name="new_pass" />
                  </div>
                </div>

                <div class="col-sm-12">
                  <div class="form-group">
                    <label>Confirm New Password</label>
                    <input type="password" class="form-control" name="confirm_pass" />
                  </div>
                </div>

                <!-- csrf token -->
                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

                <div class="col-sm-12">
                  <div class="form-group">
                    <button type="submit" class="btn btn-info">Change</button>
                  </div>
                </div>

              </div>
            </div>

          </form>
        </div>
      </div>

    </div>

    
  </section>

</div>