<!-- Start content -->
<div class="content-wrapper">
  <section class="content">

    <div class="row">

      <div class="col-md-4">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Set Fonts & Colors</h3>
                </div>
                <div class="box-body">
                    <form id="cat-form" method="post" class="validate-form" action="<?php echo base_url('admin/fonts/set_fonts')?>" role="form">
                   
                        <div class="row">
                          
                          <div class="col-md-12">
                            <div class="form-group m-t-20">
                              <label>Site Font</label>
                              <select class="form-control select2" name="site_font">
                                  <option value="">Select Font</option>
                                  <?php foreach ($fonts as $fon): ?>
                                    <option value="<?php echo $fon->id; ?>" <?php echo (user()->site_font == $fon->id) ? 'selected' : ''; ?>><?php echo ucfirst($fon->name); ?></option>
                                  <?php endforeach ?>
                              </select>
                            </div>
                          </div>

                          <div class="col-md-12">
                            <div class="form-group m-t-20">
                                <label class="control-label" for="example-input-normal">Site color</label>
                                <input type="text" name="site_color" class="colorpicker-default form-control colorpicker-element" value="<?php echo user()->site_color; ?>">
                            </div>
                          </div>

                        </div>
                        <!-- csrf token -->
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                        
                        <button type="submit" class="btn btn-info pull-right">Save changes</button>
                        
                    </form>
                </div>
            </div>
        </div>
      </div>
      
      <div class="col-md-8">
        <div class="col-md-12 add_area" style="display: <?php if($page_title == "Edit"){echo "block";}else{echo "none";} ?>">
            <div class="box input_area">
                <div class="box-header with-border">
                  
                  <?php if (isset($page_title) && $page_title == "Edit"): ?>
                    <h3 class="box-title">Edit font </h3>
                    
                    <div class="box-tools pull-right">
                      <a href="<?php echo base_url('admin/fonts') ?>" class="pull-right btn btn-info btn-sm"><i class="fa fa-angle-left"></i> Back</a>
                    </div>

                  <?php else: ?>
                    <h3 class="box-title">Add fonts </h3>

                    <div class="box-tools pull-right">
                      <a href="#" class="pull-right btn btn-info btn-sm cancel_btn"><i class="fa fa-list"></i> All Fonts</a>
                    </div>

                  <?php endif; ?>
                    
                </div>
                <div class="box-body">
                    <form id="cat-form" method="post" class="validate-form" action="<?php echo base_url('admin/fonts/add')?>" role="form">
                   
                        <div class="form-group">
                            <label>Font name<span class="require-field">*</span></label>
                            <input type="text" class="form-control" placeholder="Example: Open Sans" required name="name" value="<?php echo $font[0]['name']; ?>">
                        </div>
              
                        <input type="hidden" name="id" value="<?php echo $font['0']['id']; ?>">
                        <!-- csrf token -->
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

                        <?php if (isset($page_title) && $page_title == "Edit"): ?>
                          <button type="submit" class="btn btn-info pull-right">Save changes</button>
                        <?php else: ?>
                          <a target="_blank" href="https://fonts.google.com/" class="btn btn-warning pull-left"><i class="fa fa-search"></i> Google font link</a>
                          <button type="submit" class="btn btn-info pull-right">Save</button>
                        <?php endif; ?>
                        
                    </form>
                </div>
            </div>
        </div>



        <?php if (isset($page_title) && $page_title != "Edit"): ?>
          
        <div class="col-md-12 list_area">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">All Fonts </h3>
                    
                    <div class="box-tools pull-right">
                      <a href="#" class="pull-right btn btn-primary btn-sm add_btn"><i class="fa fa-plus"></i> Add font</a>
                    </div>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12 scroll table-responsive">
                            <table class="table table-bordered datatable" id="dg_table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php $i=1; foreach ($fonts as $font): ?>
                                    <tr id="row_<?php echo $font->id; ?>">
                                        
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $font->name; ?></td>
                                
                                        <td class="actions" width="12%">
                                          <a href="<?php echo base_url('admin/fonts/edit/'.$font->id);?>" class="btn btn-default btn-sm btn-circle on-default edit-row" data-placement="top" title="Edit"><i class="fa fa-pencil"></i></a>

                                          <a data-val="Font" data-id="<?php echo $font->id; ?>" href="<?php echo base_url('admin/fonts/delete/'.$font->id);?>" class="btn btn-default btn-sm btn-circle on-default remove-row delete_item" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash-o"></i></a>
                                          
                                        </td>
                                    </tr>
                                  <?php $i++; endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php endif ?>
      </div>

    </div>

  </section>
</div>
