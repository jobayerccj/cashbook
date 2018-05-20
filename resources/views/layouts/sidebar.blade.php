<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <i class="fa fa-user fa-3x" aria-hidden="true" style="color: #fff"></i>

        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->name }}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active">
          <a href="{{ url('/'.LaravelLocalization::getCurrentLocale().'/home') }}">
            <i class="fa fa-book"></i> <span>My Cashbook</span>
          </a>

        </li>


        <li class="treeview">
          <a href="#">
            <i class="fa fa-user"></i>
            <span>User Manager</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ url('/'.LaravelLocalization::getCurrentLocale().'/user-list') }}"><i class="fa fa-circle-o"></i> User List</a></li>
            <li><a href="{{ url('/'.LaravelLocalization::getCurrentLocale().'/register') }}"><i class="fa fa-circle-o"></i> User Add</a></li>

          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-cogs"></i>
            <span>Settings</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ url('/languages') }}"><i class="fa fa-circle-o"></i> Languages</a></li>
            

          </ul>
        </li>

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
