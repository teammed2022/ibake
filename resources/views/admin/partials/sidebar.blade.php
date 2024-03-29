

<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
    <a class="sidebar-brand brand-logo" href="/"><img src="{{ asset('admin/assets/images/logo.png') }}"
        alt="logo" /></a>
    <a class="sidebar-brand brand-logo-mini" href="/redirect"><img src="{{ asset('admin/assets/images/logo-mini.png') }}"
        alt="logo" /></a>
  </div>
  <ul class="nav">
    <li class="nav-item profile">
      <div class="profile-desc">
        <div class="profile-pic">
          <div class="count-indicator">
            <img class="img-xs rounded-circle " src="{{ asset('admin/assets/images/faces/face.jpg') }}" alt="">
            <span class="count bg-success"></span>
          </div>
          <div class="profile-name">

            @if (auth()->check())
            <h5 class="mb-0 font-weight-normal">Hi {{ auth()->user()->firstname }}!</h5>
            @endif

            <span>
              @php
              $userType = auth()->user()->role_id;
              @endphp

              @if ($userType == '1')
              <p>Adminstrator</p>
              @elseif($userType == '3')
              <p>Business Manager</p>
              @elseif($userType == '2')
              <p>Customer</p>
              @elseif($userType == '4')
              <p>Business Owner</p>
              @elseif($userType == '5')
              <p>Baker</p>
              @elseif($userType == '6')
              <p>Designer</p>
              @else
              <p>Guest</p>
              @endif

              <a href="{{ route('home') }}" class="btn btn-light">
                  <i class="fas fa-home"></i> Return
              </a>
              
            </span>

          </div>
        </div>
        <a href="#" id="profile-dropdown" data-bs-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></a>
        <div class="dropdown-menu dropdown-menu-right sidebar-dropdown preview-list" aria-labelledby="profile-dropdown">
          <a href="#" class="dropdown-item preview-item">
            <div class="preview-thumbnail">
              <div class="preview-icon bg-dark rounded-circle">
                <i class="mdi mdi-settings text-primary"></i>
              </div>
            </div>
            <div class="preview-item-content">
              <p class="preview-subject ellipsis mb-1 text-small">Account settings</p>
            </div>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item preview-item">
            <div class="preview-thumbnail">
              <div class="preview-icon bg-dark rounded-circle">
                <i class="mdi mdi-onepassword  text-info"></i>
              </div>
            </div>
            <div class="preview-item-content">
              <p class="preview-subject ellipsis mb-1 text-small">Change Password</p>
            </div>
          </a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item preview-item" a href="{{ route('logout') }}"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <div class="preview-thumbnail">
              <div class="preview-icon bg-dark rounded-circle">
                <i class="mdi mdi-logout-variant"></i>
              </div>
            </div>
            <div class="preview-item-content">
              <p class="preview-subject ellipsis mb-1 text-small">Logout</p>
            </div>
          </a>
          <!-- Form - logout function-->
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
          </form>
        </div>
      </div>
    </li>
    <li class="nav-item nav-category">
      <span class="nav-link">Navigation</span>
    </li>
    @if ($userType == '3' || $userType == '4')
    <li class="nav-item menu-items">
      <a class="nav-link" href="/redirect">
        <span class="menu-icon">
          <i class="mdi mdi-speedometer"></i>
        </span>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    @endif
  
    @if ($userType == '3' || $userType == '4'|| $userType == '5'|| $userType == '6')
    <li class="nav-item menu-items">
      <a class="nav-link" data-bs-toggle="collapse" href="#orders" aria-expanded="false" aria-controls="orders">
        <span class="menu-icon">
          <i class="mdi mdi-basket"></i>
        </span>
        <span class="menu-title">Orders</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="orders">
        <ul class="nav flex-column sub-menu">
          @if ($userType != '2' && $userType != '5' && $userType != '6')
          <li class="nav-item"><a class="nav-link" href="{{ route('customOrders') }}">Custom Cake Requests</a></li>
          @endif
          <li class="nav-item">
          <a class="nav-link" href="{{ route('activeOrders') }}">Pending Orders</a>

          </li>
          <li class="nav-item"><a class="nav-link" href="{{ route('ongoingOrders') }}">In Progress Orders</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('readyOrders') }}">Dispatched Orders</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('completedOrders') }}">Completed Orders</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('cancelledOrders') }}">Cancelled Orders</a></li>
        </ul>
      </div>
    </li>
    @endif

    @if ($userType == '1' || $userType == '3' || $userType == '4')
    <li class="nav-item menu-items">
      <a class="nav-link" data-bs-toggle="collapse" href="#users" aria-expanded="false" aria-controls="users">
        <span class="menu-icon">
          <i class="mdi mdi-account"></i>
        </span>
        <span class="menu-title">User Management</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="users">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="{{ route('user.list') }}">Users</a></li>
          @if ($userType == '1' || $userType == '4')
          <li class="nav-item"> <a class="nav-link" href="{{ route('user.form') }}">Add User</a></li>
          @endif
        </ul>
      </div>
    </li>
    @endif

    @if ($userType == '3' || $userType == '4')
    <li class="nav-item menu-items">
      <a class="nav-link" data-bs-toggle="collapse" href="#products" aria-expanded="false" aria-controls="products">
        <span class="menu-icon">
          <i class="mdi mdi-view-list"></i>
        </span>
        <span class="menu-title">Products</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="products">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"><a class="nav-link" href="{{ route('admin.viewCategories') }}">Categories</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('admin.viewTags') }}">Tags</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('admin.viewProducts') }}">View Products</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('admin.viewAddProducts') }}">Add a product</a></li>
        </ul>
      </div>
    </li>
    @endif

    @if ($userType == '3' || $userType == '4')
    <li class="nav-item menu-items">
      <a class="nav-link" data-bs-toggle="collapse" href="#customcake" aria-expanded="false" aria-controls="customcake">
        <span class="menu-icon">
        <i class="mdi mdi-cake"></i>
        </span>
        <span class="menu-title">Custom Cake</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="customcake">
        <ul class="nav flex-column sub-menu">
        <li class="nav-item"><a class="nav-link" href="{{ route('viewCakeBuilder') }}">Cake Builder</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('viewCakeComponents') }}">Cake Components</a></li>
        </ul>
      </div>
    </li>
    @endif

    {{--<li class="nav-item menu-items">
      <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
        <span class="menu-icon">
          <i class="mdi mdi-laptop"></i>
        </span>
        <span class="menu-title">Gallery</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="ui-basic">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="admin/pages/ui-features/buttons.html">Buttons</a>
          </li>
          <li class="nav-item"> <a class="nav-link" href="admin/pages/ui-features/dropdowns.html">Dropdowns</a></li>
          <li class="nav-item"> <a class="nav-link" href="admin/pages/ui-features/typography.html">Typography</a></li>
        </ul>
      </div>
    </li>--}}

    @if ($userType == '3' || $userType == '4')
    <li class="nav-item menu-items">
      <a class="nav-link" data-bs-toggle="collapse" href="#reports" aria-expanded="false" aria-controls="reports">
        <span class="menu-icon">
          <i class="mdi mdi-table-large"></i>
        </span>
        <span class="menu-title">Reports</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="reports">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"><a class="nav-link" href="{{ route('viewReview') }}">Product Reviews</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('viewCustomReviews') }}">Custom Order Reviews</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('ViewCustomerRecords') }}">Customer Records</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('shopOrders') }}">Shop Orders List</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('customOrderSummary') }}">Custom Orders List</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('viewSalesReport') }}">Sales Report</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('transactionRecords') }}">Transaction Record</a></li>
        </ul>
      </div>
    </li>
    @endif

    {{--<li class="nav-item menu-items">
      <a class="nav-link" href="admin/pages/charts/chartjs.html">
        <span class="menu-icon">
          <i class="mdi mdi-chart-bar"></i>
        </span>
        <span class="menu-title">Charts</span>
      </a>
    </li>--}}

    @if ($userType == '1')
    <li class="nav-item menu-items">
      <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
        <span class="menu-icon">
          <i class="mdi mdi-security"></i>
        </span>
        <span class="menu-title">Settings</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="auth">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="{{ route('viewSystemSettings') }}">System
            </a></li>

        </ul>
      </div>
    </li>
      @endif

    {{--<li class="nav-item menu-items">
      <a class="nav-link" href="http://www.bootstrapdash.com/demo/corona-free/jquery/documentation/documentation.html">
        <span class="menu-icon">
          <i class="mdi mdi-file-document-box"></i>
        </span>
        <span class="menu-title">Documentation</span>
      </a>
    </li>--}}
  </ul>
</nav>
