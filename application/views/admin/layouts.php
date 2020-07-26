<div class="content-wrapper">

  <!-- Main content -->
  <section class="content">

    <div class="row">
      <div class="col-md-12">
        <div class="box">

          <div class="box-header with-border">
            <h3 class="box-title">Choose Layouts</h3>
          </div>
      
          <div class="col-md-12 mt-20 mb-20">
            <div class="row layrow">
              
              <div class="col-md-3 col-sm-6 col-xs-12 width-10">
                <div class="card-box p-0 layout-box">
                    <label>
                      <input class="set_layout" type="radio"<?php echo($user->layouts == 'style1') ? 'checked' : '' ?> name="layout" value="style1" />
                      <img width="100%" src="<?php echo base_url('assets/admin/layouts/style1.png') ?>">
                    </label>
                    <?php echo($user->layouts == 'style1') ? '<i class="fa fa-check-circle"></i>' : '' ?>
                </div>
              </div> 

              <div class="col-md-3 col-sm-6 col-xs-12 width-10">
                <div class="card-box p-0 layout-box">
                    <label>
                      <input class="set_layout" type="radio"<?php echo($user->layouts == 'style2') ? 'checked' : '' ?> name="layout" value="style2" />
                      <img width="100%" src="<?php echo base_url('assets/admin/layouts/style2.png') ?>">
                    </label>
                    <?php echo($user->layouts == 'style2') ? '<i class="fa fa-check-circle"></i>' : '' ?>
                </div>
              </div> 

              <div class="col-md-3 col-sm-6 col-xs-12 width-10">
                <div class="card-box p-0 layout-box">
                    <label>
                      <input class="set_layout" type="radio"<?php echo($user->layouts == 'style3') ? 'checked' : '' ?> name="layout" value="style3" />
                      <img width="100%" src="<?php echo base_url('assets/admin/layouts/style3.png') ?>">
                    </label>
                    <?php echo($user->layouts == 'style3') ? '<i class="fa fa-check-circle"></i>' : '' ?>
                </div>
              </div> 

              <div class="col-md-3 col-sm-6 col-xs-12 width-10">
                <div class="card-box p-0 layout-box">
                    <label>
                      <input class="set_layout" type="radio"<?php echo($user->layouts == 'style4') ? 'checked' : '' ?> name="layout" value="style4" />
                      <img width="100%" src="<?php echo base_url('assets/admin/layouts/style4.png') ?>">
                    </label>
                    <?php echo($user->layouts == 'style4') ? '<i class="fa fa-check-circle"></i>' : '' ?>
                </div>
              </div> 

            </div>
          </div>

        </div>
      </div>
    
      <div class="col-md-12">
        <div class="box">

          <div class="box-header with-border">
            <h3 class="box-title">Choose Fonts & Colors</h3>
          </div>
          
          <form method="post" enctype="multipart/form-data" action="<?php echo base_url('admin/profile/update_fonts') ?>" role="form" class="form-horizontal">

          <div class="col-md-12 mt-20 mb-20">
            <div class="row layrow">
              <div class="col-md-12">
                  <div class="form-group m-t-10">
                    <label>Select Font</label>
                    <select class="form-control" name="site_font">
                      <?php foreach ($fonts as $fon): ?>
                        <option value="<?php echo $fon->id; ?>" <?php echo (user()->site_font == $fon->id) ? 'selected' : ''; ?>><?php echo ucfirst($fon->name); ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
              </div>
            
              <div class="col-md-12">
                <div class="form-group m-t-10 ">
                    <label>Select Color</label>
                    <span class="color" style="background: #<?php echo html_escape($user->site_color); ?>"></span><br>
                    
                    <input type="text" name="site_color" class="colorpicker-default form-control colorpicker-element" value="<?php echo html_escape($user->site_color); ?>">
                </div>
              </div>

              <!-- csrf token -->
              <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
              
              <div class="col-md-12" style="padding-left: 17px">
                <button type="submit" class="btn btn-info waves-effect w-md waves-light m-b-5"><i class="fa fa-check"></i> Save Changes</button>
              </div>
            </div>
          </div>

          </form>

        </div>
      </div>

    </div>

  </section>

</div>