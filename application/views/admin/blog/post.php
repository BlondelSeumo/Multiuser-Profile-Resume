<div class="content-wrapper">

  <!-- Main content -->
  <section class="content">


    <div class="box add_area" style="display: <?php if($page_title == "Edit"){echo "block";}else{echo "none";} ?>">
      <div class="box-header with-border">
        <?php if (isset($page_title) && $page_title == "Edit"): ?>
          <h3 class="box-title">Edit Blog Post</h3>
        <?php else: ?>
          <h3 class="box-title">Add New Blog Post </h3>
        <?php endif; ?>

        <div class="box-tools pull-right">
          <?php if (isset($page_title) && $page_title == "Edit"): ?>
            <a href="<?php echo base_url('admin/blog') ?>" class="pull-right btn btn-primary btn-sm"><i class="fa fa-angle-left"></i> Back</a>
          <?php else: ?>
            <a href="#" class="text-right btn btn-primary btn-sm cancel_btn"><i class="fa fa-list"></i> All Blog Posts</a>
          <?php endif; ?>
        </div>
      </div>

      <div class="box-body">
        <form id="cat-form" method="post" enctype="multipart/form-data" class="validate-form" action="<?php echo base_url('admin/blog/add')?>" role="form" novalidate>

          <div class="form-group">
              <label class="col-sm-2 control-label p-0" for="example-input-normal">Category <span class="text-danger">*</span></label>
              <select class="form-control" name="category" required>
                  <option value="">Select</option>
                  <?php foreach ($categories as $category): ?>
                      <option value="<?php echo html_escape($category->id); ?>" 
                        <?php echo ($blog[0]['category_id'] == $category->id) ? 'selected' : ''; ?>>
                        <?php echo html_escape($category->name); ?>
                      </option>
                  <?php endforeach ?>
              </select>
          </div>

          <div class="form-group">
            <label>Title <span class="text-danger">*</span></label>
            <input type="text" class="form-control" required name="title" value="<?php echo html_escape($blog[0]['title']); ?>" >
          </div>

          <?php if (isset($page_title) && $page_title != "Edit"): ?>
          <div class="form-group">
              <label>Slug</label>
              <input type="text" class="form-control" name="slug">
          </div>
          <?php endif; ?>

          <div class="form-group">
              <label>Tags</label>
              <?php if (isset($page_title) && $page_title == "Edit"): ?>
                <input type="text" data-role="tagsinput" name="tags[]" value="<?php echo html_escape($tags) ?>" />
              <?php else: ?>
                <input type="text" data-role="tagsinput" name="tags[]" placeholder="Enter your tags" />
              <?php endif ?>
          </div>

          <div class="form-group">
              <label>Post description</label>
              <textarea id="ckEditor" class="form-control" name="details"><?php echo html_escape($blog[0]['details']); ?></textarea>
          </div>
          
          <div class="form-group">
              <?php if (isset($page_title) && $page_title == "Edit"): ?>
                  <img src="<?php echo base_url($blog[0]['thumb']) ?>"> <br><br>
              <?php endif ?>
              <div class="input-group">
                  <span class="input-group-btn">
                      <span class="btn btn-info btn-file">
                        <i class="fa fa-upload"></i>Upload Image <input type="file" id="imgInp" name="photo">
                      </span>
                  </span>
              </div><br>
              <img width="200px" id='img-upload'/>
          </div>


          <div class="row m-t-30">
            <div class="col-sm-1 text-left">
              <div class="radio radio-info radio-inline">
                <input type="radio" id="inlineRadio1" value="1" name="status" <?php if($blog[0]['status'] == 1){echo "checked";}else{echo "";} ?>>
                <label for="inlineRadio1"> Active </label>
              </div>
            </div>
            <div class="col-sm-1 text-left">
              <div class="radio radio-info radio-inline">
                <input type="radio" id="inlineRadio2" value="2" name="status" <?php if($blog[0]['status'] == 2){echo "checked";}else{echo "";} ?>>
                <label for="inlineRadio2"> Inactive </label>
              </div>
            </div>
          </div>


          <input type="hidden" name="id" value="<?php echo html_escape($blog['0']['id']); ?>">
          <!-- csrf token -->
          <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

          <hr>

          <div class="row m-t-30">
            <div class="col-sm-12">
              <?php if (isset($page_title) && $page_title == "Edit"): ?>
                <button type="submit" class="btn btn-info pull-left">Save Changes</button>
              <?php else: ?>
                <button type="submit" class="btn btn-info pull-left"> Save Post</button>
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
          <h3 class="box-title">Edit Blog <a href="<?php echo base_url('admin/blog') ?>" class="pull-right btn btn-primary btn-sm"><i class="fa fa-angle-left"></i> Back</a></h3>
        <?php else: ?>
          <h3 class="box-title">All Blog posts </h3>
        <?php endif; ?>

        <div class="box-tools pull-right">
         <a href="#" class="pull-right btn btn-info btn-sm add_btn"><i class="fa fa-plus"></i> Add new blog</a>
        </div>
      </div>

      <div class="box-body">
        
        <div class="col-md-12 col-sm-12 col-xs-12 scroll table-responsive">
            <table class="table table-bordered datatable" id="dg_table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Thumb</th>
                        <th>Title</th>
                        <th>Details</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                  <?php $i=1; foreach ($posts as $post): ?>
                    <tr id="row_<?php echo html_escape($post->id); ?>">
                        
                        <td><?php echo $i; ?></td>
                        <td><img width="100px" src="<?php echo base_url($post->thumb) ?>"></td>
                        <td><?php echo html_escape($post->title); ?></td>
                        <td><?php echo character_limiter($post->details, 80); ?></td>
                        <td>
                          <?php if ($post->status == 1): ?>
                            <span class="label label-info">Active</span>
                          <?php else: ?>
                            <span class="label label-danger">Inactive</span>
                          <?php endif ?>
                        </td>



                        <td class="actions" width="12%">
                          <a href="<?php echo base_url('admin/blog/edit/'.html_escape($post->id));?>" class="on-default edit-row" data-placement="top" title="Edit"><i class="fa fa-pencil"></i></a> &nbsp; 

                          <a data-val="Category" data-id="<?php echo html_escape($post->id); ?>" href="<?php echo base_url('admin/blog/delete/'.html_escape($post->id));?>" class="on-default remove-row delete_item" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash-o"></i></a> &nbsp;

                          <?php if ($post->status == 1): ?>
                            <a href="<?php echo base_url('admin/blog/deactive/'.html_escape($post->id));?>" class="on-default deactive-row" data-toggle="tooltip" data-placement="top" title="Deactivate"><i class="fa fa-times"></i></a> &nbsp;
                          <?php else: ?>
                            <a href="<?php echo base_url('admin/blog/active/'.html_escape($post->id));?>" class="on-default active-row" data-toggle="tooltip" data-placement="top" title="Activate"><i class="fa fa-check-circle"></i></a>
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



  </section>
</div>
