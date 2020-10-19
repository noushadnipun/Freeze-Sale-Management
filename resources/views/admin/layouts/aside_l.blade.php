<div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div> --}}

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column text-sm xnav-legacy nav-compact nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
            <a href="{{route('admin_index')}}" class="nav-link {{ Request()->routeIs('admin_index') ? 'active' : ' ' }}">
                    <i class="nav-icon fas fa-tachometer-alt text-sm"></i>
                    <p> Dashboard </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{route('admin_distributor')}}" class="nav-link {{ Request()->routeIs('admin_distributor', 'admin_distributor_outlet') ? 'active' : ' ' }}">
                    <i class="nav-icon fas fa-th text-sm"></i>
                    <p> Distributors </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{route('admin_outlet')}}" class="nav-link {{ Request()->routeIs('admin_outlet', 'admin_outlet_service') ? 'active' : ' ' }}">
                    <i class="nav-icon fas fa-store text-sm"></i>
                    <p> Outlets </p>
                </a>
            </li>
            <li class="nav-item">
            <a href="{{route('admin_service')}}" class="nav-link {{ Request()->routeIs('admin_service') ? 'active' : ' ' }}">
                    <i class="nav-icon fas fa-baby-carriage text-sm"></i>
                    <p> Products </p>
                </a>
            </li>

            <li class="nav-item has-treeview menu-open {{ Request()->routeIs('admin_sale_new', 'admin_sale') ? 'menu-open' : ' ' }}">
              <a href="" class="nav-link {{ Request()->routeIs('admin_sale_new', 'admin_sale') ? 'active' : ' ' }}">
                <i class="nav-icon fas fa-cogs text-sm"></i>
                <p>
                  Services
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">   
                <li class="nav-item">
                  <a href="{{route('admin_sale_new')}}" class="nav-link {{ Request()->routeIs('admin_sale_new') ? 'active' : ' ' }}">
                    <i class="nav-icon far fa-circle text-sm"></i>
                    <p>New Services</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('admin_sale')}}" class="nav-link {{ Request()->routeIs('admin_sale') ? 'active' : ' ' }}">
                    <i class="nav-icon far fa-circle text-sm"></i>
                    <p>Manage Services</p>
                  </a>
                </li>
              </ul>
            </li>



            <li class="nav-item has-treeview menu-open">
              <a href="" class="nav-link">
                  <i class="nav-icon fas fa-users  text-sm"></i>
                  <p>Users<i class="right fas fa-angle-left"></i></p>
              </a>
              <ul class="nav nav-treeview">   
                <li class="nav-item">
                  <a href="" class="nav-link">
                    <i class="nav-icon far fa-circle text-sm"></i>
                    <p>New User</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="" class="nav-link ">
                    <i class="nav-icon far fa-circle text-sm"></i>
                    <p>All Users</p>
                  </a>
                </li>
              </ul>
            </li>
            
            
          
            
            <li class="nav-item has-treeview menu-open">
              <a href="" class="nav-link">
                <i class="nav-icon fas fa-copy text-sm"></i>
                <p>
                  Reports
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview ">   
              
                <li class="nav-item">
                  <a href="" class="nav-link">
                    <i class="nav-icon far fa-circle text-sm"></i>
                    <p>Service Summery</p>
                  </a>
                </li>
                
                
                  <li class="nav-item">
                  <a href="" class="nav-link">
                    <i class="nav-icon far fa-circle text-sm"></i>
                    <p>Date Wise Service</p>
                  </a>
                </li>
                
                
                  <li class="nav-item">
                  <a href="" class="nav-link">
                    <i class="nav-icon far fa-circle text-sm"></i>
                    <p>DB Wise Service</p>
                  </a>
                </li>
                
                
                
              </ul>
            </li>
            
            
            
            
            
            
            
            
                  <li class="nav-item has-treeview menu-open">
              <a href="" class="nav-link">
                <i class="nav-icon fas fa-tools text-sm"></i>
                <p>
                 Company Settings
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">   
              
                <li class="nav-item">
                  <a href="" class="nav-link">
                    <i class="nav-icon far fa-circle text-sm"></i>
                    <p>Genarel Settings</p>
                  </a>
                </li>
                
                
                  <li class="nav-item">
                  <a href="" class="nav-link">
                    <i class="nav-icon far fa-circle text-sm"></i>
                    <p>Logo Settings</p>
                  </a>
                </li>
                
        
              </ul>
            </li>
            
      
                <li class="nav-item">
            <a href="//nextzen.com.bd/software-services/"  target="_blank" class="nav-link">
                    <i class="nav-icon fas fa-blender-phone"></i>
                    <p> IOT Integrated </p>
                </a>
            </li>


             <div style="background: #02067a; text-align: center; width: 240px; position: fixed; bottom: 0;">
                <img src="https://nextzen.com.bd/storage/2015/12/nextzen_blue.png" alt="Nextzen Limited" style="
                        filter: brightness(0) invert(1); width: 103px; padding: 6px 0 6px 0px;" class="mCS_img_loaded">
            
              </div>

          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          {{-- <li class="nav-item has-treeview">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./index.html" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v1</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index2.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v2</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index3.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v3</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="pages/widgets.html" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Widgets
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Layout Options
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">6</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/layout/top-nav.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Top Navigation</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/top-nav-sidebar.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Top Navigation + Sidebar</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/boxed.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Boxed</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/fixed-sidebar.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Fixed Sidebar</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/fixed-topnav.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Fixed Navbar</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/fixed-footer.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Fixed Footer</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/collapsed-sidebar.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Collapsed Sidebar</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Charts
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/charts/chartjs.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>ChartJS</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/charts/flot.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Flot</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/charts/inline.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Inline</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tree"></i>
              <p>
                UI Elements
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/UI/general.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>General</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/UI/icons.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Icons</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/UI/buttons.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Buttons</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/UI/sliders.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sliders</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/UI/modals.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Modals & Alerts</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/UI/navbar.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Navbar & Tabs</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/UI/timeline.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Timeline</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/UI/ribbons.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ribbons</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Forms
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/forms/general.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>General Elements</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/forms/advanced.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Advanced Elements</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/forms/editors.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Editors</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/forms/validation.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Validation</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Tables
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/tables/simple.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Simple Tables</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/tables/data.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>DataTables</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/tables/jsgrid.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>jsGrid</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-header">EXAMPLES</li>
          <li class="nav-item">
            <a href="pages/calendar.html" class="nav-link">
              <i class="nav-icon far fa-calendar-alt"></i>
              <p>
                Calendar
                <span class="badge badge-info right">2</span>
              </p>
            </a>
          </li> --}}

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
