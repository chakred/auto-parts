<!-- Footer -->
<footer class="py-5 bg-dark" id="footer">
    <div class="container">
        <p class="m-0 text-center text-white">
            &copy;
            <strong>Privoz24</strong>
            <br/>
            {{date('Y')}}
        </p>
        @isset($viewNumbers)
            <p class="m-0 text-center text-white">
                <i class="fas fa-eye"></i>
                <span>{{$viewNumbers}}</span>
            </p>
        @endisset
    </div>
    <!-- /.container -->
</footer>
@include('parts.modal-windows.modal-shopping-cart')
<!-- Optional JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script
    src="https://code.jquery.com/jquery-3.4.0.min.js"
    integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg="
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="{{asset('js/web/modal-window.js')}}"></script>
<script src="{{asset('js/web/modal-window-cart.js')}}"></script>
</body>
</html>
