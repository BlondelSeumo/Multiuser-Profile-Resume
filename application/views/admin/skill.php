<div class="content-wrapper">

  <!-- Main content -->
  <section class="content">

  <div class="row">
    <!-- Skill area -->
    <div class="col-md-5">
      <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Add Skills </h3>
        </div>

        <div class="box-body">
          <form id="cat-form" method="post" enctype="multipart/form-data" class="validate-form" action="<?php echo base_url('admin/skill/add')?>" role="form" novalidate>

            <div class="form-group">
              <label>Skill Name <span class="text-danger">*</span></label>
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
                  <button type="submit" class="btn btn-info pull-left"> Save Skill</button>
              </div>
            </div>
          </form>


          <hr>

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
                <?php $i=1; foreach ($skills as $skill): ?>
                  <tr id="row_<?php echo html_escape($skill->id); ?>">
                      
                      <td><?php echo $i; ?></td>
                      <td><?php echo html_escape($skill->name); ?></td>
                      
                      <td>
                        <?php if ($skill->status == 1): ?>
                          <span class="label label-info">Active</span>
                        <?php else: ?>
                          <span class="label label-danger">Inactive</span>
                        <?php endif ?>
                      </td>

                      <td><?php echo html_escape($skill->orders); ?></td>

                      <td class="actions" width="20%">
                        <a href="#skillModal_<?php echo html_escape($skill->id) ?>" data-toggle="modal" class="on-default edit-row" data-placement="top" title="Edit"><i class="fa fa-pencil"></i></a> &nbsp; 

                        <a data-val="Skill" data-id="<?php echo html_escape($skill->id); ?>" href="<?php echo base_url('admin/Skill/delete/'.html_escape($skill->id));?>" class="on-default remove-row delete_item" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash-o"></i></a> &nbsp;

                        <?php if ($skill->status == 1): ?>
                          <a href="<?php echo base_url('admin/Skill/deactive/'.html_escape($skill->id));?>" class="on-default deactive-row" data-toggle="tooltip" data-placement="top" title="Deactivate"><i class="fa fa-times"></i></a> &nbsp;
                        <?php else: ?>
                          <a href="<?php echo base_url('admin/Skill/active/'.html_escape($skill->id));?>" class="on-default active-row" data-toggle="tooltip" data-placement="top" title="Activate"><i class="fa fa-check-circle"></i></a>
                        <?php endif ?>
                      </td>
                  </tr>
                  
                <?php $i++; endforeach; ?>
              </tbody>
          </table>

        </div>

      </div>
    </div>





    <!-- Skill area -->
    <div class="col-md-7">
      <div class="box add_area">
        <div class="box-header with-border">
            <h3 class="box-title">Add Sub Skills </h3>
        </div>

        <div class="box-body">
          <form id="cat-form" method="post" enctype="multipart/form-data" class="validate-form" action="<?php echo base_url('admin/skill/add_subskill')?>" role="form" novalidate>

            <div class="form-group">
                <label class="col-sm-2 control-label p-0" for="example-input-normal">Skills <span class="text-danger">*</span></label>
                <select class="form-control" name="skill" required>
                    <option value="">Select Skill</option>
                    <?php foreach ($skills as $skill): ?>
                        <option value="<?php echo html_escape($skill->id); ?>" 
                          <?php //echo ($sub_skill->parent_id == $skill->id) ? 'selected' : ''; ?>>
                          <?php if (isset($sub_skill[0]->parent_id) && $sub_skill[0]->parent_id == $skill->id){echo "selected";}else{echo"";} ?>
                          <?php echo html_escape($skill->name); ?>
                        </option>
                    <?php endforeach ?>
                </select>
            </div>

            <div class="form-group">
              <label>Sub Skill Name <span class="text-danger">*</span></label>
              <input type="text" class="form-control" required name="name">
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label p-0" for="example-input-normal">Sub Skill level <span class="text-danger">*</span></label>
                <select class="form-control" name="skill_level" required>
                    <option value="">Select Sub skill level</option>
                    <?php for ($i=1; $i < 11; $i++) { ?>
                      <option value="<?php echo $i * 10; ?>"><?php echo $i * 10; ?> %</option>
                    <?php } ?>
                </select>
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
                      <th>Sub Skill</th>
                      <th>Skill</th>
                      <th>Sub Skill Level</th>
                      <th>Status</th>
                      <th>Order</th>
                      <th>Action</th>
                  </tr>
              </thead>
              <tbody>
                <?php $i=1; foreach ($sub_skills as $sub_skill): ?>
                  <tr id="row_<?php echo html_escape($sub_skill->id); ?>">
                      
                      <td><?php echo $i; ?></td>
                      <td><?php echo html_escape($sub_skill->name); ?></td>
                      <td>
                        <?php
                          if (!empty(helper_get_category_option($sub_skill->parent_id, 'skills'))) {
                              echo html_escape(helper_get_category_option($sub_skill->parent_id, 'skills')->name);
                        } ?>
                      </td>
                      <td>
                        <span class="label label-inverse"><?php echo html_escape($sub_skill->skill_level); ?> %</span>
                      </td>
                      
                      <td>
                        <?php if ($sub_skill->status == 1): ?>
                          <span class="label label-info">Active</span>
                        <?php else: ?>
                          <span class="label label-danger">Inactive</span>
                        <?php endif ?>
                      </td>

                      <td><?php echo html_escape($sub_skill->orders); ?></td>

                      <td class="actions" width="15%">
                        <a href="#sub_skillModal_<?php echo html_escape($sub_skill->id) ?>" data-toggle="modal" class="on-default edit-row" data-placement="top" title="Edit"><i class="fa fa-pencil"></i></a> &nbsp; 

                        <a data-val="Skill" data-id="<?php echo html_escape($sub_skill->id); ?>" href="<?php echo base_url('admin/Skill/delete/'.html_escape($sub_skill->id));?>" class="on-default remove-row delete_item" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash-o"></i></a> &nbsp;

                        <?php if ($sub_skill->status == 1): ?>
                          <a href="<?php echo base_url('admin/Skill/deactive/'.html_escape($sub_skill->id));?>" class="on-default deactive-row" data-toggle="tooltip" data-placement="top" title="Deactivate"><i class="fa fa-times"></i></a> &nbsp;
                        <?php else: ?>
                          <a href="<?php echo base_url('admin/Skill/active/'.html_escape($sub_skill->id));?>" class="on-default active-row" data-toggle="tooltip" data-placement="top" title="Activate"><i class="fa fa-check-circle"></i></a>
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



