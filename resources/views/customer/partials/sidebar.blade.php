<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
    <a class="sidebar-brand brand-logo" href="/redirect"><img src="{{ asset('admin/assets/images/logo.png') }}"
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
            <h5 class="mb-0 font-weight-normal">Hi {{ auth()->user()->firstname }} {{ auth()->user()->lastname }} !</h5>
            @endif

            <span>
              @php
              $userType = auth()->user()->role_id;
              @endphp

              @if ($userType == '1')
              <p>Adminstrator</p>
              @elseif($userType == '3')
              <p>Manager</p>
              @elseif($userType == '2')
              <p>Customer</p>
              @else
              <p>Staff</p>
              @endif

              <a href="{{ route('home') }}" class="btn btn-light">
                  <i class="fas fa-home"></i> Return
              </a>

            </span>

          </div>
        </div>
        <a href="#settings" id="profile-dropdown" data-bs-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></a>
        <div class="dropdown-menu dropdown-menu-right sidebar-dropdown preview-list" aria-labelledby="profile-dropdown">
          <a href="{{ route('viewCustomerAccount') }}" class="dropdown-item preview-item">
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
          <a href="{{ route('viewCustomerPassword') }}" class="dropdown-item preview-item">
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
      <span class="nav-link">My Account</span>
    </li>
    <li class="nav-item menu-items">
      <a class="nav-link" href="#">
        <span class="menu-icon">
          <i class="mdi mdi-speedometer"></i>
        </span>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    <li class="nav-item menu-items">
      <a class="nav-link" href="#orders" data-bs-toggle="collapse" aria-expanded="false" aria-controls="orders">
        <span class="menu-icon">
          <i class="mdi mdi-basket"></i>
        </span>
        <span class="menu-title">Orders</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="orders">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"><a class="nav-link" href="{{ route('customer') }}">Custom Cake Requests</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('customerActiveOrder') }}">Active Orders</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('customerCompletedOrder') }}">Order History</a></li>

        </ul>
      </div>
    </li>

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
          <li class="nav-item"> <a class="nav-link" href="{{ route('viewCustomerAccount') }}"> Account Profile
            </a></li>
          <li class="nav-item"> <a class="nav-link" href="{{ route('viewCustomerPassword') }}">Change Password</a>
          </li>
        </ul>
      </div>
    </li>

  </ul>
</nav>