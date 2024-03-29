<!DOCTYPE html>
<html lang="en">

<head>
  @include('admin.partials.head')
  <link rel="stylesheet" href="{{ asset('admin/assets/css/custom.css') }}">
</head>

<body>
  <div class="container-scroller">
    <!-- partial:sidebar -->
    @include('admin.partials.sidebar')

    <!-- partial:navbar -->
    @include('admin.partials.navbar')

    <!-- users main panel -content-->
    <div class="main-panel">
      <div class="content-wrapper">



        <!-- page breadcrumb-->
        <div class="page-header">
          <ol class="breadcrumb">
            <li class="breadcrumb-item custom-breadcrumb">Products</li>
            <li class="breadcrumb-item custom-breadcrumb" aria-current="page">View Products</li>
          </ol>
        </div>

        <div class="col-lg-11 grid-margin stretch-card mx-auto">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-center">
                <h4 class="card-title">Products List</h4>
                <div class="d-flex">
                <a href="{{ route('admin.addProducts') }}" class="btn btn-primary me-2">+ Add Product</a>
                <a href="{{ route('exportProductsData') }}" target="__blank" class="btn btn-success me-2">
                      <i class="fas fa-download"></i> Export
                  </a>
                </div>
             
              </div>
              <div class="col-lg-3">
                <div class="input-group mb-3">
                  <input type="text" class="form-control" id="product-search-input" placeholder="Search"
                    aria-label="Search" aria-describedby="search-button">
                  <button class="btn btn-outline-secondary" type="button" id="reset-search-btn">Reset</button>
                 
                </div>
                <h6><span>Remaining Inventory: </span>₱ {{number_format($totalInventoryValue, 2)}}</h6>
                <div class="mt-2id=" product-list-msg"></div>
              </div>
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th class="sortable" id="id" data-sort="id">ID <i class="sort-icon mdi mdi-sort"></i></th>
                      <th class="sortable" id="image" data-sort="image">Image</th>
                      <th class="sortable" id="sort-name" data-sort="name">Product Name <i class="sort-icon mdi mdi-sort"></i></th>
                      <th class="sortable" id="sort-price" data-sort="price">Price <i class="sort-icon mdi mdi-sort"></i></th>
                      <th class="sortable" id="sort-category" data-sort="categories.name">Category <i class="sort-icon mdi mdi-sort"></i></th>
                      <th class="sortable" id="sort-rate" data-sort="rating">Rating <i class="sort-icon mdi mdi-sort"></i></th>
                      <th class="sortable" id="sort-isfeatured" data-sort="isfeatured">is Featured <i class="sort-icon mdi mdi-sort"></i></th>
                      <th class="sortable" id="sort-available" data-sort="availability">Availability <i class="sort-icon mdi mdi-sort"></i></th>
                      <th class="sortable" id="sort-qty" data-sort="available_qty">inStock Qty <i class="sort-icon mdi mdi-sort"></i></th>
                      <th></th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody id='product-table-body'>
                    @include('admin.pages.products.products-list-table')
                  </tbody>
                </table>
                <!-- Pagination Links -->
                {{ $products->links() }}
              </div>
            </div>
          </div>
        </div>

      </div>
      @include('admin.partials.footer')
      <!-- main-panel ends -->
    </div>

    <!-- page-body-wrapper ends -->
  </div>

  <!-- Product Image Modal -->
  <div class="modal fade" id="productImageModal" tabindex="-1" role="img" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modal-title"></h5>
        </div>
        <div class="modal-body" id="modal-body">
          <img class="rounded mx-auto d-block" id="product-image" src="">
        </div>
      </div>
    </div>
  </div>
  <!-- Product Image Modal End -->

  <!-- plugins:js -->
  @include('admin.partials.script')
  <script src="{{ asset('admin/assets/js/admin-products.js') }}?v={{ filemtime(public_path('admin/assets/js/admin-products.js')) }}"></script>
  <!-- CSS -->

  <!-- JavaScript -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>