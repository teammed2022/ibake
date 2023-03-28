<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>iBake - Tiers of Joy | Shop Single</title>
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
        <section class="page-title" style="background-image:url(https://via.placeholder.com/1920x400)">
            <div class="auto-container">
                <h1>Birthday Cake</h1>
                <ul class="page-breadcrumb">
                    <li><a href="{{ route('home') }}">home</a></li>
                    <li><a href="{{ route('shop') }}">Products</a></li>
                    <li>Birthday Cake</li>
                </ul>
            </div>
        </section>
        <!--End Page Title-->

        <!--Sidebar Page Container-->
        <div class="sidebar-page-container">
            <div class="auto-container">
                <div class="row clearfix">

                    <!--Content Side-->
                    <div class="content-side col-lg-9 col-md-12 col-sm-12">
                        <div class="shop-single">
                            <!-- Product Detail -->
                            <div class="product-details">
                                <!--Basic Details-->
                                <div class="basic-details">
                                    <div class="row clearfix">
                                        <div class="image-column col-md-6 col-sm-12">
                                            <figure class="image"><a href="https://via.placeholder.com/1000x1000"
                                                    class="lightbox-image" title="Image Caption Here"><img
                                                        src="https://via.placeholder.com/1000x1000" alt=""><span
                                                        class="icon fa fa-search"></span></a></figure>
                                        </div>
                                        <div class="info-column col-md-6 col-sm-12">
                                            <div class="details-header">
                                                <h4>Birthday Cake</h4>
                                                <div class="rating">
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                </div>
                                                <a class="reviews" href="#">(2 Customer Reviews)</a>
                                                <div class="item-price">$84.00</div>
                                                <div class="text">Accumsan lectus, consectetuer et sagittis et
                                                    commodo, massa et, sed facilisi mi, sit diam. Ultrices facilisi
                                                    convallis nullam duis. Aliquam lacinia orci convallis erat ac, vitae
                                                    neque in class.</div>
                                            </div>

                                            <div class="other-options clearfix">
                                                <div class="item-quantity">Quantity <input class="qty" type="number"
                                                        value="1" name="quantity"></div>
                                                <button type="button" class="theme-btn add-to-cart"><span
                                                        class="btn-title">Add To Cart</span></button>
                                                <ul class="product-meta">
                                                    <li class="posted_in">Category: <a href="#">Cake</a></li>
                                                    <li class="tagged_as">Tag: <a href="#">Nuts</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--Basic Details-->

                                <!--Product Info Tabs-->
                                <div class="product-info-tabs">
                                    <!--Product Tabs-->
                                    <div class="prod-tabs tabs-box">

                                        <!--Tab Btns-->
                                        <ul class="tab-btns tab-buttons clearfix">
                                            <li data-tab="#prod-details" class="tab-btn">Descripton</li>
                                            <li data-tab="#prod-reviews" class="tab-btn active-btn">Review (2)</li>
                                        </ul>

                                        <!--Tabs Container-->
                                        <div class="tabs-content">

                                            <!--Tab-->
                                            <div class="tab" id="prod-details">
                                                <h2 class="title">Descripton</h2>
                                                <div class="content">
                                                    <p>Accumsan lectus, consectetuer et sagittis et commodo, massa et,
                                                        sed facilisi mi, sit diam. Ultrices facilisi convallis nullam
                                                        duis. Aliquam lacinia orci convallis erat ac, vitae neque in
                                                        class. Suscipit vel, rhoncus est quis nibh netus, aenean
                                                        eleifend et viverra, neque accumsan maecenas nec in. Morbi
                                                        bibendum non ullamcorper aliquam natoque, tortor dui, vestibulum
                                                        vulputate pulvinar iaculis magna lectus ut, facilisis id mollis
                                                        risus lorem. Massa nulla cum nunc litora ac amet, accumsan
                                                        faucibus integer, vestibulum turpis cras, ante imperdiet
                                                        tincidunt accumsan, vivamus lacinia bibendum augue maiores
                                                        mauris.</p>
                                                </div>
                                            </div>

                                            <!--Tab-->
                                            <div class="tab active-tab" id="prod-reviews">
                                                <h2 class="title">2 reviews for Birthday Cake</h2>
                                                <!--Reviews Container-->
                                                <div class="comments-area">
                                                    <!--Comment Box-->
                                                    <div class="comment-box">
                                                        <div class="comment">
                                                            <div class="author-thumb"><img
                                                                    src="https://via.placeholder.com/60x60"
                                                                    alt=""></div>
                                                            <div class="comment-inner">
                                                                <div class="comment-info clearfix">
                                                                    <strong class="name">Stuart</strong>
                                                                    <span class="date">– 07 Jun</span>
                                                                </div>
                                                                <div class="rating">
                                                                    <span class="fa fa-star"></span>
                                                                    <span class="fa fa-star"></span>
                                                                    <span class="fa fa-star"></span>
                                                                    <span class="fa fa-star"></span>
                                                                    <span class="fa fa-star light"></span>
                                                                </div>
                                                                <div class="text">This will go great with my Hoodie
                                                                    that I ordered a few weeks ago.</div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!--Comment Box-->
                                                    <div class="comment-box">
                                                        <div class="comment">
                                                            <div class="author-thumb"><img
                                                                    src="https://via.placeholder.com/60x60"
                                                                    alt=""></div>
                                                            <div class="comment-inner">
                                                                <div class="comment-info clearfix">
                                                                    <strong class="name">Maria</strong>
                                                                    <span class="date">– 07 Jun</span>
                                                                </div>
                                                                <div class="rating">
                                                                    <span class="fa fa-star"></span>
                                                                    <span class="fa fa-star"></span>
                                                                    <span class="fa fa-star"></span>
                                                                    <span class="fa fa-star"></span>
                                                                    <span class="fa fa-star light"></span>
                                                                </div>
                                                                <div class="text">Love this shirt! The ninja near and
                                                                    dear to my heart.</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!--Comment Form-->
                                                <div class="comment-form">
                                                    <div class="sub-title">Add a review</div>
                                                    <div class="form-outer">
                                                        <p>Your email address will not be published. Required fields are
                                                            marked *</p>
                                                        <div class="rating-box">
                                                            <div class="field-label">Your Rating</div>
                                                            <div class="rating">
                                                                <a href="#"><span class="fa fa-star"></span></a>
                                                                <a href="#"><span class="fa fa-star"></span></a>
                                                                <a href="#"><span class="fa fa-star"></span></a>
                                                                <a href="#"><span class="fa fa-star"></span></a>
                                                                <a href="#"><span class="fa fa-star"></span></a>
                                                            </div>
                                                        </div>
                                                        <form method="post" action="blog-showcase.html">
                                                            <div class="row clearfix">
                                                                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                                                    <div class="field-label">Your review *</div>
                                                                    <textarea name="message" placeholder=""></textarea>
                                                                </div>

                                                                <div class="col-lg-6 col-md-12 col-sm-12 form-group">
                                                                    <div class="field-label">Name *</div>
                                                                    <input type="text" name="username"
                                                                        placeholder="" required="">
                                                                </div>

                                                                <div class="col-lg-6 col-md-12 col-sm-12 form-group">
                                                                    <div class="field-label">Email *</div>
                                                                    <input type="email" name="email"
                                                                        placeholder="" required="">
                                                                </div>

                                                                <div
                                                                    class="col-lg-12 col-md-12 col-sm-12 form-group text-right">
                                                                    <input type="submit" name="submit"
                                                                        value="Submit">
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--End Product Info Tabs-->

                                <!-- Related Products -->
                                <div class="related-products">
                                    <div class="sec-title">
                                        <h2>Related products</h2>
                                    </div>

                                    <div class="row clearfix">
                                        <!-- Shop Item -->
                                        <div class="shop-item col-lg-4 col-md-6 col-sm-12">
                                            <div class="inner-box">
                                                <div class="image-box">
                                                    <div class="sale-tag">sale!</div>
                                                    <figure class="image"><a href="shop-single.html"><img
                                                                src="https://via.placeholder.com/300x300"
                                                                alt=""></a></figure>
                                                    <div class="btn-box"><a href="shopping-cart.html">Add to cart</a>
                                                    </div>
                                                </div>
                                                <div class="lower-content">
                                                    <h4 class="name"><a href="shop-single.html">French Macaroon</a>
                                                    </h4>
                                                    <div class="rating"><span class="fa fa-star"></span><span
                                                            class="fa fa-star"></span><span
                                                            class="fa fa-star"></span><span
                                                            class="fa fa-star"></span><span
                                                            class="fa fa-star light"></span></div>
                                                    <div class="price">$17.00</div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Shop Item -->
                                        <div class="shop-item col-lg-4 col-md-6 col-sm-12">
                                            <div class="inner-box">
                                                <div class="image-box">
                                                    <figure class="image"><a href="shop-single.html"><img
                                                                src="https://via.placeholder.com/300x300"
                                                                alt=""></a></figure>
                                                    <div class="btn-box"><a href="shopping-cart.html">Add to cart</a>
                                                    </div>
                                                </div>
                                                <div class="lower-content">
                                                    <h4 class="name"><a href="shop-single.html">Happy Ninja</a></h4>
                                                    <div class="rating"><span class="fa fa-star"></span><span
                                                            class="fa fa-star"></span><span
                                                            class="fa fa-star"></span><span
                                                            class="fa fa-star"></span><span
                                                            class="fa fa-star light"></span></div>
                                                    <div class="price">$35.00</div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Shop Item -->
                                        <div class="shop-item col-lg-4 col-md-6 col-sm-12">
                                            <div class="inner-box">
                                                <div class="image-box">
                                                    <figure class="image"><a href="shop-single.html"><img
                                                                src="https://via.placeholder.com/300x300"
                                                                alt=""></a></figure>
                                                    <div class="btn-box"><a href="shopping-cart.html">Add to cart</a>
                                                    </div>
                                                </div>
                                                <div class="lower-content">
                                                    <h4 class="name"><a href="shop-single.html">Hearts Lollipop</a>
                                                    </h4>
                                                    <div class="rating"><span class="fa fa-star"></span><span
                                                            class="fa fa-star"></span><span
                                                            class="fa fa-star"></span><span
                                                            class="fa fa-star"></span><span
                                                            class="fa fa-star light"></span></div>
                                                    <div class="price">$17.00</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- End Related Products -->
                            </div><!-- Product Detail -->
                        </div><!-- End Shop Single -->
                    </div>

                    <!--Sidebar Side-->
                    @include('partials.shop-')
                </div>
            </div>
        </div>
        <!--End Sidebar Page Container-->

        <!-- Main Footer -->
        @include('partials.footer')

    </div><!-- End Page Wrapper -->

    <!-- Scroll To Top -->
    @include('partials.scroll_to_up')

    <script src="js/jquery.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/jquery.fancybox.js"></script>
    <script src="js/owl.js"></script>
    <script src="js/wow.js"></script>
    <script src="js/appear.js"></script>
    <script src="js/select2.min.js"></script>
    <script src="js/sticky_sidebar.min.js"></script>
    <script src="js/script.js"></script>
</body>

</html>