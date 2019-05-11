@include('layouts.site-header')

<!-- Page Content -->
<div class="container">

    <div class="row" style="margin-top: 100px">

        <div class="col-lg-4">
            <div class="card mb-3 goods-image">
                @if($relatedGoods->img_path)
                    <img width="200" src="{{env('APP_URL').'/storage/upload'.$relatedGoods->img_path}}">
                @else
                    <img src="http://dummyimage.com/250x240/ffffff/545454&text=No+image" />
                @endif
            </div>
            @include('parts.sidebar_contacts')
            <br/>
            @include('parts.sidebar_working-hours')
        </div>
        <!-- /.col-lg-3 -->

        @include('parts.content-goods-single')

    </div>
    <!-- /.row -->

</div>
<!-- /.container -->

@include('layouts.site-footer')
