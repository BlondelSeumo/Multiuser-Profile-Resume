<li class="<?php if(isset($page_title) && $page_title == "Layouts"){echo "active";} ?>">
  <a href="<?php echo base_url('admin/profile/layouts') ?>">
    <i class="fa fa-dashboard"></i> <span>Layouts</span>
  </a>
</li>

<li class="<?php if(isset($page_title) && $page_title == "Fonts"){echo "active";} ?>">
  <a href="<?php echo base_url('admin/fonts') ?>">
    <i class="fa fa-font"></i> <span>Fonts</span>
  </a>
</li>

<li class="<?php if(isset($page_title) && $page_title == "Service"){echo "active";} ?>">
  <a href="<?php echo base_url('admin/service') ?>">
    <i class="fa fa-cog"></i> <span>Services</span>
  </a>
</li>

<li class="<?php if(isset($page_title) && $page_title == "Skills"){echo "active";} ?>">
  <a href="<?php echo base_url('admin/skill') ?>">
    <i class="fa fa-cogs"></i> <span>Skills</span>
  </a>
</li>

<li class="<?php if(isset($page_title) && $page_title == "Experience"){echo "active";} ?>">
  <a href="<?php echo base_url('admin/experience') ?>">
    <i class="fa fa-book"></i> <span>Experience</span>
  </a>
</li>

<li class="<?php if(isset($page_title) && $page_title == "Testimonial"){echo "active";} ?>">
  <a href="<?php echo base_url('admin/testimonial') ?>">
    <i class="fa fa-comment-o"></i> <span>Testimonial</span>
  </a>
</li>

<li class="treeview <?php if(isset($page_title) && $page_title == "Portfolio " || isset($page) && $page == "Portfolio"){echo "active";} ?>">
  <a href="#"><i class="fa fa-address-card"></i>
    <span>Portfolio</span>
    <span class="pull-right-container">
      <i class="fa fa-angle-right pull-right"></i>
    </span>
  </a>
  <ul class="treeview-menu">
    <li><a href="<?php echo base_url('admin/portfolio_category') ?>"><i class="fa fa-circle"></i>Add Category </a></li>
    <li><a href="<?php echo base_url('admin/portfolio') ?>"><i class="fa fa-circle"></i>Portfolio</a></li>
  </ul>
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

<li class="<?php if(isset($page_title) && $page_title == "Appointment"){echo "active";} ?>">
  <a href="<?php echo base_url('admin/appointment') ?>">
    <i class="fa fa-calendar"></i> <span>Appointments</span>
  </a>
</li>


<li class="<?php if(isset($page_title) && $page_title == "Contact"){echo "active";} ?>">
  <a href="<?php echo base_url('admin/contact') ?>">
    <i class="fa fa-envelope"></i> <span>Contact Messages</span>
  </a>
</li>

<li class="<?php if(isset($page_title) && $page_title == "Upload"){echo "active";} ?>">
  <a href="<?php echo base_url('upload_cv') ?>">
    <i class="fa fa-cloud-upload"></i> <span>Upload CV</span>
  </a>
</li>