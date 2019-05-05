<div class="row">
        <div class="col-sm-12 mb-3">
            <div class="card head-block">
                <div>
                    <div>
                        <img src="{{env('APP_URL').'/storage/upload'.$model->img_path}}">
                    </div>
                    <p><span>Категории запчастей к</span> {{$model->autoMark->name_mark.' '.$model->name_model}}</p>
                </div>
            </div>
        </div>
    @forelse($relCatCollection as $category)
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100 cat-block">
                <a href="{{ route('sub-categories-site', ['category' => $category->id , 'model' => $model->id]) }}">
                    @if($category->img_path)
                        <img width="200" src="{{env('APP_URL').'/storage/upload'.$category->img_path}}">
                    @else
                        <img src="http://dummyimage.com/450x350/ffffff/545454&text=No+image" />
                    @endif
                </a>
                <div class="card-footer">
                    <small class="text-muted"><a href="{{ route('sub-categories-site', ['category' => $category->id , 'model' => $model->id]) }}">{{$category->category}}</a></small>
                </div>
            </div>
        </div>
    @empty
        <div class="col-sm-12 mb-5">
        Нет категорий
        </div>
    @endforelse
</div>
