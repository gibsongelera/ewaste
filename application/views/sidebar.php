<!-- Sidebar for Collector Dashboard (admin/client style) -->
<div class="sidebar" style="width:240px; min-height:100vh; background:#006837; color:#fff; position:relative;">
  <div class="side_header_inner">
    <!-- user -->
    <div class="user-menu" style="padding:20px 0;">
      <ul class="menu-click">
        <li>
          <a href="#">
            <div class="media">
              <div class="media-left media-middle">
                <img src="<?php echo base_url('uploads/temp.jpg'); ?>" alt="profile_image" style="width:40px; height:40px; border-radius:50%;">
              </div>
              <div class="media-body media-middle">
                <h4><?php echo isset($name) ? ucwords($name) : 'Collector'; ?></h4>
                Collector
              </div>
            </div>
          </a>
          <ul class="dark_bg_color">
            <li>
              <a class="" href="<?php echo base_url('collector/profile'); ?>">
                <i class="fa fa-user"></i> Profile
              </a>
            </li>
            <li>
              <a class="" href="<?php echo base_url('collector/settings'); ?>">
                <i class="fa fa-cog"></i> Settings
              </a>
            </li>
            <li>
              <a href="<?php echo base_url('logout'); ?>">
                <i class="fa fa-sign-out"></i> Log Out
              </a>
            </li>
          </ul>
          <span class="activate_submenu"></span>
        </li>
      </ul>
    </div>
    <!-- main side nav start -->
    <nav class="mainmenu_side_wrapper">
      <ul class="menu-click">
        <li class="active-submenu">
          <a class="active-link" href="<?php echo base_url('collector/dashboard'); ?>">
            <i class="fa fa-th-large"></i> Dashboard
          </a>
        </li>
      </ul>
      <ul class="menu-click">
      <li>
        <a class="active-link" href="<?php echo ($role === 'admin') ? base_url('admin/dashboard') : base_url('collector/dashboard'); ?>">
          <i class="fa fa-th-large"></i> Dashboard
        </a>
      </li>
      <?php if ($role === 'admin'): ?>
        <li><a href="<?php echo base_url('admin/gadgets'); ?>"><i class="rt-icon2-tv"></i> Garbage</a></li>
        <li><a href="<?php echo base_url('admin/disposes'); ?>"><i class="rt-icon2-cup"></i> Disposes</a></li>
        <li><a href="<?php echo base_url('admin/clients'); ?>"><i class="fa fa-users"></i> Clients</a></li>
      <?php else: ?>
        <li><a href="<?php echo base_url('collector/disposes'); ?>"><i class="rt-icon2-cup"></i> Disposes</a></li>
      <?php endif; ?>
      </ul>
    </nav>
    <!-- eof main side nav -->
  </div>
</div>
