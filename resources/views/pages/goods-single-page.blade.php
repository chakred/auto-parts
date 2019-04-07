@include('layouts.site-header')

<!-- Page Content -->
<div class="container">

    <div class="row" style="margin-top: 100px">

        <div class="col-lg-4">
            {{--<div class="list-group">--}}
            {{--<a href="#" class="list-group-item">Category 1</a>--}}
            {{--<a href="#" class="list-group-item">Category 2</a>--}}
            {{--<a href="#" class="list-group-item">Category 3</a>--}}
            {{--</div>--}}
            <div class="card mb-3 goods-image">
                @if($relatedGoods->img_path)
                    <img width="200" src="{{env('APP_URL').'/storage/upload'.$relatedGoods->img_path}}">
                @else
                    <img src="http://dummyimage.com/450x350/ffffff/545454&text=No+image" />
                @endif
            </div>
            {{--@include('parts.sidebar_marks-and-models')--}}

        </div>
        <!-- /.col-lg-3 -->

        @include('parts.content-goods-single')

    </div>
    <!-- /.row -->

</div>
<!-- /.container -->

@include('layouts.site-footer')
