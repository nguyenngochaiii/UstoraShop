<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Product</title>

    <!-- Google Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,200,300,700,600' rel='stylesheet'
        type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,100' rel='stylesheet' type='text/css'>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="/themes/ustora/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="/themes/ustora/css/font-awesome.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="/themes/ustora/css/owl.carousel.css">
    <link rel="stylesheet" href="/themes/ustora/style.css">
    <link rel="stylesheet" href="/themes/ustora/css/responsive.css">
</head>

<body>

    @include('partials.header')

    <div class="site-branding-area">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="logo">
                        <h1><a href="./"><img src="/themes/ustora/img/logo.png"></a></h1>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="shopping-item">
                        <a href="{{route('orders.index')}}">Cart - <span class="cart-amunt">${{ $totalPrice }}</span>
                            <i class="fa fa-shopping-cart"></i>
                            <span class="product-count">{{ $countProducts }}</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End site branding area -->

    <div class="mainmenu-area">
        <div class="container">
            <div class="row">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="/">Home</a></li>
                        <li><a href="/products">Shop page</a></li>
                        <li class="active"><a href="/products/{{$product->id}}">Product</a></li>
                        <li><a href="/my-cart">Cart</a></li>
                        <li><a href="checkout">Checkout</a></li>
                        <li><a href="category">Category</a></li>
                        <li><a href="others">Others</a></li>
                        <li><a href="contact">Contact</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div> <!-- End mainmenu area -->

    <div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2>Shop</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-4">

                    <div class="single-sidebar">
                        <h2 class="sidebar-title">Products</h2>
                        @foreach ($products as $singleProduct)
                        <div class="thubmnail-recent">
                            <img src="/themes/ustora/img/{{$singleProduct->image}}.jpg" class="recent-thumb" alt="">
                            <h2><a href="/products/{{$singleProduct->id}}">{{$singleProduct->name}}</a></h2>
                            <div class="product-sidebar-price">
                                <ins>${{$singleProduct->price}}</ins> <del>${{$singleProduct->discount}}</del>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="single-sidebar">
                        <h2 class="sidebar-title">Recent Posts</h2>
                        <ul>
                            @foreach ($products as $singleProduct)
                            <li><a href="/products/{{$singleProduct->id}}">{{$singleProduct->name}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="product-content-right">
                        <div class="product-breadcroumb">
                            <a href="/">Home</a>
                            <a href="/products">Shop</a>
                            <a href="/products/{{$product->id}}">Sony Smart TV - 2020</a>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="product-images">
                                    <div class="product-main-img">
                                        <img src="/themes/ustora/img/{{ $product->image}}.jpg" alt="">
                                    </div>

                                    <div class="product-gallery">
                                        <img src="/themes/ustora/img/product-thumb-1.jpg" alt="">
                                        <img src="/themes/ustora/img/product-thumb-2.jpg" alt="">
                                        <img src="/themes/ustora/img/product-thumb-3.jpg" alt="">
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="product-inner">
                                    <h2 class="product-name">{{ $product->name }}</h2>
                                    <div class="product-inner-price">
                                        <ins>{{ $product->price}}</ins> <del>$100.00</del>
                                    </div>

                                    <form action="" class="cart">
                                        <div class="quantity">
                                            <input type="number" size="4" class="input-text qty text" title="Qty"
                                                value="1" name="quantity" min="1" step="1">
                                        </div>
                                        <button class="add_to_cart_button" type="submit">Add to cart</button>
                                    </form>

                                    <div class="product-inner-category">
                                        <p>Category: <a href="">Summer</a>. Tags: <a href="">{{$product->tag}}</a></p>
                                    </div>

                                    <div role="tabpanel">
                                        <ul class="product-tab" role="tablist">
                                            <li role="presentation" class="active"><a href="#home" aria-controls="home"
                                                    role="tab" data-toggle="tab">Description</a></li>
                                            <li role="presentation"><a href="#profile" aria-controls="profile"
                                                    role="tab" data-toggle="tab">Reviews</a></li>
                                        </ul>
                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane fade in active" id="home">
                                                <h2>Product Description</h2>
                                                <p>{{ $product->description }}</p>
                                            </div>
                                            <div role="tabpanel" class="tab-pane fade" id="profile">
                                                <h2>Reviews</h2>
                                                <div class="submit-review">
                                                    <p><label for="name">Name</label> <input name="name" type="text">
                                                    </p>
                                                    <p><label for="email">Email</label> <input name="email"
                                                            type="email"></p>
                                                    <div class="rating-chooser">
                                                        <p>Your rating</p>

                                                        <div class="rating-wrap-post">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                        </div>
                                                    </div>
                                                    <p><label for="review">Your review</label> <textarea name="review"
                                                            id="" cols="30" rows="10"></textarea></p>
                                                    <p><input type="submit" value="Submit"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>


                        <div class="related-products-wrapper">
                            <h2 class="related-products-title">Related Products</h2>
                            <div class="related-products-carousel">
                                @foreach ($products as $singleProduct)
                                <div class="single-product">
                                    <div class="product-f-image">
                                        <img src="/themes/ustora/img/{{$singleProduct->image}}.jpg" alt="">
                                        <div class="product-hover">
                                            <a href="" class="add-to-cart-link"><i class="fa fa-shopping-cart"></i> Add
                                                to cart</a>
                                            <a href="" class="view-details-link"><i class="fa fa-link"></i> See
                                                details</a>
                                        </div>
                                    </div>

                                    <h2><a href="/products/{{$singleProduct->id}}">{{$singleProduct->name}}</a></h2>

                                    <div class="product-carousel-price">
                                        <ins>${{$singleProduct->price}}</ins> <del>${{$singleProduct->discount}}</del>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('partials.footer')

    <!-- Latest jQuery form server -->
    <script src="https://code.jquery.com/jquery.min.js"></script>

    <!-- Bootstrap JS form CDN -->
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

    <!-- jQuery sticky menu -->
    <script src="/themes/ustora/js/owl.carousel.min.js"></script>
    <script src="/themes/ustora/js/jquery.sticky.js"></script>

    <!-- jQuery easing -->
    <script src="/themes/ustora/js/jquery.easing.1.3.min.js"></script>

    <!-- Main Script -->
    <script src="/themes/ustora/js/main.js"></script>

    <!-- Slider -->
    <script type="text/javascript" src="/themes/ustora/js/bxslider.min.js"></script>
    <script type="text/javascript" src="/themes/ustora/js/script.slider.js"></script>
</body>

</html>