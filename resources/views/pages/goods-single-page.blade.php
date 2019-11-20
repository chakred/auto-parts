@include('layouts.site-header')

<!-- Page Content -->
<div class="container">

    <div class="row" style="margin-top: 100px">

        <div class="col-lg-4">
            <div>
                <div class="card head-block mb-3">
                    <div>
                        <a href="{{ URL::previous() }}" class="badge badge-dark" style="font-size: 25px; margin: 6px 5px;">
                            <i class="fas fa-long-arrow-alt-left"></i>
                        </a>
                        <span> Вернуться назад</span>
                    </div>
                </div>
            </div>
            {{--<a href="#" type="button" class="btn btn-dark mb-3">--}}
                {{--<div class="col-lg-12">Назад</div>--}}
            {{--</a>--}}

            <div class="card mb-3 goods-image">
                @if($relatedGoods->img_path)
                    <img width="200" src="{{env('APP_URL').'/storage/upload'.$relatedGoods->img_path}}">
                @else
                    <img src="http://dummyimage.com/250x240/ffffff/545454&text=No+image" />
                @endif
            </div>
            @include('parts.sidebar_working-hours')
            <br/>
            @include('parts.sidebar_contacts')
        </div>
        <!-- /.col-lg-3 -->

        @include('parts.content-goods-single')

    </div>
    <!-- /.row -->

</div>
<!-- /.container -->

@include('layouts.site-footer')
