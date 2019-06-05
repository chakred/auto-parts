<div class="row">
        <div class="col-sm-12 mb-3">
            <div class="card head-block">
                <div>
                    <div>
                        <img src="{{env('APP_URL').'/storage/upload'.$model->img_path}}">
                    </div>
                    <p><span>Подкатегории запчастей к</span> {{$model->autoMark->name_mark.' '.$model->name_model}}</p>
                </div>
            </div>
        </div>
    @forelse($subCategories as $subCategory)
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100 cat-block">
                <a href="{{ route('goods-site', ['subCategory' => $subCategory->id , 'model' => $model->id]) }}">
                    @if($subCategory->img_path)
                        <img src="{{env('APP_URL').'/storage/upload'.$subCategory->img_path}}">
                    @else
                        <img src="http://dummyimage.com/450x350/ffffff/545454&text=No+image" />
                    @endif
                </a>
                <div class="card-footer">
                    <small class="text-muted"><a href="{{ route('goods-site', ['subCategory' => $subCategory->id , 'model' => $model->id]) }}">{{$subCategory->sub_category}}</a></small>
                </div>
            </div>
        </div>
    @empty
        Нет подкатегорий
    @endforelse
</div>
