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

          <li class="nav-item <?php if($this->uri->segment(1, 0) == 'events') { echo 'menu-open'; } ?>">
            <a href="#" class="nav-link <?php if( $this->uri->segment(1, 0) == 'events') { echo 'active'; } ?>">
              <i class="nav-icon fas fa-newspaper"></i>
              <p>
                Master Events
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url('events/periode'); ?>" class="nav-link <?php if($this->uri->segment(2) == 'periode'  && $this->uri->segment(1, 0) == 'events') { echo 'active'; } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Master Event</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('events/tenant'); ?>" class="nav-link <?php if($this->uri->segment(2) == 'tenant'  && $this->uri->segment(1, 0) == 'events') { echo 'active'; } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Master Tenant</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('events/voucher'); ?>" class="nav-link <?php if($this->uri->segment(2) == 'voucher'  && $this->uri->segment(1, 0) == 'events') { echo 'active'; } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Master Voucher</p>
                </a>
              </li>
            </ul>
          </li>

           <li class="nav-item">
            <a href="<?php echo base_url('manageevent'); ?>" class="nav-link <?php if($this->uri->segment(1) == 'manageevent') { echo 'active'; } ?>">
              <i class="nav-icon fa fa-calendar-alt"></i>
              <p>
                Manage Event
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?php echo base_url('managevoucher'); ?>" class="nav-link <?php if($this->uri->segment(1) == 'managevoucher') { echo 'active'; } ?>">
              <i class="fas fa-ticket-alt"></i>
              <p>
                Manage Voucher
              </p>
            </a>
          </li>
        </ul>

      </nav>

      <!-- /.sidebar-menu -->

    </div>

    <!-- /.sidebar -->

  </aside>