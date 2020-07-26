<div class="content-wrapper">
  <!-- Main content -->
  <section class="content">

  <div class="col-md-8">

    <div class="box add_area" style="display: <?php if($page_title == "Edit"){echo "block";}else{echo "none";} ?>">
      <div class="box-header with-border">
        <?php if (isset($page_title) && $page_title == "Edit"): ?>
          <h3 class="box-title">Edit Category</h3>
        <?php else: ?>
          <h3 class="box-title">Add new category </h3>
        <?php endif; ?>

        <div class="box-tools pull-right">
          <?php if (isset($page_title) && $page_title == "Edit"): ?>
            <a href="<?php echo base_url('admin/blog_category') ?>" class="pull-right btn btn-primary btn-sm"><i class="fa fa-angle-left"></i> Back</a>
          <?php else: ?>
            <a href="#" class="text-right btn btn-primary btn-sm cancel_btn"><i class="fa fa-list"></i> All Categories</a>
          <?php endif; ?>
        </div>
      </div>

      <div class="box-body">
        <form id="cat-form" method="post" enctype="multipart/form-data" class="validate-form" action="<?php echo base_url('admin/blog_category/add')?>" role="form" novalidate>

          <div class="form-group">
            <label>Category Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control" required name="name" value="<?php echo html_escape($category[0]['name']); ?>" >
          </div>

          <input type="hidden" name="id" value="<?php echo html_escape($category['0']['id']); ?>">
          <!-- csrf token -->
          <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

          <hr>

          <div class="row m-t-30">
            <div class="col-sm-12">
              <?php if (isset($page_title) && $page_title == "Edit"): ?>
                <button type="submit" class="btn btn-info pull-left">Save Changes</button>
              <?php else: ?>
                <button type="submit" class="btn btn-info pull-left"> Save Category</button>
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
          <h3 class="box-title">Edit Category <a href="<?php echo base_url('admin/blog_category') ?>" class="pull-right btn btn-primary btn-sm"><i class="fa fa-angle-left"></i> Back</a></h3>
        <?php else: ?>
          <h3 class="box-title">All category </h3>
        <?php endif; ?>

        <div class="box-tools pull-right">
         <a href="#" class="pull-right btn btn-info btn-sm add_btn"><i class="fa fa-plus"></i> Add new Category</a>
        </div>
      </div>

      <div class="box-body">
        
        <div class="col-md-12 col-sm-12 col-xs-12 scroll table-responsive">
            <table class="table table-bordered datatable" id="dg_table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                  <?php $i=1; foreach ($categories as $cat): ?>
                    <tr id="row_<?php echo html_escape($cat->id); ?>">
                        
                        <td><?php echo $i; ?></td>
                        <td><?php echo html_escape($cat->name); ?></td>
                        <td>
                          <?php if ($cat->status == 1): ?>
                            <span class="label label-info">Active</span>
                          <?php else: ?>
                            <span class="label label-danger">Inactive</span>
                          <?php endif ?>
                        </td>



                        <td class="actions" width="18%">
                          <a href="<?php echo base_url('admin/blog_category/edit/'.html_escape($cat->id));?>" class="on-default edit-row" data-placement="top" title="Edit"><i class="fa fa-pencil"></i></a> &nbsp; 

                          <a data-val="Category" data-id="<?php echo html_escape($cat->id); ?>" href="<?php echo base_url('admin/blog_category/delete/'.html_escape($cat->id));?>" class="on-default remove-row delete_item" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash-o"></i></a> &nbsp;

                          <?php if ($cat->status == 1): ?>
                            <a href="<?php echo base_url('admin/blog_category/deactive/'.html_escape($cat->id));?>" class="on-default deactive-row" data-toggle="tooltip" data-placement="top" title="Deactivate"><i class="fa fa-times"></i></a> &nbsp;
                          <?php else: ?>
                            <a href="<?php echo base_url('admin/blog_category/active/'.html_escape($cat->id));?>" class="on-default active-row" data-toggle="tooltip" data-placement="top" title="Activate"><i class="fa fa-check-circle"></i></a>
                          <?php endif ?>
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

  </div>

  </section>
</div>
