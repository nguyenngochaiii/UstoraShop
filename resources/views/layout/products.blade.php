<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Shop</title>

    <!-- Google Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,200,300,700,600' rel='stylesheet'
        type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,100' rel='stylesheet' type='text/css'>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="./themes/ustora/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="./themes/ustora/css/font-awesome.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="./themes/ustora/css/owl.carousel.css">
    <link rel="stylesheet" href="./themes/ustora/style.css">
    <link rel="stylesheet" href="./themes/ustora/css/responsive.css">
</head>

<body>

    @include('partials.header')

    @include('partials.branding-area')

    @include('partials.mainmenu-area')

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
            <div class="row" style=" display: flex; flex-wrap: wrap;">
                @foreach ($products as $product)
                <div class="col-md-3 col-sm-6">
                    <div class="single-shop-product">
                        <div class="product-upper">
                            <a href="{{ route('products.show', $product->id)}}">
                                <img src="./themes/ustora/img/{{ $product->image}}.jpg" alt="">
                            </a>

                        </div>
                        <h2><a href="{{ route('products.show', $product->id)}}">{{ $product->name }}</a></h2>
                        <div class="product-carousel-price">
                            <ins>$ {{ $product->price }} </ins> <del>$999.00</del>
                        </div>

                        <div class="product-option-shop">
                            <a class="add_to_cart_button" data-quantity="1" data-product_sku=""
                                data-product_id="{{ $product->id }}" rel="nofollow">Add to cart</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="product-pagination text-center">
                        {{ $products->links('vendor.pagination.bootstrap-4')}}
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
    <script src="./themes/ustora/js/owl.carousel.min.js"></script>
    <script src="./themes/ustora/js/jquery.sticky.js"></script>

    <!-- jQuery easing -->
    <script src="./themes/ustora/js/jquery.easing.1.3.min.js"></script>

    <!-- Main Script -->
    <script src="./themes/ustora/js/main.js"></script>

    <!-- Slider -->
    <script type="text/javascript" src="./themes/ustora/js/bxslider.min.js"></script>
    <script type="text/javascript" src="./themes/ustora/js/script.slider.js"></script>

    <script src="{{ asset('js/order.js')}}"></script>
</body>

</html>