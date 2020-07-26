 <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar mt-10">
      
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">


        <?php if (is_admin()): ?>
          <li class="<?php if(isset($page_title) && $page_title == "Dashboard"){echo "active";} ?>">
            <a href="<?php echo base_url('admin/dashboard') ?>">
              <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            </a>
          </li>

          <li class="<?php if(isset($page_title) && $page_title == "Settings"){echo "active";} ?>">
            <a href="<?php echo base_url('admin/settings') ?>">
              <i class="fa fa-cog"></i> <span>Settings</span>
            </a>
          </li>

          <li class="<?php if(isset($page_title) && $page_title == "Offline Payment"){echo "active";} ?>">
            <a href="<?php echo base_url('admin/payment/offline') ?>">
              <i class="fa fa-money"></i> <span>Offline Payment</span>
            </a>
          </li>

          <li class="<?php if(isset($page_title) && $page_title == "Users"){echo "active";} ?>">
            <a href="<?php echo base_url('admin/users') ?>">
              <i class="fa fa-users"></i> <span>Users</span>
            </a>
          </li>


          <li class="treeview <?php if(isset($page_title) && $page_title == "Blog " || isset($page) && $page == "Blog"){echo "active";} ?>">
            <a href="#"><i class="fa fa-file-text"></i>
              <span>Blog</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-right pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="<?php echo base_url('admin/blog_category') ?>"><i class="fa fa-circle"></i>Add Category </a></li>
              <li><a href="<?php echo base_url('admin/blog') ?>"><i class="fa fa-circle"></i>Blog Posts</a></li>
            </ul>
          </li> 


          <li class="<?php if(isset($page_title) && $page_title == "Service"){echo "active";} ?>">
            <a href="<?php echo base_url('admin/services') ?>">
              <i class="fa fa-cog"></i> <span>Services</span>
            </a>
          </li>

          <li class="<?php if(isset($page_title) && $page_title == "Features"){echo "active";} ?>">
            <a href="<?php echo base_url('admin/package') ?>">
              <i class="fa fa-dollar"></i> <span>Pricing Package</span>
            </a>
          </li>

          <li class="<?php if(isset($page_title) && $page_title == "Feature"){echo "active";} ?>">
            <a href="<?php echo base_url('admin/feature') ?>">
              <i class="fa fa-tasks"></i> <span>Package Features</span>
            </a>
          </li>

          <li class="<?php if(isset($page_title) && $page_title == "Pages"){echo "active";} ?>">
            <a href="<?php echo base_url('admin/pages') ?>">
              <i class="fa fa-file-text-o"></i> <span>Pages</span>
            </a>
          </li>

          <li class="<?php if(isset($page_title) && $page_title == "Contact"){echo "active";} ?>">
            <a href="<?php echo base_url('admin/contact') ?>">
              <i class="fa fa-envelope"></i> <span>Messages</span>
            </a>
          </li>

        <?php else: ?>

          <li class="<?php if(isset($page_title) && $page_title == "Profile"){echo "active";} ?>">
            <a href="<?php echo base_url('admin/profile') ?>">
              <i class="fa fa-user-o"></i> <span>My Profile</span>
            </a>
          </li>
        
        <?php $payment_status = check_my_payment_status(); ?>
 
          <?php if (user()->account_type == 'pro'): ?>
              
              <li class="<?php if(isset($page_title) && $page_title == "Payment"){echo "active";} ?>">
                <a href="<?php echo base_url('admin/payment') ?>">
                  <i class="fa fa-dollar"></i> <span>Payment</span> 
                  <?php if ($payment_status != 1): ?>
                    <span class="pending text-danger"><i class="fa fa-exclamation-circle"></i></span>
                  <?php endif ?>
                </a>
              </li>
              
              <?php if ($payment_status == 1): ?>
                <?php include'left_menu.php'; ?>
              <?php endif ?>

              <?php if ($payment_status == 0 && $settings->enable_paypal == 0): ?>
                <?php include'left_menu.php'; ?>
              <?php endif ?>

          <?php else: ?>
            <li class="<?php if(isset($page_title) && $page_title == "Change Password"){echo "active";} ?>">
              <a href="<?php echo base_url('change_password') ?>">
                <i class="fa fa-lock"></i> <span>Change Password</span>
              </a>
            </li>

            <li class="<?php if(isset($page_title) && $page_title == "Upgrade"){echo "active";} ?>">
              <a href="<?php echo base_url('admin/payment/upgrade') ?>">
                <i class="fa fa-rocket"></i> <span>Upgrade Account</span>
              </a>
            </li>
          <?php endif ?>
        <?php endif ?>

      </ul>
    </section>
  </aside>