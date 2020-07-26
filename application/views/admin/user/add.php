

<!-- Start content -->
<div class="content">
    <div class="container">

        <!-- Page breadcrumb -->
        <div class="row">
            <div class="col-sm-12">
                <div class="btn-group pull-left m-t-5 m-b-20">
                    <h4><span class="label label-default uop">(<?php echo $total; ?>) Users</span></h4>
                </div>
                <ol class="breadcrumb pull-right">
                  <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                  <li><a href="#">Users</a></li>
                  <li class="active">All Users</li>
                </ol>
            </div>
        </div>

        <?php $msg = $this->session->flashdata('msg'); ?>
        <?php if (isset($msg)): ?>
            <div class="alert alert-success delete_msg pull" style="width: 100%"> <i class="fa fa-check-circle"></i> <?php echo $msg; ?> &nbsp;
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
            </div>
        <?php endif ?>

        <div class="row">
            <div class="col-lg-12">
                <div class="card-box">
                     <div class="box">
                        <div class="pull-left">
                            <form action="<?php echo base_url('admin/users/all_users') ?>" class="sort_form" method="get">
                                <select name="sort" class="form-control input-sm sort" style="width: auto; padding-right: 20px;">
                                    <option selected="selected">Sort by</option>
                                    <option <?php if(isset($_GET['sort']) && $_GET['sort'] == 'id'){echo "selected";} ?> value="id">Id</option>
                                    <option <?php if(isset($_GET['sort']) && $_GET['sort'] == 'admin'){echo "selected";} ?> value="admin">Admin</option>
                                    <option <?php if(isset($_GET['sort']) && $_GET['sort'] == 'author'){echo "selected";} ?> value="author">Author</option>
                                    <option <?php if(isset($_GET['sort']) && $_GET['sort'] == 'user'){echo "selected";} ?> value="user">User</option>
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
                    </div><br>

                    <h4 class="header-title m-t-0 m-b-30"></h4>


                    <div class="table-responsive">
                        <table class="table table-bordered m-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Joining</th>
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
                                        <td><?php echo $user->name; ?></td>
                                        
                                        <td>
                                            <?php if ($user->role == 'admin'): ?>
                                                <span class="label label-primary"><i class="fa fa-user"></i> Admin</span>
                                            <?php endif ?>
                                            <?php if ($user->role == 'author'): ?>
                                                <span class="label label-info">Author</span>
                                            <?php endif ?>
                                            <?php if ($user->role == 'user'): ?>
                                                <span class="label label-inverse">User</span>
                                            <?php endif ?>
                                        </td>

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

                                            <div class="btn-group">
                                                <button type="button" class="btn btn-info dropdown-toggle waves-effect waves-light btn-sm" data-toggle="dropdown" aria-expanded="false">Action <span class="caret"></span></button>
                                                
                                                <ul class="dropdown-menu custom-dw" role="menu">
                                                    
                                                    <?php if ($user->status == 1): ?>
                                                        <li><a href="<?php echo base_url('admin/users/status_action/2/'.$user->id) ?>"><i class="fa fa-times"></i> Deactive</a></li>
                                                    <?php endif ?>
                                                    <?php if ($user->status == 2 || $user->status == 0): ?>
                                                        <li><a href="<?php echo base_url('admin/users/status_action/1/'.$user->id) ?>"><i class="fa fa-check"></i> Active</a></li>
                                                    <?php endif ?>

                                                    <li><a href="#roleModal_<?php echo $user->id;?>" data-toggle="modal"><i class="fa fa-circle"></i> Change user role</a></li>

                                                    <!-- <li><a href="<?php echo base_url('admin/users/deactive/'.$user->id) ?>"><i class="fa fa-pencil"></i> Edit</a></li> -->
                                                    <li><a href="<?php echo base_url('admin/users/delete/'.$user->id) ?>"><i class="fa fa-trash"></i> Delete</a></li>

                                                </ul>
                                            </div>

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
            </div><!-- end col -->
        </div>

    </div>
    <!-- container -->

</div> 
<!-- content -->


<?php foreach ($users as $user): ?>

<div id="roleModal_<?php echo $user->id;?>" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <form method="post" action="<?php echo base_url('admin/users/change_role/'.$user->id)?>" role="form">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Select user role</h4>
      </div>

      <div class="modal-body">
        
            <div class="form-group m-t-20">
                <div class="radio radio-info radio-inline" style="margin-left: 29px">
                    <input <?php if($user->role == 'admin'){echo "checked";}else{echo "";} ?> type="radio" id="inlineRadio3" value="admin" name="role">
                    <label for="inlineRadio3"> Admin </label>
                </div>
                <div class="radio radio-info radio-inline">
                    <input <?php if($user->role == 'author'){echo "checked";}else{echo "";} ?> type="radio" id="inlineRadio4" value="author" name="role">
                    <label for="inlineRadio4"> Author </label>
                </div>
                <div class="radio radio-info radio-inline">
                    <input <?php if($user->role == 'user'){echo "checked";}else{echo "";} ?> type="radio" id="inlineRadio5" value="user" name="role">
                    <label for="inlineRadio5"> User </label>
                </div>
            </div>

            <!-- csrf token -->
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

      </div>

      <div class="modal-footer">
        <button type="submit" class="btn btn-info">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

    </form>

  </div>
</div>

<?php endforeach ?>