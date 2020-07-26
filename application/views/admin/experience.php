<div class="content-wrapper">
  <!-- Main content -->
  <section class="content">

  <div class="row">
    <!-- experience area -->
    <div class="col-md-5">
      <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Add Experience </h3>
        </div>

        <div class="box-body">
          <form id="cat-form" method="post" enctype="multipart/form-data" class="validate-form" action="<?php echo base_url('admin/experience/add')?>" role="form" novalidate>

            <div class="form-group">
              <label>Experience Name <span class="text-danger">*</span></label>
              <input type="text" class="form-control" required name="name">
            </div>

            <div class="form-group">
              <label>Order</label>
              <input type="number" class="form-control" name="orders">
            </div>
      
            <input type="hidden" name="id" value="0">
            <!-- csrf token -->
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

            <div class="row m-t-10">
              <div class="col-sm-12">
                  <button type="submit" class="btn btn-info pull-left"> Save</button>
              </div>
            </div>
          </form>


          <hr>

          <div class="table-responsive">
            <table class="table table-bordered datatable" id="dg_table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Order</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                  <?php $i=1; foreach ($experiences as $experience): ?>
                    <tr id="row_<?php echo html_escape($experience->id); ?>">
                        
                        <td><?php echo $i; ?></td>
                        <td><?php echo html_escape($experience->name); ?></td>
                        
                        <td>
                          <?php if ($experience->status == 1): ?>
                            <span class="label label-info">Active</span>
                          <?php else: ?>
                            <span class="label label-danger">Inactive</span>
                          <?php endif ?>
                        </td>

                        <td><?php echo html_escape($experience->orders); ?></td>

                        <td class="actions" width="25%">
                          <a href="#experienceModal_<?php echo html_escape($experience->id) ?>" data-toggle="modal" class="on-default edit-row" data-placement="top" title="Edit"><i class="fa fa-pencil"></i></a> &nbsp; 

                          <a data-val="experience" data-id="<?php echo html_escape($experience->id); ?>" href="<?php echo base_url('admin/experience/delete/'.html_escape($experience->id));?>" class="on-default remove-row delete_item" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash-o"></i></a> &nbsp;

                          <?php if ($experience->status == 1): ?>
                            <a href="<?php echo base_url('admin/experience/deactive/'.html_escape($experience->id));?>" class="on-default deactive-row" data-toggle="tooltip" data-placement="top" title="Deactivate"><i class="fa fa-times"></i></a> &nbsp;
                          <?php else: ?>
                            <a href="<?php echo base_url('admin/experience/active/'.html_escape($experience->id));?>" class="on-default active-row" data-toggle="tooltip" data-placement="top" title="Activate"><i class="fa fa-check-circle"></i></a>
                          <?php endif ?>
                        </td>
                    </tr>
                    
                  <?php $i++; endforeach; ?>
                </tbody>
            </table>
          </div>

        </div>

      </div>
    </div>

    <!-- experience area -->
    <div class="col-md-7">
      <div class="box add_area">
        <div class="box-header with-border">
            <h3 class="box-title">Add Sub Experience </h3>
        </div>

        <div class="box-body">
          <form id="cat-form" method="post" enctype="multipart/form-data" class="validate-form" action="<?php echo base_url('admin/experience/add_subexperience')?>" role="form" novalidate>

            <div class="form-group">
                <label class="col-sm-2 control-label p-0" for="example-input-normal">Experience <span class="text-danger">*</span></label>
                <select class="form-control" name="experience" required>
                    <option value="">Select experience</option>
                    <?php foreach ($experiences as $experience): ?>
                        <option value="<?php echo html_escape($experience->id); ?>">
                          <?php echo html_escape($experience->name); ?>
                        </option>
                    <?php endforeach ?>
                </select>
            </div>

            <div class="form-group">
              <label>Sub Experience Name <span class="text-danger">*</span></label>
              <input type="text" class="form-control" required name="name">
            </div>

            <div class="form-group">
              <label>Company/Institute Name <span class="text-danger">*</span></label>
              <input type="text" class="form-control" required name="company">
            </div>

            <div class="form-group">
              <label>Enter date <span class="text-danger">*</span></label>
              <input type="text" class="form-control" placeholder="2016-2018" name="date">
            </div>

            <div class="form-group">
              <label>Details <span class="text-danger">*</span></label>
              <textarea class="form-control" name="details" rows="6"></textarea>
            </div>

            <div class="form-group">
              <label>Order</label>
              <input type="number" class="form-control" name="orders">
            </div>
      
            <input type="hidden" name="id" value="0">
            <!-- csrf token -->
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

            <div class="row m-t-10">
              <div class="col-sm-12">
                  <button type="submit" class="btn btn-info pull-left"> Save</button>
              </div>
            </div>
          </form>


          <hr>

          <table class="table table-bordered datatable" id="dg_table">
              <thead>
                  <tr>
                      <th>#</th>
                      <th>Name</th>
                      <th>Experience</th>
                      <th>Date</th>
                      <th>Status</th>
                      <th>Order</th>
                      <th>Action</th>
                  </tr>
              </thead>
              <tbody>
                <?php $i=1; foreach ($sub_experience as $sub_exp): ?>
                  <tr id="row_<?php echo html_escape($sub_exp->id); ?>">
                      
                      <td><?php echo $i; ?></td>
                      <td><?php echo html_escape($sub_exp->name); ?></td>
                      <td>
                        <?php
                          if (!empty(helper_get_category_option($sub_exp->parent_id, 'experience'))) {
                              echo html_escape(helper_get_category_option($sub_exp->parent_id, 'experience')->name);
                        } ?>
                      </td>
                      <td><?php echo html_escape($sub_exp->date); ?></td>
                      
                      <td>
                        <?php if ($sub_exp->status == 1): ?>
                          <span class="label label-info">Active</span>
                        <?php else: ?>
                          <span class="label label-danger">Inactive</span>
                        <?php endif ?>
                      </td>

                      <td><?php echo html_escape($sub_exp->orders); ?></td>

                      <td class="actions" width="15%">
                        <a href="#sub_experienceModal_<?php echo html_escape($sub_exp->id) ?>" data-toggle="modal" class="on-default edit-row" data-placement="top" title="Edit"><i class="fa fa-pencil"></i></a> &nbsp; 

                        <a data-val="experience" data-id="<?php echo html_escape($sub_exp->id); ?>" href="<?php echo base_url('admin/experience/delete/'.html_escape($sub_exp->id));?>" class="on-default remove-row delete_item" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash-o"></i></a> &nbsp;

                        <?php if ($sub_exp->status == 1): ?>
                          <a href="<?php echo base_url('admin/experience/deactive/'.html_escape($sub_exp->id));?>" class="on-default deactive-row" data-toggle="tooltip" data-placement="top" title="Deactivate"><i class="fa fa-times"></i></a> &nbsp;
                        <?php else: ?>
                          <a href="<?php echo base_url('admin/experience/active/'.html_escape($sub_exp->id));?>" class="on-default active-row" data-toggle="tooltip" data-placement="top" title="Activate"><i class="fa fa-check-circle"></i></a>
                        <?php endif ?>
                      </td>
                  </tr>
                  
                <?php $i++; endforeach; ?>
              </tbody>
          </table>

        </div>

      </div>
    </div>

  </div>

  </section>
