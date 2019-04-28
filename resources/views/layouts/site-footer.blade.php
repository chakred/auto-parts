<!-- Footer -->
<footer class="py-5 bg-dark" id="footer">
    <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Your Website 2017</p>
    </div>
    <!-- /.container -->
</footer>
<!-- Optional JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script
    src="https://code.jquery.com/jquery-3.4.0.min.js"
    integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg="
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.add').click(function () {
            if ($(this).prev().val() < 3) {
                $(this).prev().val(+$(this).prev().val() + 1);
            }
        });
        $('.sub').click(function () {
            if ($(this).next().val() > 1) {
                if ($(this).next().val() > 1) $(this).next().val(+$(this).next().val() - 1);
            }
        });
    });
</script>

<script>
    $(document).ready(function(){
        var goodsId = $('.define-goods').data('goods-id'),
            buttonBuy = $('.define-goods'),
            goodsName = $('#transferred-goods-name'),
            goodsImage = $('#transferred-goods-image'),
            goodsMark = $('#transferred-goods-mark'),
            goodsPrice = $('#transferred-goods-price'),
            form = $('#form-order-goods');

        buttonBuy.on('click',function (e) {
            goodsName.text($(this).data('goods-name'));
            goodsImage.attr('src', $(this).data('goods-image'));
            goodsMark.text($(this).data('goods-mark'));
            goodsPrice.text(form.find('input[type=number]').val() * $(this).data('goods-price')+'грн');
            $('#goods-id').val(goodsId);
        });

        form.submit(function(e) {
            e.preventDefault();
            form.find('button[type=submit]').attr('disabled', 'disabled');
            var request = $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "/goods/order",
                type: "POST",
                data: {
                    good_id : $('#goods-id').val(),
                    quantity: form.find('input[type=number]').val(),
                    buyer_name: form.find('input[type=text]').val(),
                    buyer_phone: form.find('input[type=phone]').val()
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

        function resetData(){
            $('.success-message').hide();
            $('.error-message').hide();
            form.find('button[type=submit]').removeAttr('disabled');
            form.show();
        }

    })
</script>
</body>
</html>
