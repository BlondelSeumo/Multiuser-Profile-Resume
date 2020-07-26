<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Dashboard
    </h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="breadcrumb-item active">Manage Ads / Banners</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="box add_area" style="display: <?php if($page_title == "Edit"){echo "block";}else{echo "none";} ?>">
      <div class="box-header with-border">
        <?php if (isset($page_title) && $page_title == "Edit"): ?>
          <h3 class="box-title">Edit Ads / Banners</h3>
        <?php else: ?>
          <h3 class="box-title">Add new Ads / Banners </h3>
        <?php endif; ?>

        <div class="box-tools pull-right">
          <?php if (isset($page_title) && $page_title == "Edit"): ?>
            <a href="<?php echo base_url('admin/ads') ?>" class="pull-right btn btn-primary btn-sm"><i class="fa fa-angle-left"></i> Back</a>
          <?php else: ?>
            <a href="#" class="text-right btn btn-primary btn-sm cancel_btn"><i class="fa fa-list"></i> All Ads / Banners</a>
          <?php endif; ?>
        </div>
      </div>

      <div class="box-body">
        
        <form method="post" enctype="multipart/form-data" action="<?php echo base_url('admin/ads/add')?>" role="form">
                    
            <div class="row header_area">

                <div class="col-sm-12">
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="example-input-normal">Banner Type</label>
                        <select class="form-control" name="ad_type">
                        <option>Select </option>
                        <option <?php echo ($ad[0]['ad_type'] == 1) ? 'selected' : ''; ?> value="1">Header </option>
                        <option <?php echo ($ad[0]['ad_type'] == 2) ? 'selected' : ''; ?> value="2">Footer </option>
                        <option <?php echo ($ad[0]['ad_type'] == 3) ? 'selected' : ''; ?> value="3">Index Middle </option>
                        <option <?php echo ($ad[0]['ad_type'] == 4) ? 'selected' : ''; ?> value="4">Right Banner 1 </option>
                        <option <?php echo ($ad[0]['ad_type'] == 5) ? 'selected' : ''; ?> value="5">Right Banner 2 </option>
                        <option <?php echo ($ad[0]['ad_type'] == 6) ? 'selected' : ''; ?> value="6">Right Banner 3 </option>
                        </select>
                    </div>
                

                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="example-input-normal">Use Banner For</label>
                        <select class="form-control" name="banner_categories">
                        <option value="0">All Categories </option>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?php echo $category->id; ?>" 
                                  <?php echo ($ad[0]['banner_categories'] == $category->id) ? 'selected' : ''; ?>>
                                  <?php echo $category->name; ?>
                                </option>
                            <?php endforeach ?>
                        </select>
                    </div>

                </div>

                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" name="title" value="<?php echo $ad[0]['title'] ?>">
                    </div>
                </div>
                
                <div class="col-sm-12 m-b-20">
                  <div class="form-group">
                      <label class="control-label m-r-10">Ad / Banner Type</label><br>

                      <input <?php if($ad[0]['type'] == 1){echo "checked";}else{echo "";} ?> name="type" value="1" type="radio" id="radio_1">
                      <label for="radio_1">Code</label> &emsp;

                      <input <?php if($ad[0]['type'] == 2){echo "checked";}else{echo "";} ?> name="type" value="2" type="radio" id="radio_2">
                      <label for="radio_2">Image</label> 
                  </div>
                </div>

                <div class="col-sm-12">

                    <div class="form-group">
                        <label>Banner code for (728 x 90)</label>
                        <textarea class="form-control" name="code" rows="8"><?php echo $ad[0]['code'] ?></textarea>
                    </div>


                    <div class="form-group">
                        <?php if (isset($page_title) && $page_title == "Edit"): ?>
                            <img width="100px" src="<?php echo base_url($ad[0]['thumb']) ?>">
                        <?php endif; ?>

                        <div class="input-group">
                            <span class="input-group-btn">
                                <span class="btn btn-default btn-file">
                                  <i class="fa fa-cloud-upload"></i>  Browse Image <input type="file" id="imgInp" name="photo">
                                </span>
                            </span>
                        </div>
                        <img width="150px" style="margin-top: 10px" id='img-upload'/>
                    </div>

                    <div class="form-group">
                        <label>Image url</label>
                        <input type="text" class="form-control" name="img_url" value="<?php echo $ad[0]['img_url']; ?>">
                    </div>

              
                    <div class="form-group">
                        <label class="control-label m-r-10">is open new window?</label><br>

                        <input <?php if($ad[0]['is_open_new_window'] == 1){echo "checked";}else{echo "";} ?> name="is_open_new_window" value="1" type="radio" id="radio_3">
                        <label for="radio_3">Yes</label> &emsp;

                        <input <?php if($ad[0]['is_open_new_window'] == 2){echo "checked";}else{echo "";} ?> name="is_open_new_window" value="2" type="radio" id="radio_4">
                        <label for="radio_4">No</label> 
                    </div>
                </div>

                <div class="col-sm-4">

                    <div class="form-group">
                        <label class="control-label m-r-10">Status</label><br>

                        <input <?php if($ad[0]['status'] == 1){echo "checked";}else{echo "";} ?> name="status" value="1" type="radio" id="radio_5">
                        <label for="radio_5">Active</label> &emsp;

                        <input <?php if($ad[0]['status'] == 2){echo "checked";}else{echo "";} ?> name="status" value="0" type="radio" id="radio_6">
                        <label for="radio_6">Inactive</label> 
                    </div>

                </div>

            </div>

            <input type="hidden" name="id" value="<?php echo $ad[0]['id']; ?>">
            <!-- csrf token -->
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
            <button type="submit" class="btn btn-info m-t-25">Save changes</button>

        </form>

      </div>

      <div class="box-footer">

      </div>
    </div>


    <?php if (isset($page_title) && $page_title != "Edit"): ?>

    <div class="box list_area">
      <div class="box-header with-border">
        <?php if (isset($page_title) && $page_title == "Edit"): ?>
          <h3 class="box-title">Edit Ad <a href="<?php echo base_url('admin/ads') ?>" class="pull-right btn btn-primary btn-sm"><i class="fa fa-angle-left"></i> Back</a></h3>
        <?php else: ?>
          <h3 class="box-title">All Ads/Banners </h3>
        <?php endif; ?>

        <div class="box-tools pull-right">
         <a href="#" class="pull-right btn btn-info btn-sm add_btn"><i class="fa fa-plus"></i> Add new Ads/Banners</a>
        </div>
      </div>

      <div class="box-body">
        
        <div class="col-md-12 col-sm-12 col-xs-12 scroll table-responsive">
            <table class="table table-bordered datatable" id="dg_table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Type</th>
                        <th>Banner</th>
                        <th>title</th>
                        <th>Ad Position</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                  <?php $i=1; foreach ($ads as $ad): ?>
                    <tr id="row_<?php echo $ad->id; ?>">
                        
                        <td><?php echo $i; ?></td>

                        <td>
                          <?php if ($ad->type == 1): ?>
                            <span class="label label-inverse">Code</span>
                          <?php else: ?>
                            <span class="label label-primary">Image</span>
                          <?php endif ?>
                        </td>

                        <td>
                          <?php if ($ad->type != 1): ?>
                            <img width="100px" class="image-thumbnail" src="<?php echo base_url($ad->thumb); ?>">
                          <?php endif ?>
                        </td>
                        <td><?php echo $ad->title; ?></td>
                        

                        <td>
                          <?php if ($ad->ad_type == 1): ?>
                            <span class="label label-primary">Header Ad</span>
                          <?php elseif ($ad->ad_type == 2): ?>
                            <span class="label label-primary">Footer Ad</span>
                          <?php elseif ($ad->ad_type == 3): ?>
                            <span class="label label-primary">Index Middle Ad</span>
                          <?php elseif ($ad->ad_type == 4): ?>
                            <span class="label label-primary">Right Ad 1</span>
                          <?php elseif ($ad->ad_type == 5): ?>
                            <span class="label label-primary">Right Ad 2</span>
                          <?php elseif ($ad->ad_type == 6): ?>
                            <span class="label label-primary">Right Ad 3</span>
                          <?php endif ?>
                        </td>
                        <td>
                          <?php if ($ad->status == 1): ?>
                            <span class="label label-info">Active</span>
                          <?php else: ?>
                            <span class="label label-danger">Inactive</span>
                          <?php endif ?>
                        </td>



                        <td class="actions" width="12%">
                          <a href="<?php echo base_url('admin/ads/edit/'.$ad->id);?>" class="on-default edit-row" data-placement="top" title="Edit"><i class="fa fa-pencil"></i></a> &nbsp; 

                          <a data-val="Category" data-id="<?php echo $ad->id; ?>" href="<?php echo base_url('admin/ads/delete/'.$ad->id);?>" class="on-default remove-row delete_item" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash-o"></i></a> &nbsp;

                          <?php if ($ad->status == 1): ?>
                            <a href="<?php echo base_url('admin/ads/deactive/'.$ad->id);?>" class="on-default deactive-row" data-toggle="tooltip" data-placement="top" title="Deactivate"><i class="fa fa-times"></i></a> &nbsp;
                          <?php else: ?>
                            <a href="<?php echo base_url('admin/ads/active/'.$ad->id);?>" class="on-default active-row" data-toggle="tooltip" data-placement="top" title="Activate"><i class="fa fa-check-circle"></i></a>
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
