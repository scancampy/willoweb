 <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo base_url('dashboard'); ?>" class="brand-link">
      <img src="<?php echo base_url('img/willowwhite.png'); ?>"
           alt="Willow Admin"
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Willow Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="<?php echo base_url('dashboard'); ?>" class="nav-link <?php if($this->uri->segment(1) == 'dashboard') { echo 'active'; } ?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard                
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?php echo base_url('promo'); ?>" class="nav-link <?php if($this->uri->segment(1) == 'promo') { echo 'active'; } ?>">
              <i class="nav-icon fa fa-bullhorn"></i>
              <p>
                Promo                
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?php echo base_url('faq'); ?>" class="nav-link <?php if($this->uri->segment(1) == 'faq') { echo 'active'; } ?>">
              <i class="nav-icon fa fa-question"></i>
              <p>
                FAQ                
              </p>
            </a>
          </li>
         
         
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>