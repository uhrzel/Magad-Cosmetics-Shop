</style>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-pink elevation-4 sidebar-no-expand">
  <!-- Brand Logo -->
  <a href="<?php echo base_url ?>staff" class="brand-link bg-gradient-pink text-sm">
    <img src="<?php echo validate_image($_settings->info('logo')) ?>" alt="Store Logo" class="brand-image img-circle elevation-3" style="opacity: .8;width: 1.5rem;height: 1.5rem;max-height: unset">
    <span class="brand-text font-weight-light"><?php echo $_settings->info('short_name') ?></span>
  </a>
  <!-- Sidebar -->
  <div class="sidebar os-host os-theme-light os-host-overflow os-host-overflow-y os-host-resize-disabled os-host-transition os-host-scrollbar-horizontal-hidden">
    <div class="os-resize-observer-host observed">
      <div class="os-resize-observer" style="left: 0px; right: auto;"></div>
    </div>
    <div class="os-size-auto-observer observed" style="height: calc(100% + 1px); float: left;">
      <div class="os-resize-observer"></div>
    </div>
    <div class="os-content-glue" style="margin: 0px -8px; width: 249px; height: 646px;"></div>
    <div class="os-padding">
      <div class="os-viewport os-viewport-native-scrollbars-invisible" style="overflow-y: scroll;">
        <div class="os-content" style="padding: 0px 8px; height: 100%; width: 100%;">
          <!-- Sidebar user panel (optional) -->
          <div class="clearfix"></div>
          <!-- Sidebar Menu -->
          <nav class="mt-4">
            <ul class="nav nav-pills nav-sidebar flex-column text-sm nav-compact nav-flat nav-child-indent nav-collapse-hide-child" data-widget="treeview" role="menu" data-accordion="false">
              <li class="nav-item dropdown">
                <a href="./" class="nav-link nav-home">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                    Dashboard
                  </p>
                </a>
              </li>
              <!--      <li class="nav-item dropdown">
                <a href="<?php echo base_url ?>staff/?page=product" class="nav-link nav-product">
                  <i class="nav-icon fas fa-table"></i>
                  <p>
                    Product List
                  </p>
                </a>
              </li>
              <li class="nav-item dropdown">
                <a href="<?php echo base_url ?>staff/?page=inventory" class="nav-link nav-inventory">
                  <i class="nav-icon fas fa-clipboard-list"></i>
                  <p>
                    Inventory List
                  </p>
                </a>
              </li> -->
              <!--      <li class="nav-item dropdown">
                <a href="<?php echo base_url ?>staff/?page=orders" class="nav-link nav-orders">
                  <i class="nav-icon fas fa-list"></i>
                  <p>
                    Order List
                  </p>
                </a>
              </li> -->

              <!--  <li class="nav-item dropdown">
                <a href="<?php echo base_url ?>farmer/?page=clients" class="nav-link nav-clients">
                  <i class="nav-icon fas fa-users"></i>
                  <p>
                    Client List
                  </p>
                </a>
              </li> -->
              <!-- <li class="nav-item dropdown">
                <a href="<?php echo base_url ?>staff/?page=sales" class="nav-link nav-sales">
                  <i class="nav-icon fas fa-file"></i>
                  <p>
                    Sales Report
                  </p>
                </a>
              </li> -->
              <li class="nav-item dropdown">
                <a href="<?php echo base_url ?>staff/?page=messages" class="nav-link nav-messages">
                  <i class="nav-icon fas fa-comments"></i>
                  <p>
                    Messages
                  </p>
                </a>
              </li>

              <!--     <li class="nav-header">Maintenance</li>
              <li class="nav-item dropdown">
                <a href="<?php echo base_url ?>staff/?page=maintenance/brand" class="nav-link nav-maintenance_brand">
                  <i class="nav-icon fas fa-star"></i>
                  <p>
                    Brand List
                  </p>
                </a>
              </li>
              <li class="nav-item dropdown">
                <a href="<?php echo base_url ?>staff/?page=maintenance/category" class="nav-link nav-maintenance_category">
                  <i class="nav-icon fas fa-th-list"></i>
                  <p>
                    Category List
                  </p>
                </a>
              </li>
 -->

              <!--  <li class="nav-item dropdown">
                <a href="<?php echo base_url ?>farmer/?page=system_info" class="nav-link nav-system_info">
                  <i class="nav-icon fas fa-cogs"></i>
                  <p>
                    Settings
                  </p>
                </a>
              </li> -->
            </ul>
          </nav>
          <!-- /.sidebar-menu -->
        </div>
      </div>
    </div>
    <div class="os-scrollbar os-scrollbar-horizontal os-scrollbar-unusable os-scrollbar-auto-hidden">
      <div class="os-scrollbar-track">
        <div class="os-scrollbar-handle" style="width: 100%; transform: translate(0px, 0px);"></div>
      </div>
    </div>
    <div class="os-scrollbar os-scrollbar-vertical os-scrollbar-auto-hidden">
      <div class="os-scrollbar-track">
        <div class="os-scrollbar-handle" style="height: 55.017%; transform: translate(0px, 0px);"></div>
      </div>
    </div>
    <div class="os-scrollbar-corner"></div>
  </div>
  <!-- /.sidebar -->
</aside>
<script>
  $(document).ready(function() {

    var page = '<?php echo isset($_GET['page']) ? $_GET['page'] : 'home' ?>';
    /*  console.log("Current page parameter:", page); */
    var pageClass = 'nav-' + page.replace(/\//g, '_');
    /*  console.log("Computed class:", pageClass); */

    $('.nav-link').removeClass('active');
    $('.nav-link.' + pageClass).addClass('active');
    var $activeLink = $('.nav-link.' + pageClass);
    if ($activeLink.length) {
      $activeLink.closest('.nav-treeview').siblings('a').addClass('active');
      $activeLink.closest('.nav-treeview').parent().addClass('menu-open');
    }
    $('.nav-link.active').addClass('bg-gradient-pink');
  });
</script>