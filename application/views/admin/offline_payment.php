<div class="content-wrapper">

  <!-- Main content -->
  <section class="content">

    <div class="col-md-6 box add_area">
      
      <div class="box-header with-border">
        <h3 class="box-title">Add Offline Payment</h3>
      </div>

      <div class="box-body">
        <form id="cat-form" method="post" enctype="multipart/form-data" class="validate-form" action="<?php echo base_url('admin/payment/offline')?>" role="form" novalidate>

          <div class="form-group mt-10">
              <select class="form-control single_select" name="user" required>
                  <option value="">Select User</option>
                  <?php foreach ($users as $user): ?>
                    <option value="<?php echo html_escape($user->id) ?>"><?php echo html_escape($user->name.' - '.$user->email) ?> 
                      <span class="c-b"><?php if(!empty($user->payment_status)){echo '('.$user->payment_status.')';} ?></span>
                    </option>
                  <?php endforeach ?>
              </select>
          </div>

          <div class="form-group">
              <select class="form-control single_select" name="package" required>
                  <option value="">Select package</option>
                  <?php foreach ($packages as $package): ?>
                    <option value="<?php echo html_escape($package->id) ?>"><?php echo html_escape($package->name) ?> </option>
                  <?php endforeach ?>
              </select>
          </div>


          <div class="form-group mt-10">
            <label>Payment Status</label>
            <div class="radio radio-info radio-inline mt-10">
              <input type="radio" id="inlineRadio3" value="verified" name="status" required>
              <label for="inlineRadio3"> Verified </label>
              &emsp;&emsp;
              <input type="radio" id="inlineRadio4" value="pending" name="status" required>
              <label for="inlineRadio4"> Pending </label>
            </div>
          </div>
         
          <!-- csrf token -->
          <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

          <div class="row mb-20">
            <div class="col-sm-12">
                <button type="submit" class="btn btn-info pull-left"><i class="fa fa-check"></i> Add Payment</button>
            </div>
          </div>

        </form>

      </div>
    </div>

  </section>
</div>
