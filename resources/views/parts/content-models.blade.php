@forelse($marks as $mark)
<div class="row">
    <div class="col-sm-12 mb-3">
        <div class="card head-block">
            <div>
                <div>
                    <img src="{{env('APP_URL').'/storage/upload'.$mark->img_path}}">
                </div>
                <p>{{$mark->name_mark}}</p>
            </div>
        </div>
    </div>
    @forelse($mark->autoModels as $models)
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100 cat-block">
                <a href="{{ route('categories-site',['id' => $models->id]) }}">
                    @if($models->img_path)
                        <img src="{{env('APP_URL').'/storage/upload'.$models->img_path}}">
                    @else
                        <img src="http://dummyimage.com/450x350/ffffff/545454&text=No+image" />
                    @endif
                </a>
                <div class="card-body">
                    <h5 class="card-title">
                        <a href="{{ route('categories-site',['id' => $models->id]) }}">{{$mark->name_mark.' '.$models->name_model}}</a>
                    </h5>
                </div>
                <div class="card-footer">
                    <small class="text-muted">Год выпуска: {{$models->last_year?$models->year.' - '.$models->last_year.'г.':$models->last_year.'г.'}}</small>
                </div>
            </div>
        </div>
    @empty
        <div class="col-sm-12">
            <p>Нет моделей данной марки</p>
        </div>
    @endforelse
</div>
@empty
    <div class="col-sm-12">
        <p>моделей данной марки</p>
    </div>
@endforelse