<?php foreach ($skills as $skill): ?>
    <div id="skillModal_<?php echo html_escape($skill->id) ?>" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Edit skill</h4>
          </div>
          <div class="modal-body">
                
            <form method="post" class="form-horizontal" action="<?php echo base_url('admin/skill/add')?>" enctype="multipart/form-data">
                <div class="col-md-12">
                    <div class="add_info_content" style="padding:0px 0px;">
                        <div class="row">
                            
                            <div class="col-md-12">
                              <div class="form-group">
                                  <label for="">Skill Name</label>
                                  <input type="text" name="name" class="form-control" value="<?php echo html_escape($skill->name) ?>">
                              </div>

                              <div class="form-group">
                                <label>Order</label>
                                <input type="number" class="form-control" value="<?php echo html_escape($skill->orders) ?>" name="orders">
                              </div>

                            </div>
                            
                            <input type="hidden" name="id" value="<?php echo html_escape($skill->id) ?>">
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


<?php foreach ($sub_skills as $subskill): ?>
    <div id="sub_skillModal_<?php echo html_escape($subskill->id) ?>" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Edit Sub skill</h4>
          </div>
          <div class="modal-body">
                
            <form method="post" class="form-horizontal" action="<?php echo base_url('admin/skill/add_subskill')?>" enctype="multipart/form-data">
                <div class="col-md-12">
                    <div class="add_info_content" style="padding: 10px 20px;">
                        <div class="row">

                          <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-sm-2 control-label p-0" for="example-input-normal">Skills <span class="text-danger">*</span></label>
                                <select class="form-control" name="skill" required>
                                    <option value="">Select Skill</option>
                                    <?php foreach ($skills as $skill): ?>
                                        <option value="<?php echo html_escape($skill->id); ?>" 
                                          <?php echo ($subskill->parent_id == $skill->id) ? 'selected' : ''; ?>>
                                          <?php echo html_escape($skill->name); ?>
                                        </option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                          </div>
                          
                          <div class="col-md-12">
                              <div class="form-group">
                                  <label for="">Skill Name</label>
                                  <input type="text" name="name" class="form-control" value="<?php echo html_escape($subskill->name) ?>">
                              </div>
                          </div>

                          <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-sm-2 control-label p-0" for="example-input-normal">Sub Skill level <span class="text-danger">*</span></label>
                                <select class="form-control" name="skill_level" required>
                                    <option value="">Select Sub skill level</option>
                                    <?php for ($i=1; $i < 11; $i++) { ?>
                                      <option value="<?php echo $i * 10; ?>" 
                                        <?php echo ($i * 10 == $sub_skill->skill_level) ? 'selected' : ''; ?>>
                                        <?php echo $i * 10; ?> %
                                      </option>
                                    <?php } ?>
                                </select>
                            </div>
                          </div>

                          <div class="col-md-12">
                            <div class="form-group">
                              <label>Order</label>
                              <input type="number" class="form-control" value="<?php echo html_escape($subskill->orders) ?>" name="orders">
                            </div>
                          </div>

                            
                            <input type="hidden" name="id" value="<?php echo html_escape($subskill->id) ?>">
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