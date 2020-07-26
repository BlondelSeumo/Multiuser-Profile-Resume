<div class="content-wrapper">

  <!-- Main content -->
  <section class="content">


    <div class="box add_area" style="display: <?php if($page_title == "Edit"){echo "block";}else{echo "none";} ?>">
      <div class="box-header with-border">
        <?php if (isset($page_title) && $page_title == "Edit"): ?>
          <h3 class="box-title">Edit package</h3>
        <?php else: ?>
          <h3 class="box-title">Add New Package </h3>
        <?php endif; ?>

        <div class="box-tools pull-right">
          <?php if (isset($page_title) && $page_title == "Edit"): ?>
            <a href="<?php echo base_url('admin/package') ?>" class="pull-right btn btn-primary btn-sm"><i class="fa fa-angle-left"></i> Back</a>
          <?php else: ?>
            <a href="#" class="text-right btn btn-primary btn-sm cancel_btn"><i class="fa fa-list"></i> All Packages</a>
          <?php endif; ?>
        </div>
      </div>

      <div class="box-body">
        <form id="cat-form" method="post" enctype="multipart/form-data" class="validate-form" action="<?php echo base_url('admin/package/add')?>" role="form" novalidate>

          <div class="form-group">
            <label>Package Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control" required name="name" value="<?php echo html_escape($package[0]['name']); ?>" >
          </div>

          <div class="form-group">
            <label>Price <span class="text-danger">*</span></label>
            <input type="price" class="form-control" required name="price" value="<?php echo html_escape($package[0]['price']); ?>" >
          </div>


          <div class="form-group m-t-50 p-10">
            <input type="checkbox" name="is_special" value="1" id="md_checkbox_35" class="filled-in chk-col-orange" <?php if($package[0]['is_special'] == 1){echo "checked";}?> />
            <label for="md_checkbox_35">Is Special Package?</label>
          </div>


          <input type="hidden" name="id" value="<?php echo html_escape($package['0']['id']); ?>">
          <!-- csrf token -->
          <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

          <hr>

          <div class="row m-t-30">
            <div class="col-sm-12">
              <?php if (isset($page_title) && $page_title == "Edit"): ?>
                <button type="submit" class="btn btn-info pull-left">Save Changes</button>
              <?php else: ?>
                <button type="submit" class="btn btn-info pull-left"> Save</button>
              <?php endif; ?>
            </div>
          </div>

        </form>

      </div>

      <div class="box-footer">

      </div>
    </div>


    <?php if (isset($page_title) && $page_title != "Edit"): ?>

    <div class="box list_area">
      <div class="box-header with-border">
        <?php if (isset($page_title) && $page_title == "Edit"): ?>
          <h3 class="box-title">Edit package <a href="<?php echo base_url('admin/package') ?>" class="pull-right btn btn-primary btn-sm"><i class="fa fa-angle-left"></i> Back</a></h3>
        <?php else: ?>
          <h3 class="box-title">All packages </h3>
        <?php endif; ?>

        <div class="box-tools pull-right">
         <!-- <a href="#" class="pull-right btn btn-info btn-sm add_btn"><i class="fa fa-plus"></i> Add new package</a> -->
        </div>
      </div>

      
 
      <div class="col-md-12 col-sm-12 col-xs-12 scroll">
        <div class="box-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Billing Type</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                  <?php $i=1; foreach ($packages as $package): ?>
                    <tr id="row_<?php echo html_escape($package->id); ?>">
                        
                        <td><?php echo $i; ?></td>
                        <td><?php echo html_escape($package->name); ?></td>
                        <td><?php echo get_settings()->currency_symbol;?><?php echo round(html_escape($package->price)); ?></td>
                        <td><?php echo html_escape($package->bill_type); ?></td>
                        
                        <td class="actions" width="12%">
                          <a href="<?php echo base_url('admin/package/edit/'.html_escape($package->id));?>" class="on-default edit-row" data-placement="top" title="Edit"><i class="fa fa-pencil"></i></a>
                        </td>
                    </tr>
                    
                  <?php $i++; endforeach; ?>
                </tbody>
            </table>
        </div>

      </div>

      <div class="box-footer">

      </div>
    </div>
    <?php endif; ?>



  </section>
</div>
