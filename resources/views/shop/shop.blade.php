<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>iBake - Tiers of Joy | Shop</title>

  @include('partials.head')



</head>

<body>

  <div class="page-wrapper">

    <!-- Preloader -->
    @include('partials.preloader')

    <!-- Main Header-->
    @include('partials.navbar')
    <!--End Main Header -->


    <!--Page Title-->
    <section class="page-title" style="background-image:url({{ asset('images/background/background-6.jpg') }})">
      <div class="auto-container">
        <h1>Shop</h1>
        <ul class="page-breadcrumb">
          <li><a href="\">home</a></li>
          <li>Shop</li>
        </ul>
      </div>
    </section>
    <!--End Page Title-->

    <!--Sidebar Page Container-->
    <div class="sidebar-page-container">
      <div class="auto-container">
      @if($errors->has('cart'))
          <div class="alert alert-danger alert-dismissible fade show">
              {{ $errors->first('cart') }}
              <button type="button" class="close" data-dismiss="alert">
                  <span>&times;</span>
              </button>
          </div>
      @endif
        <div class="row clearfix">
                    <!--Default Links-->
                    <div class="default-links">
                    <div class="message-box with-icon info">
                        <div class="icon-box"><span class="icon fa fa-info"></span></div> Welcome to iBake Tiers of Joy! We deliver to all areas within Nueva Vizcaya.
                        You can also pick up your order at our <a href="{{ route('faqs') }}">shop</a>. 
                        <button class="close-btn"><span class="fa fa-times"></span></button>
                    </div>
                    </div>

          {{-- <option value="popularity" {{ session('sort-order')=='popularity' ? 'selected' : '' }}>
            Sort by popularity
          </option>
          <option value="rating" {{ session('sort-order')=='rating' ? 'selected' : '' }}>
            Sort by average rating
          </option>
          <option value="date" {{ session('sort-order')=='date' ? 'selected' : '' }}>
            Sort by newness
          </option> --}}
          
          <!--Content Side-->
          <div class="content-side col-lg-9 col-md-12 col-sm-12">
            <div class="our-shop">
              <div class="shop-upper-box clearfix">
                <div class="items-label">Showing all {{ count($products) }} results</div>

                <form method="post" action="{{ route('sortProducts') }}" id="searchForm">
                    @csrf

                    <div class="orderby">
                        <select name="sort-order" class="sortby-select" id="sort-order-select">
                            <option value="" disabled selected>Sort by</option>
                            <option value="created_at">Sort by newness</option>
                            <option value="rating">Sort by average rating</option>
                            <option value="availability">Sort by availability</option>
                            <option value="price-asc">Sort by price: low to high</option>
                            <option value="price-desc">Sort by price: high to low</option>
                        </select>
                    </div>
                </form>


                
              </div>


              <div class="row clearfix product-cards-container">
                @include('shop.shop-item-card')
              </div>
                  <!-- Pagination Links -->
                  <div class="pagination-wrap">
                
                  <div class="pagination-wrap">
                  {{ $products->appends(request()->query())->links() }}
                  </div>


                  </div>




            </div>
          </div>

              

          <!--Sidebar Side-->
          <div class="sidebar-side sticky-container col-lg-3 col-md-12 col-sm-12">
            <aside class="sidebar theiaStickySidebar">
              <div class="sticky-sidebar">
                <!-- Search Widget -->
                <div class="sidebar-widget search-widget">
                <form method="post" action="{{ route('searchProducts') }}">
                    @csrf
                    <div class="form-group">
                    <input type="search" name="query" value="" placeholder="@if(isset($query) && $query !== null){{ $query }}@else Search products…@endif" required>
                      <button type="submit"><span class="icon fa fa-search"></span></button>
                    </div>
                </form>
                  
                </div>
     

                <!-- Cart Widget -->
                <div class='sidebar-widget cart-widget' id="cart-widget-container">
                  <div class="widget-content">
                    <h3 class="widget-title">Cart</h3>
                    <div class="shopping-cart">
                      <h4>No Items in cart.</h4>
                    </div>
                    <!--end shopping-cart -->
                  </div>
                </div>

                <!-- Tags Widget -->
                
                    <div class="sidebar-widget tags-widget">
                        <h3 class="widget-title">Categories</h3>
                        <ul class="tag-list clearfix">
                        <form method="post" action="{{ route('filterCategories') }}">
                            @csrf
                                <li>
                                <a>
                                    <button type="submit" name="category" value="All" style="color: white; background-color: yourBackgroundColor;">
                                        All
                                    </button>
                                </a>
                                </li>
                            
                            @foreach ($categoryNames as $categoryName)
                                <li>
                                  <a>
                                    <button type="submit" name="category" value="{{ $categoryName }}" style="color: white; background-color: yourBackgroundColor;">
                                        {{ $categoryName }}
                                    </button>
                                  </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                      </form>
 

                <!-- Range Slider Widget -->
                {{--<div class="sidebar-widget rangeslider-widget">
                  <div class="widget-content">
                    <h3 class="widget-title">Price Filter</h3>

                    <div class="range-slider-one clearfix">
                      <div class="clearfix">
                        <div class="pull-left input-box">
                          <!-- Max Price Filter -->
                          <div class="form-group">
                            <label for="min-price">Min. Price: </label>
                            <input type="number" class="form-control" id="min-price" name="min-price"
                              placeholder="Min. Price" value="0">
                          </div>

                          <!-- Max Price Filter -->
                          <div class="form-group">
                            <label for="max-price">Max. Price: </label>
                            <input type="number" class="form-control" id="max-price" name="max-price"
                              placeholder="Max Price:" value="10000">
                          </div>
                        </div>

                        Show an error if the min/max price entered is not numeric
                        @if ($errors->has('max-price') || $errors->has('min-price'))
                        <span class="text-red-500">Please enter a numeric value</span>
                        @endif

                        <div class="pull-left btn-box">
                          <button class="theme-btn" id="filter-shop" name="filter"><span
                              class="btn-title">Filter</span></button>
                        </div>
                        <div class="pull-right btn-box">
                          <button class="theme-btn" id="view-all-shop" name="view-all">
                            <span class="btn-title">View All</span></button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div> --}}

                

              </div>
            </aside>
          </div>
        </div>
      </div>
    </div>
    <!--End Sidebar Page Container-->



    <!-- Main Footer -->
    @include('shop.shop-footer')
    <!-- End Footer -->

  </div><!-- End Page Wrapper -->

  <!-- Scroll To Top -->
  <div class="scroll-to-top scroll-to-target" data-target="html">
    <svg viewBox="0 0 500 500">
      <path
        d="M488.5,274.5L488.5,274.5l1.8-0.5l-2,0.5c-2.4-8.7-4.5-16.9-4.5-24.5c0-8,2.3-16.5,4.7-25.5
        c3.5-13,7.1-26.5,3.7-39.5c-3.6-13.2-13.5-23.1-23.1-32.7c-6.5-6.5-12.6-12.6-16.6-19.4c-3.9-6.8-6.1-15.2-8.5-24.1
        c-3.5-13.1-7.1-26.7-16.7-36.3c-9.5-9.5-22.9-13.1-35.9-16.6c-9-2.4-17.5-4.6-24.4-8.7c-6.5-3.8-12.5-9.8-18.9-16.2
        c-9.7-9.8-19.6-19.8-33.2-23.4c-13.5-3.7-27.3,0.1-40.4,3.7c-8.7,2.4-16.9,4.6-24.5,4.6c-8,0-16.5-2.3-25.5-4.7
        c-9.3-2.5-18.8-5-28.1-5c-3.8,0-7.6,0.4-11.3,1.4C172,11.1,162,21.1,152.4,30.7c-6.5,6.5-12.6,12.6-19.4,16.6
        c-6.8,3.9-15.2,6.1-24.1,8.5c-13.1,3.5-26.7,7.1-36.3,16.7c-9.5,9.5-13.1,23-16.6,36c-2.4,9-4.6,17.5-8.7,24.4
        c-3.8,6.5-9.8,12.5-16.2,18.9c-9.8,9.7-19.7,19.6-23.4,33.2c-3.7,13.5,0.1,27.3,3.7,40.5c2.4,8.7,4.6,16.9,4.6,24.5
        c0,8-2.3,16.5-4.6,25.5c-3.5,13-7.1,26.6-3.7,39.5c3.6,13.2,13.5,23.1,23.1,32.7c6.5,6.5,12.6,12.6,16.6,19.4
        c3.9,6.8,6.1,15.1,8.5,24c3.5,13.1,7.1,26.8,16.7,36.4c9.5,9.5,23,13.1,35.9,16.6c9,2.4,17.5,4.6,24.4,8.7
        c6.5,3.8,12.5,9.8,18.9,16.2c9.7,9.8,19.6,19.8,33.2,23.5c3.8,1,7.6,1.5,11.8,1.5c9.6,0,19.3-2.7,28.5-5.1c8.8-2.4,17-4.6,24.5-4.6 c8,0,16.5,2.3,25.5,4.6c13,3.6,26.6,7.1,39.5,3.7c13.2-3.6,23.1-13.5,32.7-23.1c6.5-6.5,12.6-12.6,19.4-16.6 c6.7-3.9,15.1-6.1,24-8.5c13.1-3.5,26.8-7.1,36.4-16.8c9.5-9.5,13.1-23,16.6-36c2.4-9,4.6-17.5,8.7-24.4c3.8-6.5,9.8-12.5,16.2-18.9 c9.8-9.7,19.9-19.7,23.6-33.3C495.7,301.4,494.4,287.7,488.5,274.5z">
      </path>
    </svg>
    <span class="fa fa-angle-up"></span>
  </div>

<script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('js/popper.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('js/jquery.fancybox.js') }}"></script>
<script src="{{ asset('js/owl.js') }}"></script>
<script src="{{ asset('js/wow.js') }}"></script>
<script src="{{ asset('js/appear.js') }}"></script>
<script src="{{ asset('js/select2.min.js') }}"></script>
<script src="{{ asset('js/sticky_sidebar.min.js') }}"></script>
<script src="{{ asset('js/script.js') }}"></script>

<script src="//code.tidio.co/rxspxjqfeocjtadtyjrdmxudlhr0m8vc.js" async></script>


<script>
  $(document).ready(function () {
    $('#sort-order-select').change(function () {
        console.log('Dropdown value changed'); // Add this line for debugging
        $('#searchForm').submit();
    });
});
</script>

<script src="{{ asset('js/shop.js') }}?v={{ filemtime(public_path('js/shop.js')) }}"></script>

</script>

</body>

</html>