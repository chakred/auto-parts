<div class="row">
        <div class="col-sm-12 mb-3">
            <div class="card head-block">
                <div>
                    <div>
                        <img src="{{env('APP_URL').'/storage/upload'.$model->img_path}}">
                    </div>
                    <p><span>Запчасти к</span> {{$model->autoMark->name_mark.' '.$model->name_model}}</p>
                </div>
            </div>
        </div>
    @forelse($relatedGoods as $goods)
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100 cat-block">
                <a href="{{ route('goods-single-site', ['subCategory' => $goods->id_sub_category, 'model' => $model->id, 'id' => $goods->id]) }}">
                    @if($goods->img_path)
                        <img width="200" src="{{env('APP_URL').'/storage/upload'.$goods->img_path}}">
                    @else
                        <img src="http://dummyimage.com/450x350/ffffff/545454&text=No+image" />
                    @endif
                </a>
                <div class="card-body">
                    <div class="card-title">
                        <h4>
                            <a href="{{ route('goods-single-site', ['subCategory' => $goods->id_sub_category, 'model' => $model->id, 'id' => $goods->id]) }}">{{$goods->name_good}}</a>
                        </h4>
                        <h6>{{$goods->cost}} грн.</h6>
                    </div>
                    <p class="card-text">
                        {{$goods->desc_good}}
                    </p>
                    <p class="card-text trade-mark">
                        TM {{$goods->mark_good}}
                    </p>
                </div>
                <div class="card-footer">
                   <a href="{{ route('goods-single-site', ['subCategory' => $goods->id_sub_category, 'model' => $model->id, 'id' => $goods->id]) }}" class="btn btn-success">Купить</a>
                </div>
            </div>
        </div>
    @empty
        <div class="col-sm-12 mb-3">
            Нет товаров
        </div>
    @endforelse
</div>
