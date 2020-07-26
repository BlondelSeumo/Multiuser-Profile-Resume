<div class="content-wrapper">

  <!-- Main content -->
    <section class="content">

      <div class="box list_area">
        <div class="box-header with-border">
            <h3 class="box-title">All Users </h3>
         </div>

       <div class="box-body">

        <div class="col-md-12 col-sm-12 col-xs-12 scroll table-responsive">
          <table class="table table-hover <?php if(count($users) > 10){echo "datatable";} ?>" id="dg_table">
            <thead>
              <tr>
                <th>#</th>
                <th>Avatar</th>
                <th>Name</th>
                <th>Total Views</th>
                <th></th>
                <th>Package</th>
                <th>Payment status</th>
                <th>Role</th>
                <th>Status</th>
                <th>Join</th>
                <th>Expire</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php $i=1; foreach ($users as $user): ?>
              <tr id="row_<?php echo $user->id; ?>">

                <td><?php echo $i; ?></td>
                <td>
                  <?php if ($user->thumb == ''): ?>
                    <?php $avatar = 'assets/images/avatar.png'; ?> 
                  <?php else: ?>
                    <?php $avatar = $user->thumb; ?>
                  <?php endif ?>
                  <img width="40px" class="img-circle" src="<?php echo base_url($avatar); ?>">
                </td>
               
                <td><?php echo $user->name; ?></td>
                <td><?php echo $user->hit; ?></td>
                <td><a target="_blank" href="<?php echo base_url($user->slug) ?>"><span class="label label-default"><i class="icon-eye"></i> View profile</span></a></td>

                <td>
                  <span class="label label-<?php if($user->account_type == 'free'){echo "info";}else{echo "warning";} ?>">
                    <?php echo $user->account_type; ?>
                  </span>
                </td>
                <td><span class="label label-info"><?php echo $user->payment_status; ?></span></td>

                <td>
                  <?php if ($user->role == 'admin'): ?>
                    <span class="label label-primary"><i class="fa fa-user"></i> Admin</span>
                  <?php endif ?>
                  <?php if ($user->role == 'user'): ?>
                    <span class="label label-success"><i class="fa fa-user-o"></i> User</span>
                  <?php endif ?>
                </td>
                <td>
                  <?php if ($user->status == 1): ?>
                    <span class="label label-info">Active</span>
                  <?php else: ?>
                    <span class="label label-danger">Inactive</span>
                  <?php endif ?>
                </td>

                <td>
                  <?php echo get_time_ago($user->created_at) ?>
                </td>
                <td>
                  <span class="label label-default"><b><?php echo date_difference($user->created_at); ?></b> days left</span>
                </td>

                <td class="actions">
                  <div class="btn-group">
                    <button type="button" class="btn btn-info dropdown-toggle waves-effect waves-light btn-sm" data-toggle="dropdown" aria-expanded="false">Action <span class="caret"></span></button>

                    <ul class="dropdown-menu custom-dw" role="menu">

                      <?php if ($user->status == 1): ?>
                        <li><a href="<?php echo base_url('admin/users/status_action/2/'.$user->id) ?>"><i class="fa fa-times"></i> Deactive</a></li>
                      <?php endif ?>
                      <?php if ($user->status == 2 || $user->status == 0): ?>
                        <li><a href="<?php echo base_url('admin/users/status_action/1/'.$user->id) ?>"><i class="fa fa-check"></i> Active</a></li>
                      <?php endif ?>

                      <li><a href="<?php echo base_url('admin/users/edit/'.$user->id);?>" class="on-defaults remove-row"><i class="fa fa-pencil"></i> Edit</a></li>

                      <li><a data-val="User" data-id="<?php echo $user->id; ?>" href="<?php echo base_url('admin/users/delete/'.$user->id);?>" class="on-defaults remove-row delete_item"><i class="fa fa-trash-o"></i> Delete</a></li>

                    </ul>
                  </div>
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

    </section>
</div>