</div>



<?php foreach ($experiences as $experience): ?>
    <div id="experienceModal_<?php echo html_escape($experience->id) ?>" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Edit Experience</h4>
          </div>
          <div class="modal-body">
                
            <form method="post" class="form-horizontal" action="<?php echo base_url('admin/experience/add')?>" enctype="multipart/form-data">
                <div class="col-md-12">
                    <div class="add_info_content" style="padding: 10px 20px;">
                        <div class="row">
                            
                            <div class="col-md-12">
                              <div class="form-group">
                                  <label for="">Experience Name</label>
                                  <input type="text" name="name" class="form-control" value="<?php echo html_escape($experience->name) ?>">
                              </div>

                              <div class="form-group">
                                <label>Order</label>
                                <input type="number" class="form-control" value="<?php echo html_escape($experience->orders) ?>" name="orders">
                              </div>

                            </div>
                            
                            <input type="hidden" name="id" value="<?php echo html_escape($experience->id) ?>">
                            <!-- csrf token -->
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                            <div class="col-md-12">
                              <div class="form-group text-left">
                                  <button class="btn btn-primary" type="submit">Save</button>
                              </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </form>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>

      </div>
    </div>
<?php endforeach ?>


<?php foreach ($sub_experience as $subexperience): ?>
    <div id="sub_experienceModal_<?php echo html_escape($subexperience->id) ?>" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Edit Sub experience</h4>
          </div>
          <div class="modal-body">
                
            <form method="post" class="form-horizontal" action="<?php echo base_url('admin/experience/add_subexperience')?>" enctype="multipart/form-data">
                <div class="col-md-12">
                    <div class="add_info_content" style="padding: 10px 20px;">
                        <div class="row">

                          <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-sm-2 control-label p-0" for="example-input-normal">Experience <span class="text-danger">*</span></label>
                                <select class="form-control" name="experience">
                                    <option value="">Select experience</option>
                                    <?php foreach ($experiences as $experience): ?>
                                        <option value="<?php echo html_escape($experience->id); ?>" 
                                          <?php echo ($subexperience->parent_id == $experience->id) ? 'selected' : ''; ?>>
                                          <?php echo html_escape($experience->name); ?>
                                        </option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                          </div>
                          
                          <div class="col-md-12">
                              <div class="form-group">
                                  <label for="">experience Name</label>
                                  <input type="text" name="name" class="form-control" value="<?php echo html_escape($subexperience->name) ?>">
                              </div>
                          </div>

                          <div class="col-md-12">
                            <div class="form-group">
                              <label>Company/Institute Name <span class="text-danger">*</span></label>
                              <input type="text" class="form-control" value="<?php echo html_escape($subexperience->company) ?>" name="company">
                            </div>
                          </div>

                          <div class="col-md-12">
                            <div class="form-group">
                              <label>Enter date <span class="text-danger">*</span></label>
                              <input type="text" class="form-control" name="date" value="<?php echo html_escape($subexperience->date) ?>">
                            </div>
                          </div>

                          <div class="col-md-12">
                            <div class="form-group">
                              <label>Details <span class="text-danger">*</span></label>
                              <textarea class="form-control" name="details" rows="6"><?php echo html_escape($subexperience->details) ?></textarea>
                            </div>
                          </div>
                        
                          <div class="form-group">
                            <label>Order</label>
                            <input type="number" class="form-control" value="<?php echo html_escape($subexperience->orders) ?>" name="orders">
                          </div>
                            
                          <input type="hidden" name="id" value="<?php echo html_escape($subexperience->id) ?>">

                          <!-- csrf token -->
                          <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                          <div class="col-md-12">
                            <div class="form-group text-left">
                                <button class="btn btn-primary" type="submit">Save</button>
                            </div>
                          </div>
                            
                        </div>
                    </div>
                </div>
            </form>

          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
          
        </div>

      </div>
    </div>
<?php endforeach ?>