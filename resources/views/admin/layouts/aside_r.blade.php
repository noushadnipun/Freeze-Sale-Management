<style>
    a {
    color: #49477f;
    text-decoration: none;
    background-color: transparent;
}

.mt-2, .my-2 {
    margin-top: .5rem!important;
    padding-bottom: 90px;
}
</style>


<a href="{{url('/')}}/admin/sale/create"><span style="background: #e4e2ff; padding: 5px; border-radius: 4px; font-weight: 600;margin: 0 10px 0px 0; ">New Service Entry <i class="fa fa-plus" style=" background: #9695b5; border-radius: 50%;
padding: 3px 3px 0px 2px; width: 18px; height: 18px; text-align: center; color: white; font-size: 12px;"></i> <span></a>

<a href="{{url('/')}}/admin/outlate">
<span style=" background: #e4e2ff; padding: 5px; border-radius: 4px; font-weight: 600; margin: 0 10px 0px 0; ">New Outlet <i class="fa fa-plus" style="background: #9695b5; border-radius: 50%; padding: 3px 3px 0px 2px; width: 18px;height: 18px; text-align: center; color: white; font-size: 12px; "></i> </span></a>

<a href="{{url('/')}}/admin/service">
<span style=" background: #e4e2ff; padding: 5px; border-radius: 4px; font-weight: 600;  margin: 0 10px 0px 0; ">New Products <i class="fa fa-plus" style=" background: #9695b5; border-radius: 50%; padding: 3px 3px 0px 2px;  width: 18px; height: 18px; text-align: center; color: white; font-size: 12px;"></i> </span></a>

<ul class="navbar-nav ml-auto">
    <li class="nav-item nav-link text-success">
        <a class="" href="https://nextzen.com.bd/contact-us" target="_blank"><i class="fa fa-info"></i> Help</a>   
    </li>
    <li class="nav-item dropdown">
      <a class="nav-link text-success" data-toggle="dropdown" href="#">
        <i class="far fa-user"></i> {{ Auth::user()->name }}
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
        </form>
      </div>  
    </li>

    <li class="nav-item">
        <a class="nav-link text-danger" href="{{ route('logout') }}"
            onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">
            <i class="fa fa-power-off"></i>
        </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </li>








      <?php 
      /*
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
      */ ?>
    </ul>
