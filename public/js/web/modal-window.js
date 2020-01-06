$(document).ready(function(){
    var goodsId = $('.define-goods').data('goods-id'),
        currencyName = $('.define-goods').data('currency-name'),
        fixedRateAtDate = $('.define-goods').data('fixed-rate'),
        buttonBuy = $('.define-goods'),
        goodsName = $('#transferred-goods-name'),
        goodsImage = $('#transferred-goods-image'),
        goodsMark = $('#transferred-goods-mark'),
        goodsPrice = $('#transferred-goods-price'),
        convertedPrice,
        calculatedPrice,
        goodsQuantity,
        form = $('#form-order-goods');


    var singleGoodsFormModal = function() {
        $('#goodsQuantity #add').on('click', function () {
            convertedPrice = goodsPrice.data('goods-price');
            goodsQuantity = parseInt(form.find('input[type=number]').val());
            if (goodsQuantity != null && goodsQuantity > 0 && goodsQuantity !== undefined && goodsQuantity != "") {
                goodsQuantity = parseInt(goodsQuantity);
                goodsQuantity = goodsQuantity >= 10 ? 10 : goodsQuantity;
                calculatedPrice = goodsQuantity * convertedPrice;
                goodsPrice.text(calculatedPrice +'грн');
            } else {
                goodsPrice.text(convertedPrice +'грн');
            }
        });

        $('#goodsQuantity #sub').on('click', function () {
            convertedPrice = goodsPrice.data('goods-price');
            goodsQuantity = parseInt(form.find('input[type=number]').val());
            if (goodsQuantity != null && goodsQuantity > 0 && goodsQuantity !== undefined && goodsQuantity != "") {
                goodsQuantity = parseInt(goodsQuantity);
                goodsQuantity = goodsQuantity <= 1 ? 1 : goodsQuantity;
                calculatedPrice = goodsQuantity * convertedPrice;
                console.log(convertedPrice);
                goodsPrice.text(calculatedPrice +'грн');
            } else {
                goodsPrice.text(convertedPrice +'грн');
            }
        });
    };

    $('#quantity').on('input', function () {
        if ($(this).val() != null && $(this).val() > 0 && $(this).val() !== undefined && $(this).val() != "") {
            calculatedPrice = $(this).val() * convertedPrice;
            goodsPrice.text(calculatedPrice +'грн');
        } else {
            goodsPrice.text(0 +'грн');
        }
    });

    var generaGoodsFormModal = function() {
        $('#field1 #add').on('click', function () {
            goodsQuantity = parseInt(form.find('input[type=number]').val());
            if (goodsQuantity != null && goodsQuantity > 0 && goodsQuantity !== undefined && goodsQuantity != "") {
                goodsQuantity = parseInt(goodsQuantity);
                goodsQuantity = goodsQuantity >= 10 ? 10 : goodsQuantity;
                calculatedPrice = goodsQuantity * convertedPrice;
                goodsPrice.text(calculatedPrice +'грн');
            } else {
                goodsPrice.text(convertedPrice +'грн');
            }
        });

        $('#field1 #sub').on('click', function () {
            goodsQuantity = parseInt(form.find('input[type=number]').val());
            if (goodsQuantity != null && goodsQuantity > 0 && goodsQuantity !== undefined && goodsQuantity != "") {
                goodsQuantity = parseInt(goodsQuantity);
                goodsQuantity = goodsQuantity <= 1 ? 1 : goodsQuantity;
                calculatedPrice = goodsQuantity * convertedPrice;
                goodsPrice.text(calculatedPrice +'грн');
            } else {
                goodsPrice.text(convertedPrice +'грн');
            }
        });
    };

    buttonBuy.on('click',function (e) {
        form.find('input[type=number]').val(1);
        goodsName.text($(this).data('goods-name'));
        goodsImage.attr('src', $(this).data('goods-image'));
        goodsMark.text($(this).data('goods-mark'));
        convertedPrice = $(this).data('goods-price');
        goodsPrice.text(form.find('input[type=number]').val() * $(this).data('goods-price') +'грн');
        $('#goods-id').val(goodsId);
        $('#currency-name').val(currencyName);
        $('#fixed-rate').val(fixedRateAtDate);
        $('#bought-price').val(convertedPrice);
    });

    form.submit(function(e) {
        e.preventDefault();
        form.find('button[type=submit]').attr('disabled', 'disabled');
        var request = $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "/products/order",
            type: "POST",
            data: {
                good_id : $('#goods-id').val(),
                quantity: form.find('input[type=number]').val(),
                bought_price: $('#bougth-price').val(),
                buyer_name: form.find('input[type=text]').val(),
                buyer_phone: form.find('input[type=phone]').val(),
                bought_price: $('#bought-price').val(),
                fixed_rate: $('#fixed-rate').val(),
                currency_name: $('#currency-name').val(),

            },
            dataType: "html"
        });

        request.done(function(msg) {
            form.hide();
            $('.success-message').show();
            setTimeout(resetData, 2000);
        });

        request.fail(function(jqXHR, textStatus) {
            form.hide();
            $('.error-message').show();
            setTimeout(resetData, 2000);
            console.log( "Request failed: " + textStatus );
        });
    });

    function resetData() {
        $('.success-message').hide();
        $('.error-message').hide();
        form.find('button[type=submit]').removeAttr('disabled');
        form.show();
    }

    function priceCounter() {
        $('.add').click(function () {
            if ($(this).prev().val() < 10) {
                $(this).prev().val(+$(this).prev().val() + 1);
            }
        });
        $('.sub').click(function () {
            if ($(this).next().val() > 1) {
                if ($(this).next().val() > 1) $(this).next().val(+$(this).next().val() - 1);
            }
        });
    }

    function init() {
        priceCounter();
        generaGoodsFormModal();
        singleGoodsFormModal();
    }
    init();
})
