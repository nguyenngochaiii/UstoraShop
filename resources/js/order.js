const { data } = require("autoprefixer");

$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.add_to_cart_button').click(function () {
        var productID = $(this).data('product_id');
        var currentCartNumber = parseInt($('.product-count').text());
        currentCartNumber++;
        $('.product-count').text(currentCartNumber).show();

        var url = '/orders';
        var data = {
            'product_id': productID,
        };

        $.ajax({
            url: url,
            data: data,
            type: 'POST',
            success: function (result) {
                console.log('ajax suc');
            },
            error: function () {
                console.log('ajax err');
            }
        });
    });
});
