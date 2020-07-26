<div class="content-wrapper">

  <!-- Main content -->
  <section class="content">
    
    <div class="box add_area">
        <div class="box-header with-border">
          <h3 class="box-title">All Users <a href="<?php echo base_url('admin/users/company') ?>" class="btn btn-default btn-sm ml-50"><i class="fa fa-bars"></i> Company List</a></h3>

          <div class="box-tools pull-right">
            <div class="pull-left">
                <form action="<?php echo base_url('admin/users/all_users') ?>" class="sort_form" method="get">
                    <select name="sort" class="form-control input-sm sort search">
                        <option selected="selected">Sort by</option>
                        <option <?php if(isset($_GET['sort']) && $_GET['sort'] == 'id'){echo "selected";} ?> value="id">Id</option>
                        <option <?php if(isset($_GET['sort']) && $_GET['sort'] == 'active'){echo "selected";} ?> value="active">Active</option>
                        <option <?php if(isset($_GET['sort']) && $_GET['sort'] == 'inactive'){echo "selected";} ?> value="suspend">Inactive</option>
                  </select>
                </form>
            </div>
            <div class="pull-right">
                <form role="search" autocomplete="off" action="<?php echo base_url('admin/users/all_users') ?>" method="get">
                     <div class="input-group input-group-sm" style="width: 300px;">
                      <input type="text" name="search" class="form-control pull-right" placeholder="Search" autocomplete="off">
    
                      <div class="input-group-btn">
                        <button type="submit" class="btn btn-info"><i class="fa fa-search"></i></button>
                      </div>
                    </div>
                </form>
            </div>
          </div>
        </div>

      <div class="box-body">
        
        <div class="table-responsive">
            <table class="table table-hover m-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Status</th>
                        <th>Joined</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1; foreach ($users as $user): ?>
                        <tr id="row_<?php echo $user->id ?>">
                            <th scope="row"><?php echo $i ?></th>
                            
                            <?php if ($user->thumb == ''): ?>
                                <?php $avatar = 'assets/images/avatar.png'; ?> 
                            <?php else: ?>
                                <?php $avatar = $user->thumb; ?>
                            <?php endif ?>

                            <td><img width="60px" class="img-circle" src="<?php echo base_url($avatar) ?>"></td>
                            <td><?php echo $user->first_name.' '.$user->last_name; ?></td>
                            <td><?php echo $user->email; ?></td>
                            <td><?php echo $user->mobile; ?></td>
                            
                            <td>
                                <?php if ($user->status == 1): ?>
                                    <span class="label label-success">Active</span>
                                <?php endif ?>
                                <?php if ($user->status == 2): ?>
                                    <span class="label label-danger">Inactive</span>
                                <?php endif ?>
                            </td>

                            <td><?php echo my_date_show($user->created_at) ?></td>

                            <td class="actions">

                                <a class="btn btn-info-outline btn-sm" title="Edit" href="<?php echo base_url('admin/users/status_action/2/'.$user->id) ?>"><i class="fa fa-pencil"></i></a>

                                <a class="btn btn-danger-outline btn-sm" title="Delete" href="<?php echo base_url('admin/users/status_action/2/'.$user->id) ?>"><i class="fa fa-trash"></i></a>

                                <?php if ($user->status == 1): ?>
                                    <a class="btn btn-danger-outline btn-sm" title="Deactivate" href="<?php echo base_url('admin/users/status_action/2/'.$user->id) ?>"><i class="fa fa-times"></i></a>
                                <?php else: ?>
                                    <a class="btn btn-success-outline btn-sm" title="Activate" href="<?php echo base_url('admin/users/status_action/1/'.$user->id) ?>"><i class="fa fa-check"></i></a>
                                <?php endif ?>

                            </td>
                        </tr>
                    <?php $i++; endforeach ?>
                </tbody>
            </table>
        </div>

        <div class="center p-30">
            <?php echo $this->pagination->create_links(); ?>
        </div>

      </div>

      <div class="box-footer">

      </div>

    </div>

  </section>
</div>
