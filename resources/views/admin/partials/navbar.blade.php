@php
    $userType = auth()->user()->role_id;
@endphp

<nav class="navbar p-0 fixed-top d-flex flex-row">
    <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
        <a class="navbar-brand brand-logo-mini" href="/"><img src="{{ asset('admin/assets/images/logo-mini.png') }}"
                alt="logo" /></a>
    </div>

    <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
        </button>

        <ul class="navbar-nav navbar-nav-right">
        @if ($userType == '3' || $userType == '4')
            <li class="nav-item dropdown d-none d-lg-block">
                <a href="{{ route('customOrders') }}" class="nav-link btn btn-primary create-new-button">
                    <i class="fas fa-eye"></i> View Order Requests
                </a>
            </li>

            <li class="nav-item dropdown d-none d-lg-block">
                <a href="{{ route('admin.viewProducts') }}" class="nav-link btn btn-success create-new-button">
                    <i class="fas fa-cogs"></i> Manage Products
                </a>
            </li>

            <li class="nav-item dropdown d-none d-lg-block">
                <a href="{{ route('admin.viewAddProducts') }}" class="nav-link btn btn-warning create-new-button">
                    <i class="fas fa-plus-circle"></i> Add New Product
                </a>
            </li>
        @endif

        

            <li class="nav-item nav-settings d-none d-lg-block">
                <a class="nav-link" href="#">
                    <i class="mdi mdi-view-grid"></i>
                </a>
            </li>


            <li class="nav-item dropdown">
                <a class="nav-link" id="profileDropdown" href="#" data-bs-toggle="dropdown">
                    <div class="navbar-profile">
                        <img class="img-xs rounded-circle" src="{{ asset('admin/assets/images/faces/face.jpg') }}"
                            alt="">
                        @if (auth()->check())
                            <p class="mb-0 d-none d-sm-block navbar-profile-name">{{ auth()->user()->firstname }}</p>
                        @endif
                        <i class="mdi mdi-menu-down d-none d-sm-block"></i>
                    </div>
                </a>

                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                    aria-labelledby="profileDropdown">
                    <h6 class="p-3 mb-0">Profile</h6>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('home') }}" class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                            <div class="preview-icon bg-dark rounded-circle">
                                <i class="mdi mdi-home text-success"></i>
                            </div>
                        </div>
                        <div class="preview-item-content">
                            <p class="preview-subject mb-1">Home</p>
                        </div>
                    </a>

                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item preview-item" href="{{ route('switch') }}">
                        <div class="preview-thumbnail">
                            <div class="preview-icon bg-dark rounded-circle">
                                <i class="mdi mdi-account-switch text-primary"></i>
                            </div>
                        </div>
                        <div class="preview-item-content">
                            <p class="preview-subject mb-1">Switch User</p>
                        </div>
                    </a>


                    <div class="dropdown-divider"></div>
                    <!-- Includes logout function-->
                    <a class="dropdown-item preview-item"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <div class="preview-thumbnail">
                            <div class="preview-icon bg-dark rounded-circle">
                                <i class="mdi mdi-logout text-danger"></i>
                            </div>
                        </div>
                        <div class="preview-item-content">
                            <p class="preview-subject mb-1">Log out</p>
                        </div>
                    </a>
                    <!-- Form - logout function-->
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                  

                </div>
            </li>

    </div>
    </li>

    </ul>
    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
        data-toggle="offcanvas">
        <span class="mdi mdi-format-line-spacing"></span>
    </button>

</nav>
